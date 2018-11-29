<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'ms_users';

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'gender', 'address', 'profile_picture', 
    ];

    protected $hidden = [
        'password',
    ];

    public function roles()
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }

    public function  forums(){
        return $this->hasMany(Forum::class, 'user_id', 'id');
    }

    public function  threads(){
        return $this->hasMany(ForumThread::class, 'user_id', 'id');
    }

    public function inboxes(){
        return $this->hasMany(Inbox::class,'user_id', 'id');
    }
}
