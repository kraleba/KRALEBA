<div class="row searchFilter-custom-template card round3">

    <div class="col-lg-12 box-filter">
        <form action="{{ route('templates.index') }}" method="get">
            <div>
                <h4>SELECTEAZA:</h4>
            </div>
            <br>

            <br>
            <div class="form-row">

                <div>
                    <div class="form-group col-md-6">
                        <select name="customer_type" id="department"
                                class="form-control rounded-pill filter-control">
                            <option value="customer">--Selecteaza tipul--</option>
                            <option value="customer">Abelard</option>
                            <option value="provider">Heloise</option>
                        </select>
                    </div>
                </div>


                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="product_name"
                               placeholder="--Product Name--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Collection--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Code--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Author--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>
                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Category--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>
                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Theme--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Tayloring--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Occasion --"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Sesonality --"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Syles --"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Supplier--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Composition--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Material--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Design--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Color--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Structure--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Weaving--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Finishing--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
                </div>

                <div>
                    <div class="form-group col-md-6">
                        <input type='text'
                               id="find_customer"
                               name="customer_name"
                               placeholder="--Rating--"
                               class="form-control filter-control rounded-pill"
                        >
                    </div>
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
            <div class="revert-b-template">
                <button type="submit" class="btn btn-secondary">REVERT</button>
            </div>
        </form>
    </div>

</div>
