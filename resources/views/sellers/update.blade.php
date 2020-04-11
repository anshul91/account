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
                <h3 class="card-title">Update Seller</h3>
                <a href="<?=url('/seller-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$seller->id}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" 
                                id="first_name" placeholder="Enter first name" value="{{$seller->first_name}}">
                                @error('first_name')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" 
                                id="last_name" placeholder="Enter last name" value="{{$seller->last_name}}">
                                @error('last_name')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="email">Email Id</label>
                                <input type="text" class="form-control" name="email" 
                                id="email" placeholder="Enter email" value="{{$seller->email}}">
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
                                id="mobile_no" placeholder="Enter Mobile No." value="{{$seller->mobile_no}}">
                                @error('mobile_no')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="contact_no">Landline no.</label>
                                <input type="text" class="form-control" name="contact_no" 
                                id="contact_no" placeholder="Enter Landline No." value="{{$seller->contact_no}}">
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
                                value="{{$seller->contact_no}}">
                                @error('contact_person')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="faxno">Fax No.</label>
                                <input type="text" class="form-control" 
                                name="faxno" id="faxno" placeholder="Enter Fax No." value="{{$seller->faxno}}">
                                @error('faxno')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" 
                                id="city" placeholder="Enter City" value="{{$seller->city}}">
                                @error('city')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="state">State</label>
                                <input type="text" class="form-control" name="state" 
                                id="state" placeholder="Enter State" value="{{$seller->state}}">
                                @error('state')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="tax_reg_no">Tax Reg. No.</label>
                                <input type="text" class="form-control" name="tax_reg_no" 
                                id="tax_reg_no" placeholder="Enter Tax Reg. no." value="{{$seller->tax_reg_no}}"/>
                                @error('tax_reg_no')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="customers_type_id">Seller Type</label>
                                <select class="form-control" name="customers_type_id" id="customers_type_id">
                                <option value="">--Select Seller Type--</option>
                                @foreach($customers_type as $k=>$v)
                                    <option value="<?=$v->id?>"<?php if($v->id==$seller->customers_type_id)echo "selected";?>><?=ucwords($v->type)?></option>
                                @endforeach
                                </select>
                                @error('customers_type_id')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" 
                                id="address" placeholder="Enter Address">{{$seller->address}}</textarea>
                                @error('address')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" 
                                id="description" placeholder="Enter description">{{$seller->description}}</textarea>
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