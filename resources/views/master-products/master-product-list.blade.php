@extends('adminlte::page')
@section('content')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

<!-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5>master_products</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">master_products</li>
            </ol>
          </div>
        </div>
      </div>
    </section> -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         
          <div class="card">
            <div class="card-header"> @include('layouts/flash')
              <h3 class="card-title">Master Product Listing
                  
              </h3>
              <span style="float:right"><a href="<?=url('/master-product-add');?>" class="btn btn-sm btn-success">
                  <i class="fas fa-plus-circle"></i> Add Master Product</a>
                </span>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row"><div class="col-sm-12 col-md-6">
                      <div class="dataTables_length" id="example1_length">
                          <label>Show <select name="example1_length" 
                          aria-controls="example1"
                           class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12">
                            <table id="master_products" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc">S.no.</th>
                                    <th class="sorting">Title</th>
                                    <th class="sorting">Sub-Title</th>
                                    <th class="sorting" width="20px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $k=>$master_product){?>
                                <tr role="row" class="odd">
                                    <td class="sorting_1"><?=$k+1?></td>
                                    <td><?=$master_product->title?></td>
                                    <td><?= $master_product->sub_title?></td>
                                   
                                    <td class="text-right py-0 align-middle">
                                      <div class="btn-group btn-group-sm">
                                        <a href="<?=url('/master-product-update'."/".Crypt::encrypt($master_product->id));?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="<?=url('/master-product-view'."/".Crypt::encrypt($master_product->id));?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="#" 
                                        class="btn btn-danger" onclick="deletemaster_product({{$master_product->id}})"><i class="fas fa-trash"></i></a>
                                    </div>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
               
              </table>
           
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@section('js')
    <script>
        $(function () {
            // $("#master_products").DataTable();
            $('#master_products').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });

            
        });
        function deletemaster_product(id){
          Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "<?=url('/master-product-delete')?>",
                        data: {'id':id,"_token": "{{ csrf_token() }}",},              
                        success: function(data){
                          Swal.fire(
                              'Deleted!',
                              'Your master product has been deleted.',
                              'success'
                          );
                          $(".content").load(location.href + " .content");
                        },
                        error:function(data){
                          alert(data);
                        }
                      });
                   
                  }
              });
          
        }
    </script>
@Stop
@yield('scripts')
@endsection