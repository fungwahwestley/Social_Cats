@extends('layouts.myapp')

@section('title', 'Post details')

@section('content')
    <ul>
        <li>{{$post->image_filepath ?? ''}}</li>
        <li>Caption: {{$post->caption}}</li>
        <li>Posted by {{$post->user->name}}</li>
    </ul>

    <form method="POST"
          action="{{route('posts.destroy', ['post'=>$post])}}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    <a href="{{route('posts.index')}}">Back</a>

@endsection
