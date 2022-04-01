@extends('layouts.myapp')

@section('title','Create post')

@section('content')
    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        <p>Caption: <input type="text" name="caption" value="{{old('caption')}}"></p>
        <p>Image: <input type="text" name="image_filepath" value="{{old('image_filepath')}}"></p>
        <p>User ID: <input type="text" name="user_id" value="{{old('user_id')}}"></p>
        <input type="submit" value="Submit">
        <a href="{{route('posts.index')}}">Cancel</a>
    </form>
@endsection
