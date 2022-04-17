@extends('layouts.myapp')

@section('content')
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <ul>
        <li>{{$post->image_filepath ?? ''}}</li>
        <li>Caption: {{$post->caption}}</li>
        <li>Posted by {{$post->user->name}}</li>
        <li>Number of likes: {{$post->likes()->count()}}</li>
    </ul>

    <form method="POST" action="{{route('likes.store', ['post'=>$post])}}">
        @csrf
        <input type="submit" value="like post">
    </form>


    <li><a href="{{route('posts.edit',['post'=>$post])}}">Edit Post</a></li>

    <a href="{{route('posts.index')}}">Back</a>

    <div id="comment">
        <ul>
            <li> Comments:</li>
            <li v-for="comment in comments"> @{{ comment.content }} Posted by @{{ comment.user_id }}</li>
        </ul>
        Add comment: <input type="text" id="newComment" v-model="newComment">
        <button @click="createComment()">Create</button>
    </div>
    <script>
        // axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('id')
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
                            Authorization: `Bearer $(config.token)`,
                        },
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
