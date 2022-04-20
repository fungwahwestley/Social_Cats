@extends('layouts.myapp')

@section('title','Main Feed')

@section('content')
    <ul>
        @foreach($posts as $post)
            @if($post->path != null)
                <img src="{{ url($post->path)}}"
                     style="height: 100px; width: 150px;">
            @endif
            <li><a href="{{route('posts.show', ['post'=>$post])}}">{{$post->caption}} by {{$post->user->name}}</a></li>
            <li>Likes: {{$post->likes()->count()}} | Comments: {{$post->comments()->count()}}<br/><br/></li>
        @endforeach
    </ul>
@endsection





