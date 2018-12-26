<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use SoftDeletes;

    protected $table = 'mtr_forums';

    protected $fillable = [
        'name', 'description', 'status',
    ];

	public function threads()
	{
	  return $this->hasMany(Thread::class, 'forum_id', 'id');
	}

	public function category()
	{
	  return $this->hasOne(ForumCategory::class, 'category_id', 'id');
	}

	public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
