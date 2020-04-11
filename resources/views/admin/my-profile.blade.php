@extends('adminlte::page')
@section('plugins.Chartjs', true)
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding:0px 0px!important;">
      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-sm-6">
            <h5>My Profile</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="name" id="username" value="{{$user->name}}" placeholder="Enter username">
                    @error('name')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" class="form-control" name="email" id="email_id" value="{{$user->email}}" placeholder="Enter email">
                    @error('email')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
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