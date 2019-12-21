<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegisterGoogleController extends Controller
{
    public function index()
    {
      // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');
        $userSesseion = (object)Session::get('authuser');
        $user  =  DB::table('users')->where('email',$userSesseion->email)->first();

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->name,
            $user->google2fa_secret
        );

        $data = array(
          'QR_Image' => $QR_Image,
          'secret' => $user->google2fa_secret
        );
        // Pass the QR barcode image to our view
      return view('contents.authgoogle.register')->with($data);
    }

    public function submitRegister(Request $request)
    {
      $google2fa = app('pragmarx.google2fa');
      // get data user from session
      $user = (object)Session::get('authuser');

      $validator = \Validator::make($request->all(), [
          'pin' => 'required',
          'secret' => 'required',
        ]);
        if ($validator->fails())
        {
          return redirect()->back()->with('errors', $validator->errors()->all());
        }
        $pin = $request->pin;
        $secret = $request->secret;
        // validation key from Authenticator
        $valid = $google2fa->verifyKey($secret, $pin);
        if ($valid) {
            // update user to input secret token google authenticator and update session user
            $updateuser = $this->updateuser('1');
            // data for save to session
            if ($updateuser) {
              return redirect()->route('login.author');
            }else {
              return redirect()->back()->with('errors', [$updateuser]);
            }
        }else {
          return redirect()->back()->with('errors', ['PIN Invalid']);
        }
    }

    public function updateuser($secret)
    {
      try {
        $user = (object)Session::get('authuser');
        $user  =  DB::table('users')->where('email',$user->email);
        $user->update([
          'google2fa_secret_verified' => $secret
        ]);
        return true;
      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
}
