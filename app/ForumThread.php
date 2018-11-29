<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    protected $table = 'trn_forum_threads';

    protected $fillable = [
        'content',
    ];

	public function forums()
	{
		return $this->belongsTo(Forum::class, 'forum_id', 'id');
	}

	public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
