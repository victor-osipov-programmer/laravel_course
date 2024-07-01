@extends('layouts.main')
@section('content')
<div class="container">
    <form method="post" action="{{route('post.update', $post->id)}}">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input value="{{$post->title}}" name="title" type="text" class="form-control" id="title"
                placeholder="Title">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" type="text" class="form-control" id="content"
                placeholder="Content">{{$post->content}}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input value="{{$post->image}}" name="image" type="text" class="form-control" id="image"
                placeholder="Image">
        </div>

        <label for="category">Категория</label>
        <select name="category_id" id="category" class="form-select mb-3">
            @foreach ($categories as $category)
                <option value="{{$category->id}}" {{$post->category->id === $category->id ? 'selected' : ''}}>
                    {{$category->title}}
                </option>
            @endforeach
        </select>

        <label for="tags">Tags</label>
        <select multiple name="tags[]" id="tags" class="form-select mb-3">
            @foreach ($tags as $tag)
                <option @foreach ($post->tags as $post_tag) {{$tag->id === $post_tag->id ? 'selected' : ''}} @endforeach
                    value="{{$tag->id}}">{{$tag->title}}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Обновить</button>

    </form>
</div>
@endsection