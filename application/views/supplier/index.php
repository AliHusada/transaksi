<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info '">
        <div class="box-header">
          <h2 class="box-title"><b style="font-weight: 1000;font-variant: small-caps;font-size: 30px"> Data Supplier </b></h2>

          <div class="box-tools">
            <div class="margin">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">
                <span data-trigger="hover" data-container="body" data-toggle="popover" data-placement="left"  data-original-title="Tambah Data "><i class="fa fa-plus"></i>
                </span>
              </button>

            </div>
          </div>

        </div>

        <!-- /.box-header -->
        <div class="box-body">

          <!-- <div  style="margin-bottom: 1%">
            <font size="3">Pagination</font>   
            <select class="form-control" style="width: 8%;" id="page">  
                <option  value="10">10</option>
                <option  value="20">20</option>
                <option  value="50">50</option>
            </select>
          </div> -->
          <div class="table-responsive"> 
            <table  id="tabel" class="table table-bordered table-hover" data-empty="Data Kosong"
            >
            <thead>
              <tr class="bg-info">
                <th  width="100">Opsi</th>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telpon</th>

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
<div class="modal fade" id="tambah">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data</h4>
        </div>

        <div class="modal-body">
          <form method="post" id="form-add">
            <div class="form-group">
              <label>Kode</label>
              <input type="text" id="kode" name="kode" value="<?php echo kode('supplier','S') ?>" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" id="nama" name="nama" class="form-control">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" id="alamat" name="alamat" class="form-control">
            </div>
            <div class="form-group">
              <label>No Telpon</label>
              <input type="text" id="no_telpon" name="tlp" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="reset" class="btn btn-default pull-left">Reset</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>
  </div>

  <div class="modal fade" id="update">
    <div class="modal-dialog modal-md ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ubah Data</h4>
          </div>

          <div class="modal-body modal-edit">
            <form method="post" id="form-edit">
              <div class="form-group">
                <label>Kode</label>
                <input type="text" id="kode" name="kode"  class="form-control">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="hidden" id="id" name="id" class="form-control">
                <input type="text" id="nama" name="nama" class="form-control">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control">
              </div>
              <div class="form-group">
                <label>No Telpon</label>
                <input type="text" id="tlp" name="tlp" class="form-control">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="reset" class="btn btn-default pull-left">Reset</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>
    </div>
    <script type="text/javascript">
      read()
      create()
      function read(){
        $.ajax({
          url:'<?php echo site_url('supplier/Read') ?>',
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


      function create(){
        $('#form-add').submit(function(e){
          e.preventDefault();
          var data = $(this).serialize();
          var id = $('#id').val();
          $.ajax({
            url:"<?php echo site_url('supplier/save/tambah/') ?>",
            type:"POST",
            data:data,
            success:function(){
              read();
              $('#tambah').modal('hide');
              document.getElementById('tambah').reset();
            }
          })
        })
      }

      $(document).on('click','#edit',function(){
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var alamat = $(this).data('alamat');
        var tlp = $(this).data('tlp');
        var kode  = $(this).data('kode');

        $('.modal-edit #id').val(id);
        $('.modal-edit #nama').val(nama);
        $('.modal-edit #alamat').val(alamat);
        $('.modal-edit #tlp').val(tlp);
        $('.modal-edit #kode').val(kode);
      })

      $('#form-edit').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var id = $('#id').val();
        $.ajax({
          url:"<?php echo site_url('supplier/save/edit') ?>/"+id,
          type:"POST",
          data:data,
          success:function(){
            read();
            $('#update').modal('hide');
            document.getElementById('form-add').reset();
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
            url : '<?php echo site_url('supplier/save/hapus')?>/'+id,
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