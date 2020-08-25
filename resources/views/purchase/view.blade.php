
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
                <h3 class="card-title">Purchase Details</h3>
                <a href="<?=url('/purchase-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?=url('/purchase-goods')?>" id="pur_goods_frm">
              @csrf
                
                <div class="card-body">    
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="seller_id">Seller Company</label><br/>
                                <span><?=$product_data->sellers->company_name?></span>
                            </div>
                        </div>


                        <div class="col-sm-2">
                            <div class="form-group">                       
                                <label for="mobile_no">Mobile no.</label><br/>
                                <span id="mobile_no"><?=$product_data->sellers->mobile_no?></span>
                            </div>
                        </div>


                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="email">Email Id</label><br/>
                                <span id="email"><?=$product_data->sellers->email?></span>
                            </div>
                        </div>


                    
                        <div class="col-sm-2">
                            <div class="form-group">   
                                <label for="payment_mode">Payment Mode</label><br/>
                                <span><?=$product_data->payment_mode?></span>
                            </div>
                        </div>
                        <?php if(!empty($product_data->payment_reminder)){ ?>
                            <div class="col-sm-2" id="pay_date" style="display:none;">
                                <div class="form-group">   
                                    <label for="contact_person">Payment date</label><br/>
                                    <span><?=$product_data->payment_reminder?></span>
                                </div>
                            </div>
                        <?php }?>
<hr/>

                <div class="card-body purchase_details_div" style="margin-bottom:-21px;padding-bottom:0px;">
                    <div class="row" id="row_1">
                        <div class="col-sm-1 first">
                            <div class="form-group">                       
                                <label for="master_product_id">#</label>
                            </div>
                        </div>

                        <div class="col-sm-2 first">
                            <div class="form-group">                       
                                <label for="master_product_id">Master Product</label>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="product">Product</label>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="unit_id">Unit</label>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="length">Length</label>
                            </div>
                        </div>
                        
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="width">Width</label>
                            </div>
                        </div>
                        
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                            </div>
                        </div>
                        <!-- <span>X</span>     -->
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="price">Price</label>
                            </div>
                        </div>
                        <!-- <span>=</span> -->
                        <div class="col-sm-1">
                            <div class="form-group">
                              <label for="Total">Total</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body purchase_details_div">
                <?php $totalPrice=0;
                foreach($product_data->purchaseDetails as $k=>$product){?>
                    <div class="row" id="row_1">
                        <div class="col-sm-1 first">
                            <div class="form-group">
                                <span><?=$k+1?></span>
                            </div>
                        </div>
                        <div class="col-sm-2 first">
                            <div class="form-group">
                                <span><?=$product->masterProduct->title?></span>
                            </div>
                        </div>



                        <div class="col-sm-2">
                            <div class="form-group">
                                <span><?=$product->product->title;?></span>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <span><?=$product->unit_id?></span>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <span><?=$product->length;?></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-1">
                            <div class="form-group">
                                <span><?=$product->width;?></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-1">
                            <div class="form-group">
                                <span><?=$product->quantity;?></span>
                            </div>
                        </div>
                        <!-- <span>X</span>     -->
                        <div class="col-sm-1">
                            <div class="form-group">
                                <span><?=$product->price;?></span>
                            </div>
                        </div>
                        <!-- <span>=</span> -->
                        <div class="col-sm-1">
                            <div class="form-group">
                              <p><span id="total_amt_1"><?=$tot = $product->quantity*$product->price?></span></p>
                            </div>
                        </div>
                    </div>
                    <?php $totalPrice=$tot+$totalPrice ?>
                <!-- </div> -->
                <?php }?>
                    </div>
                </div>
    <hr/>
    <div class="card-body purchase_details_div">

    <div class="row col-md-11">
        <div class="col-md-6">
            <label>Grand Total</label>
        </div>
        <div class="col-md-6">
        <label style="float:right">
                <?=$totalPrice?>
            </label>
        </div>
    </div>
    </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  @endsection
  @section('js')
<script>
function getProdOptions(e){

    let master_product_id = $(e).val();
    disableProductAlreadySel(e);
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

function getSellerDetails(that){
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
