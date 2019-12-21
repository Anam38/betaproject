<?php

namespace App\Http\Controllers\Command;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Command\Phpshell;
use phpseclib\Net\SSH2;

class CommandController extends Controller
{

  protected $ini;

  public function __construct(){
    $this->ini = config('command');
  }

  public function index()
  {
    // $ssh = new SSH2('194.31.53.214');
    // if (!$ssh->login('anam', 'anam123')) {
    //   dd('Login Failed');
    // }
    // dd($ssh->exec('htop'));

    Session::put('ini', $this->ini);
    Session::put('nounce',  mt_rand());
    (Session::has('rows') ? Session::get('rows')  : Session::put('rows','30'));
    (Session::has('columns') ? Session::get('columns')  : Session::put('columns','10'));
    (Session::has('cwd') ? Session::get('cwd') : Session::put('cwd', realpath($this->ini['settings']['home-directory'])));
    (Session::has('output') ? Session::get('output') : Session::put('output', array()));
    (Session::has('history') ? Session::get('history') : Session::put('history',array()));
    return view('contents.command.index');
  }

  public function login(Request $req)
  {
    $sessNounce  = Session::get('nounce');
    $username = isset($req->username) ? $req->username : '';
    $password = isset($req->password) ? $req->password : '';
    $nounce   = isset($req->nounce)   ? $req->nounce   : '';
    /* Attempt authentication. */
    if (isset($sessNounce) && $nounce == $sessNounce && isset($this->ini['users'][$username])) {
        if (strchr($this->ini['users'][$username], ':') === false) {
            // No seperator found, assume this is a password in clear text.
            // $_SESSION['authenticated'] = ($this->ini['users'][$username] == $password);
            Session::put('authenticated',($this->ini['users'][$username] == $password));
        } else {
            list($fkt, $salt, $hash) = explode(':', $this->ini['users'][$username]);
            // $_SESSION['authenticated'] = ($fkt($salt . $password) == $hash);
            Session::put('authenticated',($fkt($salt . $password) == $hash));
        }
        // dd(strchr($this->ini['users'][$username], ':'),($this->ini['users'][$username] == $password));
    }

    Session::put('authenticated',true);
    return redirect()->back();
  }

  /**
   * execute command
   * req shouldbe have command , and levelup
   */
  public function submitcommand(Request $req)
  {
    $phpshell = new Phpshell();
    $result = $phpshell->command((object)$req->all());

    return redirect()->back();
    // return response()->json($result);
  }

}
