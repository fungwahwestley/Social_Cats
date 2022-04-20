@extends('layouts.myapp')

@section('content')
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{route('posts.index')}}"> Back to Main
        Feed<br><br></a>

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
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posted by <a
                    href="{{route('profile.show',['user'=>$post->user])}})">{{$post->user->name}}</a> |
                Likes: {{$post->likes()->count()}}</li>
            <form method="POST"
                  action="{{route('likes-post.store', ['post'=>$post])}}">
                @csrf
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<x-like-button type="submit">like</x-like-button>
            </form>
        </ul>

    </div>



    <br><br><br><br><br>


    <div id="comment">
        <ul>
            <p class="font-semibold text-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comments: </p>
            <li v-for="comment in comments"> @{{ comment.content }} | posted by @{{ comment.user_id }}<br><br></li>
        </ul>
        <x-label for="content" :value="__('Add Comment')"/>

        <x-input id="newComment" class="block mt-1 w-full" type="text" v-model="newComment" required
                 autofocus/>
        <div class="flex items-center justify-end mt-4">
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" @click="createComment()">Create</button>
        </div>
    </div>
    <script>
        const Comment = {
            data() {
                return {
                    comments: [],
                    newComment: "",
                }
            },
            methods: {
                createComment() {
                    axios.post("{{route('api.comments.store',['post'=>$post])}}", {
                        headers: {
                            "Content-type": "application/json",
                            Authorization: `Bearer $(token)`,
                        },
                        content: this.newComment,
                        user_id: {{Auth::User()->getAuthIdentifier()}},


                    })
                        .then(response => {
                            this.comments.push(response.data);
                            this.newComment = '';
                        })
                        .catch(error => {
                            console.log(error.response.data);
                        })
                }
            },
            mounted() {
                axios.get("{{route('api.comments.index',['post'=>$post])}}", {
                    headers: {
                        "Content-type": "application/json",
                        Authorization: `Bearer $(config.token)`,
                    }

                }).then(response => {


                    this.comments = response.data;
                }).catch(response => {
                    console.log(response);
                })
            }
        }
        Vue.createApp(Comment).mount('#comment');
    </script>

@endsection
