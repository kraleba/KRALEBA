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
                    {{--                    <a class="btn btn-secondary" href="{{ route('bills.create', $customer_id) }}"> Creaza o Factura</a>--}}
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif


        <div class="container">
            <div class="row searchFilter card round3b">

                <div class="col-sm-12 box-filter-b">
                    <form action="{{ route('bills.index', $customer_id ?? '' ) }}" method="get">
                        <div>
                            <h4>SELECTEAZA:</h4>
                        </div>


                        <br>

                        <div class="input-group">
                            <div class="filter-item1 item-left">
                                <select name="type" id="department" class="form-control rounded-pill filter-control">
                                    <option
                                        value="{{$filtering_criteria['type']['name'] ?? ''}}"> {{$filtering_criteria['type']['nume'] ?? '-- Selecteaza tipul --'}} </option>
                                    <option value="Customer"> Beneficiar</option>
                                    <option value="Provider">Furnizor</option>
                                </select>
                            </div>

                            <div class="filter-item1">
                                <select name="category" id="department"
                                        class="form-control filter-control  rounded-pill">

                                    <option
                                        value="{{$filtering_criteria['category']->category_id ?? ''}}"> {{$filtering_criteria['category']->name ?? '-- Selecteaza o categorie --'}}</option>

                                    @foreach ($furnace_categories as $furnace_category)

                                        <option
                                            value="{{$furnace_category->category_id}}">{{ $furnace_category->name }}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="filter-item1">
                                <input type='text'
                                       name="subcategory"
                                       list="browsers"
                                       placeholder="Selecteaza o subcategorie"
                                       class="form-control filter-control rounded-pill"
                                       value="{{$filtering_criteria['subcategory'] ?? ''}}"
                                >

                                <datalist id="browsers" class="dropdown">

                                    @foreach ($subcategories as $subcategory)
                                        <option>{{ $subcategory->name }}</option>
                                    @endforeach
                                </datalist>

                            </div>
                        </div>

                        {{-- <div class="filter-item_OK col-3">
                            <button id="searchBtn" type="submit" class="btn btn-secondary"> OK</button>
                        </div> --}}
                    </form>


                    <form action="{{ route('bills.index', $customer_id ?? '') }}" method="get">
                        {{-- <div>
                            <h4>SELECTEAZA:</h4>
                        </div> --}}


                        <br>

                        <div class="input-group">
                            <div class="filter-item1 item-left">
                                <div class="form-row">

                                    {{-- <option> --}}
                                    <input id="startdate" class="form-control filter-control  rounded-pill"
                                           placeholder="--Start Date--">
                                    {{-- </option> --}}
                                </div>
                                </select>
                            </div>

                            <div class="filter-item1">
                                {{-- <select name="category" id="department" class=""> --}}
                                <div class="form-row">
                                    {{-- <strong>End Date </strong> --}}
                                    <br>

                                    <input id="enddate" class="form-control filter-control  rounded-pill"
                                           placeholder="--End Date--">
                                </div>
                                </select>
                            </div>

                            {{-- <div class="filter-item1">
                                <input type='text'
                                       name="subcategory"
                                       list="browsers"
                                       placeholder="Selecteaza o subcategorie"
                                       class="form-control filter-control rounded-pill"
                                       value="{{$filtering_criteria['subcategory'] ?? ''}}"
                                >

                                <datalist id="browsers" class="dropdown">

                                    @foreach ($subcategories as $subcategory)
                                        <option>{{ $subcategory->name }}</option>
                                    @endforeach
                                </datalist>

                            </div> --}}
                        </div>

                        <div class="filter-item_OK">
                            <button id="searchBtn" type="submit" class="btn btn-secondary"> OK</button>
                        </div>
                    </form>


                    {{--  <form action="{{ route('bills.index') }}" method="get">
                          <div>
                              <h4>SELECTEAZA:</h4>
                          </div>


                          <br>

                          <div class="input-group">
                              <div class="filter-item1 item-left">
                                  <select name="type" id="department" class="form-control rounded-pill filter-control">
                                      <option
                                          value="{{$filtering_criteria['type']['name'] ?? ''}}"> {{$filtering_criteria['type']['nume'] ?? '-- Selecteaza tipul --'}} </option>
                                      <option value="Customer"> Beneficiar</option>
                                      <option value="Provider">Furnizor</option>
                                  </select>
                              </div>

                              <div class="filter-item1">
                                  <select name="category" id="department" class="form-control filter-control  rounded-pill">

                                      <option
                                          value="{{$filtering_criteria['category']->category_id ?? ''}}"> {{$filtering_criteria['category']->name ?? '-- Selecteaza o categorie --'}}</option>

                                      @foreach ($furnace_categories as $furnace_category)

                                          <option
                                              value="{{$furnace_category->category_id}}">{{ $furnace_category->name }}</option>

                                      @endforeach
                                  </select>
                              </div>

                              <div class="filter-item1">
                                  <input type='text'
                                         name="subcategory"
                                         list="browsers"
                                         placeholder="Selecteaza o subcategorie"
                                         class="form-control filter-control rounded-pill"
                                         value="{{$filtering_criteria['subcategory'] ?? ''}}"
                                  >

                                  <datalist id="browsers" class="dropdown">

                                      @foreach ($subcategories as $subcategory)
                                          <option>{{ $subcategory->name }}</option>
                                      @endforeach
                                  </datalist>

                              </div>
                          </div>

      {{--                    <div class="filter-item_OK">--}}
                    {{--                        <button id="searchBtn" type="submit" class="btn btn-secondary"> OK</button>--}}
                    {{--                    </div>--}}

                    </form>


                </div>
                <form>
                    <div class="revert-bills">
                        <button type="submit" class="btn btn-secondary">REVERT</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <br>

    <div>
        <h3> {{$filter_title ?? 'Toate facturile clientului X'}}</h3>
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

                            {{-- <b>{{ $bill->name }} </b> / --}}

                            {{-- {{ $bills->bill_date}} --}}

                            @if($bills->bill_number)
                                /
                            @endif
                            {{ $bills->bill_number}}

                            @if($bills->exchange)
                                /
                            @endif
                            {{ $bills->exchange}}

                            @if($bills->TVA)
                                /
                            @endif
                            {{ $bills->TVA}}

                    </div>

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
                    <form action="{{ route('bills.destroy',['customer_id' => $bill->customer_id, 'bill' => $bill->id]) }}"
                          method="POST">

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <a class="dropdown-item" href="{{ route('bills.show', ['customer_id' => $bill->customer_id, 'bill' => $bill->id]) }}">Vezi Fctura </a>

                            @csrf
                            @method('DELETE')
                            <button class="dropdown-item">Delete</button>

                        </div>
                    </form>
                </div>


{{--aici  se termina tabelul --}}


            @endforeach
    </div>

    @else
        <div class="alert alert-warning">
            <h5>Nici un client!</h5>
        </div>
    @endif


    @endsection


    </body>

    </html>

    <script>
        /*Datae time modal*/
        $(document).ready(function () {
            $("#startdate").datepicker();
            $("#enddate").datepicker();
        });
        /*Datae time modal end*/
    </script>
