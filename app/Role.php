<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'ms_roles';

    protected $fillable = [
        'name', 
    ];

  public function users()
  {
    return $this->hasMany(UserRole::class, 'role_id', 'id');
  }
}
