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
        <button type="submit">Delete Post</button>
    </form>

    <a href="{{route('posts.edit',['post'=>$post])}}">Edit Post</a>

    <a href="{{route('posts.index')}}">Back</a>

    <form method="POST" action="{{route('comments.store',['post'=>$post])}}">
        @csrf
        <p>Add Comment: <input type="text" name="content" value="{{old('content')}}"></p>
        <input type="submit" value="Submit">
        <a href="{{route('posts.show',['post'=>$post])}}">Cancel</a>
    </form>

    <ul>
        <p> Comments: </p>
        @foreach($comments as $comment)
            <li>{{$comment->content}} by {{$comment->user->name}}</li>
        @endforeach
    </ul>

@endsection
