<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Database\UserTable;
use App\Repositories\Session\AuthSession;

class RegisterController extends Controller
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
    return view('contents.auth.register');
  }
  public function register(Request $request)
  {
    $validator = \Validator::make($request->all(), [
        'username' => 'required',
        'password' => 'required',
        'validation' => 'required|captcha',
      ]);
      if ($validator->fails())
      {
        $error = collect();
        $error->put('errors',$validator->errors()->all());
        return response()->json($error);
      }

      try {
        // $google2fa = app('pragmarx.google2fa');
        //// Add the secret key to the registration data
        // $secret = $google2fa->generateSecretKey();
        $secret = base64_encode('data');
        // data to insert to table user
        $datauser = array(
          'name'      => $request->username,
          'email'     => $request->email,
          'password'  => Hash::make($request->password),
          'google2fa_secret' => $secret
        );
        // insert to table user
        $validinsert = $this->user->UserInsert($datauser);
        if ($validinsert) {
          $datasession = array(
            'username'  => $request->username,
            'email' => $request->email,
            'go_secret' => $secret,
            'token' => base64_encode($request->username.$request->email)
          );
          // save session user
          $this->session->StoreAuthUser($datasession);
          return response()->json(collect()->put('success','success'));
        }else {
          return response()->json(collect()->put('errors','Something wrong'));
        }
    } catch (\Exception $e) {
      $error = collect();
      $error->put('errors',$e->getMessage());
      return response()->json($error);
    }

  }
  public function checkPasswordFormat(Request $request)
  {
      $password = $request->password;
      $username = ($request->username ? $request->username : ' ');
      $checkUpper = preg_match('/[A-Z]/', $password);
      $checkLower = preg_match('/[a-z]/', $password);
      $checkAlpha = preg_match('/[a-zA-Z]/', $password);
      $checkNumeric = preg_match('/[0-9]/', $password);
      $checkSymbol = preg_match('/[$%(),|=!*~`^_@.\/#&+-]/', $password);
      $checkSpace = preg_match("/[ ]/",$password);

       // && stristr($password,$username) === false
      if ($checkAlpha && $checkNumeric && $checkSymbol && !$checkSpace && strlen($password) >= '6')
        return response()->json(['valid' => true]);
      else
        return response()->json(['valid' => false]);
  }
}
