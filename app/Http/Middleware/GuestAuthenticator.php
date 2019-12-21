<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GuestAuthenticator
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
      if ($valid->google2fa_secret_verified) {
        return redirect()->back();
      }else {
        return $next($request);
      }
    }
}
