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
                <h2>Home</h2>
                </div>
            </section>
            <section id="slide2">
                <div id="serv">
                    <div class="servcontainer">
                        <div class="servcontent">
                            <h2>Serviços disponiveis no ginásio</h2>
                        </div>
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
                <div id="free">
                    <div class="freecontainer">
                        <div class="freecontent">
                            <h2>Free trial</h2>
                        </div>
                    </div>
                </div>
            </section>
            <section id="slide4">
                <div id="about">
                    <div class="aboutcontainer">
                        <div class="aboutcontent">
                            <h2>Sobre o nosso ginásio</h2>
                        </div>
                    </div>
                </div>
            </section>
            <section id="slide5">
                <div id="pricing_table">
                    <div class="aboutcontainer">
                        <div class="aboutcontent">
                            <h2>Pricing Tables</h2>
                            <div class="col-pricing">
                                <ul class="price-box">
                                <li class="header-pricing">Simple</li>
                                <li class="emph"><strong>$ 5.99</strong> / Month</li>
                                <li><strong>20GB</strong> Disk Space</li>
                                <li><strong>10GB</strong> Data Transfer</li>
                                <li><strong>2</strong> Domains</li>
                                <li><strong>50</strong> Email Accounts</li>
                                <li><strong>2</strong> FTP Accounts</li>
                                <li class="emph"><a href="#" class="button-pricing">Sign Up</a></li>
                                </ul>
                            </div>

                            <div class="col-pricing">
                                <ul class="price-box best">
                                <li class="header-pricing header-orange">Standard</li>
                                <li class="emph"><strong>$ 15.99</strong> / Month</li>
                                <li><strong>75GB</strong> Disk Space</li>
                                <li><strong>50GB</strong> Data Transfer</li>
                                <li><strong>10</strong> Domains</li>
                                <li><strong>100</strong> Email Accounts</li>
                                <li><strong>Unlimited</strong> FTP Accounts</li>
                                <li class="emph"><a href="#" class="button-pricing">Sign Up</a></li>
                                </ul>
                            </div>

                            <div class="col-pricing">
                                <ul class="price-box">
                                <li class="header-pricing">Advanced</li>
                                <li class="emph"><strong>$ 25.99</strong> / Month</li>
                                <li><strong>120GB</strong> Disk Space</li>
                                <li><strong>100GB</strong> Data Transfer</li>
                                <li><strong>Unlimited</strong> Domains</li>
                                <li><strong>Unlimited</strong> Email Accounts</li>
                                <li><strong>UNlimited</strong> FTP Accounts</li>
                                <li class="emph"><a href="#" class="button-pricing">Sign Up</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endsection