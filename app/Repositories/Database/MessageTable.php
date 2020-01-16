<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

class MessageTable
{

	function __construct()
	{
		# code...
	}
	public function MessageAll()
	{
		try {
			$user = DB::table('messages')->get();
			return $user;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function MessageWhere($where,$email)
	{
		try {
			$user = DB::table('messages')->where($where,$email)->first();
			return $user;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * insert to table user
	 * $data should array() type
	 */
	public function MessageInsert($data)
	{
		try {
			$user = DB::table('messages')->insert(
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
	public function MessageDelete($email)
	{
		try {
			$user = DB::table('messages')->where('email',$email)->delete();
			return true;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
}
