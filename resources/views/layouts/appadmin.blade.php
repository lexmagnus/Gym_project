<!DOCTYPE html>
<html >
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

<body>
  <nav class="menu Admin" tabindex="0">
	<div class="smartphone-menu-trigger"></div>
  <header class="avatar Admina">
		<img src="/uploads/avatars/{{Auth::user()->avatar}}">
        <br><h2>{{Auth::user()->username}}</h2><h5>Administrator</h5></a>
        
  </header>
	<ul id="ulperfil">
        <li tabindex="0" class="icon-dashboard"><span><a id="ref" href="/admin">Dashboard</a></span></li>
        <li tabindex="0" class="icon-customers"><span><a id="ref" href="/admin/clientes">Clientes</a></span></li>
        <li tabindex="0" class="icon-customers"><span><a id="ref" href="/admin/pt">Personal Trainers</a></span></li>
        <li tabindex="0" class="icon-customers"><span><a id="ref" href="/admin/admin">Administrators</a></span></li>
  </ul>
</nav>

<main>

@yield('AdminContent')

</main>



</body>
</html>
