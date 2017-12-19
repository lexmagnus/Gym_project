@extends('layouts.app')

@section('content')

<body>
  <nav class="menu" tabindex="0">
	<div class="smartphone-menu-trigger"></div>
  <header class="avatar">
    <img src="/uploads/avatars/{{Auth::user()->avatar}}">
    <br><a id="id_try_ajax" class="try_ajax" href="/home/{{Auth::user()->username}}/perfil"><h2>{{Auth::user()->username}}</h2></a>
  </header>
	<ul id="ulperfil">
    <?php
    use App\Pessoa;
    use App\Morada;
    $pessoa = Pessoa::where(['user_id'=>Auth::user()->id])->first();
    $morada = Morada::where(['id'=>($pessoa->morada_id)])->first();
    if (!empty ($pessoa->morada_id)) {
      echo "<li tabindex='0' class='icon-dashboard'><span><a class='try_ajax' href='/home/".Auth::user()->username."/addMorada'>Alterar Morada</a></span></li>";
    }else{
      echo "<li tabindex='0' class='icon-dashboard'><span><a class='try_ajax' href='/home/".Auth::user()->username."/addMorada'>Adicionar Morada</a></span></li>";
    }
    
    if (!empty ($pessoa->contacto)) {
      echo "<li tabindex='0' class='icon-customers'><span><a class='try_ajax' href='/home/".Auth::user()->username."/edit'>Alterar dados Pessoais</a></span></li>";
    }else{
      echo "<li tabindex='0' class='icon-customers'><span><a class='try_ajax' href='/home/".Auth::user()->username."/edit'>Adicionar dados Pessoais</a></span></li>";
      }?>

    <!-- <li tabindex="0" class="icon-dashboard"><span><a id="ref" href="/home/{{Auth::user()->username}}/addMorada">Adicionar Morada</a></span></li> -->
    <!-- <li tabindex="0" class="icon-customers"><span><a id="ref" href="/home/{{Auth::user()->username}}/edit">Alterar dados Pessoais</a></span></li> -->
    <li tabindex="0" class="icon-users"><span><a class="try_ajax" href="/home/{{Auth::user()->username}}/altEmail">Alterar email</a></span></li>
    <li tabindex="0" class="icon-settings"><span><a class="try_ajax" href="/home/{{Auth::user()->username}}/altPassword">Alterar Password</a></span></li>
  </ul>
</nav>

<div class="contenttest"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    $('.try_ajax').click(function (event) {
    
    // Avoid the link click from loading a new page
    event.preventDefault();

    // Load the content from the link's href attribute
    $('.contenttest').load($(this).attr('href'));
});
</script>
