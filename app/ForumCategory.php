<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumCategory extends Model
{
    use SoftDeletes;

    protected $table = 'trn_forum_categories';

	public function forum()
	{
		return $this->belongsTo(Forum::class, 'forum_id', 'id');
	}

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}
}
