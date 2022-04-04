@extends('layouts.myapp')

@section('title','Edit post')

@section('content')
    <form method="POST" action="{{route('posts.update', ['post'=>$post])}}">
        @csrf
        <p>Caption: <input type="text" name="caption" value="{{$post->caption}}"></p>
        <p>Image: <input type="text" name="image_filepath" value="{{$post->image_filepath}}"></p>
        <input type="submit" value="Update">
        <a href="{{route('posts.show',['post'=>$post])}}">Cancel</a>
    </form>
@endsection
