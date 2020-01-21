<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;
use App\Message;

class MessageTable
{
	public function MessageAll()
	{
		try {
			$message = Message::get();
			return $message;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function MessageWhere($userId)
	{
		try {
			$message = Message::where('user_id_1',$userId)->orWhere('user_id_2', $userId);
			return $message;
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
			$message = Message::create(
				$data
			);
			return $message;
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
}
