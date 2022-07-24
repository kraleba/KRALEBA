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
{{--                    <div class="filter-item1 ">--}}
{{--                        <select name="customer_type" id="department"--}}
{{--                                class="form-control rounded-pill filter-control">--}}
{{--                            --}}{{-- <option value="{{$filtering_criteria['type']['name'] ?? ''}}"> {{$filtering_criteria['type']['nume'] ?? '-- Selecteaza tipul --'}} </option> --}}
{{--                            <option value=" "> Selecteaza tipul</option>--}}
{{--                            <option value="customer"> Beneficiar</option>--}}
{{--                            <option value="provider">Furnizor</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

                    <div class="filter-item1">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Selecteaza un Client--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>

                    <div class="filter-item1">
                        <input type='text'
                               id="find_textiles_composition"
                               row_name="composition"
                               name="textiles_composition"
                               placeholder="--Selecteaza Compozitia--"
                               class="form-control filter-control rounded-pill find_textiles_composition"
                        >
                    </div>

                    <div class="filter-item1">
                        <input type='text'
                               id="find_material"
                               row_name="material"
                               name="textiles_material"
                               placeholder="--Selecteaza Material--"
                               class="form-control filter-control rounded-pill find_material"
                        >
                    </div>

                    <div class="filter-item1">
                        <input type='text'
                               id="find_textiles_design"
                               row_name="design"
                               name="textiles_design"
                               placeholder="--Selecteaza Design--"
                               class="form-control filter-control rounded-pill find_textiles_design"
                        >
                    </div>

                    <div class="filter-item1">
                        <input type='text'
                               id="find_textiles_color"
                               row_name="color"

                               name="textiles_color"
                               placeholder="--Select Color--"
                               class="form-control filter-control rounded-pill find_textiles_color"
                        >
                    </div>

                    <div class="filter-item1">
                        <input type='text'
                               id="find_textiles_structure"
                               row_name="structure"
                               name="textiles_structure"
                               placeholder="--Selecteaza Structure--"
                               class="form-control filter-control rounded-pill find_textiles_structure"
                        >
                    </div>

                    <div class="filter-item1">
                        <input type='text'
                               id="find_textiles_weaving"
                               row_name="weaving"
                               name="textiles_weaving"
                               placeholder="--Selecteaza Weaving--"
                               class="form-control filter-control rounded-pill find_textiles_weaving"
                        >
                    </div>

                    <div class="filter-item1">
                        <input type='text'
                               id="find_textiles_finishing"
                               row_name="finishing"
                               name="textiles_finishing"
                               placeholder="--Selecteaza Finishing--"
                               class="form-control filter-control rounded-pill find_textiles_finishing"
                        >
                    </div>

                    <div class="filter-item1">
                        <input type='text'
                               id="find_textiles_rating"
                               row_name="rating"
                               name="textiles_rating"
                               placeholder="--Selecteaza Rating--"
                               class="form-control filter-control rounded-pill find_textiles_rating"
                        >
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

    </div>
</div>


{{--    <div class="form-group">--}}
{{--        <label for="exampleInputEmail1">Search Name:</label>--}}
{{--        <input type="text" id="name" name="name" class="form-control">--}}
{{--    </div>--}}



