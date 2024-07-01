@extends('layouts.main')
@section('content')
<div class="container">
    <a class="btn btn-dark mb-3" href="{{route('post.edit', $post->id)}}">Редактировать</a>
    <div>
        ID: {{$post->id}}
    </div>
    <div>
        Title: {{$post->title}}
    </div>
    <div>
        Category: {{$post->category->title}}
    </div>
    <div>
        Tags: {{ implode(',', array_map(fn($el) => $el['title'], $post->tags->all())) }}
    </div>
    <div class="mb-3">
        Content: {{$post->content}}
    </div>

    <a class="btn btn-dark mb-3" href="{{route('post.index')}}">Назад</a>
    <form method="post" action="{{route('post.destroy', $post->id)}}">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger" href="{{route('post.destroy', $post->id)}}">Удалить</button>
    </form>
</div>
@endsection 