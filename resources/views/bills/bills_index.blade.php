@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <title>Facturii</title>
    </head>

    <body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>Facturii</h3>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-secondary" href="{{ route('bills.create', $customer_id) }}"> Creaza o Factura</a>
                </div>
            </div>
        </div>
        @include('bills.bills_filter')

    </div>
    <br>

    <div>
        <h3> {{$filter_title ?? 'Toate facturile!'}}</h3>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div>

        @if($bills)
            @foreach($bills as $bill)

                <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">

                    <div class="align">
                        {{-- <a href="{{ route('bills.show',$bills->id) }}"> --}}

                        <b>{{ $bill->name }} </b> /

                        Data Facturari: {{ $bill->bill_date}}

                        @if($bill->bill_number)
                            /
                        @endif
                        Numarul Facturi: {{ $bill->bill_number}}

                        @if($bill->exchange)
                            /
                        @endif
                        Curs Valutar: {{ $bill->exchange}}

                        @if($bill->tva)
                            /
                        @endif
                        Total incl. TVA: {{ $bill->tva}}

                    </div>
                    <div class="dropdown option-button">
                        <div class=" dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                             aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </div>
                        <form
                            action="{{ route('bills.destroy',['customer_id' => $bill->customer_id, 'bill' => $bill->id]) }}"
                            method="POST">

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item"
                                   href="{{ route('bills.show', ['customer_id' => $bill->customer_id, 'bill' => $bill->id]) }}">Vezi
                                    Fctura </a>

                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item">Delete</button>

                            </div>
                        </form>
                    </div>
                </div>

                <br>
            @endforeach
    </div>

    @else
        <div class="alert alert-warning">
            <h5>Nici o factura!</h5>
        </div>
    @endif

@endsection

