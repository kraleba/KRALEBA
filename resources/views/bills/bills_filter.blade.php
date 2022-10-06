<div class="container">
    <div class="row box-filter-b card round3b">

        <div class="col-sm-12">
            <form method="get">
                <div>
                    <h4>SELECTEAZA:</h4>
                </div>
                <br>
                <div class="input-group item-left center">
                    <div class="filter-item1">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Selecteaza un Client--"
                               class="form-control filter-control rounded-pill"
                               value="{{$filtering_criteria['customer_name'] ?? ''}}"
                        >
                    </div>

                    <div class="filter-item1">
                        <select name="type" id="department" class="form-control rounded-pill filter-control">
                            <option selected value> -- select an option --</option>
                            <option
                                value="1"
                                @if(isset($filtering_criteria['type']) && $filtering_criteria['type'] == 1)
                                    selected
                                @endif
                            >
                                Proforma
                            </option>

                            <option
                                value="2"
                                @if(isset($filtering_criteria['type']) && $filtering_criteria['type'] == 2)
                                    selected
                                @endif
                            >
                                Definitiva
                            </option>
                        </select>
                    </div>
                </div>
                <br>

                <div class="input-group item-left center">
                    <div class="filter-item1" style="padding-left: 4px;">
                        <div class="form-row">

                            <input type="date" id="bills_start_date" class="form-control filter-control rounded-pill"
                                   value="{{$filtering_criteria['start_date'] ?? ''}}"
                                   name="start_date"
                            >
                        </div>
                    </div>

                    <div class="filter-item1" style="padding-left: 12px;">
                        <div class="form-row">

                            <input type="date" id="bills_end_date" class="form-control filter-control  rounded-pill"
                                   value="{{$filtering_criteria['end_date'] ?? ''}}" name="end_date"
                            >
                        </div>
                    </div>
                </div>

                <div class="filter-item_OK">
                    <button id="searchBtn" type="submit" class="btn btn-secondary"> OK</button>
                </div>
            </form>

        </div>
        <form>
            <div class="revert-bills">
                <button type="submit" class="btn btn-secondary">REVERT</button>
            </div>
        </form>
    </div>
    <br>

</div>


