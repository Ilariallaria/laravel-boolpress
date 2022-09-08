@extends('layouts.dashboard')

@section('content')
    <h1>Posts list</h1>

  @if ($show_deleted_message === 'yes')
    <div class="alert alert-primary" role="alert">
      The post was successfully deleted
    </div>
  @endif

  <div class="row cols-4">
    @foreach ($posts as $post)
        {{-- CARD --}}
        <div class="col">
            <div class="card mt-2" style="width: 18rem;">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                  <h5 class="card-title">{{$post->title}}</h5>
                  {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                  <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Read more</a>
                </div>
            </div>
        </div>    
    @endforeach

  </div>
@endsection
