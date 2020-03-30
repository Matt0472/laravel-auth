@extends('layouts.layout')
@section('header')
    <h1 class="text-center">Update this post</h1>
@endsection
@section('main-content')
  <div class="wrapper">
    <div class="row">
      <form action="{{route('admin.posts.update', $post)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="title">Title</label>
        <input class="form-control" type="text" name="title" value="{{$post->title}}">
        </div>
        <div class="form-group">
          <label for="content">Content</label>
        <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{$post->body}}</textarea>
        </div>
        <button class="btn btn-success" type="submit">Salva</button>
      </form>
    </div>
  </div>
@endsection