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
                        >
                    </div>

                    <div class="filter-item1">
                        <select name="customer_type" id="department" class="form-control rounded-pill filter-control">
                            <option
                                value="{{$filtering_criteria['type']['name'] ?? ''}}"> {{$filtering_criteria['type']['nume'] ?? '-- Selecteaza tipul --'}} </option>
                                <option value="Customer"> Beneficiar</option>
                                <option value="Provider">Furnizor</option>
                        </select>
                    </div>

                    <div class="filter-item1">
                        <select name="type" id="department" class="form-control rounded-pill filter-control">
                            <option
                                value="{{$filtering_criteria['type']['name'] ?? ''}}"> {{$filtering_criteria['type']['nume'] ?? '-- Selecteaza tipul --'}} </option>
                            <option value="1"> Proforma</option>
                        </select>
                    </div>
                </div>
                <br>

                <div class="input-group item-left center">
                    <div class="filter-item1">
                        <div class="form-row">
                            
                            <input type="date" class="form-control filter-control rounded-pill" value=""
                                name="start_date"
                            >
                            <option> </option>
                        </div>
 
                    </div>

                    <option> </option>
                    <option> </option>
                    <option> </option>
                    
                    <div class="filter-item1">
                        <div class="form-row">
                            <option> </option>
                            <input type="date" class="form-control filter-control  rounded-pill"
                               value="{{date('Y-m-d')}}" name="end_date"
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


