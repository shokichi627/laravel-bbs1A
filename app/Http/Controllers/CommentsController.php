<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
    public function store(CommentRequest $request)
    {
        // TODO:laravel_bbs2と見比べ
        $params = [
            'post_id' => $request->post_id,
            'body' => $request->body,
        ];

        $post = Post::findOrFail($params['post_id']);
        $post->comments()->create($params);

        return redirect()->route('posts.show', ['post' => $post]);
    }
}
