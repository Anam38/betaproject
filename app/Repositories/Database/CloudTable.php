<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

class CloudTable
{
	public function Cloudall()
	{
		try {
			$cloud = DB::table('cloud')->get();
			return $cloud;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function Cloudwhere($id)
	{
		try {
			$cloud = DB::table('cloud')->where('id',$id)->get();
			return $cloud;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
	/**
	 * insert to table user
	 * $data should array() type
	 */
	public function CloudInsert($data)
	{
		try {
			$user = DB::table('cloud')->insert([
					'connection_name'	=> $data['connection_name'],
					'ip_address'			=> $data['ip_address'],
					'port'						=> $data['port'],
					'username'				=> $data['username'],
					'password'				=> $data['password'],
					'directory'				=> $data['directory'],
					'isactive'				=> $data['status'],
			]);
			return 'success';
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
	/**
	 * insert to table user
	 * $data should array() type
	 */
	public function CloudUpdate($data)
	{
		try {
			$user = DB::table('cloud')->where('id',$data['id'])->update([
					'connection_name'	=> $data['connection_name'],
					'ip_address'			=> $data['ip_address'],
					'port'						=> $data['port'],
					'username'				=> $data['username'],
					'password'				=> $data['password'],
					'directory'				=> $data['directory'],
					'isactive'				=> $data['status'],
			]);
			return 'success';
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
	/**
	 * insert to table user
	 * $data should array() type
	 */
	public function CloudDelete($id)
	{
		try {
			$user = DB::table('cloud')->where('id',$id)->delete();
			return 'success';
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
}
