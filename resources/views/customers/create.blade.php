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
                <h3 class="card-title">Add New Customer</h3>
                <a href="<?=url('/customer-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" 
                                id="first_name" placeholder="Enter first name">
                                @error('first_name')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" 
                                id="last_name" placeholder="Enter last name">
                                @error('first_name')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="email">Email Id</label>
                                <input type="text" class="form-control" name="email" 
                                id="email" placeholder="Enter email">
                                @error('email')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>  

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="mobile_no">Mobile No.</label>
                                <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter Mobile No.">
                                @error('mobile_no')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="contact_no">Landline no.</label>
                                <input type="text" class="form-control" name="contact_no" 
                                id="contact_no" placeholder="Enter Landline No.">
                                @error('contact_no')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" 
                                id="address" placeholder="Enter Address"></textarea>
                                @error('address')
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