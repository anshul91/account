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
                <h3 class="card-title">Update Master Products</h3>
                <a href="<?=url('/master-product-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" 
                                id="title" placeholder="Enter first name" value="{{$data->title}}">
                                @error('title')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="sub_title">Sub-title</label>
                                <input type="text" class="form-control" name="sub_title" 
                                id="sub_title" placeholder="Enter Sub-title" value="{{$data->sub_title}}">
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