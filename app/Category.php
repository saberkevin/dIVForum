<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'mtr_categories';

    protected $fillable = [
        'name',
    ];

	public function forums()
	{
	  return $this->hasMany(ForumCategory::class, 'category_id', 'id');
	}
}
