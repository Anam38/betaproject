<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Session\AuthSession;

class LoginGoogleController extends Controller
{
    protected $session;

    public function __construct()
    {
      $this->session   =  new AuthSession;
    }

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
        $user = (object)$this->session->GetAuthUser();
        $secret = $user->go_secret;
        $pin = $request->pin;
        $valid = $google2fa->verifyKey($secret, $pin);
        if ($valid) {
          // save session sutenticator
          $this->session->StoreAuthenticator(base64_encode($secret));
          return redirect()->route('command.index');
        }else {
          return redirect()->back()->with('errors',['Invalid PIN']);
        }
    }
}
