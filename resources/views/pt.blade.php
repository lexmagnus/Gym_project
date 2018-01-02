@extends('layouts.app')

@section('content')

<div class="pt-body">
    
        @foreach($posts as $post)
        <div class="container-chat-img ">
            <img  class="img-chat"src="/uploads/avatars/default.jpg" alt="Avatar" class="left">
            <div class="container-chat ">
                <article data-postid="{{ $post->id }}">
                    <h3 id="nome"> {{ $post->user->username.": "}}</h3>
                    <p>{{ $post->body }}</p>
                    <span class="time-right">{{ "created at: ".$post->created_at }}</span>
                </article>
            </div>
        </div>
        @endforeach
        
    
        <div class="message">
            <form action="{{ route('post.create') }}" method="post">
                <!--<textarea id="new_post" name="body" rows="5" placeholder="Type a message."></textarea>-->
                <input class="textarea" id="new_post" name="body" type="text"  rows="5" placeholder="Type here!"/>
                <br>
                <button id="send-btn"type="submit">Send Message</button>
                <input type="hidden" value="{{Session::token()}}" name="_token">
            </form>
        </div>   
 </div>

@endsection

