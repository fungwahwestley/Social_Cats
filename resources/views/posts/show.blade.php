@extends('layouts.myapp')

@section('title','Post')

@section('content')


    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{route('posts.index')}}"> Back to Main Feed<br><br></a>



    <div class="hidden sm:flex sm:items sm:ml-6">
        <x-dropdown align="right" width="35">
            <x-slot name="trigger">
                <div
                    class="text-black hover:text-gray-500 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <ul>
                        @if($post->path != null)
                            <img src="{{ url($post->path)}}"
                                 style="height: 300px; width: 350px;">
                        @endif
                        <li>Caption: {{$post->caption}}</li>
                    </ul>
                </div>

            </x-slot>

            <x-slot name="content">
                <!-- Edit post -->
                <form action="{{route('posts.edit',['post'=>$post])}}">
                    @csrf
                    <x-dropdown-link :href="route('posts.edit',['post'=>$post])"
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Edit') }}
                    </x-dropdown-link>
                </form>
                <!-- Delete post -->
                <form method="POST"
                      action="{{route('posts.destroy', ['post'=>$post])}}">
                    @csrf
                    @method('DELETE')
                    <x-dropdown-link :href="route('posts.destroy', ['post'=>$post])"
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Delete') }}
                    </x-dropdown-link>
                </form>

            </x-slot>

        </x-dropdown>
    </div>

    <div>

        <ul>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posted by <a href="{{route('profile.show',['user'=>$post->user])}})">{{$post->user->name}}</a> |
                Likes: {{$post->likes()->count()}}</li>
            <form method="POST"
                  action="{{route('likes-post.store', ['post'=>$post])}}">
                @csrf
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<x-like-button type="submit">like</x-like-button>
            </form>
        </ul>

    </div>

    <br><br><br><br><br>

    <form method="POST" action="{{route('comments.store',['post'=>$post])}}">
        @csrf

        <x-label for="content" :value="__('Add Comment')"/>

        <x-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content')" required
                 autofocus/>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('posts.show',['post'=>$post]) }}">
                {{ __('Cancel?') }}
            </a>
            <x-button class="ml-4">
                {{ __('Submit') }}
            </x-button>
        </div>
    </form>


    <ul>
        <p class="font-semibold text-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comments: </p>
        @foreach($comments as $comment)
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <li>{{$comment->content}}
                            by <a href="{{route('profile.show',['user'=>$comment->user])}}">{{$comment->user->name}}</a> | Likes: {{$comment->likes()->count()}}</li>
                    </x-slot>
                    <x-slot name="content">
                        <form method="POST"
                              action="{{route('comments.destroy', ['comment'=>$comment, 'post' => $post]) }}">
                            @csrf
                            @method('DELETE')

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Delete') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>


            <form method="POST"
                  action="{{route('likes-comment.store', ['comment'=>$comment])}}">
                @csrf
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<x-like-button type="submit">like</x-like-button>
            </form>
            <x-edit-comment-card align="right" width="48">
                <x-slot name="trigger">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<x-like-button class="mt-2" type="submit">Edit</x-like-button>
                </x-slot>

                <x-slot name="content">
                    @if((Gate::allows('delete-comment', $comment) || Gate::allows('delete-comment-admin')))
                        <form method="POST" action="{{route('comments.update', ['comment'=>$comment, 'post'=>$post])}}">
                            @csrf
                            @method('PUT')
                            <x-label class="mt-2" for="content" :value="__('Edit Comment')"/>

                            <x-input id="content" class="block mt-1 w-full" type="text" name="content"
                                     :value="$comment->content" required
                                     autofocus/>

                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                   href="{{route('posts.show',['post'=>$post])}}">
                                    {{ __('Cancel?') }}
                                </a>
                                <x-button class="ml-4">
                                    {{ __('Update') }}
                                </x-button>
                            </div>
                        </form>
                    @endif

                </x-slot>
            </x-edit-comment-card>
            <br/><br/>
        @endforeach
    </ul>

@endsection
