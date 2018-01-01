@extends('layouts.appadmin')

@section('AdminContent')

<div class="container_admin">
    <ul class="breadcrumb">
        <li><a href="/home">Home</a></li>
        <li><a href="/admin">Admin</a></li>
        <li>Personal Trainer</li>
    </ul>
    <h1>Personal Trainers <small>Administrator</small></h1>
    <div class="adminbox">
        <div class="admin_input">
            <form id="try" action="/admin/clientes/find_pt" method="GET">
                <input type="text" class="pesquisa" name="search" id="search">
                <select name="type" class="select_type" id="type">
                    <option value="username">Username</option>
                    <option value="email">Email</option>
                    <option value="name">Nome</option>
                </select>
                <button class="try_ajax" onclick="return AjaxRequest();" id="lbuttonadmin">Procurar</button>
            </form>
            <button class="inlineform" onclick="document.getElementById('id01').style.display='block'" id="lbuttonadmin" style="width:auto;">Adicionar PT</button>
            <!--<button type="submit" id="lbuttonadmin">Adicionar Cliente</button>
            <a href="/admin/clientes/find_client" class="abutton">Adicionar Cliente</a>-->
        </div>
        <div id="success"></div>
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
        <tr class="row_{{$client->id}}">
            <td id="id_value" style="text-align: center;">{{$client->id}}</td>
            <td style="text-align: center;">{{$client->username}}</td>
            <td style="text-align: center;">{{$client->email}}</td>
            <td style="text-align: center;">{{$client->name}}</td>
            <td style="text-align: center;">{{$client->contacto}}</td>



            <td style="text-align: center;">

            <a class="face-button" id="{{$client->id}}" onclick="return Modal({{$client->id}});">

                <div class="face-primary">
                    Editar
                </div>

                <div class="face-secondary">
                    Editar
                </div>
            </a>

            <div id="id02" class="modal">
                <form class="modal-content animate" action="/admin/clientes/update" method="POST" style="text-align: left;">
                    <div class="imgcontainer">
                    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <img src="/uploads/avatars/default.jpg" alt="Avatar" class="avatar">
                    </div>

                    <div class="containerm">
                        <label><b>Username</b></label>
                        <input type="text" placeholder="Username" name="uusername" id="uusername" class="input_modal" required>

                        <label><b>Nome</b></label>
                        <input type="text" placeholder="Nome" name="uname" id="uname" class="input_modal" required>

                        <label><b>E-Mail Address</b></label>
                        <input type="text" placeholder="Email" name="uemail" id="uemail" class="input_modal" required>

                        <label><b>Password</b></label>
                        <input type="password" placeholder="Password: madeiragym" class="input_modal" name="upassword" id="upassword" required>

                        <label><b>Confirm Password</b></label>
                        <input type="password" placeholder="Password: madeiragym" class="input_modal" name="upassword_confirmation" id="upassword_confirmation" required>
                            
                        <button onclick="return AjaxUpdate({{$client->id}});" id="lbutton" type="submit">Atualizar Dados do cliente</button>
                    </div>

                
                </form>
                </div>



            <a class="face-button" id="face-buttonid" onclick="return Ajaxdelete({{$client->id}});" href="/admin/cliente/delete">

                <div class="face-primary">
                    Apagar
                </div>

                <div class="face-secondary">
                    Apagar
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
  
  <form class="modal-content animate" action="/admin/pt/add" method="POST">
    {!! csrf_field() !!}
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="/uploads/avatars/default.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="containerm">

        <label><b>Username</b></label>
        <input type="text" placeholder="Username" name="username" id="username" class="input_modal" required>

        <label><b>Nome</b></label>
        <input type="text" placeholder="Nome" name="name" id="name" class="input_modal" required>

        <label><b>E-Mail Address</b></label>
        <input type="text" placeholder="Email" name="email" id="email" class="input_modal" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Password: madeiragym" class="input_modal" name="password" id="password" required>

        <label><b>Confirm Password</b></label>
        <input type="password" placeholder="Password: madeiragym" class="input_modal" name="password_confirmation" id="password_confirmation" required>
            
        <button onclick="return AjaxPOST();" id="lbutton" type="submit">Adicionar PT</button>
    </div>

  
  </form>
</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
var insert = document.getElementById('lbutton');

// When the user clicks anywhere outside of the modal, close it

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == modal2){
        modal2.style.display = "none";
    }
    if (event.target == insert){
        modal.style.display = "none";
    }
}

function Modal(id){
    document.getElementById('id02').style.display='block';
    var res = id;
    
    $('#id02').on('load', function() {
    AjaxUpdate(id);
    })
    alert(id);
}

function AjaxRequest(){
    
    $("tbody").val('loading...');

    var search = $("#search").val();  // reading value from your text field here
    var type = $("#type").val();
    alert(search);
    $.ajax({
        type: "GET",
        url: "/admin/pt/find_pt", // request handler
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

function Ajaxdelete(id){

    //alert(id);
    //var parent = $(this).parent();
    $tr = $(this).closest("tr");

    var choice = confirm('Tem a certeza que quer eliminar este Cliente?');
    if(choice === true) {
        $.ajax({
        type: "GET",
        url: "/admin/pt/delete", // request handler
        data: {id: id},
        //error case
        error: function(xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success:function(result){
            //updating table with result
            $('.row_'+id).remove();
            $("#success").html("");
            $("#success").html('<div class="success"><strong>'+result+'</strong></div>').delay(3000).fadeOut();
        }
    });
        }
        return false;
    
        

}


function AjaxPOST(){

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var username = $("#username").val();
    var name = $("#name").val();  // reading value from your text field here
    var email = $("#email").val();
    var password = $("#password").val();
    var password_confirmation = $("#password_confirmation").val();
    
    alert(CSRF_TOKEN);
    $.ajax({
        type: "POST",
        url: "/admin/pt/add", // request handler
        data: {
            _token: CSRF_TOKEN,
            username: username,
            name: name,
            email: email,
            password: password,
            password_confirmation: password_confirmation
        },
        //error case
        error: function(xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success:function(result){
            //updating table with result
            $("#success").html("");
            $("#success").html('<div class="success"><strong>'+result.success+'</strong></div>').delay(3000).fadeOut();
            $("tbody").append(result);
        }
    });
    return false;

}

function AjaxUpdate(value){

/*var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var username = $("#username").val();
var name = $("#name").val();  // reading value from your text field here
var email = $("#email").val();
var password = $("#password").val();
var password_confirmation = $("#password_confirmation").val();*/

alert(value);
$.ajax({
    type: "POST",
    url: "/admin/clientes/add", // request handler
    data: {
        "_token": CSRF_TOKEN,
        "id": res,
        "username": username,
        "name": name,
        "email": email,
        "password": password,
        "password_confirmation": password_confirmation
    },
    //error case
    error: function(xhr, status, error) {
        alert(status);
        alert(xhr.responseText);
    },
    success:function(result){
        //updating table with result
        $("#success").html("");
        $("#success").html('<div class="success"><strong>'+result+'</strong></div>').delay(3000).fadeOut();
    }
});
return false;

}
    

</script>



@endsection