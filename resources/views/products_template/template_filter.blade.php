<div class="row searchFilter-custom round3">

    <div class="form-row filter-customers col-lg-12">
        <form action="{{ route('templates.index') }}" method="get">
            <div class="form-row">
            <div>
                <a class="add" href="{{ route('templates.create') }}"> ADAUGA PROTOTIP</a>
            </div>
            <div >

                <div class="input-group ">
                    <div class="filter-item1 filter-control btn-group">
                        <select name="customer_type" id="department" class="form-control group">
                            <option value="customer">--Selecteaza tipul--</option>
                            <option value="customer">Abelard</option>
                            <option value="provider">Heloise</option>
                        </select>
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="product_name" placeholder="--Prototip Name--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Collection--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Code--"
                            class="form-control group">
                    </div>
                </div>
                <br>

                <div class="input-group">
                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Author--"
                        class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Category--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Theme--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <select placeholder="--Tayloring--" name="marketing_category_id" class="form-control group">
                            @foreach($taylorings as $tayloring)
                                <option >
                                    {{$tayloring->name}}
                                </option>
                            @endforeach
                        <select>
                    </div>
                </div>

                <br>

                <div class="input-group ">
                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Occasion --"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Sesonality --"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Syles --"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Supplier--"
                            class="form-control group">
                    </div>
                </div>
                <br>

                <div class="input-group ">

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Composition--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Material--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Design--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Color--"
                            class="form-control group">
                    </div>
                </div>
                <br>

                <div class="input-group ">
                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Structure--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Weaving--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Finishing--"
                            class="form-control group">
                    </div>

                    <div class="filter-item1 filter-control btn-group">
                        <input type='text' id="find_customer" name="customer_name" placeholder="--Rating--"
                            class="form-control group">
                    </div>
                </div>
            </div>
            </div>

            <button id="searchBtn" type="submit" class="filter-customers-OK"> OK</button>

            {{--                        @if ($customers) --}}
            {{--                            <button type="submit" name="downloadPDF" value="PDF" class="class="pdf-style"">SALVEAZA ca .pdf --}}
            {{--                            </button> --}}
            {{--                        @endif --}}
        </form>
        <form>
            <button type="submit" class="revert-customers">REVERT</button>
        </form>
    </div>

</div>
