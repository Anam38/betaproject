<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Database\UserTable;
use App\Repositories\Session\AuthSession;

class ChatsController extends Controller
{
    protected $user;
    protected $session;

    public function __construct()
    {
      $this->user   =  new UserTable;
      $this->session   =  new AuthSession;
    }

    public function index()
    {
      // dd($this->user->JoinToMessage());
      $data = array(
        'user' => $this->user->UserAll()
      );
      return view('contents.chats.index')->with($data);
    }
}
