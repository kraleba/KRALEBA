<div class="row searchFilter-custom round3">

    <div class=" filter-customers col-lg-12">
        <form method="get">
            <div>
                <a class="add" href="{{ route('bills.create', $customer_id) }}"> Create a Bill</a>
            </div>

            <div class="input-group select-group">
                <div>
                    <input type='text' id="find_customer" name="customer_name" placeholder="-- Select a Client --"
                        class="form-control filter-control group"
                        value="{{ $filtering_criteria['customer_name'] ?? '' }}">
                </div>

                <div>
                    <select name="type" id="department" class="form-control filter-control group">
                        <option selected value>-- Select an Option --</option>
                        <option value="1" @if (isset($filtering_criteria['type']) && $filtering_criteria['type'] == 1) selected @endif>
                            Proforma
                        </option>

                        <option value="2" @if (isset($filtering_criteria['type']) && $filtering_criteria['type'] == 2) selected @endif>
                            Definitiva
                        </option>
                    </select>
                </div>


                <div>
                    <div>

                        <input type="date" id="bills_start_date" class="form-control filter-control group"
                            value="{{ $filtering_criteria['start_date'] ?? '' }}" name="start_date">
                    </div>
                </div>

                <div>
                    <div>

                        <input type="date" id="bills_end_date" class="form-control filter-control group"
                            value="{{ $filtering_criteria['end_date'] ?? '' }}" name="end_date">
                    </div>
                </div>
            </div>



            <button id="searchBtn" type="submit" class="filter-customers-OK"> OK</button>
            @if ($bills)
                <button type="submit" name="downloadPDF" value="PDF" class="pdf-style">SALVEAZA ca
                    .pdf
                </button>
            @endif
        </form>
        <form>
            <button type="submit" class="revert-customers">REVERT</button>
        </form>
    </div>
</div>
