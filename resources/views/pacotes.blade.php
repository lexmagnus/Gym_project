@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0">

            @if (session('status'))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h1>Welcome <span class="text-primary">{{ Auth::user()->name }}</span></h1>

                    @if( $is_subscribed )

                        <img width="180" src="{{ asset('img/train-active.png') }}" alt="Train Active">

                        <h1 class="pulse"><span>Choo</span> <span>Choo...</span></h1>

                        <h3 class="text-success">
                            🚂 Who whoo! your train is running  <br>
                            <small>
                                it has <span class="text-primary">{{ $subscription->stripe_plan }}</span> plan.
                            </small>
                        </h3>

                        @if( $subscription->onGracePeriod() )

                            <div class="alert alert-warning">
                                <h3 class="modal-title">Subscription expiring at {{ $subscription->ends_at->toFormattedDateString() }}</h3>
                            </div>

                            <form method="post" action="{{ route('subscriptionResume') }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success">Resume Subscription</button>
                            </form>
                            <br>

                        @else
                            <a href="{{ route('confirmCancellation') }}" class="btn btn-danger">Cancel Subscription</a>
                        @endif

                    @else

                        <img width="180" src="{{ asset('img/train.png') }}" alt="Train Disabled">
                        <h3 class="text-danger">Your train is out of fuel. <br>
                            <small>You need to a coal delivery subscription to keep your train running!</small>
                        </h3>

                    @endif

                </div>
            </div> -->


            <div class="row text-center">
                <div class="col-md-12">
                    @if( !empty($plans) )

                        
                        @if($is_subscribed)
                            @if( $subscription->onGracePeriod() )

                                <div class="warning">
                                    <strong>Plano cancelado! A sua subscrição expira a {{ $subscription->ends_at->toFormattedDateString() }} !</strong><br>
                                    <form method="post" action="{{ route('subscriptionResume') }}">
                                        {{ csrf_field() }}
                                        <strong><button type="submit" class="btn_link"><b>Retome a sua subscrição<b> </button> e continue a usufruir das nossas vantagens!</strong>
                                    </form>
                                </div>
                                <br>

                            @else
                                <div class="success">
                                    <strong>O seu plano atual é {{ $subscription->stripe_plan }}!</strong>
                                    <strong>Mas se quiser pode mudar de pacote ou 
                                    <a href="{{ route('confirmCancellation') }}" class="btn btn-danger">cancelar a subscrição</a>.</strong>
                                </div>
                            @endif

                        @else
                            <div class="warning">
                                <strong>Escolha o plano que melhor se adequa aos seus objetivos!</strong>
                            </div>
                        @endif

                        <h2>Tabela de Preços</h2>

                        @foreach($plans as $plan)

                            <div class="col-pricing">
                                <ul class="price-box">
                                <li class="header-pricing">{{ $plan->name }}</li>
                                <li class="emph"><strong>{{ $plan->currency }} {{ $plan->amount / 100 }} / {{ $plan->interval }}</strong></li>
                                <li><strong>120GB</strong> Disk Space</li>
                                <li><strong>100GB</strong> Data Transfer</li>
                                <li><strong>Unlimited</strong> Domains</li>
                                <li><strong>Unlimited</strong> Email Accounts</li>
                                <li><strong>UNlimited</strong> FTP Accounts</li>
                                <li class="emph">
                                    @if( $is_subscribed &&  ( $subscription->stripe_plan ==  $plan->id ) )
                                        <a href="#" class="button-pricing" onClick="return false;">Plano Atual</a>
                                    @else
                                        <a href="{{ route('plan', $plan->id) }}" class="button-pricing">Subscrever</a>
                                    @endif
                                </li>
                                </ul>
                            </div>
                        @endforeach

                    @else
                        <div class="alert alert-warning">
                            <strong>No Plan found on Stripe Account!</strong> <br>
                            <p>It could be Network error or you don't have plans defined in Stripe Panel.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
