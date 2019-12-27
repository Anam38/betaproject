<?php

namespace App\Http\Controllers\Cloud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Database\CloudTable;
use App\Repositories\SSH2\Connection;
use App\Repositories\Session\OtherSession;

class CloudController extends Controller
{
  protected $cloud;
  protected $SSH2;
  protected $session;

  public function __construct()
  {
    $this->cloud   =  new CloudTable;
    $this->SSH2   =  new Connection;
    $this->session   =  new OtherSession;
  }
    public function index()
    {
      // delete session on command line
      $this->ForgetSession_command();
      $cloud = $this->cloud->Cloudall();
      $data = array(
        'cloud' => $cloud,
      );
      return view('contents.cloud.index')->with($data);
    }

    public function insert(Request $request)
    {
      $validator = \Validator::make($request->all(), [
          'connection_name' => 'required',
          'ip_address' => 'required',
          'port' => 'required',
          'username' => 'required',
          'password' => 'required',
          'status' => 'required',
        ]);
      if ($validator->fails())
      {
        return redirect()->back()->with('errors', $validator->errors()->all());
      }
      // inser data
      $cloud = $this->cloud->CloudInsert($request->all());
      if ($cloud == 'success') {
        return redirect()->back()->with('success','Insert Successfully');
      }else {
        return redirect()->back()->with('errors', [$cloud]);
      }
    }

    public function getdata(Request $request)
    {
      $cloud = $this->cloud->Cloudwhere($request->id);
      $data = $cloud->first();
      return response()->json($data);
    }

    public function update(Request $request)
    {
      $validator = \Validator::make($request->all(), [
          'id' => 'required',
          'connection_name' => 'required',
          'ip_address' => 'required',
          'port' => 'required',
          'username' => 'required',
          'password' => 'required',
          'status' => 'required',
        ]);
      if ($validator->fails())
      {
        return redirect()->back()->with('errors', $validator->errors()->all());
      }
      // update data
      $cloud = $this->cloud->CloudUpdate($request->all());
      if ($cloud == 'success') {
        return redirect()->back()->with('success','Update Successfully');
      }else {
        return redirect()->back()->with('errors', [$cloud]);
      }
    }

    public function delete(Request $request)
    {
      // update data
      $cloud = $this->cloud->CloudDelete($request->id);
      if ($cloud == 'success') {
        return redirect()->back()->with('success','Delete Successfully');
      }else {
        return redirect()->back()->with('errors', [$cloud]);
      }
    }

    public function testConnection(Request $request)
    {
      $validator = \Validator::make($request->all(), [
          'ip_address' => 'required',
          'port' => 'required',
          'username' => 'required',
          'password' => 'required',
        ]);
      if ($validator->fails())
      {
        $error = collect();
        $error->put('errors',$validator->errors()->all());
        return response()->json($error);
      }

      $ssh = $this->SSH2->Login($request->ip_address,$request->port,$request->username,$request->password);
      if (!$ssh) {
        return response()->json(['errors' => 'lost Connection check your configuration']);
      }
      return response()->json(['success' => 'Successfully']);
    }

    public function ForgetSession_command()
    {
      // forget session on commandline
      $this->session->ForgetSession('cloud');
      $this->session->ForgetSession('output');
      $this->session->ForgetSession('history');
      $this->session->ForgetSession('cwd');
      $this->session->ForgetSession('cwd_name');
      $this->session->ForgetSession('firstcommand');
    }
}
