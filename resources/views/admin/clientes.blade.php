@extends('layouts.appadmin')

@section('AdminContent')
    <h2>Clientes</h2>
    <div class="adminbox">
        <input type="text" name="search" id="search">
        <button type="submit">Procurar</button>
        <button type="submit">Adicionar Cliente</button>
        <br><hr><br>
    <table class="faturas">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Nome</th>
                <th>Contacto</th>
                <th>Opções</th>
            </tr>
        @foreach($pessoa as $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->username}}</td>
            <td>{{$client->email}}</td>
            <td>{{$client->name}}</td>
            <td>{{$client->contacto}}</td>



            <td>
                <form action="{{ route('deletecliente', $client->id) }}" class="button">
                    <input type="submit" value="Editar" />
                </form>
                <form action="{{ route('deletecliente', $client->id) }}" class="button">
                    <input type="submit" value="Eliminar" />
                </form>
            </td>
        </tr>
        @endforeach
    </table>
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