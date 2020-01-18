<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;
use App\detailMessage;

class DetailMessageTable
{
	public function DetailMessageAll()
	{
		try {
			$detailMessage = detailMessage::get();
			return $detailMessage;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function DetailMessageWhere($messageId)
	{
		try {
			$detailMessage = detailMessage::where('message_id',$messageId);
			return $detailMessage;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}


	/**
	 * insert to table user
	 * $data should array() type
	 */
	public function DetailMessageInsert($data)
	{
		try {
			$detailMessage = auth()->user()->detailMessages()->create(
				$data
			);
			return $detailMessage;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
	public function UpdateMessageWhere($id,$data)
	{
		try {
			$detailMessage = detailMessage::where('message_id',$id)->update(
				$data
			);
			return $detailMessage;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
}
