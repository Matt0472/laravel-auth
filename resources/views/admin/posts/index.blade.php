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
          <p class="card-text">This post was write from: {{ $post->user->name }}</p>
          <a href="#" class="btn btn-primary m-3">Add Comment</a>
          <a class="btn btn-success m-3" href="">View all details</a>
          <a class="btn btn-warning m-3" href="">Edit post</a>
          <form action="" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger m-3" type="submit">Delete post</button> 
          </form>
        </div>
      </div>
  @endforeach
@endsection