@extends('layouts.main')
@section('content')
<div class="container">
    <a class="btn btn-dark mb-3" href="{{route('post.create')}}">Создать пост</a>
    @foreach ($posts as $post)
        <div>
            <a href="{{route('post.show', $post->id)}}">
                {{$post->id}}. {{$post->title}}
            </a>
        </div>
    @endforeach
</div>
@endsection