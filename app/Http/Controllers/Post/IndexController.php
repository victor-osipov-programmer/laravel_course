<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        // $query = Post::query();

        // if (isset($data["category_id"])) {
        //     $query->where("category_id", $data["category_id"]);
        // }
        // if (isset($data["title"])) {
        //     $query->where("title", 'like', "%{$data['title']}%");
        // }
        // if (isset($data["content"])) {
        //     $query->where("content", 'like', "%{$data['content']}%");
        // }

        // $posts = $query->get();
        // dd($posts);
        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate(10);

        // dd($posts);


        // $posts = Post::paginate(10);

        return view("post.index", compact("posts"));
    }
}
