<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::all();

        return view("post.index", compact("posts"));
    }
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("post.create", compact('categories', 'tags'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);
        $post->tags()->attach($tags);
        return redirect()->route('post.index');
    }
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();

        return view('post.edit', compact('post', 'categories', 'tags'));
    }
    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);

        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
    public function delete()
    {
        $post = Post::withTrashed()->find(6);
        $post->restore();
        dd('delete');
    }
    public function firstOrCreate()
    {

        $anotherPost = [
            'id' => 7,
            'title' => 'SOME title',
            'content' => 'SOME image',
            'image' => 'SOME image',
            'likes' => 5000,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
            'id' => 7
        ], $anotherPost);

        dd($post->id);
    }
    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'title 10',
            'content' => 'update_or_create image',
            'image' => 'update_or_create image',
            'likes' => 3300,
            'is_published' => 0,
        ];
        $post = Post::updateOrCreate([
            'title' => 'title 10',
        ], $anotherPost);

        dd($post->id);
    }
}
