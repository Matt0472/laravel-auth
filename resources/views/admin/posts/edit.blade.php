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
        
        <div class="form-group">
          <label for="tags">Tags</label>
          @foreach ($tags as $tag)
          <div>
            <span>{{$tag->name}}</span>
            <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{($post->tags->contains($tag->id)) ? 'checked' : ''}}>
          </div>
          @endforeach
        </div>

        <div class="form-group">
           <label for="images">Images</label>
           @foreach ($images as $image)
               <div>
               <h3>{{$image->path}}</h3>
               <input type="checkbox" name="images[]" value="{{$image->id}}" {{($post->images->contains($image->id)) ? 'checked' : ''}}>
               </div>
           @endforeach
        </div> 
        <button class="btn btn-success" type="submit">Salva</button>
      </form>
    </div>
  </div>
@endsection