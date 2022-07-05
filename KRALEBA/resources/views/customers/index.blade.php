@extends('layouts.app')

@section('content')

    {{--test--}}
    <div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-secondary" href="{{ route('customers.create') }}"> ADAUGA CLIENT</a>
                </div>
            </div>

        </div>
    </div>
    <div class="container ">
        <div class="row searchFilter card round3">

            <div class="col-lg-12 box-filter">
                <form action="{{ route('customers.index') }}" method="get">
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

                    <div class="filter-item_OK ">
                        <button id="searchBtn" type="submit" class="btn btn-secondary"> OK</button>
                    </div>

                    <div class="pdf-style">

                        @if($customers)
                            <button type="submit" name="downloadPDF" value="PDF" class="btn btn-info">SALVEAZA ca .pdf</button>
                        @endif
                    </div>
                </form>

                <form>
                    <div class="revert-b">
                        <button type="submit" class="btn btn-secondary">REVERT</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!--end filter-->
    <br>

    @if($customers)
        <div>
            <h3> {{$filter_title ?? 'Toti clientii'}}</h3>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if($customers)
        <div>
            <ul class="list-body">
                @foreach ($customers as $customer)

                    <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">

                        <div class="align">
                            <b>{{ $customer->name }} </b> /

                            {{ $customer->uniqueCode }}

                            @if($customer->address)
                                /
                            @endif
                            {{ $customer->address }}

                            @if($customer->city)
                                /
                            @endif
                            {{ $customer->city }}

                            @if($customer->zipCode)
                                /
                            @endif
                            {{ $customer->zipCode }}

                            @if($customer->country)
                                /
                            @endif
                            {{ $customer->country }}
                        </div>
                        <div class="align">

                            {{ $customer->cif }}

                            @if($customer->ocr)
                                /
                            @endif
                            {{ $customer->ocr }}

                            @if($customer->iban)
                                /
                            @endif
                            {{ $customer->iban }}

                            @if($customer->swift)
                                /
                            @endif
                            {{ $customer->swift }}

                            @if($customer->bank)
                                /
                            @endif
                            {{ $customer->bank }}

                        </div>

                        <div class="align">
                            {{$customer->contact}}

                            @if($customer->phone)
                                /
                            @endif

                            {{ $customer->phone }}

                            @if($customer->phone2)
                                /
                            @endif
                            {{ $customer->phone2 }}

                            @if($customer->type)
                                /
                            @endif
                            {{ $customer->type }}

                            @if($customer->email)
                                /
                            @endif
                            {{ $customer->email }}

                            @if($customer->www)
                                /
                            @endif
                            {{ $customer->www }}

                            @if($customer->note)
                                /
                            @endif
                            {{ $customer->note }}

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
                            <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <a class="dropdown-item" href="{{ route('customers.edit',$customer->id) }}">Edit</a>


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


