<div class="row searchFilter-custom card round3">

    <div class="col-lg-12 box-filter">
        <form action="{{ route('customers.index') }}" method="get">
            <div>
                <h4>SELECTEAZA:</h4>
            </div>
            <br>

            <br>
            <div class="input-group item-left filter-item1">
                <div >
                    <div>
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Selecteaza un Client--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div>
                        <select name="customer_type" id="department"
                                class="form-control rounded-pill filter-control">
                            {{-- <option value="{{$filtering_criteria['type']['name'] ?? ''}}"> {{$filtering_criteria['type']['nume'] ?? '-- Selecteaza tipul --'}} </option> --}}
                            <option value="customer"> Beneficiar</option>
                            <option value="provider">Furnizor</option>
                        </select>
                    </div>
                </div>



                <div>
                    <select name="category" id="department" class="form-control rounded-pill filter-control">

                        <option
                            value="{{$filtering_criteria['category']->category_id ?? ''}}"> {{$filtering_criteria['category']->name ?? '-- Selecteaza o categorie --'}}</option>

                        {{--                                @foreach ($furnace_categories as $furnace_category)--}}

                        {{--                                    <option--}}
                        {{--                                        value="{{$furnace_category->category_id}}">{{ $furnace_category->name }}</option>--}}

                        {{--                                @endforeach--}}
                    </select>

                </div>

                <div>
                    <input type='text'
                           name="subcategory"
                           list="browsers"
                           placeholder="--Selecteaza o subcategorie--"
                           class="form-control filter-control rounded-pill"
                           value="{{$filtering_criteria['subcategory'] ?? ''}}"
                    >

                    <datalist id="browsers" class="dropdown">

                        {{--                                @foreach ($subcategories as $subcategory)--}}
                        {{--                                    <option>{{ $subcategory->name }}</option>--}}
                        {{--                                @endforeach--}}
                    </datalist>

                </div>
            </div>


            <div class="filter-item_OK ">
                <button id="searchBtn" type="submit" class="btn btn-secondary"> OK</button>
            </div>

            <div class="pdf-style">

                {{--                        @if($customers)--}}
                {{--                            <button type="submit" name="downloadPDF" value="PDF" class="btn btn-info">SALVEAZA ca .pdf--}}
                {{--                            </button>--}}
                {{--                        @endif--}}
            </div>
        </form>

        <form>
            <div class="revert-b">
                <button type="submit" class="btn btn-secondary">REVERT</button>
            </div>
        </form>
    </div>

</div>
