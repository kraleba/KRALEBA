@extends('layouts.app')

@section('content')

    <div class="form-group">
        <div class="row">
            <div>
                <a class="add" href="{{ route('customers.create') }}"> ADAUGA CLIENT</a>
            </div>

            <div>
                <div class="row searchFilter-custom round3">

                    <div class=" filter-customers col-lg-12">
                        <form action="{{ route('customers.index') }}" method="get">

                            <div class="input-group select-group ">
                                <div>
                                    <div>
                                        <input type='text' id="find_customer" name="customer_name"
                                            placeholder="--Selecteaza un Client--"
                                            class="form-control filter-control rounded-pill group"
                                            value="{{ $filtering_criteria['customer_name'] ?? '' }}">
                                    </div>
                                </div>

                                <div>
                                    <div>
                                        <select name="type" id="department"
                                            class="form-control rounded-pill filter-control group">
                                            <option selected value> -- Selecteaza tipul --</option>
                                            <option value="customer" @if (isset($filtering_criteria['type']) && $filtering_criteria['type'] == 'customer') selected @endif>
                                                Beneficiar
                                            </option>
                                            <option value="provider" @if (isset($filtering_criteria['type']) && $filtering_criteria['type'] == 'provider') selected @endif>
                                                Furnizor
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div>
                                    <select name="category" id="department"
                                        class="form-control rounded-pill filter-control group">

                                        <option selected value> -- select an option --</option>
                                        @foreach ($furnace_categories as $furnace_category)
                                            <option value="{{ $furnace_category->id }}"
                                                @if (isset($filtering_criteria['category']->id) && $furnace_category->id == $filtering_criteria['category']->id) selected @endif>
                                                {{ $furnace_category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <button id="searchBtn" type="submit" class="filter-customers-OK"> OK</button>


                            @if ($customers)
                                <button type="submit" name="downloadPDF" value="PDF" class="pdf-style">SALVEAZA ca.pdf
                                </button>
                            @endif

                            <button type="submit" class="revert-customers">REVERT</button>

                        </form>

                    </div>

                </div>

            </div>
            <!--end filter-->
            <div class="clintes">
                @if ($customers)
                    <div>
                        <h3> {{ $filter_title ?? 'Toti clientii' }}</h3>
                    </div>
                @endif

                <br>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @if ($customers)
                    <div>
                        <ul class="list-body">
                            @foreach ($customers as $customer)
                                <div class="list-group-item white-text rounded-pill group"
                                    style=" border-radius: 0; height: 80px">

                                    <div class="align">

                                        <b>{{ $customer->name }} </b> /

                                        {{ $customer->unique_code }}

                                        @if ($customer->address)
                                            /
                                        @endif
                                        {{ $customer->address }}

                                        @if ($customer->city)
                                            /
                                        @endif
                                        {{ $customer->city }}

                                        @if ($customer->zip_code)
                                            /
                                        @endif
                                        {{ $customer->zip_code }}

                                        @if ($customer->country)
                                            /
                                        @endif
                                        {{ $customer->country }}
                                    </div>
                                    <div class="align">

                                        {{ $customer->cif }}

                                        @if ($customer->ocr)
                                            /
                                        @endif
                                        {{ $customer->ocr }}

                                        @if ($customer->iban)
                                            /
                                        @endif
                                        {{ $customer->iban }}

                                        @if ($customer->swift)
                                            /
                                        @endif
                                        {{ $customer->swift }}

                                        @if ($customer->bank)
                                            /
                                        @endif
                                        {{ $customer->bank }}

                                    </div>

                                    <div class="align">
                                        {{ $customer->contact }}

                                        @if ($customer->phone)
                                            /
                                        @endif

                                        {{ $customer->phone }}

                                        @if ($customer->phone2)
                                            /
                                        @endif
                                        {{ $customer->phone2 }}

                                        @if ($customer->type)
                                            /
                                        @endif
                                        {{ $customer->type }}

                                        @if ($customer->email)
                                            /
                                        @endif
                                        {{ $customer->email }}

                                        @if ($customer->www)
                                            /
                                        @endif
                                        {{ $customer->www }}

                                        @if ($customer->note)
                                            /
                                        @endif
                                        {{ $customer->note }}

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
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                <a class="dropdown-item"
                                                    href="{{ route('customers.edit', $customer->id) }}">Edit</a>

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
            </div>
        @endsection
