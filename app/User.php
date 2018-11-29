<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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
}
