<div class="container ">
    <div class="form-group">
        <div class="row searchFilter-custom round3">
            <div class=" filter-customers col-lg-12">
                <form method="get">
                    <div class="input-group select-group ">
                        <div>
                            <input type='text' id="find_customer" name="customer_name"
                                placeholder="-- Select a Client --" class="form-control filter-control group"
                                value="{{ $filtering_criteria['customer_name'] ?? '' }}">
                        </div>

                        <div>
                            <select id="category_select" name="category" id="department"
                                class="form-control filter-control group">

                                <option selected value> -- Select an Option --</option>
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
                                placeholder="-- Select a Specification --" class="form-control filter-control group"
                                value="{{ $filtering_criteria['subcategory'] ?? '' }}">
                        </div>
                    </div>

                    <button id="searchBtn" type="submit" class="filter-customers-OK"> OK</button>
                    @if ($wares)
                        <button type="submit" name="downloadPDF" value="PDF" class="pdf-style">SALVEAZA
                            ca.pdf</button>
                    @endif

                </form>

                <form>
                    <button type="submit" class="revert-customers">REVERT</button>
                </form>

            </div>
        </div>


    </div>

</div>
