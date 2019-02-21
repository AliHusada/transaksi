<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info '">
        <div class="box-header">
          <h2 class="box-title"><b style="font-weight: 1000;font-variant: small-caps;font-size: 30px"> Data Barang </b></h2>

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
          <div class="table-responsive"> 
            <table id="tabel" class="table table-bordered table-hover ">
              <thead >
                <tr class="bg-info">
                  <th  width="100">Opsi</th>
                  <th>No</th>
                  <th>Kode</th>
                  <th>Bar Kode</th>
                  <th>Nama Barang</th>
                  <th>Satuan</th>
                  <th>Jenis</th>
                  <th>Stok</th>
                  <th>Harga Jual(Rp)</th>

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
              <input type="text" value="<?php echo kode('barang','B'); ?>" id="kode" name="kode" class="form-control">
            </div>
            <div class="form-group">
              <label>Barcode/PLU</label>
              <input type="text" id="barcode" name="barcode" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" id="nama" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label>Satuan</label>
              <input type="text" id="satuan" name="satuan" class="form-control">
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <input type="text" id="jenis" name="jenis" class="form-control">
            </div>
            <div class="form-group">
              <label>Stok</label>
              <input type="text" id="stok" name="stok" class="form-control">
            </div>
            <div class="form-group">
                <label>Harga Modal(RP)</label>
                <input type="text" id="modal" name="modal" class="form-control">
              </div>
              <div class="form-group">
                <label>Harga Jual(RP)</label>
                <input type="text" id="harga" name="harga" class="form-control">
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Reset</button>
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
            <h4 class="modal-title">Edit Data</h4>
          </div>

          <div class="modal-body modal-edit">
            <form method="post" id="form-edit">
              <div class="form-group">
                <label>Kode</label>
                <input type="text"  id="kode" name="kode" class="form-control">
                <input type="hidden"  id="id" name="id" class="form-control">
              </div>
              <div class="form-group">
                <label>Barcode/PLU</label>
                <input type="text" id="barcode" name="barcode" class="form-control">
              </div>
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" id="nama" name="name" class="form-control">
              </div>
              <div class="form-group">
                <label>Satuan</label>
                <input type="text" id="satuan" name="satuan" class="form-control">
              </div>
              <div class="form-group">
                <label>Jenis</label>
                <input type="text" id="jenis" name="jenis" class="form-control">
              </div>
              <div class="form-group">
                <label>Stok</label>
                <input type="text" id="stok" name="stok" class="form-control">
              </div>
              <div class="form-group">
                <label>Harga Modal(RP)</label>
                <input type="text" id="modal" name="modal" class="form-control">
              </div>
              <div class="form-group">
                <label>Harga Jual(RP)</label>
                <input type="text" id="harga" name="harga" class="form-control">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Reset</button>
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

     function read(){
      $.ajax({
        url:'<?php echo site_url('barang/read') ?>',
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
      var data = $('#form-add').serialize();
      $.ajax({
        url:"<?php echo site_url('barang/save/tambah/') ?>",
        type:"POST",
        data:data,
        success:function(data){
          $('#tambah').modal('hide');
          $('#kode').val(data);
          read();
        }
      })
    })

    $(document).on('click','#edit',function(){
      var id     = $(this).data('id');
      var kode   = $(this).data('kode');
      var barcode   = $(this).data('barcode');
      var nama   = $(this).data('nama');
      var satuan   = $(this).data('satuan');
      var jenis   = $(this).data('jenis');
      var stok   = $(this).data('stok');
      var harga   = $(this).data('harga');

      $('.modal-edit #id').val(id);
      $('.modal-edit #kode').val(kode);
      $('.modal-edit #barcode').val(barcode);
      $('.modal-edit #nama').val(nama);
      $('.modal-edit #satuan').val(satuan);
      $('.modal-edit #jenis').val(jenis);
      $('.modal-edit #stok').val(stok);
      $('.modal-edit #harga').val(harga);
    })

    $('#form-edit').submit(function(e){
      e.preventDefault();
      var data = $('#form-edit').serialize();
      var id = $('#id').val();
      $.ajax({
        url:"<?php echo site_url('barang/save/edit') ?>/" + id ,
        type:"POST",
        data:data,
        success:function(){
          $('#update').modal('hide');
          read();
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
            url : '<?php echo site_url('barang/save/hapus')?>/'+id,
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