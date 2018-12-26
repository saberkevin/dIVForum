<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumThread extends Model
{
    use SoftDeletes;

    protected $table = 'trn_forum_threads';

    protected $fillable = [
        'content',
    ];

	public function forum()
	{
		return $this->belongsTo(Forum::class, 'forum_id', 'id');
	}

	public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
