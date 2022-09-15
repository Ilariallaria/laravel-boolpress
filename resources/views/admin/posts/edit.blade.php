@extends('layouts.dashboard')

@section('content')
    <h1>Edit post</h1>

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            {{-- old accetta due parametri, il secondo è il defoult se il primo non esiste --}}
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" >
        </div>

        <div class="mb-3">
            <label for="category_id">Category</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">not assigned</option>

                @foreach ($categories as $category)
                    <option
                    {{-- il valore da prepopolare arriva dall'old se c'è un old, oppure dal database --}}
                        value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}>
                        {{ $category->name }}
                    </option>
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image">
                
            @if ($post->cover)
            <div class="mt-3">Your image</div>
            <img class="w-50" src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}">
            @endif
        </div>

        {{-- <input type="submit" class="btn btn-success" value="Save"> --}}
        <button type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Save</button>

        


    </form>
@endsection