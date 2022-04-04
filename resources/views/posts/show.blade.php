@extends('layouts.myapp')

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

    <a href="{{route('posts.edit',['post'=>$post])}}">Edit</a>

    <a href="{{route('posts.index')}}">Back</a>

@endsection
