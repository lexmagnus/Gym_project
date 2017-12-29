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

		@if (Auth::guest())
        <nav class="navclass">
		<!-- menu hamburger --> 
		<span class="open-slide">
      			<a href="#" onclick="openSlideMenu()">
        	<svg width="30" height="30">
            	<path d="M0,5 30,5" stroke="#fff" stroke-width="5"/>
            	<path d="M0,14 30,14" stroke="#fff" stroke-width="5"/>
            	<path d="M0,23 30,23" stroke="#fff" stroke-width="5"/>
        	</svg>
      			</a>
	</span>
	<script>
    function openSlideMenu(){
      document.getElementById('side-menu').style.width = '250px';
     // document.getElementById('main').style.marginLeft = '250px';
    }

    function closeSlideMenu(){
      document.getElementById('side-menu').style.width = '0';
     // document.getElementById('main').style.marginLeft = '0';
    }
  </script>
          <ul class="ulteste">
		  	<li id="login">
            <!-- <li id="login"> -->
				<!--<a href="{{ url('/login') }}">Login</a>-->
				<a id="login-trigger" href="#" onClick="return false;">Login</a>
			
				<form id="login-form" role="form" method="POST" action="{{ url('/login') }}">
					{{ csrf_field() }}
					<label>
						<b>Username:</b>
					</label>

					<input type="text" placeholder="Username" id="username" type="username" class="form-control" name="username" required>
					<label>
						<b>Password:</b>
					</label>
					<input type="password" placeholder="Password" class="form-control" name="password" required>
					
					<input type="checkbox" name="remember" {{ old( 'remember') ? 'checked' : ''}}> Remember </br>
					<button type="submit" id="lbutton">LOGIN</button>

					<a id="create_account" href="#regist">Register</a><b> - </b>
					<a id="forgot" href="{{ url('/password/reset') }}">Forgot your Password?</a>
					
				</form>
			</li>
			<li class="liteste"><a href="/register">Inscrição</a></li>
			<li class="liteste"><a href="#about">Sobre</a></li>
			<li class="liteste"><a href="#pricing_table">Preços</a></li>
			<li class="liteste"><a href="#serv">Serviços</a></li>
			<li class="liteste"><a href="#home">Home</a></li>
			
          </ul>
		</nav>
		<!-- menu hamburger aberto--> 
	<div id="side-menu" class="side-nav">
    	<a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
    	<li class="liteste2"><a href="#home">Home</a></li>
		<li class="liteste2"><a href="#serv">Serviços</a></li>
		<li class="liteste2"><a href="#pricing_table">Preços</a></li>
		<li class="liteste2"><a href="#about">Sobre</a></li>
		<li class="liteste2"><a href="#regist">Inscrição</a></li>
		<li class="liteste2"><a href="/login">Login</a></li>
	  </div>

		@else
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
		  @endif

      </div>
	  
    </header>
	
<body>

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

<!-- @yield('content2') -->

<div class="container_admin">@yield('content2')</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    $('.try_ajax').click(function (event) {
    
    // Avoid the link click from loading a new page
    event.preventDefault();

    // Load the content from the link's href attribute
    $('.contenttest').load($(this).attr('href'));
});
</script>

</body>
    <!-- <footer>
					<p>@Copyright 2017/2018 - Grupo 5 ACR</p>
            </footer> -->

</html>