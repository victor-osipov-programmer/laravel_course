@extends('layouts.main')
@section('content')
<div class="container">
    <form method="post" action="{{route('post.store')}}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input value="{{old('title')}}" name="title" type="text" class="form-control" id="title"
                placeholder="Title">
            @error('title')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" type="text" class="form-control" id="content"
                placeholder="Content">{{old('content')}}</textarea>
            @error('content')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input value="{{old('image')}}" name="image" type="text" class="form-control" id="image"
                placeholder="Image">
            @error('image')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>


        <label for="category">Категория</label>
        <select name="category_id" id="category" class="form-select mb-3">
            @foreach ($categories as $category)
                <option
                {{old('category_id') == $category->id ? 'selected' : ''}}
                
                value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-danger">{{$message}}</p>
        @enderror

        <label for="tags">Tags</label>
        <select multiple name="tags[]" id="tags" class="form-select mb-3">
            @foreach ($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->title}}</option>
            @endforeach
        </select>
        @error('tags')
            <p class="text-danger">{{$message}}</p>
        @enderror

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>
@endsection