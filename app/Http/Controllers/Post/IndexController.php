<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        // $this->authorize('view', auth()->user());
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $per_page = $data['per_page'] ?? 10;


        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate($per_page, ['*'], 'page', $page);


        return PostResource::collection($posts);

        // return array_map(fn($resource) => new PostResource($resource), $posts->all());

        // return view("post.index", compact("posts"));
    }
}
