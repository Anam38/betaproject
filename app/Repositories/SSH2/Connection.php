<?php

namespace App\Repositories\SSH2;

use phpseclib\Net\SSH2;
use App\Repositories\Session\OtherSession;

class Connection
{
	protected $Session;

	function __construct()
	{
		$this->Session   =  new OtherSession;
	}

	public function Login($ip_address,$port,$username,$password)
	{
		try {
			$ssh = new SSH2($ip_address,$port);
			if (!$ssh->login($username, $password)) {
				return false;
			}else {
				// $this->getInformation($ssh,$ip_address);
				return $ssh;
			}
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
	public function getInformation($ssh)
	{
		// cpu speed
		$cpu_speed = $ssh->exec("lscpu | grep MHz | sed 's/^.*: //'");
		// memory
		$memory = $ssh->exec('free -m | grep Mem | sed "s/^.*: //"');
		// dd($ssh->exec('cat /proc/meminfo; free -m'));
		$memory = trim(preg_replace('/\s+/', ' ', $memory));
		$memory = explode(' ',$memory);
		// hostname
		$host_name = $ssh->exec('hostnamectl |grep "Static hostname" | sed "s/^.*: //"');
		// opration system
		$operation_system = $ssh->exec('hostnamectl |grep "Operating System" | sed "s/^.*: //"');
		$operation_system = trim(preg_replace('/\s+/', ' ', $operation_system));
		// Bytes
		$operation_system = $operation_system.' '.$ssh->exec('hostnamectl |grep "Architecture" | sed "s/^.*: //"');
		// disck_count
		$disk = $ssh->exec('df -h --total | grep "total" | sed "s/total //"');
		$disk = trim(preg_replace('/\s+/', ' ', $disk));
		$disk = explode(' ',$disk);

		$data = array(
			'host_name'	=> $host_name,
			'cpu_speed'	=> $cpu_speed,
			'memory'	=> $memory,
			'operation_system'	=> $operation_system,
			'disck'	=> $disk,
		);
		return $data;
	}

	public function getLocation($ssh,$ip_address)
	{
		// command bash get location
		$location = $ssh->exec('curl -s https://ipvigilante.com/'.$ip_address);
		$location = json_decode($location);
		// save session location
		$this->Session->PutSession('location',$location);
	}
}
