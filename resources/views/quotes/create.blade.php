
@extends('adminlte::page')
@section('plugins.select2', true)
@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="alert alert-danger" style="display:none">
	            <button type="button" class="close" data-dismiss="alert">×</button>	
	                Errors:<br>
            </div>
            <div class="alert alert-success alert-block" style="display:none;">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>Success: </strong>
                    <span class="success_msg"></span>
            </div>
            <div class="card card-info">
                @include('layouts/flash')
                
              <div class="card-header">
                <h3 class="card-title">Prepare Quote</h3>
                <a href="<?=url('/sales-quote-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?=url('/purchase-goods')?>" id="pur_goods_frm">
              @csrf
                
                <div class="card-body" style="margin-bottom:-30px;">    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="customer_id">Select Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control" onchange="getCustomerDetails(this)">
                                <option value=""> --Select Customer--</option>
                                    @foreach($sellers as $k=>$v)
                                        <option value="<?=$v->id?>"><?=$v->company_name?></option>
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

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="email">Email Id</label><br/>
                                <span id="email">N/A</span>
                            </div>
                        </div>
<!-- 
                        <div class="col-sm-2">
                            <div class="form-group">   
                                <label for="contact_person">Contact Person</label><br/>
                                <span id="contact_person">N/A</span>
                            </div>
                        </div> -->
<!-- 
                        <div class="col-sm-2">
                            <div class="form-group">   
                                <label for="payment_mode">Payment Mode</label><br/>
                                <select class="form-control" name="payment_mode" id="payment_mode">
                                    <option value="">--Payment mode--</option>
                                    <?php foreach(Config::get('constants.payment_modes') as $k=>$v){?>
                                        <option value="<?=$k?>"><?=ucfirst($v)?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2" id="pay_date" style="display:none;">
                            <div class="form-group">   
                                <label for="contact_person">Payment date</label><br/>
                                <input type="text" name="payment_date" id="payment_date" class="form-control datepicker" readonly/>
                            </div>
                        </div> -->
                    </div>
                </div>
<hr/>
                <div class="card-body purchase_details_div"style="margin-top:-20px;">
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
                        
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="width">Width</label>
                                <input type="text" name="width[]" id="width_1" placeholder="Width" class='form-control' value="0" />
                                @error('width')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="text" name="quantity[]" id="quantity_1" class='form-control' placeholder="quantity" value="0" />
                                @error('quantity')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- <span>X</span>     -->
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price[]" id="price_1" class='form-control price' placeholder="price" value="0" data-value="1" />
                                @error('price')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- <span>=</span> -->
                        <div class="col-sm-1">
                            <div class="form-group">
                              <label for="Total">Total</label>
                              <p><span id="total_amt_1">--</span></p>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group"><label>&nbsp;</label><br>
                                <button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fas fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>            
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="save">Save</button>
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
    $(".purchase_details_div").hide();
    let i = 1;

    $("#add").on('click',function(){
        i++;        
        $(".purchase_details_div").append('<div class="row" id="row_'+i+'"><div class="col-sm-2 first"><div class="form-group"><select name="master_product_id[]" id="master_product_id_'+i+'" class="form-control" onchange="getProdOptions(this)"><option value=""> --Select Master Product--</option><?php foreach($master_product as $k=>$v){?><option value="<?=$v->id?>"><?=$v->title?></option><?php }?></select>@error('master_product_id')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-2"><div class="form-group"><select name="product_id[]" id="product_id_'+i+'" class="product form-control" onchange="getUnitType(this)"><option value=""> --Select Product--</option></select>@error('product_id')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><div class="form-group"><input type="text" name="unit_id[]" id="unit_id_'+i+'" class="form-control" readonly />@error('unit_id')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><div class="form-group"><input type="text" placeholder="Length" name="length[]" id="length_'+i+'" class="form-control" value="0" />@error('length')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><div class="form-group"><input type="text" name="width[]" id="width_'+i+'" placeholder="Width" class="form-control" value="0" />@error('width')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><div class="form-group"><input type="text" name="quantity[]" id="quantity_'+i+'" class="form-control" placeholder="quantity" value="0" />@error('quantity')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><div class="form-group"><input type="text" name="price[]" id="price_'+i+'" class="form-control price" placeholder="price" value="0" data-value="'+i+'" />@error('price')<div style="color:red">{{ $message }}</div>@enderror</div></div><div class="col-sm-1"><p><span id="total_amt_'+i+'">--</span></p></div><div class="col-sm-1"><div class="form-group"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove"> <i class="fas fa-trash" aria-hidden="true"> </button></div></div></div></div>'
            ); 
        });
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");
           $('#row_'+button_id+'').remove();  
      });  

});
function getProdOptions(e){

    let master_product_id = $(e).val();
    disableProductAlreadySel(e);
    $.ajax({
        type: "post",
        url: "<?=url('/get-prod-opt-by-masterid')?>",
        dataType:'json',
        data: {
            "master_product_id" : master_product_id,
            "chk_remaining" : true,
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
let sel_val;
function disableProductAlreadySel(e) {
    // sel_val = [$("select[name=product_id").val()];
    // console.log(sel_val);
    // $("select[id^=product_id_").not(e).find("option[value="+ $(e).val() + "]").attr('disabled', true);
  
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

function getCustomerDetails(that){
    let seller_id = $(that).val();
    if(typeof seller_id !== 'undefined' && seller_id != ''){
        $(".purchase_details_div").show();
    }else{
        $(".purchase_details_div").hide();
    }

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
$(document).on('keyup', ".price", function() {
    let element_postfix = parseInt($(this).attr('data-value'));
    let price = $(this).val();
    let qty = $("#quantity_"+element_postfix).val();
    let total_amt = parseFloat(price * qty);
    $("#total_amt_"+element_postfix).text(total_amt);
});

$("#pur_goods_frm").submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=url('/purchase-goods')?>",
        dataType:'json',
        data: $("#pur_goods_frm").serialize(),
        success: function(data){
            $('.alert-danger').empty().hide();
            console.log(data);
            if(data.status == 'success') {
                $('.success_msg').text(data.resp);
                Swal.fire({
                    title: 'Success',
                    text: "Purchase of goods successful!",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        window.location = '<?=url('purchase-list');?>';
                    }
                })
            }else{
                $('.alert-danger').append('<p>'+value+'</p>');
            }
        }, error: function (request, status, error) {
                json = $.parseJSON(request.responseText);
                $('.alert-danger').empty().show();
                $.each(json.errors, function(key, value){
                    $('.alert-danger').append('<p>'+value+'</p>');
                });
                $("#result").html('');
        }
    });
});
/**IF PAYMENT MODE IS CHEQUE THEN SHOW PAYMENT REMINDER */
$("#payment_mode").change(function(){
    if(this.value == 2){
        $("#pay_date").show();
    }else{
        $("#pay_date").hide();
    }
});
$(function() {
    $('.datepicker').datepicker({
        startDate: '-3d'
    });
  });
</script>

<!-- <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->
      
@Stop

@yield('scripts')
