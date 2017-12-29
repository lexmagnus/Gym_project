@extends('layouts.app')

@section('content')
<div class="services-body">
    <head>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    </head>
    $table->increments('id');
            $table->string('title');
            $table->integer('room')->nullable();
            $table->DateTime('start_date');
            $table->DateTime('end_date');
            $table->string('color');
            $table->timestamps();

    <div id="services">
        <div id="left">
            {!! $calendar->calendar() !!}
             {!! $calendar->script() !!}
        </div>
            <div id="right">
                    <h1>Insert classes</h1>
                <form role="form" method="POST" action="/home/{{Auth::user()->username}}/services">

                    {{ csrf_field() }}

                    <label><b>Nome da aula</b></label>
                    <input type="text" placeholder="Nome aula" id="nome aula" class="form-control" name="nome aula" value="{{ old('rua') }}" required autofocus>

                    <label><b>Sala de Aula</b></label>
                    <input type="text" placeholder="Sala de aula" id="room" type="room" class="form-control" name="room" value="{{ old('room') }}" required autofocus>
                    @if ($errors->has('room'))
                        <span>
                        <strong>{{ $errors->first('room') }}</strong>
                        <br>
                        </span>
                    @endif
                    <label><b>Hora de início</b></label>
                    <input type="DateTime" placeholder="Hora de início" id="start_date" type="start_date" class="form-control" name="start_date" value="{{ old('start_date') }}" required autofocus>
                    @if ($errors->has('start_date'))
                        <span>
                        <strong>{{ $errors->first('start_date') }}</strong>
                        <br>
                        </span>
                    @endif
                    <label><b>Hora de fim</b></label>
                    <input type="DateTime" placeholder="Hora de fim" id="end_date" type="end_date" class="form-control" name="end_date" value="{{ old('end_date') }}" required autofocus>
                    @if ($errors->has('end_date'))
                        <span>
                        <strong>{{ $errors->first('end_date') }}</strong>
                        <br>
                        </span>
                    @endif

                    @if (empty($pessoa->morada_id))
                        <button type="submit" id="lbutton">Adicionar Morada</button>
                    @else
                        <button type="submit" id="lbutton">Alterar Morada</button>
                    @endif

                </form>
            </div>
        <div class="clear"></div>
    </div>
</div>


@endsection