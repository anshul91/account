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
                <h3 class="card-title">Unit Details</h3>
                <a href="<?=url('/unit-list')?>" style="float:right;"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
              @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$unit->id}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" 
                                id="name" placeholder="name" value="{{$unit->name}}">
                                @error('name')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="last_name">Type</label>
                                <input type="text" class="form-control" name="type" 
                                id="type" placeholder="type" value="{{$unit->type}}">
                                @error('type')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">                       
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" 
                                id="description" placeholder="Enter description">{{$unit->description}}</textarea>
                                @error('description')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>  

                    <div class="row">
                        
                    </div> 
                    
                </div>
               
              </form>
            </div>
        </div>
         
    </section>
  
  @section('js')
<script>
    $(function(){
        $(".container-fluid").find(":input").attr('disabled',true);
    });
</script>
@stop
@endsection