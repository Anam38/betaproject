<?php

namespace App\Repositories\Session;

use Illuminate\Support\Facades\Session;

class OtherSession
{

	function __construct()
	{
	}

	public function PutSession($key,$data)
	{
		Session::put($key,$data);
	}

	public function HasSession($key)
	{
		return Session::has($key);
	}

	public function GetSession($key)
	{
		$session = Session::get($key);
		return $session;
	}

	public function ForgetSession($key)
	{
		Session::forget($key);
	}

	public function flushSession()
	{
		Session::flush();
	}
}
