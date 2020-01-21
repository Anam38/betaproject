<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Database\UserTable;
use App\Repositories\Session\AuthSession;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  use AuthenticatesUsers;
  protected $user;
  protected $session;

  public function __construct()
  {
    $this->user   =  new UserTable;
    $this->session   =  new AuthSession;
  }

  public function index()
  {
    return view('contents.auth.login');
  }
  public function login(Request $request)
  {
    try {
        $validator = \Validator::make($request->all(), [
          'email' => 'required',
          'password' => 'required',
          'validation' => 'required|captcha',
        ]);
        if ($validator->fails())
        {
          return redirect()->back()->with('errors', $validator->errors()->all());
        }
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

      } catch (\Exception $e) {
        return redirect()->back()->with('errors', [$e->getMessage()]);
      }

    // $validator = \Validator::make($request->all(), [
    //     'username' => 'required',
    //     'password' => 'required',
    //     'validation' => 'required|captcha',
    //   ]);
    //   if ($validator->fails())
    //   {
    //     return redirect()->back()->with('errors', $validator->errors()->all());
    //   }
    //   // check to table user
    //   try {
    //     $user  =  $this->user->UserWhere('name',$request->username);
    //     if ($user != null) {
    //       if (Hash::check($request->password, $user->password)) {
    //         $datasession = array(
    //             'id'  => $user->id,
    //             'username'  => $user->name,
    //             'email' => $user->email,
    //             'go_secret' => $user->google2fa_secret,
    //             'token' => base64_encode($user->name.$user->email)
    //         );
    //         Auth::login($user);
    //         // save session user
    //         $this->session->StoreAuthUser($datasession);
            // return redirect()->route('home');
    //       }else {
    //         return redirect()->back()->with('errors', ['Invalid Username or password']);
    //       }
    //     }else {
    //       return redirect()->back()->with('errors', ['Invalid Username or password']);
    //     }
    //   } catch (\Exception $e) {
    //     return redirect()->back()->with('errors', [$e->getMessage()]);
    //   }
  }
  public function logout()
  {
    Auth::logout();
    // $this->session->flushSession();
    return redirect()->route('login.index');
  }
}
