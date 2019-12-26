<?php

namespace App\Http\Controllers\Cloud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Database\CloudTable;
use App\Repositories\SSH2\Connection;
use App\Repositories\Session\OtherSession;
use Illuminate\Support\Facades\Cache;

class CommandController extends Controller
{
    protected $cloud;
    protected $SSH2;
    protected $Session;
    protected $ssh;
    //
    public function __construct()
    {
      $this->cloud   =  new CloudTable;
      $this->SSH2   =  new Connection;
      $this->Session   =  new OtherSession;
    }

    public function index(Request $request)
    {
      if ($this->Session->HasSession('cloud')) {
        $session = $this->Session->GetSession('cloud');
        // login server
        $this->ssh = $this->SSH2->Login($session->ip_address,$session->port,$session->username,$session->password);
        // running command
        $this->command($request->command);
        return view('contents.cloud.command');
      }else {
        $cloud = $this->cloud->Cloudwhere($request->id);
        $data = $cloud->first();
        $session = $this->Session->PutSession('cloud',$data);
        // login server
        $this->ssh = $this->SSH2->Login($data->ip_address,$data->port,$data->username,$data->password);
        // get location server
        $information = $this->SSH2->getLocation($this->ssh,$data->ip_address);
        // running command
        $this->command($request->command);
        return view('contents.cloud.command');
      }
    }
    public function command($command)
    {
      // $this->Session->PutSession('cwd','');
      // $this->Session->PutSession('cwd_name','anam');

      // get session info data cloud from database
      $sessionTable = $this->Session->GetSession('cloud');
      $sessionOutput = collect($this->Session->GetSession('output'));
      $sessionHistory = collect($this->Session->GetSession('history'));
      $sessionCwd = $this->Session->GetSession('cwd');
      $sessionCwdname = $this->Session->GetSession('cwd_name');
      // put to session history
      $sessionHistory->push($command);
      $sessionOutput->push('~'.$sessionCwdname.'$ '.$command);
      if ($this->Session->HasSession('firstcommand')) {
        if($command){
          if ($command =='clear') {
            $this->Session->PutSession('output',array());
          }else {
            if (strpos($command, 'cd') !== false) {
              $command = str_replace('cd','',$command);
              $command = str_replace(' ','',$command);
              if (strpos($command, '..') !== false) {
                $commands = $this->ssh->exec('cd '.$command.'; ls pwd');
                $commands = str_replace('\n','',$command);
                $command = str_replace(' ','',$sessionCwd).($sessionCwd ? '/' :'').$command;
              }else {
                $commands = $command;
                $command = str_replace(' ','',$sessionCwd).($sessionCwd ? '/' :'').$command;
              }
                $this->Session->PutSession('cwd',$command);
                $command = $this->ssh->exec('cd '.$sessionCwd);
                $pwd = $this->ssh->exec('cd '.$sessionCwd.'; pwd');
                $pwd = str_replace('\n','',$pwd);
                $this->Session->PutSession('cwd_name',$pwd);
            }elseif ($command == 'history') {
              $sessionOutput->push($sessionHistory);
            }else {
              // $command = $this->ssh->exec('cd public_html/exlampleproject/..; ls; pwd');
              $command = $this->ssh->exec('cd '.$sessionCwd.'; '.$command);
            }
            $sessionOutput->push($command);
            // save session history input and output command
            $this->Session->PutSession('output',$sessionOutput->toArray());
            $this->Session->PutSession('history',$sessionHistory->toArray());
          }
        }
      }else {
        $this->Session->PutSession('firstcommand','1');
        $this->Session->PutSession('cwd',$sessionTable->directory);
        $this->Session->PutSession('cwd_name',$sessionTable->directory);
      }
    }
    public function getInformation()
    {
      if ($this->Session->HasSession('cloud')) {
        $session = $this->Session->GetSession('cloud');
        $this->ssh = $this->SSH2->Login($session->ip_address,$session->port,$session->username,$session->password);
        $information = $this->SSH2->getInformation($this->ssh);
        return response()->json($information);
      }else {
        return response()->json(false);
      }
    }
}
