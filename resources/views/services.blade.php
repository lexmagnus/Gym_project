@extends('layouts.app')

@section('content')
<div class="services-body">
    <head>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    </head>
   
    <div id="services">
        <div id="left">
            {!! $calendar->calendar() !!}
             {!! $calendar->script() !!}
        </div>
            <div id="right">
            @if (Auth::user()->isAdmin() OR Auth::user()->isInst())
                <h1>Insert classes</h1><br><hr><br><br>
                <h3></h3>Please insert the classes bellow:</h3>
                <br><br>
                <form role="form" method="POST" action="{{ route('class.create') }}">

                    {{ csrf_field() }}

                    <label><b>Class name &nbsp</b></label>
                    <input type="text" placeholder="Nome aula" id="title" class="" style="width:50%;" name="title" value="{{ old('title') }}" required autofocus>
                    <br>
                    <label><b>Classroom &nbsp</b></label>
                    <input type="text" placeholder="Sala de aula" id="room" type="room" style="width:50%;"  name="room" value="{{ old('room') }}" required autofocus>
                    @if ($errors->has('room'))
                        <span>
                        <strong>{{ $errors->first('room') }}</strong>
                        <br>
                        </span>
                    @endif
                    <br>
                    <label><b>Starts at &nbsp&nbsp&nbsp&nbsp&nbsp</b></label>
                    <input type="DateTime" placeholder="Ano-mês-diaTh:m" id="start_date" style="width:50%;"type="start_date"  name="start_date" value="{{ old('start_date') }}" required autofocus>
                    <br>
                    @if ($errors->has('start_date'))
                        <span>
                        <strong>{{ $errors->first('start_date') }}</strong>
                        <br>
                        </span>
                    @endif
                    
                    <label><b>Ends at &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b></label>
                    <input type="Datetime" placeholder="Ano-mês-diaTh:m" id="end_date" style="width:50%;"type="end_date"  name="end_date" value="{{ old('end_date') }}" required autofocus>
                    <br>
                    @if ($errors->has('end_date'))
                        <span>
                        <strong>{{ $errors->first('end_date') }}</strong>
                        <br>
                        </span>
                    @endif
                    
                    <label><b>Color &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b></label>
                    <input type="enum" placeholder="Red, Green, Blue, Grey, Orange" id="color" style="width:50%;" type="color"  name="color" value="{{ old('color') }}" required autofocus>
                    <br>
                    @if ($errors->has('color'))
                        <span>
                        <strong>{{ $errors->first('color') }}</strong>
                        <br>
                        </span>
                    @endif
                    
                    <button type="submit" id="lbutton">Save</button>

                </form>  
            @endif
            </div>
        <div class="clear"></div>
    </div>
</div>


@endsection