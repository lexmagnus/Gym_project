@extends('layouts.app')

@section('content')
  
                    <div class="loginbox">

                        <h1><small>Ola </small> <b>{{ Auth::user()->username }}</b></h1><br>

                        <h3>Tem a certeza que quer cancelar a subscrição?</h3><br>

                        <hr>

                        <form action="{{ route('subscriptionCancel') }}" method="post">
                            {{ csrf_field() }}
                            <br><p><a href="{{ route('plano') }}">Não, pretendo continuar</a></p><br>
                            <button type="submit" id="lbutton">Cancelar subscrição!</button>
                        </form>

                    </div>

@endsection