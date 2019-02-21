<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header">
          <h2 class="box-title"><b style="font-weight: 1000;font-variant: small-caps;font-size: 30px"> Data Transaksi </b></h2>

        </div>
  
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table table-responsive">  
            <table id="tabel" class="table table-bordered table-hover text-center">
              <thead >
                <tr class="bg-info">
                  <th>No</th>
                  <th>Tgl Pembelian</th>
                  <th>Nama/Jenis Pembelian</th>
                  <th>No Pembelian</th>
                  <th>Total harga</th>
                  <th>Jumlah</th>
                  <th></th>

                </tr>
              </thead>
              <tbody >
                 

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

    <script type="text/javascript">
      $(document).ready(function(){

      })
      
      read()
        function read(){
          $.ajax({
            url:"<?php echo site_url('transaksi_pembelian/read') ?>",
            type:"POST",
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
    </script>