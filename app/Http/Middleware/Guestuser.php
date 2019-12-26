<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Session\AuthSession;

class Guestuser
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
        return redirect()->route('home');
      }else {
        return $next($request);
      }
    }
}
