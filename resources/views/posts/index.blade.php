@extends('layouts.myapp')

@section('title','Main Feed')

@section('content')
    <a href="{{route('posts.create')}}">Create Post</a>

    <p> Posts from other users </p>
    <ul>
        @foreach($posts as $post)
            <li><a href="{{route('posts.show', ['post'=>$post])}}">{{$post->caption}} by {{$post->user->name}}</a></li>
        @endforeach
    </ul>
@endsection
