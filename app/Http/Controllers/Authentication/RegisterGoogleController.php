<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Database\UserTable;
use App\Repositories\Session\AuthSession;

class RegisterGoogleController extends Controller
{
  protected $user;
  protected $session;

  public function __construct()
  {
    $this->user   =  new UserTable;
    $this->session   =  new AuthSession;
  }

    public function index()
    {
      // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');
        $userSesseion = (object)$this->session->GetAuthUser();
        $user  =  $this->user->UserWhere('email',$userSesseion->email);

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
      $user = (object)$this->session->GetAuthUser();

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
          return redirect()->back()->with('errors', ['Invalid PIN']);
        }
    }

    public function updateuser($secret)
    {
      try {
        $user = (object)$this->session->GetAuthUser();
        $dataupdate = array('google2fa_secret_verified' => $secret);
        $user  =  $this->user->UserUpdate($user->email,$dataupdate);
        if ($user) {
          return true;
        }else {
          return 'filed update data';
        }
      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
}
