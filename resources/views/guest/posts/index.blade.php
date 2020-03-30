@extends('layouts.layout')
@section('header')
    <h1 class="text-center">All posts</h1>
@endsection
@section('main-content')
  @foreach ($posts as $post)
      <div class="card mb-5" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{ $post->body }}</p>
          <a href="#" class="btn btn-primary">Add Comment</a>
        </div>
      </div>
  @endforeach
@endsection