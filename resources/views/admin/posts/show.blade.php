@extends('layouts.dashboard')

@section('content')
    <h1>{{ $post->title }}</h1>

    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">&#8592</a>
    <a href="{{ route('admin.posts.edit', ['post'=> $post->id]) }}" class="btn btn-primary">Edit post</a>

    <div class="mt-2">Created on: {{ $post->created_at->format('Y F d') }}</div>
    <div>Updated on: {{ $diff_date }}</div>
    <div>Slug: {{ $post->slug }}</div>
    <div>Category: {{ $post->category ? $post->category->name : 'not assigned' }}</div>

    <h3 class="mt-3">Content:</h3>
    <p>{{ $post->content }}</p>

    <form class="mt-3" action="{{route ('admin.posts.destroy', ['post' => $post->id])}}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-danger" type="submit" value="Delete post" onclick="return confirm('Post will be permanently deleted. Confirm?')">
    </form>


@endsection