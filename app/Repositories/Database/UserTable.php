<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

class UserTable
{

	function __construct()
	{
		# code...
	}

	public function UserAll()
	{
		try {
			$user = DB::table('users')->get();
			return $user;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function UserWhere($where,$email)
	{
		try {
			$user = DB::table('users')->where($where,$email)->first();
			return $user;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * insert to table user
	 * $data should array() type
	 */
	public function UserInsert($data)
	{
		try {
			$user = DB::table('users')->insert(
				$data
			);
			return true;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
	/**
	 * insert to table user
	 * $data should array() type
	 * $email type email
	 */
	public function UserUpdate($email,$data)
	{
		try {
			$user = DB::table('users')->where('email',$email);
			$user->update(
				$data
			);
			return true;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
	/**
	 * insert to table user
	 * $data should array() type
	 * $email type email
	 */
	public function UserDelete($email)
	{
		try {
			$user = DB::table('users')->where('email',$email)->delete();
			return true;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function JoinToMessage()
	{
		try {
			$user = DB::table('users')
						->leftJoin('messages', 'users.id', '=', 'messages.user_id')
						->get();
			// $user = DB::table('users')
			// 			->leftJoin('messages', 'users.id', '=', 'messages.user_id')
			// 			->get();
			return $user;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
}
