<!doctype html>
<html lang="en">
<head>
    <title>Swansea Zoo -
        @yield('title')</title>
</head>
<body>
<h1>Catagram - @yield('title')</h1>
@if($errors->any())
    <div>
        Errors:
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@error('name')
<div class="alert alert-danger">
    {{$message}}
</div>
@enderror

@if(session('message'))
    <p><b>{{session('message')}}</b></p>
@endif

<div>
    @yield('content')
</div>
</body>
</html>
