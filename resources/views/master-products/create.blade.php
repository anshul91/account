@extends('adminlte::page')
@section('plugins.Chartjs', true)
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
                <h3 class="card-title">Add New Master Product</h3>
                <a href="<?=url('/master-product-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="first_name">Title</label>
                                <input type="text" class="form-control" name="title" 
                                id="title" placeholder="Enter title" value="{{old('title')}}">
                                @error('title')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="last_name">Sub-title</label>
                                <input type="text" class="form-control" name="sub_title" 
                                id="sub_title" placeholder="Enter Sub-title" value="{{old('sub_title')}}">
                                @error('sub_title')
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