@extends('layouts.dashboard')

@section('content')
    <h1>Create your own post</h1>
    {{-- visualizza errori --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        {{-- deve inviare i dati a store con metodo post --}}
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title"
            placeholder="Write title here..." value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="category_id">Category</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">not assigned</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content"
            placeholder="Write content here..." rows="5">{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image">
        </div>

        {{-- <input type="submit" class="btn btn-success" value="Save"> --}}
        <button type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Save</button>
    </form>
@endsection