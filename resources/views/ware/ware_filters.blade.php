<div class="container ">
    <div class="row searchFilter card round3">

        <div class="col-lg-12 box-filter">
            <form method="get">
                <div>
                    <h4>SELECTEAZA:</h4>
                </div>

                <br>

                <div class="input-group item-left">
                    {{--          type               --}}
                    <div class="filter-item1 ">
                        <select name="customer_type" id="department"
                                class="form-control rounded-pill filter-control">
                            {{-- <option value="{{$filtering_criteria['type']['name'] ?? ''}}"> {{$filtering_criteria['type']['nume'] ?? '-- Selecteaza tipul --'}} </option> --}}
                            <option value=" "> Selecteaza tipul </option>
                            <option value="customer"> Beneficiar</option>
                            <option value="provider">Furnizor</option>
                        </select>
                    </div>


                    <div class="filter-item1">
                        <select name="category" id="department" class="form-control rounded-pill filter-control">

                            <option
                                value="{{$filtering_criteria['category']->category_id ?? ''}}"> {{$filtering_criteria['category']->name ?? '-- Selecteaza o categorie --'}}</option>

                            @foreach ($furnace_categories as $furnace_category)

                                <option
                                    value="{{$furnace_category->id}}">{{ $furnace_category->name }}</option>

                            @endforeach
                        </select>

                    </div>

                    <div class="filter-item1">
                        <input type='text'
                               name="subcategory"
                               list="browsers"
                               placeholder="--Selecteaza o subcategorie--"
                               class="form-control filter-control rounded-pill"
                               value="{{$filtering_criteria['subcategory'] ?? ''}}"
                        >

                        <datalist id="browsers" class="dropdown">

                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </datalist>

                    </div>

                </div>

                <div class="filter-item_OK ">
                    <button id="searchBtn" type="submit" class="btn btn-secondary"> OK</button>
                </div>

                <div class="pdf-style">

                    {{--                    @if($customers)--}}
                    {{--                        <button type="submit" name="downloadPDF" value="PDF" class="btn btn-info">SALVEAZA ca .pdf--}}
                    {{--                        </button>--}}
                    {{--                    @endif--}}
                </div>
            </form>

            <form>
                <div class="revert-b">
                    <button type="submit" class="btn btn-secondary">REVERT</button>
                </div>
            </form>

        </div>
        <form>
            <div class="generare">
                <button type="submit" class="btn btn-secondary">Generare pdf</button>
            </div>
        </form>
    </div>

</div>
