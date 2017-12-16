@extends('layouts.appperfil')

@section('content2')

<div class="loginbox">
        <form role="form" method="POST" action="{{ url('/home/Auth::user()->username/addMorada') }}">

            {{ csrf_field() }}

            <label>
                <b>Rua</b>
            </label>
            <input type="text" placeholder="Rua" id="rua" type="rua" class="form-control" name="rua" value="{{ old('rua') }}" required autofocus>
            @if ($errors->has('rua'))
            <span>
                <strong>{{ $errors->first('rua') }}</strong>
                <br>
            </span>
            @endif

            <label>
                <b>Código Postal</b>
            </label>
            <input type="text" placeholder="Código Postal" id="cod" type="cod" class="form-control" name="cod" value="{{ old('cod') }}" required autofocus>
            @if ($errors->has('cod'))
            <span>
                <strong>{{ $errors->first('cod') }}</strong>
                <br>
            </span>
            @endif

            <label>
                <b>Localidade</b>
            </label>
            <input type="text" placeholder="Localidade" id="localidade" type="localidade" class="form-control" name="localidade" value="{{ old('localidade') }}" required autofocus>
            @if ($errors->has('localidade'))
            <span>
                <strong>{{ $errors->first('localidade') }}</strong>
                <br>
            </span>
            @endif

            <button type="submit" id="lbutton">Alterar Dados</button>

        </form>
        </div>

@endsection