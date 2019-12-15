<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

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
       Auth::login($request->username, true);
      dd(Auth::user());
  }
}
