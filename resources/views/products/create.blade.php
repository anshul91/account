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
                <h3 class="card-title">Add New Product</h3>
                <a href="<?=url('/product-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="master_product_id">Select Master Product</label>
                                <select name="master_product_id" id="master_product_id" class="form-control">
                                    <?php foreach($master_product as $k=>$v){?>
                                        <option value="<?=$v->id?>"><?=$v->title?></option>
                                    <?php }?>
                                </select>
                                @error('master_product_id')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="unit_id">Select Unit</label>
                                <select name="unit_id" id="unit_id" class="form-control">
                                    <?php foreach($unit_data as $k=>$v){?>
                                        <option value="<?=$v->id?>"><?=$v->name?></option>
                                    <?php }?>
                                </select>
                                @error('unit_id')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" 
                                id="title" placeholder="Enter Sub-title" value="{{old('title')}}">
                                @error('title')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="sub_title">Sub-title</label>
                                <input type="text" class="form-control" name="sub_title" 
                                id="sub_title" placeholder="Enter Sub-title" value="{{old('sub_title')}}">
                                @error('sub_title')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" 
                                id="description" placeholder="Enter description">{{old('description')}}</textarea>
                                @error('description')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
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
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
        
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  @endsection
  <!-- <style>
      .content-header{
        padding: 6px .5rem!important;
      }
  </style> -->