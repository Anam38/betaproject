<?php

namespace App\Http\Middleware;

use App\Repositories\Database\UserTable;
use App\Repositories\Session\AuthSession;
use Closure;

class AuthenticatorAuth
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
        if ($this->session->HashAuthenticator()) {
            $userAuthenticator = $this->session->GetAuthenticator();
            if ($userAuthenticator == base64_encode($valid->google2fa_secret)) {
              return $next($request);
            }
            return redirect()->route('login.author');
        }else {
            return redirect()->route('login.author');
        }
    }
}
