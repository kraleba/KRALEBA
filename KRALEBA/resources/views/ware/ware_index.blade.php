@extends('layouts.app')

@section('content')

    <h3>Articole</h3>
    <div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-secondary" href="{{ route('wares.create', $customer_id ?? '') }}"> ADAUGA ARTICOl</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row  card round3">

            <div class="col-lg-12 ">
                @if($customer_id && $wares)
                <form action="{{ route('bills.create', $customer_id ?? '') }}">
                    <div>
                        <h3>Articole ne facturate {{$wares_count ?? ''}}</h3>
                        <button class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm"
                                data-toggle="tooltip" style="float: right">Genereaza factura
                        </button>

                    </div>
                </form>
                    @endif
            </div>

        </div>
    </div>


    <!--end filter-->
    <br>

{{--    @if($wares)--}}
{{--        <div>--}}
{{--            <h3> {{$filter_title ?? 'Toti clientii'}}</h3>--}}
{{--        </div>--}}
{{--    @endif--}}

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if($wares)
        <div>
            <ul class="list-body">
                @foreach ($wares as $ware)

                    <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">

                        <div class="align">
                            {{--                            <a href="{{ route('customers.show',$ware->id) }}">--}}

                            <b>{{ $ware->product_name }} </b> /

                            {{ $ware->custom_code }}

                            @if($ware->composition)
                                /
                            @endif
                            {{ $ware->material }}

                            @if($ware->design)
                                /
                            @endif
                            {{ $ware->weaving }}

                            @if($ware->color)
                                /
                            @endif
                            {{ $ware->finishing }}

                            @if($ware->softness)
                                /
                            @endif
                            {{ $ware->country }}
                            {{--                            </a>--}}
                        </div>
                        <div class="align">

                            {{ $ware->cif }}

                            @if($ware->ocr)
                                /
                            @endif
                            {{ $ware->ocr }}

                            @if($ware->iban)
                                /
                            @endif
                            {{ $ware->iban }}

                            @if($ware->swift)
                                /
                            @endif
                            {{ $ware->swift }}

                            @if($ware->bank)
                                /
                            @endif
                            {{ $ware->bank }}

                        </div>

                        <div class="align">
                            {{$ware->contact}}

                            @if($ware->phone)
                                /
                            @endif

                            {{ $ware->phone }}

                            @if($ware->phone2)
                                /
                            @endif
                            {{ $ware->phone2 }}

                            @if($ware->type)
                                /
                            @endif
                            {{ $ware->type }}

                            @if($ware->email)
                                /
                            @endif
                            {{ $ware->email }}

                            @if($ware->www)
                                /
                            @endif
                            {{ $ware->www }}

                            @if($ware->note)
                                /
                            @endif
                            {{ $ware->note }}

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
                            <form action="{{ route('wares.destroy', ['customer_id'=>$ware->customer_id,'ware'=>$ware->id]) }}"
                                  method="POST"
                            >
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <a class="dropdown-item"
                                       href="{{ route('wares.edit', ['customer_id'=>$ware->customer_id, 'ware'=>$ware->id])}}">
                                        Edit
                                    </a>


                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item">Delete</button>

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
            <h5>Nici un client!</h5>
        </div>
    @endif

@endsection
