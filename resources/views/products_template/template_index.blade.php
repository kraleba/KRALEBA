@extends('layouts.app')

@section('content')
    <div class="container">

        <div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-secondary" href="{{ route('templates.create') }}"> ADAUGA CLIENT</a>
                    </div>
                </div>

            </div>
        </div>

        @include('products_template.template_filter')

        <!--end filter-->
        <br>

        {{--    @if($customers)--}}
        {{--        <div>--}}
        {{--            <h3> {{$filter_title ?? 'Toti clientii'}}</h3>--}}
        {{--        </div>--}}
        {{--    @endif--}}

        <br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        {{--    @if($customers)--}}
        <div>
            <ul class="list-body">
                {{--                @foreach ($customers as $customer)--}}

                <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">

                    <div class="align">
                        {{--                            <a href="{{ route('customers.show',$customer->id) }}">--}}

                        <b>pirus </b> /

                        {{--                                {{ $customer->unique_code }}--}}
                        <a> 001-1/5 </a>
                        {{--                                @if($customer->address)--}}
                        {{--                                    /--}}
                        {{--                                @endif--}}
                        {{--                                {{ $customer->address }}--}}

                        {{--                                @if($customer->city)--}}
                        {{--                                    /--}}
                        {{--                                @endif--}}
                        {{--                                {{ $customer->city }}--}}

                        {{--                                @if($customer->zip_code)--}}
                        {{--                                    /--}}
                        {{--                                @endif--}}
                        {{--                                {{ $customer->zip_code }}--}}

                        {{--                                @if($customer->country)--}}
                        {{--                                    /--}}
                        {{--                                @endif--}}
                        {{--                                {{ $customer->country }}--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="align">--}}

                        {{--                            {{ $customer->cif }}--}}

                        {{--                            @if($customer->ocr)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}
                        {{--                            {{ $customer->ocr }}--}}

                        {{--                            @if($customer->iban)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}
                        {{--                            {{ $customer->iban }}--}}

                        {{--                            @if($customer->swift)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}
                        {{--                            {{ $customer->swift }}--}}

                        {{--                            @if($customer->bank)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}
                        {{--                            {{ $customer->bank }}--}}

                        {{--                        </div>--}}

                        {{--                        <div class="align">--}}
                        {{--                            {{$customer->contact}}--}}

                        {{--                            @if($customer->phone)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}

                        {{--                            {{ $customer->phone }}--}}

                        {{--                            @if($customer->phone2)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}
                        {{--                            {{ $customer->phone2 }}--}}

                        {{--                            @if($customer->type)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}
                        {{--                            {{ $customer->type }}--}}

                        {{--                            @if($customer->email)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}
                        {{--                            {{ $customer->email }}--}}

                        {{--                            @if($customer->www)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}
                        {{--                            {{ $customer->www }}--}}

                        {{--                            @if($customer->note)--}}
                        {{--                                /--}}
                        {{--                            @endif--}}
                        {{--                            {{ $customer->note }}--}}

                        {{--                        </div>--}}

                        <div class="dropdown option-button">
                            <div class=" dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                 aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path
                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                </svg>
                            </div>
                            {{--                                <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">--}}

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item"
                                   href="{{--{{ route('bills.index', $customer->id) }}--}}">Creaza Productie </a>

                                <a class="dropdown-item"
                                   href="{{--{{ route('customers.edit', $customer->id) }}--}}">Edit</a>

                                <a class="dropdown-item" href="{{--{{ route('wares.index', $customer->id) }}--}}">
                                    Articole </a>


                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item">Delete</button>

                            </div>
                            {{--                                </form>--}}
                        </div>
                    </div>
                {{--                    <br>--}}
                {{--                @endforeach--}}
            </ul>
        </div>

        {{--    @else--}}
        <div class="alert alert-warning">
            <h5>Nici un client!</h5>
        </div>
        {{--    @endif--}}
    </div>
@endsection


