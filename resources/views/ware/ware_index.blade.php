@extends('layouts.app')

@section('content')


    @if ($customer_id && $wares)
        <div class="container ">
            <div class="row  card round3">
                <div class="col-lg-12 ">
                    <form action="{{ route('bills.create', $customer_id ?? '') }}">
                        <div>
                            <h3>Articole ne facturate {{ $wares_count ?? '' }}</h3>
                            <button class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip"
                                style="float: right">Genereaza factura
                            </button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    @else
        @include('ware.ware_filters')
    @endif

    <!--end filter-->
    <br>
    <div class="clintes">

        @if ($wares)
            <div>
                <h4 class="filter-selection"> {{ $filter_title ?? 'Articole' }}</h4>
            </div>
        @endif
        <br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($wares)
            <div>
                <ul class="list-body">
                    @foreach ($wares as $ware)
                        <div class="clients-group list-group-item">

                            <div class="align">

                                <b>{{ $ware->product_name }} </b> 

                                @if ($ware->customer_id)
                                /
                                @endif
                                Cod: {{ $ware->customer_id }} 

                                {{ $ware->custom_code }} /

                                @if ($ware->description)
                                @endif
                                Descriere: {{ $ware->description }} /

                                @if ($ware->bill_date)
                                @endif
                                Data Facturi: {{ $ware->bill_date }} /

                                {{-- @if ($ware->color)
                                /
                                {{-- @endif                                  nu stiu --}}
                                {{-- ???????????? --}}

                                UM: @if ($ware->um)
                                @endif
                                {{ $ware->um }} /

                                @if ($ware->price)
                                @endif
                               Pret-buc: {{ $ware->price }}

                                / #  {{ $ware->amount }} 
                                @if ($ware->price)
                                /
                                @endif
                                @if ($ware->currency == 1)  
                                    Total-Lei: {{ round($ware->price * $ware->amount, 2)}} /
                                    Total-Euro: {{ round($ware->price * $ware->amount / $ware->exchange, 2)}} /

                                @else
                                    Total-Lei: {{ round($ware->price * $ware->amount / $ware->exchange, 2)}} /
                                    Total-Euro: {{ round($ware->price * $ware->amount, 2)}} /

                                @endif


                                
                                Tva-pret-total: @if ($ware->currency == 1)
                                    {{ round($ware->price * $ware->amount * $ware->tva / (100 + $ware->tva), 2) }} /
                                        
                                    @else
                                    {{ round(($ware->price * $ware->amount / $ware->exchange) * $ware->tva / (100 + $ware->tva), 2) }} /
                                @endif
                                
                                
                                @if ($ware->exchange)
                                @endif
                                Curs Valutar: {{ $ware->exchange }}
                            </div>

                            <div class="dropdown option-button">
                                <div class=" dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg>
                                </div>
                                <form
                                    action="{{ route('wares.destroy', ['customer_id' => $ware->customer_id, 'ware' => $ware->id]) }}"
                                    method="POST">
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        {{-- <a class="dropdown-item"
                                       href="{{ route('wares.edit', ['customer_id'=>$ware->customer_id, 'ware'=>$ware->id])}}">
                                        Edit
                                    </a> --}}


                                        @csrf
                                        @method('DELETE')
                                        {{-- <button class="dropdown-item">Delete</button> --}}

                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="alert alert-warning">
                <h5>Nici un articol!</h5>
            </div>
        @endif
    </div>

@endsection
