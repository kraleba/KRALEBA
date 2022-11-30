<div class="container ">
    <div class="">

        <div class="col-lg-12 box-filter">
            <form method="get">

                <br>
                <div class="row searchFilter-custom round3">
                    <div class="filter-customers col-lg-12">
                        <div>
                            <input type='text' id="find_customer" name="customer_name"
                                placeholder="--Selecteaza un Client--" class="form-control filter-control group"
                                value="{{ $filtering_criteria['customer_name'] ?? '' }}">
                        </div>

                        <div>
                            <select id="category_select" name="category" id="department"
                                class="form-control filter-control group">

                                <option selected value> -- select an option --</option>
                                @foreach ($furnace_categories as $furnace_category)
                                    <option value="{{ $furnace_category->id }}"
                                        @if (isset($filtering_criteria['category']->id) && $furnace_category->id == $filtering_criteria['category']->id) selected @endif>
                                        {{ $furnace_category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <input type='text' id="find_subcategories_by_category_id" name="subcategory"
                                placeholder="--Selecteaza Specificatia--" class="form-control filter-control group"
                                value="{{ $filtering_criteria['subcategory'] ?? '' }}">
                        </div>

                    </div>

                </div>
                <button id="searchBtn" type="submit" class="filter-customers-OK"> OK</button>

                <div class="pdf-style">

                    {{--                    @if ($customers) --}}
                    {{--                        <button type="submit" name="downloadPDF" value="PDF" class="btn btn-info">SALVEAZA ca .pdf --}}
                    {{--                        </button> --}}
                    {{--                    @endif --}}
                </div>
            </form>
        </div>
        <form>
            <button type="submit" class="revert-customers">REVERT</button>
        </form>

    </div>
    <form>
        <div class="generare">
            <button type="submit" class="btn btn-secondary">Generare pdf</button>
        </div>
    </form>
</div>

