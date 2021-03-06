@extends('layouts.app')

@section('content')
            <div class="messages">
                @if ($errors->has('username'))
                <div class="error">
					<span>
						<strong>{{ $errors->first('username') }}</strong>
						<br>
                    </span>
                </div>
                @endif
                @if ($errors->has('password'))
                <div class="error">
					<span>
						<strong>{{ $errors->first('password') }}</strong>
						<br>
                    </span>
                </div>
				@endif
                @if(session('status'))
                    <div class="warning">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                @if(session('activated'))
                    <div class="success">
                        <strong>{{ session('activated') }}</strong>
                    </div>
                @endif
            </div>
            <section id="slide1">
                <div id="home">
                <img id="galeria" src="" alt="">
                <script type="text/javascript">
                    var primeira = 0
                    const fgaleria = ['images/wallpapers/homepromocao.jpg', 'images/wallpapers/freetrial.jpg']
    
                function mudar() {
                    let mudanca = ( primeira == fgaleria.length-1 ) ? 0 : primeira+1
                    document.getElementById('galeria').src = fgaleria[mudanca]
                    primeira = mudanca
                }

                window.onload = function () {
                    if (fgaleria.length) {
                        document.getElementById('galeria').src = fgaleria[primeira]
                        setInterval(mudar, 4000)
                }
                }

</script>
                </div>
            </section>
            <section id="slide2">
                <div id="serv">
                            <div class="col_servico">
                            <div id="topserv"><img id="first" src="images/wallpapers/first.png" alt="primeira"></div>
                            <div id="bottomserv"><p><br>Para começar com o insubstituível aquecimento proporcionamos-lhe uma grande quantidade de máquinas da maior qualidade. Temos passadeiras, elipticas, remos e muito mais! Todas as máquinas que temos foram compradas com a intenção de proporcionar uma fácil utilização, por tanto, não tenha medo, venha experimentar!</p></div>
                            </div>
                            <div class="col_servico">
                            <div id="topserv"><img id="second" src="images/wallpapers/second.png" alt="segunda"></div>
                            <div id="bottomserv"><p><br>Quer ganhar músculo? É no nosso ginásio! Para ganhar força necessita de pesos adequados a si. Portanto aqui temos quaisqueres pesos que necessite, venha testar! Para além disso, possuímos tudo o que precisar de halteres, barras, bancos, etc...</p></div>
                            </div>
                            <div class="col_servico">
                            <div id="topserv"><img id="last" src="images/wallpapers/last.png" alt="ultima"></div>
                            <div id="bottomserv"><p><br>Qualquer que seja a sua dificuldade ou objetivo, seja perder peso ou até ganhá-lo, ou simplesmente manter, temos todo o equipamento disponível para si com a maior facilidade de utilização. Uma variade de equipamento que lhe permite efectuar qualquer tipo de treino. Em áreas designadas a fitness, o espaço é constituido pela melhor qualidade de colchões, bolas de pilates e muito mais.</p></div>
                            </div>
                </div>

                <script>
                    var slideIndex = 0;
                    showSlides();   

                    function showSlides() {
                        var i;
                        var slides = document.getElementsByClassName("mySlides");
                        var dots = document.getElementsByClassName("dot");
                        for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";  
                        }
                        slideIndex++;
                        if (slideIndex > slides.length) {slideIndex = 1}    
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        slides[slideIndex-1].style.display = "block";  
                        dots[slideIndex-1].className += " active";
                        setTimeout(showSlides, 4000); // Change image every 2 seconds
                    }
                    </script>
            </section>
            <section id="slide3">
                <div id="pricing_table">
                            <div class="col-pricing">
                                <ul class="price-box">
                                <li class="header-pricing">Simple</li>
                                <li class="emph"><strong>€ 39.90</strong> / Mês</li>
                                <li><strong>5</strong> Sessões com PT</li>
                                <li><strong>3</strong> Vezes p/ Semana</li>
                                <li><strong>2</strong> Consultas de nutricionismo</li>
                                <li class="emph"><a href="/register" class="button-pricing">Sign Up</a></li>
                                </ul>
                            </div>

                            <div class="col-pricing">
                                <ul class="price-box best">
                                <li class="header-pricing header-orange">Standard</li>
                                <li class="emph"><strong>€ 59.90</strong> / Mês</li>
                                <li><strong>10</strong> Sessões com PT</li>
                                <li><strong>4</strong> Vezes p/ Semana</li>
                                <li><strong>5</strong> Consultas de nutricionismo</li>
                                <li class="emph"><a href="/register" class="button-pricing">Sign Up</a></li>
                                </ul>
                            </div>

                            <div class="col-pricing">
                                <ul class="price-box">
                                <li class="header-pricing">Advanced</li>
                                <li class="emph"><strong>€ 99.90</strong> / Mês</li>
                                <li><strong>Ilimitado</strong> Sessões com PT</li>
                                <li><strong>Ilimitado</strong> Vezes p/ Semana</li>
                                <li><strong>Ilimitado</strong> Consultas de nutricionismo</li>
                                <li class="emph"><a href="/register" class="button-pricing">Sign Up</a></li>
                                </ul>
                            </div>
                </div>
                
            </section>
            <section id="slide4">
                <div id="about">
                            <div id="googleMap" style="width:80%; height:600px; margin: 0 auto;position: relative; z-index: 900;"></div>
                                
                                <script>
                                function myMap() {
                                // var mapProp= {
                                //     center:new google.maps.LatLng(32.658978, -16.924315),
                                //     zoom:18,
                                // };
                                var uluru = { lat: 32.658978, lng: -16.924315 };
                                    var map = new google.maps.Map(document.getElementById('googleMap'), {
                                        zoom: 18,
                                        center: uluru
                                    });
                                    var marker = new google.maps.Marker({
                                        position: uluru,
                                        map: map
                                    });
                                
                                //var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                                }
                                </script>

                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFivJePR3xH39kBRZ3X8W-H7PjaiftQNo&callback=myMap"></script>
                                
                            </div>
                </div>
            </section>
            
            <!--<section id="slide5">
                <div id="regist">
                            <h2>Registo</h2>
                            <div class="loginbox">
                            <form role="form" method="POST" action="{{ url('/register') }}">

                                {{ csrf_field() }}
                                <label>
                                    <b>Username</b>
                                </label>
                                <input type="text" placeholder="Username" id="username" type="username" class="form-control" name="username" required>
                                @if ($errors->has('username'))
                                <span>
                                    <strong>{{ $errors->first('username') }}</strong>
                                    <br>
                                </span>
                                @endif

                                <label>
                                    <b>Name</b>
                                </label>
                                <input type="text" placeholder="Name" id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span>
                                    <strong>{{ $errors->first('name') }}</strong>
                                    <br>
                                </span>
                                @endif

                                <label>
                                    <b>E-Mail Address</b>
                                </label>
                                <input type="text" placeholder="email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                <span>
                                    <strong>{{ $errors->first('email') }}</strong>
                                    <br>
                                </span>
                                @endif

                                <label>
                                    <b>Password</b>
                                </label>
                                <input type="password" placeholder="Password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span>
                                    <strong>{{ $errors->first('password') }}</strong>
                                    <br>
                                </span>
                                @endif

                                <label>
                                    <b>Confirm Password</b>
                                </label>
                                <input id="password-confirm" type="password" placeholder="Password" class="form-control" name="password_confirmation" required>
                                

                                <button type="submit" id="lbutton">Register</button>

                            </form>
                            </div>
                </div>
            </section>-->
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <script>
        $(function() {
            $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 500);
                        return false;
                    }
                }
            });
        });
    </script>
@endsection