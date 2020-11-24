<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // @todo
    protected $fillable = [
        'title',
        'body',
        'category_id',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function category()
    {
        // 投稿は1つのカテゴリーに属する
        return $this->belongsTo('App\Category');
    }
}
