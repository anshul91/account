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
                <h3 class="card-title">Update Customer</h3>
                <a href="<?=url('/customer-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$customer->id}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" 
                                id="first_name" placeholder="Enter first name" value="{{$customer->first_name}}">
                                @error('first_name')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" 
                                id="last_name" placeholder="Enter last name" value="{{$customer->last_name}}">
                                @error('last_name')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="email">Email Id</label>
                                <input type="text" class="form-control" name="email" 
                                id="email" placeholder="Enter email" value="{{$customer->email}}">
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
                                <input type="text" class="form-control" name="mobile_no" 
                                id="mobile_no" placeholder="Enter Mobile No." value="{{$customer->mobile_no}}">
                                @error('mobile_no')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="contact_no">Landline no.</label>
                                <input type="text" class="form-control" name="contact_no" 
                                id="contact_no" placeholder="Enter Landline No." value="{{$customer->contact_no}}">
                                @error('contact_no')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="contact_person">Contact Person</label>
                                <input type="text" class="form-control" name="contact_person" 
                                id="contact_person" placeholder="Enter Contact Person" 
                                value="{{$customer->contact_no}}">
                                @error('contact_person')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="faxno">Fax No.</label>
                                <input type="text" class="form-control" 
                                name="faxno" id="faxno" placeholder="Enter Fax No." value="{{$customer->faxno}}">
                                @error('faxno')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" 
                                id="city" placeholder="Enter City" value="{{$customer->city}}">
                                @error('city')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="state">State</label>
                                <input type="text" class="form-control" name="state" 
                                id="state" placeholder="Enter State" value="{{$customer->state}}">
                                @error('state')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="tax_reg_no">Tax Reg. No.</label>
                                <input type="text" class="form-control" name="tax_reg_no" 
                                id="tax_reg_no" placeholder="Enter Tax Reg. no." value="{{$customer->tax_reg_no}}"/>
                                @error('tax_reg_no')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" 
                                id="address" placeholder="Enter Address">{{$customer->address}}</textarea>
                                @error('address')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" 
                                id="description" placeholder="Enter description">{{$customer->description}}</textarea>
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