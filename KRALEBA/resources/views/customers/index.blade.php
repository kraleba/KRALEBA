@extends('layouts.app')

@section('content')

    {{----}}
    <h3> Clienti</h3>

    <div class="container">
        <div class="row searchFilter">
            <div class="col-sm-12">

                <form action="{{ route('customers.index') }}" method="get">

                    <div class="input-group">
                        <div>
                            <select name="type" id="department" class="form-control rounded-pill">
                                <option value=""> -- Selecteaza tipul --</option>
                                <option value="Customer"> Beneficiar</option>
                                <option value="Provider">Furnizor</option>
                            </select>
                        </div>
                        <div>
                            <select name="category" id="department" class="form-control rounded-pill">

                                <option value=""> -- Selecteaza o categorie --</option>

                                @foreach ($furnace_categories as $furnace_category)

                                    <option
                                        value="{{$furnace_category->category_id}}">{{ $furnace_category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <input type='text' name="subcategory" list="browsers"
                                   placeholder="Selecteaza o subcategorie" class="form-control rounded-pill">

                            <datalist id="browsers" class="dropdown">

                                @foreach ($subcategories as $subcategory)
                                    <option>{{ $subcategory->name }}</option>
                                @endforeach
                            </datalist>
                        </div>

                        <button id="searchBtn" type="submit" class="btn btn-secondary btn-search"><span
                                class="glyphicon glyphicon-search">&nbsp;</span> <span class="label-icon">Search</span>
                        </button>
                    </div>
                </form>

                <form>
                    <button type="submit"> Scoate filtrele</button>
                </form>


            </div>
        </div>
    </div>

    <!--end filter-->
    <div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                </div>
                <div class="pull-right">
                    <a class="btn btn-secondary" href="{{ route('customers.create') }}"> Creaza clinet</a>
                </div>
            </div>

        {{--    print pdf --}}
            <button class="btn btn-secondary">Printeaza PDF</button>
        </div>
    </div>
    <h3>{{$filter_title ?? ''}}</h3>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <ul class="list-body">
        @if($customers)
            @foreach ($customers as $customer)

                <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">
                    <div>
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
                    <div>

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

                    <div>
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
    </ul>
    <br>

    @endforeach
    @else
        <div class="alert alert-warning">
            <h5>Nici un client!</h5>
        </div>
    @endif

@endsection
<script>
    import Checkbox from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Checkbox";

    export default {
        components: {Checkbox}
    }


</script>

