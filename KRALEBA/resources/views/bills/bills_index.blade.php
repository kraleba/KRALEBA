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

                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$ware['product_name']}}</td>
                            <td>{{$ware['custom_code']}}</td>
                            <td>{{$ware['description']}}</td>
                            <td>{{$ware['um']}}</td>
                            <td>{{$ware['amount']}}</td>
                            {{--pret pe bucata--}}
                            <td>{{$ware['price_euro']}}</td>
                            <td>{{$ware['price_lei']}}</td>
                            {{--total pret fara tva--}}
                            <td>{{round($ware['amount'] * $ware['price_euro'] - $ware['tva_euro_buc'] * $ware['amount'], 2)}}</td>
                            <td>{{round($ware['amount'] * $ware['price_lei'] - $ware['tva_lei_buc'] * $ware['amount'], 2)}}</td>

                            <td>{{round($ware['tva_euro_buc'] * $ware['amount'], 2)}}</td>
                            <td>{{round($ware['tva_lei_buc'] * $ware['amount'], 2)}}</td>
                            {{--total pret tva--}}
                            <td>{{round($ware['amount'] * $ware['price_lei'], 2)}}</td>
                            <td>{{round($ware['amount'] * $ware['price_lei'], 2)}}</td>

                            @php
                                $eu_wit_out_tva += round($ware['amount'] * $ware['price_lei'] - $ware['tva_euro_buc'] * $ware['amount'], 2);
                                $lei_wit_out_tva += round($ware['amount'] * $ware['price_lei'] - $ware['tva_lei_buc'] * $ware['amount'], 2);

                                $eu_tva += round($ware['tva_euro_buc'] * $ware['amount'], 2);
                                $lei_tva += round($ware['tva_lei_buc'] * $ware['amount'], 2);

                                $eu_with_tva += round($ware['amount'] * $ware['price_lei'], 2);
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
