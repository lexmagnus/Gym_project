@extends('layouts.app')

@section('content')
<div class="pt-body">
    
      <!--    <h1>Chat:</h1>
          <div class="media">
             @foreach($posts as $post)
                <article data-postid="{{ $post->id }}">
                    
                    <h2 class="title">{{ $post->user->username }}</h2>
                    <div class="content">
                        <p>{{ $post->body }}</p>
                    </div>
                    <div class="footer">
                        {{ $post->created_at }}
                    </div>
                </article>
            @endforeach
         </div>  -->
        
        <!--<div class="wrapper">
            <h1>Chat:</h1>
            @foreach($posts as $post)
            <article data-postid="{{ $post->id }}">
                <div class="box a">A</div>
                <div class="box b">B</div> 
                <div class="box c">
                  <h2> {{ $post->user->username }}</h2>
                </div>
                <div class="box d">
                    <p>{{ $post->body }}</p>
                </div>
                <div class="box e">
                    {{ $post->created_at }}
                </div>
            </article>
        </br>
            @endforeach
        </div>-->
    <h1>Chat:</h1>

    
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

