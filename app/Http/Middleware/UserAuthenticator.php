<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Database\UserTable;
use App\Repositories\Session\AuthSession;

class UserAuthenticator
{
    protected $user;
    protected $session;

    public function __construct()
    {
      $this->user   =  new UserTable;
      $this->session   =  new AuthSession;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $user = (object)$this->session->GetAuthUser();
      $valid = $this->user->UserWhere('email',$user->email);
      if ($valid->google2fa_secret_verified) {
        return $next($request);
      }else {
        return redirect()->route('register.author');
      }
    }
}
