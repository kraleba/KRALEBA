<div class="modal fade ware1-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Modal Header</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="modal-body">
            <form action="{{ route('bills.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Product Name:</strong>
                            <input type="text" name="product_id" class="form-control" placeholder="Product Name">
                            @error('Product name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Custom code :</strong>
                            <input type="text" name="custom_code" class="form-control" placeholder="Custom code ">
                            @error('Custom code')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Composition:</strong>
                            <input type="text" name="composition" class="form-control" placeholder="Composition">
                            @error('Composition')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Material :</strong>
                            <input type="text" name="material " class="form-control" placeholder="Material ">
                            @error('Material ')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Structure:</strong>
                            <input type="text" name="structure" class="form-control" placeholder="Structure">
                            @error('Structure')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Design:</strong>
                            <input type="text" name="design" class="form-control" placeholder="Design">
                            @error('Design')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Weawing:</strong>
                            <input type="text" name="weawing" class="form-control" placeholder="Weawing">
                            @error('Weawing')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Color:</strong>
                            <input type="text" name="color" class="form-control" placeholder="Color">
                            @error('Color')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Finishing:</strong>
                            <input type="text" name="finishing" class="form-control" placeholder="Finishing">
                            @error('Finishing')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Perceived weight:</strong>
                            <input type="text" name="perceived_weight" class="form-control" placeholder="Perceived weight">
                            @error('Perceived weight')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Softness:</strong>
                            <input type="text" name="softness" class="form-control" placeholder="Softness">
                            @error('Softness')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Look:</strong>
                            <input type="text" name="look" class="form-control" placeholder="Look">
                            @error('Look')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Grounds:</strong>
                            <input type="text" name="grounds" class="form-control" placeholder="Grounds">
                            @error('Grounds')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Weight in g/m2:</strong>
                            <input type="text" name="Weight_in_g/m2" class="form-control" placeholder="Weight in g/m2">
                            @error('Weight in g/m2')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Width (cm):</strong>
                            <input type="text" name="width_(cm)" class="form-control" placeholder="Width (cm)">
                            @error('Width (cm)')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn number warp:</strong>
                            <input type="text" name="yarn_number_warp" class="form-control" placeholder="Yarn number warp">
                            @error('Yarn number warp')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn number weft:</strong>
                            <input type="text" name="yarn_number_weft" class="form-control" placeholder="Yarn number weft">
                            @error('Yarn number weft')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn count per cm warp:</strong>
                            <input type="text" name="yarn_count_per_cm_warp" class="form-control" placeholder="Yarn count per cm warp">
                            @error('Yarn count per cm warp')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn count per cm weft:</strong>
                            <input type="text" name="yarn_count_per_cm_weft" class="form-control" placeholder="Yarn count per cm weft">
                            @error('Yarn count per cm weft')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Origin:</strong>
                            <input type="text" name="origin" class="form-control" placeholder="Origin">
                            @error('Origin')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Date:</strong>
                            <input type="text" name="date" class="form-control" placeholder="Date">
                            @error('Date')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Description:</strong>
                            <input type="text" name="description" class="form-control" placeholder="Description">
                            @error('Description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>UM:</strong>
                            <select name="UM" class="form-select" aria-label="Default select example">
                                <option selected>Selecteaza UM</option>
                                <option value="1">ml</option>
                                <option value="2">gr</option>
                                <option value="3">kg</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>

    </div>
  </div>

{{-- <form action="{{ route('bills.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Product Name:</strong>
                <input type="text" name="product_id" class="form-control" placeholder="Product Name">
                @error('Product name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Custom code :</strong>
                <input type="text" name="custom_code" class="form-control" placeholder="Custom code ">
                @error('Custom code')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Composition:</strong>
                <input type="text" name="composition" class="form-control" placeholder="Composition">
                @error('Composition')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Material :</strong>
                <input type="text" name="material " class="form-control" placeholder="Material ">
                @error('Material ')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Structure:</strong>
                <input type="text" name="structure" class="form-control" placeholder="Structure">
                @error('Structure')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Design:</strong>
                <input type="text" name="design" class="form-control" placeholder="Design">
                @error('Design')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Weawing:</strong>
                <input type="text" name="weawing" class="form-control" placeholder="Weawing">
                @error('Weawing')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Color:</strong>
                <input type="text" name="color" class="form-control" placeholder="Color">
                @error('Color')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Finishing:</strong>
                <input type="text" name="finishing" class="form-control" placeholder="Finishing">
                @error('Finishing')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Perceived weight:</strong>
                <input type="text" name="perceived_weight" class="form-control" placeholder="Perceived weight">
                @error('Perceived weight')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Softness:</strong>
                <input type="text" name="softness" class="form-control" placeholder="Softness">
                @error('Softness')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Look:</strong>
                <input type="text" name="look" class="form-control" placeholder="Look">
                @error('Look')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Grounds:</strong>
                <input type="text" name="grounds" class="form-control" placeholder="Grounds">
                @error('Grounds')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Weight in g/m2:</strong>
                <input type="text" name="Weight_in_g/m2" class="form-control" placeholder="Weight in g/m2">
                @error('Weight in g/m2')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Width (cm):</strong>
                <input type="text" name="width_(cm)" class="form-control" placeholder="Width (cm)">
                @error('Width (cm)')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn number warp:</strong>
                <input type="text" name="yarn_number_warp" class="form-control" placeholder="Yarn number warp">
                @error('Yarn number warp')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn number weft:</strong>
                <input type="text" name="yarn_number_weft" class="form-control" placeholder="Yarn number weft">
                @error('Yarn number weft')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn count per cm warp:</strong>
                <input type="text" name="yarn_count_per_cm_warp" class="form-control" placeholder="Yarn count per cm warp">
                @error('Yarn count per cm warp')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn count per cm weft:</strong>
                <input type="text" name="yarn_count_per_cm_weft" class="form-control" placeholder="Yarn count per cm weft">
                @error('Yarn count per cm weft')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Origin:</strong>
                <input type="text" name="origin" class="form-control" placeholder="Origin">
                @error('Origin')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Date:</strong>
                <input type="text" name="date" class="form-control" placeholder="Date">
                @error('Date')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Description:</strong>
                <input type="text" name="description" class="form-control" placeholder="Description">
                @error('Description')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>UM:</strong>
                <select name="UM" class="form-select" aria-label="Default select example">
                    <option selected>Selecteaza UM</option>
                    <option value="1">ml</option>
                    <option value="2">gr</option>
                    <option value="3">kg</option>
                </select>
            </div>
        </div>
    </div>
</form> --}}
