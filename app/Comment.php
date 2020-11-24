<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // @todo
    protected $fillable = [
        'body',
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
