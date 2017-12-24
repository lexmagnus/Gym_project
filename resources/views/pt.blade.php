@extends('layouts.appOLD(NOT_USE)')

@section('content')

    <section>
        <h1>What others say:</h1>
    
        @foreach($posts as $post)
            <article data-postid="{{ $post->id }}">
                <p>{{ $post->user->name }} {{ $post->created_at }}</p>

                <p>{{ $post->body }}</p>
            </article>
        @endforeach
        
    </section>
    <section>
    <h1>What you say:</h1>
    <form action="{{ route('post.create') }}" method="post">
    <textarea id="new_post" name="body" rows="5" placeholder="enter your message"></textarea>

    </form>
    </section>
    <script>
        var token = '{{Session::token()}}';
    </script>
@endsection

