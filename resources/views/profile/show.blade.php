@extends('layouts.myapp')

@section('title','Profile')



@section('content')

    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{route('posts.index')}}"> Back to Main
        Feed<br><br></a>

    <ul>
        <li>Name: {{$user->name}}</li>
        <li>Email: {{$user->email}}</li>
    </ul>

    <br/><br/>
    <p class="font-semibold text-lg">Posts: </p>
    <ul>
        @foreach($user->posts()->get() as $post)
            @if($post->path != null)
                <img src="{{ url($post->path)}}"
                     style="height: 100px; width: 150px;">
            @endif
            <li><a href="{{route('posts.show', ['post'=>$post])}}">{{$post->caption}} by {{$post->user->name}}</a></li>
            <li>Likes: {{$post->likes()->count()}} | Comments: {{$post->comments()->count()}}<br/><br/></li>

        @endforeach
    </ul>


@endsection
