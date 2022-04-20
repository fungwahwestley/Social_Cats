@extends('layouts.myapp')

@section('title','Profile')



@section('content')
    <ul>
        <li>Name: {{Auth::user()->name}}</li>
        <li>Email: {{Auth::user()->email}}</li>
        @if(Auth::user()->admin == 1)
            <li>Admin : True</li>
        @endif


        <br/><br/>
        <p class="font-semibold text-lg">Posts: </p>

        <ul>
            @foreach(Auth::user()->posts()->get() as $post)

                @if($post->path != null)
                    <img src="{{ url($post->path)}}"
                         style="height: 100px; width: 150px;">
                @endif
                <li><a href="{{route('posts.show', ['post'=>$post])}}">{{$post->caption}} by {{$post->user->name}}</a>
                </li>
                <li>Likes: {{$post->likes()->count()}} | Comments: {{$post->comments()->count()}}<br/><br/></li>
            @endforeach
        </ul>

    </ul>


@endsection
