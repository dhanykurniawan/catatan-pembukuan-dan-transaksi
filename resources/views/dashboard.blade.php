@extends('template')

@section('container')
<h1 class="card-title text-center">Welcome back, {{ Auth::user()->name }}</h1>
@endsection