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
            <table class="table">
              <thead>
                <tr class="bg-gray" >
                  <th>No</th>
                  <th>Kode</th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Disc(%)</th>
                  <th>Jumlah</th>
                  <th>Sub Total(RP)</th>
                  <th></th>
                </tr>
              </thead>
              <tbody >
                  <?php $i=1; foreach ($query as $key ): ?>
                    <tr>  
                        <td> <?php echo $i++ ?></td>
                        <td> <?php echo $key['kode'] ?></td>
                        <td> <?php echo $key['nama'] ?></td>
                        <td> <?php echo number_format($key['harga']) ?></td>
                        <td> <?php echo $key['disc'] ?></td>
                        <td> <?php echo $key['jumlah'] ?></td>
                        <td> <?php echo number_format($key['sub_total']) ?></td>
                    </tr>
                  <?php endforeach ?>
              </tbody>
              <tfoot class="bg-default">
                <tr>
                  <th colspan="4"></th>
                  <th>Grand Total Belanja(Rp.) :</th>
                  <th>
                    <input type="text"  id="jml" name="jml" 
                    value="<?php echo $query2['jumlah'] ?>" class='text-center form-control' readonly>
                  </th>
                  <th>
                    <input type="text"  id="total" name="total"
                    value="<?php echo number_format($query2['total']) ?>" class='text-center form-control' readonly>
                  </th>
                  <th></th>

                </tr>
                <tr>
                  <th colspan="4"></th>
                  <th>Uang Bayar(Rp.) :</th>
                  <th></th>
                  <th><input type="text" 
                    value="<?php echo number_format($query2['uang_bayar']) ?>" class="form-control text-center" name="bayar" id="bayar" readonly></th>
                  <th></th>
                </tr>
                 <tr>
                  <th colspan="4"></th>
                  <th>Uang Kembali(Rp.) :</th>
                  <th></th>
                  <th><input type="text" value="<?php echo number_format($query2['uang_kembali']) ?>" class="form-control text-center" name="kembali" id="kembali" readonly></th>
                  <th></th>
                </tr>
                <tr>
                  <th colspan="4"></th>
                  <th>No Transaksi :</th>
                  <th></th>
                  <th><input type="text" value="<?php echo $query2['no_penjualan'] ?>" class="form-control text-center" name="kembali" id="kembali" readonly></th>
                  <th></th>
                </tr>
                <tr>
                  <th colspan="4"></th>
                  <th>Tanggal Transaksi :</th>
                  <th></th>
                  <th><input type="text" value="<?php echo $query2['tgl_penjualan'] ?>" class="form-control text-center" name="kembali" id="kembali" readonly></th>
                  <th></th>
                </tr>
                <tr class="bg-gray">
                  <th colspan="8">Keterangan</th>
                </tr>
                <tr class="bg-default">  
                    <th colspan="8"><textarea class="form-control"><?php echo $query2['keterangan'] ?></textarea></th>
                </tr>
              </tfoot>
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
