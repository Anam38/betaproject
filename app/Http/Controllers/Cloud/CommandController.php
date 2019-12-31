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
      try {
        if ($this->Session->HasSession('cloud')) {
          $session = $this->Session->GetSession('cloud');
          // login server
          $this->ssh = $this->SSH2->Login($session->ip_address,$session->port,$session->username,$session->password);
          // running command
          $this->command(strtolower($request->command) );
          $data = array(
            'id' => $request->id,
            'location' => ''
          );
          return view('contents.cloud.command')->with($data);
        }else {
          $cloud = $this->cloud->Cloudwhere($request->id);
          $data = $cloud->first();
          $session = $this->Session->PutSession('cloud',$data);
          // // login server
          $this->ssh = $this->SSH2->Login($data->ip_address,$data->port,$data->username,$data->password);
          // running command
          $this->command(strtolower($request->command));
          $data = array(
            'id' => $request->id,
            'location' => '1'
          );
          return view('contents.cloud.command')->with($data);
        }
      } catch (\Exception $e) {
        return response()->json(false);
      }
    }

    public function runcommand(Request $request)
    {
      $session = $this->Session->GetSession('cloud');
      // login server
      $this->ssh = $this->SSH2->Login($session->ip_address,$session->port,$session->username,$session->password);
      // running command
      $command = $this->command(strtolower($request->command));
      return response()->json($command);
    }

    public function command($command)
    {
      try {
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
              $sessionOutput = $this->Session->PutSession('output',array());
            }else {
              if (strpos($command, 'cd') !== false) {
                $command = str_replace('cd','',$command);
                $command = str_replace(' ','',$command);
                if ($command == '~'){
                  $this->Session->PutSession('cwd','');
                  $pwd = $this->ssh->exec('cd ~; pwd');
                  $pwd = trim(preg_replace('/\s+/', ' ', $pwd));
                  $pwdname = $pwd;
                  $command = '';
                }elseif (strpos($command, '..') !== false) {
                  $command = str_replace(' ','',$sessionCwd).($sessionCwd ? '/' :'').$command;
                  $pwd = $this->ssh->exec('cd '.$command.'; pwd');
                  $pwdname = trim(preg_replace('/\s+/', ' ', $pwd));
                  $this->Session->PutSession('cwd',$command);
                  $command = '';
                }else {
                  $command = str_replace(' ','',$sessionCwd).($sessionCwd ? '/' :'').$command;
                  $pwd = $this->ssh->exec('cd '.$command.'; pwd');
                  $pwd = trim(preg_replace('/\s+/', ' ', $pwd));
                  if (strpos($pwd, 'bash: line 0:') === false) {
                    $this->Session->PutSession('cwd',$command);
                    $command = $this->ssh->exec('cd '.$sessionCwd);
                    $pwdname = $pwd;
                  }else {
                    $command = 'No such file or directory';
                  }
                }

                $this->Session->PutSession('cwd_name',$pwdname);

              }elseif ($command == 'history') {
                $i = 1 ;
                $hisdata = array();
                foreach ($sessionHistory as $histline) {
                    $hisdata[] = $i.'  '.$histline;
                    $i++;
                }
                $sessionOutput->push($hisdata);
              }else {
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
        $data = array(
          'sessionCwdname' => $this->Session->GetSession('cwd_name'),
          'sessionOutput' => $sessionOutput,
        );
        return response()->json($data);
      } catch (\Exception $e) {
        return response()->json($e->getMessage());
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

    public function getLocation(Request $request)
    {
      try {
        $data = $session = $this->Session->GetSession('cloud');
        // login server
        $this->ssh = $this->SSH2->Login($data->ip_address,$data->port,$data->username,$data->password);
        $location = $this->SSH2->getLocation($this->ssh,$data->ip_address);
        return response()->json($this->Session->GetSession('location'));
      } catch (\Exception $e) {
        return response()->json($e->getMessage());
      }
    }
}
