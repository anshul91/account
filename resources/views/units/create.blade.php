@extends('adminlte::page')
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
                <h3 class="card-title">Add New Measurement</h3>
                <a href="<?=url('/unit-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" 
                                id="name" placeholder="Enter name" value="{{old('name')}}">
                                @error('name')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                @foreach(Config::get('constants.measurement_unit') as $k => $measures)
                                  <option value="<?=$k?>"><?=$measures?></option>
                                  
                                @endforeach
                                </select>
                                @error('type')
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