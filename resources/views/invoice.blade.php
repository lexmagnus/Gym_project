@extends('layouts.app')

@section('content')

                @if(session('status'))
                    <div class="warning">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
   
                    <div class="loginbox">

                        <h3>Faturas disponíveis:</h3><br>

                        <hr><br>

                        <table class="faturas">
                            <tr>
                                <th>Data</th>
                                <th>Total</th>
                                <th>Opção</th>
                            </tr>

                            @if( count($invoices) )
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                        <td>{{ $invoice->total() }}</td>
                                        <td><a href="{{ route('downloadInvoice', $invoice->id) }}">Download</a></td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="3">No Invoice currently.</td>
                                </tr>
                            @endif
                        </table>

                    </div>
@endsection