@extends('layouts.myapp')

@section('title','Profile')



@section('content')
    <ul>
        <p>User information: </p>
        <li>Name: {{$user->name}}</li>
        <li>Email: {{$user->email}}</li>
        @if($user->adim == 1)
            <li>Admin : True</li>
        @else
            <li>Admin : False</li>
        @endif

    </ul>


@endsection
