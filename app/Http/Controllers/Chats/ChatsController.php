<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Database\UserTable;
use App\Repositories\Database\MessageTable;
use App\Repositories\Database\DetailMessageTable;
use App\Repositories\Session\AuthSession;
use App\Message;
use App\User;
use App\Events\MessageEvent;
use App\Events\UpdateMessageStatus;
use Auth;

class ChatsController extends Controller
{
    protected $user;
    protected $session;
    protected $message;
    protected $detailmessage;

    public function __construct()
    {
      $this->user      =  new UserTable;
      $this->message   =  new MessageTable;
      $this->detailmessage   =  new DetailMessageTable;
      $this->session   =  new AuthSession;
    }

    public function index()
    {
      return view('contents.chats.index');
    }

    public function fetchUser()
    {
      return User::get();
    }

    public function fetchChat()
    {
      $user = Auth::user();
      return $this->message->MessageWhere($user->id)->with('user')->get();
    }

    public function fetchMessages(Request $req)
    {
      return $this->detailmessage->DetailMessageWhere($req->id)->with('user')->get();
    }

    public function submitNewChat(Request $req)
    {
      try {
        $user = Auth::user();
        $data = array(
            'user_id_1' => $user->id,
            'user_id_2' => $req->id,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
          );
        $message = $this->message->MessageInsert($data);
        return $message;

      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function sendMessages(Request $req)
    {
      $user = Auth::user();
      $data = array(
          'message_id'  => $req->message_id,
          'user_id'     => $user->id,
          'message'     => $req->message,
          'created_at'  => date("Y-m-d h:i:s"),
          'updated_at'  => date("Y-m-d h:i:s")
        );

      $message = $this->detailmessage->DetailMessageInsert($data);

      broadcast(new MessageEvent($message->load('user')))->toOthers();

      return ['status' => 'success'];
    }

    public function statusUpdate(Request $req)
    {
      $data = array(
        'status' => 1
      );
      $message = $this->detailmessage->UpdateMessageWhere($req->id,$data);

      broadcast(new UpdateMessageStatus($message))->toOthers();

      return ['status' => 'success'];
    }
}
