@extends('layouts.dashboard')

@section('content')
<h1>Benvenuto nella tua dashboard privata</h1>
{{-- <div><i class="fa-regular fa-user"></i> {{$user->name}}</div>
<div><i class="fa-regular fa-envelope"></i> {{$user->email}}</div> --}}
<div>
    <span style="color:#3490dc"><i class="fa-regular fa-user"></i></span>
    <span>{{$user->name}}</span>
</div>
<div>
    <span style="color:#3490dc"><i class="fa-regular fa-envelope"></i></span>
    <span>{{$user->email}}</span>
</div>
@endsection