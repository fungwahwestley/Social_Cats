@extends('layouts.myapp')

@section('content')
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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

    <div id="comment">
        <ul>
            <li v-for="comment in comments">@{{ comment.content }} Posted by @{{ comment.user_id }}</li>
        </ul>
        Add comment: <input type="text" id="newComment" v-model="newComment">
        <button @click="createComment">Create</button>
    </div>
    <script>const Comment = {
            data() {
                return {
                    comments: [],
                    newComment: "",
                }
            },
            methods: {
                createComment() {
                    axios.post("{{route('api.comments.store',['post'=>$post])}}", {
                        content: this.newComment
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
                axios.get("{{route('api.comments.index',['post'=>$post])}}").then(response => {
                    this.comments = response.data;
                }).catch(response => {
                    console.log(response);
                })
            }
        }
        Vue.createApp(Comment).mount('#comment');
    </script>

@endsection
