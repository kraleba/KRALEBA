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
                    <a class="btn btn-secondary" href="{{ route('bills.create') }}"> Creeaza o Factura</a>
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
                <form action="{{ route('bills.index') }}" method="get">
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

                    {{-- <div class="filter-item_OK col-3">
                        <button id="searchBtn" type="submit" class="btn btn-secondary"> OK</button>
                    </div> --}}
                </form>



                <form action="{{ route('bills.index') }}" method="get">
                    {{-- <div>
                        <h4>SELECTEAZA:</h4>
                    </div> --}}


                    <br>

                    <div class="input-group">
                        <div class="filter-item1 item-left">
                                <div class="form-row">

                                    {{-- <option> --}}
                                    <input  id="startdate" class="form-control filter-control  rounded-pill" placeholder="--Start Date--">
                                {{-- </option> --}}
                                </div>

                                <script>
                                    $(document).ready(function(){
                                    $("#startdate").datepicker();
                                    });
                                </script>
                            </select>
                        </div>

                        <div class="filter-item1">
                            {{-- <select name="category" id="department" class=""> --}}
                                <div class="form-row">
                                    {{-- <strong>End Date </strong> --}}
                                    <br>

                                    <input id="enddate" class="form-control filter-control  rounded-pill" placeholder="--End Date--">
                                </div>

                                <script>
                                    $(document).ready(function(){
                                    $("#enddate").datepicker();
                                    });
                                </script>
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
    <br>




    <div class="row searchFilter card round3b">
    <div class="col-sm-12 box-filter-b">
        <table class="form-control filter-control  rounded-pill">
            
            <tr > 
                <th rowspan="2"> </th>
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
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            <tr>
                <td>3</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="8"></td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td ></td>
            </tr>
            
        </table>

    </div>
    </div>
    </div> 
    <br>
    
    <br>




    <div>
        <h3> {{$filter_title ?? 'Toti clientii'}}</h3>
    </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
         @endif
        <div >
            <ul class="list-body"  >
                @if($bills)

                    @foreach ($bills as $bills)

                        <div class="list-group-item rounded-pill" style=" border-radius: 0; height: 80px; ">
                            <div class="align-b">
                                <div>
                                {{ $bills->custumer_id }} </b>
                                    @if($bills->custumer_id)
                                        /
                                    @endif
                                    {{ $bills->custumer_id }}

                                    @if($bills->uniqueCode)
                                        /
                                    @endif
                                    {{ $bills->uniqueCode }}
                                    <!-- {{ $bills->uniqueCode }} -->

                                    @if($bills->bill_date)
                                        /
                                    @endif
                                    {{ $bills->bill_date }}

                                    @if($bills->bill_number)
                                        /
                                    @endif
                                    {{ $bills->bill_number }}

                                    @if($bills->type)
                                        /
                                    @endif
                                    {{ $bills->type }}
                                </div>
                                <div >
                                    @if($bills->currency)
                                        /
                                    @endif
                                    {{ $bills->currency }}

                                    @if($bills->exchange)
                                        /
                                    @endif
                                    {{ $bills->exchange }}

                                    @if($bills->TVA)
                                        /
                                    @endif
                                    {{ $bills->TVA }}

                                    @if($bills->item)
                                        /
                                    @endif
                                    {{ $bills->item }}

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
                                <form action="{{ route('bills.destroy',$bills->id) }}" method="POST">

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('bills.edit',$bills->id) }}">Edit</a>
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
    </div>

    @else
        <div class="alert alert-warning">
            <h5>Nici un client!</h5>
        </div>
    @endif

@endsection



</body>

</html>
