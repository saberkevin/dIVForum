<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inbox extends Model
{
    use SoftDeletes;

    protected $table = 'trn_inboxes';

    protected $fillable = [
        'content',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function senders(){
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
