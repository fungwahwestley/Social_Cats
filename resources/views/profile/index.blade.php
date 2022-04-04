@extends('layouts.myapp')

@section('title','Profile')



@section('content')
    <ul>
        @foreach($posts as $post)
                <li><a href="{{route('posts.show', ['post'=>$post])}}">{{$post->caption}} by {{$post->user->name}}</a></li>
        @endforeach
    </ul>
@endsection
