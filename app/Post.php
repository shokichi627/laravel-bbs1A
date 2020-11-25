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

    public function deletePost($post_id)
    {
        $post = Post::findOrFail($post_id);

        \DB::transaction(function () use ($post) {
            $post->comments()->delete();
            $post->delete();
        });
    }
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
