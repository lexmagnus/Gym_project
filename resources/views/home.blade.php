@extends('layouts.app')

@section('content')
            <div class="messages">
                @if(session('login'))
                    <div class="success">
                        <strong>{{ session('login') }}</strong>
                    </div>
                @endif
                @if(session('error_token'))
                    <div class="error">
                        <strong>{{ session('error_token') }}</strong>
                    </div>
                @endif
            </div>
                
                    <!-- @if (Auth::user()->isAdmin())
                    <br><p><strong>{{ Auth::user()->username }}, You are logged in as ADMIN!</strong></p>

                    @elseif (Auth::user()->isInst())
                    <br><p><strong>{{ Auth::user()->username }}, You are logged in as instructor!</strong></p>
                    
                    @else
                    <br><p><strong>{{ Auth::user()->username }}, You are logged in as Client!</strong></p>
                
                    @endif -->

            <section id="slide3">
                <div id="free">
                    <div class="freecontainer">
                        <div class="freecontent">
                            <img src="images\wallpapers\freetrial.jpg" alt="freeimage" height="100%" width="100%">
                        </div>
                    </div>
                </div>
            </section>
    
@endsection
