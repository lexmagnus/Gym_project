@extends('layouts.app')

@section('content')
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
@endsection
