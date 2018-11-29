<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'mtr_roles';

    protected $fillable = [
        'name', 
    ];

  public function users()
  {
    return $this->hasMany(UserRole::class, 'role_id', 'id');
  }
}
