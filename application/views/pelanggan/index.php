<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info '">
        <div class="box-header">
          <h2 class="box-title"><b style="font-weight: 1000;font-variant: small-caps;font-size: 30px"> Data Pelanggan </b></h2>

          <div class="box-tools">
            <div class="margin">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#form-add">
                <span data-trigger="hover" data-container="body" data-toggle="popover" data-placement="left"  data-original-title="Tambah Data "><i class="fa fa-plus"></i>
                </span>
              </button>

            </div>
          </div>

        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="table table-responsive">  
            <table id="tabel" class="table table-bordered table-hover">
              <thead >
                <tr class="bg-info">
                  <th>Opsi</th>
                  <th>No</th>
                  <th>kode</th>
                  <th>Nama Pelanggan</th>
                  <th>Nama Toko</th>
                  <th>Alamat</th>

                </tr>
              </thead>
              <tbody id="data">


              </tbody>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<div class="modal fade" id="form-add">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data</h4>
        </div>
        <div class="modal-body">
          <font color="red" class="text-center"><div class="error"></div></font>
          <form class="form-horizontal" id="form-tambah" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="kode" class="col-sm-2 control-label">Kode </label>

              <div class="col-sm-10">
                <input  type="text" value="<?php echo kode('pelanggan','P') ?>" name="kode" class="form-control" id="kode" required="">
              </div>

            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Nama Pelanggan </label>

              <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" id="name" required="">
              </div>

            </div>

            <div class="form-group">
              <label for="shop" class="col-sm-2 control-label">Nama Toko</label>

              <div class="col-sm-10">
                <input type="text" name="toko" class="form-control" id="shop" required="">
              </div>

            </div>

            <div class="form-group">
              <label for="address" class="col-sm-2 control-label">Alamat</label>

              <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" id="address" required="">
              </div>

            </div>



            <div class="modal-footer">
              <button type="reset" class="btn btn-warning pull-left">Reset</button>
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>

        </form>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</div>



<div class="modal fade" id="form-edit">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data</h4>
        </div>
        <div class="modal-body modal-edit">
          <font color="red" class="text-center"><div class="error"></div></font>
          <form class="form-horizontal" id="form-update" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="kode" class="col-sm-2 control-label">Kode </label>

              <div class="col-sm-10">
                <input type="text" name="kode" class="form-control" id="kode" required="">
                <input type="hidden" name="id" class="form-control" id="id" >
              </div>

            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Nama Pelanggan </label>

              <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" id="nama" required="">
              </div>

            </div>

            <div class="form-group">
              <label for="shop" class="col-sm-2 control-label">Nama Toko</label>

              <div class="col-sm-10">
                <input type="text" name="toko" class="form-control" id="toko" required="">
              </div>

            </div>

            <div class="form-group">
              <label for="address" class="col-sm-2 control-label">Alamat</label>

              <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" id="alamat" required="">
              </div>

            </div>



            <div class="modal-footer">
              <button type="reset" class="btn btn-warning pull-left">Reset</button>
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>

        </form>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
      read()
  
      function read(){
        $.ajax({
          url:'<?php echo site_url('pelanggan/Read') ?>',
          type:'POST',
          success:function(data){
            $('tbody').html(data);
            $('.table').footable({
              "paging": {
                "enabled": true
              },
              "filtering": {
                "enabled": true
              },
              "sorting": {
                "enabled": true
              }
            });
          }
        })
      }


      
        $('#form-add').submit(function(e){
          e.preventDefault();
          var data = $('#form-tambah').serialize();
          $.ajax({
            url:"<?php echo site_url('pelanggan/save/tambah/') ?>",
            type:"POST",
            data:data,
            success:function(data){
              $('#form-add').modal('hide');
              $('#kode').val(data);
              read();
            }
          })
        })
      

      $(document).on('click','#edit',function(){
        var id   = $(this).data('id');
        var nama = $(this).data('nama');
        var alamat = $(this).data('alamat');
        var kode = $(this).data('kode');
        var toko = $(this).data('toko');

        $('.modal-edit #id').val(id);
        $('.modal-edit #kode').val(kode);
        $('.modal-edit #alamat').val(alamat);
        $('.modal-edit #nama').val(nama);
        $('.modal-edit #toko').val(toko);
      })

      $('#form-edit').submit(function(e){
        e.preventDefault();
        var data = $('#form-update').serialize();
        var id = $('#id').val();
        $.ajax({
          url:"<?php echo site_url('pelanggan/save/edit') ?>/"+id,
          type:"POST",
          data:data,
          success:function(){
            read();
            $('#form-edit').modal('hide');
          }
        })
      })

      function hapus(id){
       swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it",
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
      }, function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url : '<?php echo site_url('pelanggan/save/hapus')?>/'+id,
            type : 'POST',
            cache: false,
            contentType: false,
            processData: false,
            success:function(){

              swal({
                title: "Deleted!",
                text: "Your imaginary file has been deleted.",
                type: "success",
              }, function (isConfirm) {
                read();
              });

            }
          });
        } else {
          swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
      });
     }
     $(document).ready(function(){
      $('#page').on('change', function(e){
        e.preventDefault();
        var newSize = $(this).val();
        FooTable.get('.table').pageSize(newSize);
      });
    })

  </script>