<?php

namespace App\Repositories\Session;

use Illuminate\Support\Facades\Session;

class AuthSession
{
	public $authuser = 'authuser';
	public $authenticator = 'authenticator';

	function __construct()
	{
	}

	public function StoreAuthUser($data)
	{
		$session = Session::put($this->authuser,$data);
	}

	public function GetAuthUser()
	{
		$session = Session::get($this->authuser);
		return $session;
	}

	public function HashAuthUser()
	{
		return Session::has($this->authuser);
	}

	public function StoreAuthenticator($data)
	{
		Session::put($this->authenticator,$data);
	}

	public function GetAuthenticator()
	{
		$session = Session::get($this->authenticator);
		return $session;
	}

	public function HashAuthenticator()
	{
		return Session::has($this->authenticator);
	}
	
	public function flushSession()
	{
		Session::flush();
	}
}
