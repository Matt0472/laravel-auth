@extends('layouts.layout')
@section('header')
    <h1 class="text-center">All posts</h1>
    @if (session('delete'))
    <div class="alert alert-danger">
      You deleted the post: {{session('delete')->title}}
    </div>
@endif
@endsection
@section('main-content')
  @foreach ($posts as $post)
      <div class="card mb-5" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{ $post->body }}</p>
          <p class="card-text">This post was write from: {{ $post->user->name }}</p>
          <a href="#" class="btn btn-primary m-3">Add Comment</a>
          <a class="btn btn-success m-3" href="{{route('admin.posts.show', $post->slug)}}">View all details</a>
          @if (Auth::id() == $post->user_id)
            <a class="btn btn-warning m-3" href="{{route('admin.posts.edit', $post->slug)}}">Edit post</a>
            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger m-3" type="submit">Delete post</button> 
            </form>
          @else
          <td></td>
          <td></td>
          @endif
        </div>
      </div>
  @endforeach
@endsection