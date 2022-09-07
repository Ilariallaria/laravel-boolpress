@extends('layouts.dashboard')

@section('content')
    <h1>{{ $post->title }}</h1>

    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">&#8592</a>
    <a href="{{ route('admin.posts.edit', ['post'=> $post->id]) }}" class="btn btn-primary">Edit post</a>

    <div class="mt-2">Created on: {{ $post->created_at }}</div>
    <div>Updated on: {{ $post->updated_at }}</div>
    <div>Slug: {{ $post->slug }}</div>

    <h3 class="mt-3">Content:</h3>
    <p>{{ $post->content }}</p>

    <form class="mt-3" action="{{route ('admin.posts.destroy', ['post' => $post->id])}}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-danger" type="submit" value="Delete post">
    </form>


@endsection