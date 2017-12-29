@extends('layouts.appadmin')

@section('AdminContent')

<div class="container_admin">
    <ul class="breadcrumb">
        <li><a href="/home">Home</a></li>
        <li><a href="/admin">Admin</a></li>
        <li>Clientes</li>
    </ul>
    <h1>Clientes<small>Administrator</small></h1>
    <div class="adminbox">
        <input type="text" class="pesquisa" name="search" id="search">
        <button type="submit" id="lbuttonadmin">Procurar</button>
        <button type="submit" id="lbuttonadmin">Adicionar Cliente</button>
        <br><hr><br>
    <table class="faturas">
        <thead>
            <tr>
                <th style="text-align: center;">ID</th>
                <th style="text-align: center;">Username</th>
                <th style="text-align: center;">Email</th>
                <th style="text-align: center;">Nome</th>
                <th style="text-align: center;">Contacto</th>
                <th style="text-align: center;">Opções</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pessoa as $client)
        <tr>
            <td style="text-align: center;">{{$client->id}}</td>
            <td style="text-align: center;">{{$client->username}}</td>
            <td style="text-align: center;">{{$client->email}}</td>
            <td style="text-align: center;">{{$client->name}}</td>
            <td style="text-align: center;">{{$client->contacto}}</td>



            <td style="text-align: center;">

            <a class="face-button" href="{{ route('deletecliente', $client->id) }}">

                <div class="face-primary">
                    Editar
                </div>

                <div class="face-secondary">
                    {{$client->username}}
                </div>
            </a>

            <a class="face-button" href="{{ route('deletecliente', $client->id) }}">

                <div class="face-primary">
                    <span class="icon fa fa-cloud"></span>
                    Apagar
                </div>

                <div class="face-secondary">
                    <span class="icon fa fa-hdd-o"></span>
                    {{$client->username}}
                </div>
            </a>

<!--                 <form action="{{ route('deletecliente', $client->id) }}" class="button">
                    <input type="submit" value="Editar" />
                </form>
                <form action="{{ route('deletecliente', $client->id) }}" class="button">
                    <input type="submit" value="Eliminar" />
                </form> -->
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>

<script>
    $('form.button').on('click', function() {
        var choice = confirm('Tem a certeza que quer eliminar este Cliente?');
        if(choice === true) {

            return true;
        }
        return false;
    });
    



    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#n').val($(this).data('name'));
        $('#myModal').modal('show');
    });


</script>



@endsection