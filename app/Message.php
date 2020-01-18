<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [
    'user_id_1', 'user_id_2', 'status',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function sendMessages()
  {
    return $this->hasmany(detailMessage::class);
  }
}
