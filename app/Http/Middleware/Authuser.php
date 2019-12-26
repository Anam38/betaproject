<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Session\AuthSession;

class Authuser
{
    protected $session;

    public function __construct()
    {
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
      if ($this->session->HashAuthUser()) {
        return $next($request);
      }else {
        return redirect()->route('login.index');
      }
    }
}
