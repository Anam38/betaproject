<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginGoogleController extends Controller
{
    public function index()
    {
      return view('contents.authgoogle.login');
    }

    public function login(Request $request)
    {
      $google2fa = app('pragmarx.google2fa');
      $validator = \Validator::make($request->all(), [
          'pin' => 'required',
        ]);
        if ($validator->fails())
        {
          return redirect()->back()->with('errors', $validator->errors()->all());
        }
        $user = (object)Session::get('authuser');
        $secret = $user->go_secret;
        $pin = $request->pin;
        $valid = $google2fa->verifyKey($secret, $pin);
        if ($valid) {
          // save session sutenticator 
          Session::put('authenticator',base64_encode($secret));
          return redirect()->route('command.index');
        }else {
          return redirect()->back()->with('errors',['Invalid PIN']);
        }
    }
}
