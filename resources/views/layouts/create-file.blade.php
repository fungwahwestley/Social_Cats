<x-app-layout>
    <head>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @yield('title')
            </h2>
        </x-slot>


    </head>


    <body>
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



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </div>

    </body>
</x-app-layout>
