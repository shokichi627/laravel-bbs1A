<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with(['comments'])->orderBy('created_at', 'desc')->paginate(10);

        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        $category = new Category;
        $categories = $category->getLists()->prepend('選択', '');

        return view('posts.create', ['categories' => $categories]);
    }

    public function store(PostRequest $request)
    {
        $params = [
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ];

        Post::create($params);

        return redirect()->route('top');
    }

    public function show($post_id)
    {
        // @todo
        $post = Post::findOrFail($post_id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function edit($post_id)
    {
        $category = new Category;
        $categories = $category->getLists();

        $post = Post::findOrFail($post_id);

        return view('posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update($post_id, PostRequest $request)
    {
        $params = [
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ];

        $post = Post::findOrFail($post_id);
        $post->fill($params)->save();

        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);
        // TODO
        \DB::transaction(function () use ($post) {
            $post->deletePost();
        });

        return redirect()->route('top');
    }
}
