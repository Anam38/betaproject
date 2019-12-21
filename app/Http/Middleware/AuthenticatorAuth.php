<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthenticatorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $user = (object)Session::get('authuser');
      $valid = DB::table('users')->where('email',$user->email)->first();
        if (Session::has('authenticator')) {
            $userAuthenticator = Session::get('authenticator');
            if ($userAuthenticator == base64_encode($valid->google2fa_secret)) {
              return $next($request);
            }
            return redirect()->route('login.author');
        }else {
            return redirect()->route('login.author');
        }
    }
}
