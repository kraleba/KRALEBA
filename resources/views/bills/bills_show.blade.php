@extends('layouts.app')

@section('content')

    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    <br>
    <head>
        <meta charset="UTF-8">
        <title>Facturii</title>
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
        <div>
            <h3> {{$filter_title ?? 'Factura!'}}</h3>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div>

            @if($bills)
                @foreach($bills as $bill)

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
                        @foreach($bill as $ware)
                            @php
                            print_r($ware['tva']);
                            @endphp
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
                                {{--total pret fara tva--}}
                                <td>{{round($ware['amount'] * $ware['price_euro'] - $ware['tva_euro_buc'] * $ware['amount'], 2)}}</td>
                                <td>{{round($ware['amount'] * $ware['price_lei'])-($ware['amount'] * $ware['price_lei']) * ($ware['tva']) * 100 * ($ware['tva'])}}</td>

                                <td>{{round($ware['tva_euro_buc'] * $ware['amount'], 2)}}</td>
                                <td>{{round($ware['amount'] * $ware['price_lei']) * ($ware['tva']) * 100 * ($ware['tva'])}}</td>
                                {{--total pret tva--}}
                                <td>{{round($ware['amount'] * $ware['price_euro'], 2)}}</td>
                                <td>{{round($ware['amount'] * $ware['price_lei'], 2)}}</td>

                                @php
                                    $eu_wit_out_tva += round($ware['amount'] * $ware['price_euro'] - $ware['tva_euro_buc'] * $ware['amount'], 2);
                                    $lei_wit_out_tva += round($ware['amount'] * $ware['price_lei'] - $ware['tva_lei_buc'] * $ware['amount'], 2);

                                    $eu_tva += round($ware['tva_euro_buc'] * $ware['amount'], 2);
                                    $lei_tva += round($ware['tva_lei_buc'] * $ware['amount'], 2);

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
        </div>


        @else
            <div class="alert alert-warning">
                <h5>Nici o factura!</h5>
            </div>
    @endif

@endsection
