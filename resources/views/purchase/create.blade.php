@extends('adminlte::page')
@section('plugins.select2', true)
@section('content')
   
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
                @include('layouts/flash')
                
              <div class="card-header">
                <h3 class="card-title">Purchase Goods</h3>
                <a href="<?=url('/purchase-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                
                <div class="card-body">    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="seller_id">Select Seller</label>
                                <select name="seller_id" id="seller_id" class="form-control" onchange="getSellerDetails(this)">
                                <option value=""> --Select Seller--</option>
                                    @foreach($sellers as $k=>$v)
                                        <option value="<?=$v->id?>"><?=$v->first_name." ".$v->last_name?></option>
                                    @endforeach
                                </select>
                                @error('seller_id')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-2">
                            <div class="form-group">                       
                                <label for="mobile_no">Mobile no.</label><br/>
                                <span id="mobile_no">N/A</span>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="form-group">                       
                                <label for="email">Email Id</label><br/>
                                <span id="email">N/A</span>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">                       
                                <label for="contact_person">Contact Person</label><br/>
                                <span id="contact_person">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body purchase_details_div">
                    
                    <div class="row" id="row_1">
                        <div class="col-sm-2 first">
                            <div class="form-group">                       
                                <label for="master_product_id">Master Product</label>
                                <select name="master_product_id[]" id="master_product_id_1" class="form-control" onchange="getProdOptions(this)">
                                <option value=""> --Select Master Product--</option>
                                    @foreach($master_product as $k=>$v)
                                        <option value="<?=$v->id?>"><?=$v->title?></option>
                                    @endforeach
                                </select>
                                @error('master_product_id')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="product">Product</label>
                                <select name="product_id[]" id="product_id_1" class="product form-control" onchange="getUnitType(this)">
                                    <option value=""> --Select Product--</option>
                                </select>
                                @error('product_id')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="unit_id">Unit</label>
                                <input type="text" name="unit_id[]" id="unit_id_1" class='form-control' readonly />
                                @error('unit_id')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="length">Length</label>
                                <input type="text" placeholder="Length" name="length[]" id="length_1" class='form-control' value="0" />
                                @error('length')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <span>X</span>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="width">Width</label>
                                <input type="text" name="width[]" id="width_1" placeholder="Width" class='form-control' value="0" />
                                @error('width')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <span>X</span>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="text" name="quantity[]" id="quantity_1" class='form-control' placeholder="quantity" value="0" />
                                @error('quantity')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price[]" id="price_1" class='form-control' placeholder="price" value="0" />
                                @error('price')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group"><label>&nbsp;</label><br>
                                <button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-plus" aria-hidden="true"></i>
</button>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  @endsection
  @section('js')
<script>
$(document).ready(function() {
        $('.master_product').select2();
let i = 1;
    $("#add").on('click',function(){

        i++;
        // alert(i);
        console.log(".row_"+i);
        $(".purchase_details_div").append('<div class="row" id="row_'+i+'"><div class="col-sm-2 first"><div class="form-group"><label for="master_product_id">Master Product</label><select name="master_product_id[]" id="master_product_id_'+i+'" class="form-control" onchange="getProdOptions(this)"><option value=""> --Select Master Product--</option><?php foreach($master_product as $k=>$v){?><option value="<?=$v->id?>"><?=$v->title?></option><?php }?></select>@error('master_product_id')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-2"><div class="form-group"><label for="product">Product</label><select name="product_id[]" id="product_id_'+i+'" class="product form-control" onchange="getUnitType(this)"><option value=""> --Sele1ct Product--</option></select>@error('product_id')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><div class="form-group"><label for="unit_id">Unit</label><input type="text" name="unit_id[]" id="unit_id_'+i+'" class="form-control" readonly />@error('unit_id')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><div class="form-group"><label for="length">Length</label><input type="text" placeholder="Length" name="length[]" id="length_'+i+'" class="form-control" value="0" />@error('length')<div style="color:red">{{ $message }}</div>@enderror</div></div><span>X</span><div class="col-sm-1"><div class="form-group"><label for="width">Width</label><input type="text" name="width[]" id="width_'+i+'" placeholder="Width" class="form-control" value="0" />@error('width')<div style="color:red">{{ $message }}</div>@enderror</div></div><span>X</span><div class="col-sm-1"><div class="form-group"><label for="quantity">Quantity</label><input type="text" name="quantity[]" id="quantity_'+i+'" class="form-control" placeholder="quantity" value="0" />@error('quantity')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><div class="form-group"><label for="price">Price</label><input type="text" name="price[]" id="price_'+i+'" class="form-control" placeholder="price" value="0" />@error('price')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><div class="form-group"><label>&nbsp;</label><br><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"> <i class="fas fa-trash" aria-hidden="true"> </button></div></div></div></div>'
            ); 
        });
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");
           $('#row_'+button_id+'').remove();  
      });  

});
function getProdOptions(e){
    let master_product_id = $(e).val();
    $.ajax({
        type: "post",
        url: "<?=url('/get-prod-opt-by-masterid')?>",
        dataType:'json',
        data: {
            "master_product_id" : master_product_id,
            "_token" : "{{ csrf_token() }}",
        },
        success: function(data){
            next_product_id = $(e).closest('div.first').next('div').find('select').attr('id');
            $("#"+next_product_id).empty().append(data.html);
        },
        error:function(data){
            console.log("error here: "+data);
        }
    });
}

function getUnitType(that) {
    let product_id = $(that).val();
    $.ajax({
        type: "post",
        url: "<?=url('/get-unit-by-prodid')?>",
        dataType:'json',
        data: {
            "product_id" : product_id,
            "_token" : "{{ csrf_token() }}",
        },
        success: function(data){
            let next_unit_id = $(that).closest('div').parent().next('div').find('input[id^="unit_id_"]').attr('id');
            if(data.status == 'success')
                $("#" + next_unit_id).val(data.unit_type);
        },
        error:function(data){
            console.log("error here: "+data);
        }
    });
}

function getSellerDetails(that){
    let seller_id = $(that).val();
    $.ajax({
        type: "post",
        url: "<?=url('/seller-details')?>",
        dataType:'json',
        data: {
            "seller_id" : seller_id,
            "_token" : "{{ csrf_token() }}",
        },
        success: function(data){
            if(data.status == 'success') {
                $("#mobile_no").empty().text(data.mobile_no);
                $("#email").empty().text(data.email);
                $("#contact_person").text(data.contact_person);
            }else{
                alert("error");
            }
        },
        error:function(data){
            console.log("error here: "+data);
        }
    });
}
</script>

@Stop
@yield('scripts')