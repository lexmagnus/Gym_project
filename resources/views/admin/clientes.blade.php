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
        <div class="admin_input">
            <form id="try" action="/admin/clientes/find_client" onsubmit="return AjaxRequest();" method="GET">
                <input type="text" class="pesquisa" name="search" id="search">
                <select name="type" id="type">
                    <option value="username">Username</option>
                    <option value="email">Email</option>
                    <option value="name">Nome</option>
                </select>
                <button class="try_ajax" id="lbuttonadmin">Procurar</button>
            </form>
            <button onclick="document.getElementById('id01').style.display='block'" id="lbuttonadmin" style="width:auto;">Adicionar Cliente</button>
            <!--<button type="submit" id="lbuttonadmin">Adicionar Cliente</button>
            <a href="/admin/clientes/find_client" class="abutton">Adicionar Cliente</a>-->
            <div id="success"></div>
        </div>
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
                    Apagar
                </div>

                <div class="face-secondary">
                    {{$client->username}}
                </div>
            </a>

            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pages">
        {{ $pessoa->links() }}
    </div>
</div>
</div>


<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="/uploads/avatars/default.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="containerm">

        <label><b>Nome</b></label>
        <input type="text" placeholder="Nome" name="uname" class="input_modal" required>

        <label><b>Username</b></label>
        <input type="text" placeholder="Username" name="uname" class="input_modal" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Password: madeiragym" class="input_modal" name="psw" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Password: madeiragym" class="input_modal" name="psw" required>
            
        <button id="lbutton" type="submit">Adicionar Cliente</button>
    </div>

  
  </form>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function AjaxRequest(){
    
    $("tbody").val('loading...');

    var search = $("#search").val();  // reading value from your text field here
    var type = $("#type").val();
    alert(search);
    $.ajax({
        type: "GET",
        url: "/admin/clientes/find_client", // request handler
        data: {
            search: search,
            type: type
        },
        //error case
        error: function(xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success:function(result){
            //updating table with result
            $(".pages").html("");
            $("tbody").html(result);
        }
    });
    return false;

}

    $('form.button').on('click', function() {
        var choice = confirm('Tem a certeza que quer eliminar este Cliente?');
        if(choice === true) {

            return true;
        }
        return false;
    });
    

</script>



@endsection