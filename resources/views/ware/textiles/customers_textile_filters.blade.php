<div class="container ">
    <div class="row searchFilter card round3">

        <div class="col-lg-12 box-filter">
            <form method="get">
                <div>
                    <h4>SELECTEAZA:</h4>
                </div>

                <br>
                <div class="center">
                    <div class="input-group item-left">
                        <div class="filter-item1">
                            <input type='text' id="find_customer" name="customer_name"
                                placeholder="--Selecteaza un Client--" class="form-control filter-control rounded-pill"
                                value="{{ $filtering_criteria['customer_name'] ?? '' }}">
                        </div>

                        <div class="filter-item1">
                            <input type='text' id="find_textiles_composition" row_name="composition"
                                name="textiles_composition" placeholder="--Selecteaza Compozitia--"
                                value="{{ $filtering_criteria['textiles_composition'] ?? '' }}"
                                class="form-control filter-control rounded-pill find_textiles_composition">
                        </div>

                        <div class="filter-item1">
                            <input type='text' id="find_material" row_name="material" name="textiles_material"
                                placeholder="--Selecteaza Material--"
                                value="{{ $filtering_criteria['textiles_material'] ?? '' }}"
                                class="form-control filter-control rounded-pill find_material">
                        </div>
                    </div>
                    <br>

                    <div class="input-group item-left">
                        <div class="filter-item1">
                            <input type='text' id="find_textiles_design" row_name="design" name="textiles_design"
                                placeholder="--Selecteaza Design--"
                                value="{{ $filtering_criteria['textiles_design'] ?? '' }}"
                                class="form-control filter-control rounded-pill find_textiles_design">
                        </div>

                        <div class="filter-item1">
                            <input type='text' id="find_textiles_color" row_name="color" name="textiles_color"
                                placeholder="--Select Color--" value="{{ $filtering_criteria['textiles_color'] ?? '' }}"
                                class="form-control filter-control rounded-pill find_textiles_color">
                        </div>

                        <div class="filter-item1">
                            <input type='text' id="find_textiles_structure" row_name="structure"
                                name="textiles_structure" placeholder="--Selecteaza Structure--"
                                value="{{ $filtering_criteria['textiles_structure'] ?? '' }}"
                                class="form-control filter-control rounded-pill find_textiles_structure">
                        </div>
                    </div>
                    <br>

                    <div class="input-group item-left">

                        <div class="filter-item1">
                            <input type='text' id="find_textiles_weaving" row_name="weaving" name="textiles_weaving"
                                placeholder="--Selecteaza Weaving--"
                                value="{{ $filtering_criteria['textiles_weaving'] ?? '' }}"
                                class="form-control filter-control rounded-pill find_textiles_weaving">
                        </div>

                        <div class="filter-item1">
                            <input type='text' id="find_textiles_finishing" row_name="finishing"
                                name="textiles_finishing" placeholder="--Selecteaza Finishing--"
                                value="{{ $filtering_criteria['textiles_finishing'] ?? '' }}"
                                class="form-control filter-control rounded-pill find_textiles_finishing">
                        </div>

                        <div class="filter-item1">
                            <input type='text' id="find_textiles_rating" row_name="rating" name="textiles_rating"
                                placeholder="--Selecteaza Rating--"
                                value="{{ $filtering_criteria['textiles_rating'] ?? '' }}"
                                class="form-control filter-control rounded-pill find_textiles_rating">
                        </div>
                    </div>
                </div>

                <div class="filter-item_OK ">
                    <button id="searchBtn" type="submit" class="btn btn-secondary"> OK</button>
                </div>

                <div class="pdf-style">

                    @if ($wares)
                        <button type="submit" name="downloadPDF" value="PDF" class="btn btn-info">SALVEAZA ca .pdf
                        </button>
                    @endif
                </div>
            </form>

            <form>
                <div class="revert-textil">
                    <button type="submit" class="btn btn-secondary">REVERT</button>
                </div>
            </form>
        </div>

    </div>
</div>


{{--    <div class="form-group"> --}}
{{--        <label for="exampleInputEmail1">Search Name:</label> --}}
{{--        <input type="text" id="name" name="name" class="form-control"> --}}
{{--    </div> --}}
