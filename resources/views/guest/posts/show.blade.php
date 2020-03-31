@extends('layouts.layout')
@section('header')
  <h2 class="text-center text-warning">Post details</h2>
@endsection
@section('main-content')
  <div class="card">
    <ul>
      <li class="text-primary">#ID: <span class="text-dark">{{$post->id}}</span></li>
      <li class="text-primary">Post Title: <span class="text-dark">{{$post->title}}</span></li>
      <li class="text-primary">Post Content: <span class="text-dark">{{$post->body}}</span></li>
      <li class="text-primary">Author: <span class="text-dark">{{$post->user->name}}</span></li>
      <li class="text-primary">Created at: <span class="text-dark">{{$post->created_at}}</span></li>       
    </ul>
  </div>            
@endsection

@section('section-content')
    <h2 class="w-100 text-center mt-5">Post Comments</h2>
    @forelse ($post->comments as $comment)
      <div class="card mb-5" style="width: 18rem;">
        <div class="card-body">
          <h3 class="card-title">{{$comment->title}}</h3>
          <h5 class="card-title">{{$comment->name}}</h5>
          <p class="card-text">{{$comment->body}}</p>
        </div>
      </div>
    @empty
      <p>No Comments</p>
    @endforelse
    
@endsection

@section('form')
<h2 class="text-center">Insert your comment</h2>
  <form action="{{route('comments.store')}}" method="POST">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Title</label>
      <input class="form-control" type="text" name="title">
    </div>
    <div class="form-group">
      <label for="body">Comments</label>
      <textarea class="form-control"  name="body" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
      <label for="name">Your Name</label>
      <input class="form-control"  type="text" name="name">
    </div>
    <div class="form-group">
      <label for="email">Your email</label>
      <input class="form-control"  type="text" name="email">
    </div>
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <button class="btn btn-primary" type="submit">Send</button>
  </form>
@endsection

@section('footer')
    <a class="btn btn-success mt-5 mb-5" href="{{route('posts.index')}}">HOME</a>
@endsection

    