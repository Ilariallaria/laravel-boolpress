@extends('layouts.dashboard')

@section('content')
    <h1>Edit post</h1>

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            {{-- old accetta due parametri, il secondo è il defoult se il primo non esiste --}}
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" >
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5">{{ old('content', $post->content) }}</textarea>
        </div>

        {{-- <input type="submit" class="btn btn-success" value="Save"> --}}
        <button type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Save</button>

    </form>
@endsection