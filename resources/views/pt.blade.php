@extends('layouts.app')

@section('content')

    <section>
        <h1>Chat:</h1>
        
        @foreach($posts as $post)
            <article data-postid="{{ $post->id }}">
                <p>{{ $post->user->username }} {{ $post->created_at }}</p>

                <p>{{ $post->body }}</p>
            </article>
        @endforeach
        
    </section>
    <section>
        <h1>What you say:</h1>
        <form action="{{ route('post.create') }}" method="post">
        <textarea id="new_post" name="body" rows="5" placeholder="enter your message"></textarea>
        <button type="submit">Send Message</button>
        <input type="hidden" value="{{Session::token()}}" name="_token">
        </form>
        </form>
    </section>
    <script>
        var token = '{{Session::token()}}';
    </script>
@endsection

