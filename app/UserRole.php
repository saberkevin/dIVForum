<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'tr_user_roles';

  public function users()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function roles()
  {
    return $this->belongsTo(Role::class, 'role_id', 'id');
  }
}
