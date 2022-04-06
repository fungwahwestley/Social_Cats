@extends('layouts.myapp')

@section('content')
    <ul>
        <li>{{$comment->post->image_filepath ?? ''}}</li>
        <li>Caption: {{$comment->post->caption}}</li>
        <li>Posted by {{$comment->post->user->name}}</li>


        <li>Comment: {{$comment->content}}</li>
        <li>Posted by {{$comment->user->name}}</li>
    </ul>

    <form method="POST" action="{{route('comments.update', ['comment'=>$comment, 'post'=>$post])}}">
        @csrf
        <p>Comment: <input type="text" name="content" value="{{$comment->content}}"></p>
        <input type="submit" value="Update">
        <a href="{{route('comments.show',['comment'=>$comment,'post'=>$post])}}">Cancel</a>
    </form>

@endsection
