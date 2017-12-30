@extends('layouts.appadmin')

@section('AdminContent')

<div class="container_admin">
    <ul class="breadcrumb">
        <li><a href="/home">Home</a></li>
        <li><a href="/admin">Admin</a></li>
        <li><a href="/admin/clientes">Clientes</a></li>
        <li>Pesquisa</li>
    </ul>
    <h1>Clientes<small>Administrator</small></h1>
    <div class="adminbox">
        <div class="admin_input">
            <form id="try" action="/admin/clientes/find_client" method="GET">
                <input type="text" class="pesquisa" name="search" id="search">
                <select name="type" id="type">
                    <option value="username">Username</option>
                    <option value="email">Email</option>
                    <option value="name">Nome</option>
                </select>
                <button class="try_ajax" type="submit" id="lbuttonadmin">Procurar</button>
            </form>
            <button type="submit" id="lbuttonadmin">Adicionar Cliente</button>
            <!--<a href="/admin/clientes/find_client" class="abutton">Adicionar Cliente</a>-->
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
    @endsection