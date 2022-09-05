@extends('layouts.dashboard')

@section('content')
<h1>Benvenuto nella tua dashboard privata</h1>
<div>Ciao {{$user->name}}</div>
<div>La tua mail è: {{$user->email}}</div>
@endsection