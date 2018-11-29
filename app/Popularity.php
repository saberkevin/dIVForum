<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Popularity extends Model
{
    use SoftDeletes;

    protected $table = 'trn_popularity';

    protected $fillable = [
        'positive', 'negative',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
