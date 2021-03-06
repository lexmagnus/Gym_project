<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>
	
	<link rel="stylesheet" href="{{ URL::asset('css/customHome.css') }}" />
	<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
	<script>
		window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
	</script>
</head>
<header>
      <div class="container">
        <div id="branding">
          <h1><span class="highlight">Madeira</span> Gym</h1>
        </div>
          <ul class="ulheader">
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn">Olá, <u>{{Auth::user()->username}}</u></a>
				<div class="dropdown-content">
					<a href="/home/{{Auth::user()->username}}">Ver Perfil</a>
					<a href="#">Ver amigos</a>
					<a href="#">Ver pagamentos</a>
					<a href="#">Ver horários</a>
					<a href="#">inscrever em aulas</a>
					<a href="#">Definições Pessoais</a>
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
			<li class="liteste"><a href="/dadosPessoais">Dados Pessoais</a></li>
			<li class="liteste"><a href="/pagamentos">Pagamentos</a></li>
			<li class="liteste"><a href="/pt">Contate o PT</a></li>
			<li class="liteste"><a href="/home">Home</a></li>
          </ul>
	  </div>
    </header>
<body>

	@yield('content')

</body>

</html>