@extends('layouts.myapp')

@section('content')

    <ul>

        <li>{{$comment->post->image_filepath ?? ''}}</li>
        <li>Caption: {{$comment->post->caption}}</li>
        <li>Posted by {{$comment->post->user->name}}</li>


        <li>Comment: {{$comment->content}}</li>
        <li>Posted by {{$comment->user->name}}</li>
    </ul>

    <a href="{{route('comments.edit',['comment'=>$comment, 'post' => $post])}}">Edit Comment</a>

    <form method="POST"
          action="{{route('comments.destroy', ['comment'=>$comment, 'post' => $post])}}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Comment</button>
    </form>


@endsection
