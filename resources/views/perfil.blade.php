<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>
	
	<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
	<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
	</script>
</head>
<button onclick="topFunction()" id="btopo" title="homepagebutton">Top</button>
<header class="header">
      <div class="container">
        <div id="branding">
		<a href="../"><h1><span class="highlight">Madeira</span> Gym</h1></a>
		</div>

		<ul class="ullogout">
		<img id="log-teste" src="/uploads/avatars/{{ Auth::user()->avatar }}">
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn">
				
				@if (Auth::user()->isAdmin())
				Administrador
				@else
				{{ Auth::user()->username }}
				@endif
				</a>
				<div class="dropdown-content">
					<a onclick="load_main_content()" href="/home/{{Auth::user()->username}}" id="jtest" name="/home/{{Auth::user()->username}}/perfil">Ver Perfil</a>
					<a href="{{ route('invoices') }}">Ver Faturas</a>
					<a href="{{ url('/logout') }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
								Logout
					</a>
					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							<button type="submit" id="lobutton">logout</button>
					</form>
				</div>
			</li>
			@if (Auth::user()->isAdmin())
				<li class="liteste"><a href="/pt">Contate o PT</a></li>
				<li class="liteste"><a href="/plan">Pacotes</a></li>
				<li class="liteste"><a href="/services">Serviços</a></li>
				<li class="liteste"><a href="/admin">Admin</a></li>
				<li class="liteste"><a href="/home">Home</a></li>
			@else
				<li class="liteste"><a href="/pt">Contate o PT</a></li>
				<li class="liteste"><a href="/plan">Pacotes</a></li>
				<li class="liteste"><a href="/services">Serviços</a></li>
				<li class="liteste"><a href="/home">Home</a></li>
			@endif
		  </ul>

      </div>
	  
    </header>
	


<nav class="menu" tabindex="0">
	<div class="smartphone-menu-trigger"></div>
  <header class="avatar">
    <img src="/uploads/avatars/{{Auth::user()->avatar}}">
    <br><a id="id_try_ajax" class="try_ajax" href="/home/{{Auth::user()->username}}/perfil"><h2>{{Auth::user()->username}}</h2></a>
  </header>
	<ul id="ulperfil">
    <?php
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

<body>
<!-- @yield('content2') -->

<div class="container_admin">
  <div class="profile_d">
  <img id="img_prof" src="/uploads/avatars/{{Auth::user()->avatar}}" alt="Avatar" style="height:100%">
  <form id="change_img" enctype="multipart/form-data" action="/home/{{Auth::user()->username}}" method="post">
          <label id="upload_i" for="form-file">Alterar a imagem de perfil</label>
          <input type="file" name="avatar" id="form-file" class="hidden" />
          <!-- <input type="file" name="avatar"> -->
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" value="Submeter">
        </form>
    <div class="prof_cont">
      <br>
      <h3>{{$pessoa->name}}
        @if($user->isAdmin)
          <b>(Administrador)</b>
        @elseif($user->isInst)
          <b>(Instrutor)</b>
        @else
          <b>(Cliente)</b>
        @endif
        </h3>
        <h5>---- {{$user->email}} ----</h5>

        <br><hr><br>
        <div id="bb"><p><label>Contacto</label> {{$pessoa->contacto}}</p></div><br>
        <div id="bb"><p><label>Data de Nascimento</label> {{$pessoa->nascimento}}</p></div><br>
        <div id="bb"><p><label>NIF</label> {{$pessoa->nif}}</p></div><br>
        <div id="bb"><p><label>Sexo</label> {{$pessoa->sexo}}</p></div><br>
        <div id="bb"><p><label>Peso</label> {{$pessoa->peso}}</p></div><br>
        <div id="bb"><p><label>Altura</label> {{$pessoa->altura}}</p>

        @if (!empty($morada))
          <p><label>Morada</label> {{$morada->rua}}</p>
        @endif
    </div>
  </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    $('.try_ajax').click(function (event) {
      //clearsection
      $('.container_admin').html("");
      // Avoid the link click from loading a new page
      event.preventDefault();
      
      // Load the content from the link's href attribute
      $('.container_admin').load($(this).attr('href'));
      });
</script>

</body>
    <!-- <footer>
					<p>@Copyright 2017/2018 - Grupo 5 ACR</p>
            </footer> -->

</html>
