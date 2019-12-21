<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  public function index()
  {
    return view('contents.auth.login');
  }
  public function login(Request $request)
  {
    $validator = \Validator::make($request->all(), [
        'username' => 'required',
        'password' => 'required',
        'validation' => 'required|captcha',
      ]);
      if ($validator->fails())
      {
        return redirect()->back()->with('errors', $validator->errors()->all());
      }
      // check to table user
      try {
        $user  =  DB::table('users')->where('name',$request->username)->first();
        if ($user != null) {
          if (Hash::check($request->password, $user->password)) {
            $datauth = array(
                'username'  => $user->name,
                'email' => $user->email,
                'go_secret' => $user->google2fa_secret,
                'token' => base64_encode($user->name.$user->email)
            );
            // save session user
            Session::put('authuser',$datauth);
            return redirect()->route('home');
          }else {
            return redirect()->back()->with('errors', ['Invalid Username or password']);
          }
        }else {
          return redirect()->back()->with('errors', ['Invalid Username or password']);
        }
      } catch (\Exception $e) {
        // dd($e);
        return redirect()->back()->with('errors', ['Something wrong connect to DB']);
      }
  }
  public function logout()
  {
    Session::flush();
    return redirect()->route('login.index');
  }
}
