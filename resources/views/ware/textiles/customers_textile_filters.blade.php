<div class="row searchFilter-custom round3">

    <div class=" filter-customers col-lg-12">

        <form method="get">

            <div class="input-group select-group">

                <div class="filter-item1">
                    <input type='text' id="find_customer" name="customer_name" placeholder="-- Select a Client --"
                    class="form-control filter-control group"
                        value="{{ $filtering_criteria['customer_name'] ?? '' }}">
                </div>

                <div class="filter-item1">
                    <input type='text' id="find_textiles_composition" row_name="composition"
                        name="textiles_composition" placeholder="-- Select a Compozition --"
                        value="{{ $filtering_criteria['textiles_composition'] ?? '' }}"
                        class="form-control filter-control group">
                </div>

                <div class="filter-item1">
                    <input type='text' id="find_material" row_name="material" name="textiles_material"
                        placeholder="-- Select the Material --"
                        value="{{ $filtering_criteria['textiles_material'] ?? '' }}"
                        class="form-control filter-control group">
                </div>
            </div>
            <br>

            <div class="input-group select-group1">
                <div class="filter-item1">
                    <input type='text' id="find_textiles_design" row_name="design" name="textiles_design"
                        placeholder="-- Select the Design --" value="{{ $filtering_criteria['textiles_design'] ?? '' }}"
                        class="form-control filter-control group">
                </div>

                <div class="filter-item1">
                    <input type='text' id="find_textiles_color" row_name="color" name="textiles_color"
                        placeholder="-- Select a Color --" value="{{ $filtering_criteria['textiles_color'] ?? '' }}"
                        class="form-control filter-control group">
                </div>

                <div class="filter-item1">
                    <input type='text' id="find_textiles_structure" row_name="structure" name="textiles_structure"
                        placeholder="-- Select the Structure --"
                        value="{{ $filtering_criteria['textiles_structure'] ?? '' }}"
                        class="form-control filter-control group">
                </div>
            </div>
            <br>

            <div class="input-group select-group2">

                <div class="filter-item1">
                    <input type='text' id="find_textiles_weaving" row_name="weaving" name="textiles_weaving"
                        placeholder="-- Select the Weaving --" value="{{ $filtering_criteria['textiles_weaving'] ?? '' }}"
                        class="form-control filter-control group">
                </div>

                <div class="filter-item1">
                    <input type='text' id="find_textiles_finishing" row_name="finishing" name="textiles_finishing"
                        placeholder="-- Select the Finishing --"
                        value="{{ $filtering_criteria['textiles_finishing'] ?? '' }}"
                        class="form-control filter-control group">
                </div>

                <div class="filter-item1">
                    <input type='text' id="find_textiles_rating" row_name="rating" name="textiles_rating"
                        placeholder="-- Select a Rating --" value="{{ $filtering_criteria['textiles_rating'] ?? '' }}"
                        class="form-control filter-control group">
                </div>
            </div>
            <button id="searchBtn" type="submit" class="filter-customers-OK"> OK</button>

            @if ($wares)
                <button type="submit" name="downloadPDF" value="PDF" class="pdf-style">SALVEAZA ca .pdf</button>
            @endif

        </form>
        <form>
            <button type="submit" class="revert-customers">REVERT</button>
        </form>
    </div>

</div>



{{--    <div class="form-group"> --}}
{{--        <label for="exampleInputEmail1">Search Name:</label> --}}
{{--        <input type="text" id="name" name="name" class="form-control"> --}}
{{--    </div> --}}
