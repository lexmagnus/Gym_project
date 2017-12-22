@extends('layouts.app')

@section('content')
    <head>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>


    <style>
        /* ... */
    </style>
</head>
 
    <div style="max-width: 800px; margin:20px;">
        {!! $calendar->calendar() !!}
        {!! $calendar->script() !!}
    </div>
@endsection