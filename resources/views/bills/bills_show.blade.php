@extends('layouts.app')

@section('content')

    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    <br>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    {{-- <h3>Facturii</h3> --}}
                </div>
                <div class="pull-right mb-2">
                    {{--                    <a class="btn btn-secondary" href="{{ route('bills.create', $customer_id) }}"> Creaza o Factura</a>--}}
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div>
            @php
                if($bill->type == 1) {
                    $bill->type = 'Proforma';
                } else {
                    $bill->type = 'Definitiva';
                } 
            @endphp
            @if($bills)

            <h4>Emitent: {{$customer->name}}</h4>
            <p>Cod: {{$bill->bill_number}}</p>
            <p>Data facturii: {{$bill->bill_date}}</p>
            <p>Numar: {{$bill->id}}</p>
            @php
            if($customer->country == 1) {
                    $customer->coin = 'LEI';
                } else {
                    $customer->coin = 'EURO';
                }
            @endphp
            <p>Moneda: {{$customer->coin}}</p>
            <p>Curs Valutar: {{$bill->exchange}}</p>
            <p>TVA: {{$bill->tva}}%</p>
                @foreach($bills as $bill_ware)

                    <table>

                        <tr>
                            <th rowspan="2"></th>
                            <th rowspan="2">Product</th>
                            <th rowspan="2">Code</th>
                            <th rowspan="2">Description</th>
                            <th colspan="4"> buc./UM</th>
                            <th colspan="2">Total fara TVA</th>
                            <th colspan="2">TVA</th>
                            <th colspan="2">Total incl. TVA</th>
                        </tr>
                        <tr>
                            <th>UM</th>
                            <th>Cantit.</th>
                            <th>Euro</th>
                            <th>Lei</th>
                            <th>Euro</th>
                            <th>Lei</th>
                            <th>Euro</th>
                            <th>Lei</th>
                            <th>Euro</th>
                            <th>Lei</th>
                        </tr>
                        @php $i = 1;
                     $eu_wit_out_tva = 0;
                     $lei_wit_out_tva = 0;
                     $eu_tva = 0;
                     $lei_tva = 0;
                     $eu_with_tva = 0;
                     $lei_with_tva = 0;
                        @endphp
                        @foreach($bill_ware as $ware)

                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$ware['product_name']}}</td>
                                <td>{{$ware['custom_code']}}</td>
                                <td>{{$ware['description']}}</td>
                                <td>{{$ware['um']}}</td>
                                <td>{{$ware['amount']}}</td>

                                {{--pret pe bucata--}}
                                <td>{{round($ware['price_euro'],2)}}</td>
                                <td>{{round($ware['price_lei'], 2)}}</td>

                                {{--total pret fara tva EURO --}}
                                <td>{{round(($ware['amount'] * $ware['price_euro']) - ($ware['amount'] * $ware['price_euro'] * $ware['tva'] / (100 + $ware['tva'])), 2)}}</td>

                                {{--total pret fara tva LEI--}}
                                <td>{{round(($ware['amount'] * $ware['price_lei']) - ($ware['amount'] * $ware['price_lei'] * $ware['tva'] / (100 + $ware['tva'])), 2)}}</td>

                                {{--- TVA in eur---}}
                                <td>{{round($ware['amount'] * $ware['price_euro'] * $ware['tva'] / (100 + $ware['tva']), 2)}}</td>

                                {{-- TVA in lei --}}
                                <td>{{round($ware['amount'] * $ware['price_lei'] * $ware['tva'] / (100 + $ware['tva']), 2)}}</td>

                                {{--total pret tva--}}
                                <td>{{round($ware['amount'] * $ware['price_euro'], 2)}}</td>
                                <td>{{round($ware['amount'] * $ware['price_lei'], 2)}}</td>

                                @php
                                    $eu_wit_out_tva += round(($ware['amount'] * $ware['price_euro']) - ($ware['amount'] * $ware['price_euro'] * $ware['tva'] / (100 + $ware['tva'])), 2);
                                    $lei_wit_out_tva += round(($ware['amount'] * $ware['price_lei']) - ($ware['amount'] * $ware['price_lei'] * $ware['tva'] / (100 + $ware['tva'])), 2);

                                    $eu_tva += round($ware['amount'] * $ware['price_euro'] * $ware['tva'] / (100 + $ware['tva']), 2);
                                    $lei_tva += round($ware['amount'] * $ware['price_lei'] * $ware['tva'] / (100 + $ware['tva']), 2);

                                    $eu_with_tva += round($ware['amount'] * $ware['price_euro'], 2);
                                    $lei_with_tva += round($ware['amount'] * $ware['price_lei'], 2);


                                @endphp

                            </tr>
                            @php($i++)
                        @endforeach
                        <tr>
                            <td colspan="8"></td>
                            <td>{{$eu_wit_out_tva}}</td>
                            <td>{{$lei_wit_out_tva}}</td>
                            <td>{{$eu_tva}}</td>
                            <td>{{$lei_tva}}</td>
                            <td>{{$eu_with_tva}}</td>
                            <td>{{$lei_with_tva}}</td>

                        </tr>

                    </table>
                    <br>
                @endforeach
                <form>
                    <button id="searchBtn" type="submit" name="downloadPDF" value="PDF" class="btn btn-secondary"> Generare pdf</button>
                    <button id="searchBtn" type="submit"
                            class="btn btn-secondary btn-danger btn-flat bills-alert-delete">
                        Delete
                    </button>
                </form>
                <br>
                <div>    
                    <h3>Tipul facturii: {{$bill->type}} </h3>
                </div>
                @foreach($bills as $bill)
                    @foreach($bill as $ware)
                    <p> Categoria: <b> {{$ware['category_name']->name ?? ''}}</b>, Specificatia: <b>{{$ware['subcategory_name']->name ?? ''}} </b> </p>
                    @endforeach
                @endforeach
        </div>
         @else
            <div class="alert alert-warning">
                <h5>Nici o factura!</h5>
            </div>
    @endif

@endsection
