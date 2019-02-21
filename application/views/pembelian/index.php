<div class="container">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info '">
					<div class="box-header">
						
					<div class="col-sm-12">
						<div class="col-sm-2">
							<a href="pelanggan"><button class="btn btn-success btn-md btn-block">Kembali</button></a>
						</div>
						<div class="col-sm-2  col-sm-offset-8">
							<input class="form-control" type="text" name="tanggal" id="tanggal">
						</div>
					</div>
						
					</div>	
					<!-- /.box-header -->
					<div class="box-body">
						

						
						
						
						<table style="margin-top: 2%;" class="table">
							<tr>
								<th class="bg-gray" colspan="4" >Data Pembelian</th>

							</tr>
							<tr>
								<th class="bg-default" width="225" >No pembayaran : </th>
								<th class="bg-default"  >
									<input type="text" id="nop" readonly  class="form-control" name="" value="<?php echo $no_penjualan ?>">
								</th>
								<th class="bg-default" width="225" >Supplier :</th>
								<th class="bg-default"  >
									<select class="form-control" id="supplier">
										<?php foreach ($supp as $key): ?>
											<option value="<?php echo $key['id'] ?>"><?php echo $key['name'] ?></option>
										<?php endforeach ?>
									</select>
								</th>
							</tr>

							<tr>
								<th class="bg-default" width="225" >Keterangan :</th>
								<th class="bg-default" colspan="3" >
										<textarea id="keterangan" class="form-control"></textarea>
										
								</th>
							</tr>
							

						</table>
						
						<table style="margin-top: 2%;" class="table">
							<tr>
								<th class="bg-gray" colspan="9" >Input Barang</th>

							</tr>
							<tr>
								<th class="bg-default"  >Barcode/PLU : </th>
								<th class="bg-default" width="300" >
									<div class="form-inline" >
										
										<input id="barcode" type="text" class="form-control" name="barcode" >
										<a href="pencarian_barang?menu=pembelian" class="btn btn-info "><i class="fa fa-search"></i></a>
										
									</div>
								</th>

								<th class="bg-default" >Nama Barang :</th>
								<th class="bg-default" colspan="3"  >
									<input readonly id="nama" type="text" class="form-control" name="">
								</th>
								
								

							</tr>
							<tr>
								<th class="bg-default" width="225" >Harga Jual(Rp) :</th>
								<th class="bg-default"  >
								
										<input id="harga" readonly type="text"  class="form-control" name=""> 
										
									
								</th>
								<th>Disc(%):</th>
								<th>	
									<input id="disc" type="number" class="form-control" name="">
								</th>
								<th>Jumlah:</th>
								<th>	
									<input id="jumlah" type="text"  class="form-control" name="">
								</th>
								<th><button class="btn" id="add">Tambah</button></th>
							</tr>
							

						</table>

						<h4><b>Daftar Barang</b></h4>
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
									<th>
										<button id="clear" class="btn btn-block btn-danger">Clear</button>
									</th>
								</tr>
							</thead>
							<tbody id="data">
								
							</tbody>
							<tfoot class="bg-default">
								<tr>
									<th colspan="4"></th>
									<th>Grand Total Belanja(Rp.) :</th>
									<th>
										<input type="text" class="btn" id="jml" name="jml" readonly>
									</th>
									<th>
										<input type="text" class="btn" id="total" name="total" readonly>
									</th>
									<th></th>

								</tr>
								<tr>
									<th colspan="4"></th>
									<th>Uang Bayar(Rp.) :</th>
									<th></th>
									<th><input type="number" class="form-control" name="bayar" id="bayar" ></th>
									<th></th>
								</tr>
								<tr>
									<th colspan="6"></th>
									<th><a id="a"><button type="button" id="simpan" class="btn btn-warning btn-block">Simpan pembayaran</button></a></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
</div>
<script type="text/javascript">
	
	ambilkode()
	addBarang()
	readSementara()
	jmltot()
	bayar()
	changebarcode()
	clear()
	function ambilkode(){
		$.ajax({
			url:"<?php echo site_url('pembayaran/kode') ?>",
			type:'POST',
			dataType:'JSON',
			success:function(data){
				$('#barcode').val(data.barcode);
				$('#nama').val(data.name);
				$('#harga').val(data.harga);
			}
		})
	}

	function addBarang(){
		$('#add').click(function(){
			var barcode = $('#barcode').val();
			var nop     = $('#nop').val();
			var harga   = $('#harga').val();
			var disc    = $('#disc').val();
			var jumlah  = $('#jumlah').val();
			var dsc = disc/100;
			var all =  harga * jumlah - (harga * dsc) * jumlah
			$.ajax({
				url:"<?php echo site_url('pembayaran/jual') ?>",
				data:{nop:nop,barcode:barcode,harga:harga,disc:disc,jumlah:jumlah,all:all},
				type:'POST',
				success:function(){
					$('#barcode').val('');
					$('#nama').val('');
					$('#harga').val('');
					$('#disc').val('');
					$('#jumlah').val('');
					readSementara()
					jmltot();
				}

			})
		})
	}

	function readSementara(){
		$.ajax({
			url:'<?php echo site_url('pembayaran/sementara') ?>',
			Type:'POST',
			success:function(data){
				
				$('#data').html(data);
			}
		})
	}
	function hapus(id){
		$.ajax({
			url:'<?php echo site_url('pembayaran/hapus') ?>/' +id,
			type:'POST',
			cache: false,
			contentType: false,
			processData: false,
			success:function(){
				readSementara();
				jmltot();
			}
		})
	}
	


	function jmltot(){
		$.ajax({
			url:"<?php echo site_url('pembayaran/jmltot') ?>",
			type:"POST",
			dataType:"JSON",
			success:function(data){
				$('#jml').val(data.jumlah);
				$('#total').val(data.total);
			}
		})
	}

	function bayar(){
		
		$('#simpan').click(function(){
			var bayar   = $('#bayar').val()
			var nop     = $('#nop').val()
			var total   = $('#total').val()
			var ket     = $('#keterangan').val()
			var tgl     = $('#tanggal').val()
			var supp    = $('#supplier').val()
			var jml     = $('#jml').val()
		    var i       = total.split(',').join('');

			var kembali = bayar - i;
			$.ajax({
				url:"<?php echo site_url('pembayaran/bayar') ?>",
				data:{bayar:bayar,kembali:kembali,nop:nop,tgl:tgl,total:i,jumlah:jml,ket:ket,supp:supp},
				type:'POST',
				success:function(){
					
				}
			})		
		})
	}

	function changebarcode() {
		$('#barcode').change(function(){
			var code = $(this).val();
			$.ajax({
			url:"<?php echo site_url('pembayaran/kode2') ?>",
			type:'POST',
			data:{barkode:code},
			dataType:'JSON',
			success:function(data){
				$('#barcode').val(data.barcode);
				$('#nama').val(data.name);
				$('#harga').val(data.harga);
			}
		})
		})
	}

	function clear(){
		$('#clear').click(function(){
			$.ajax({
				url:"<?php echo site_url('pembayaran/clear') ?>",
				type:"POST",
				success:function(){
					readSementara();
					jmltot()
				}
			})
		})
	}
	$(document).ready(function(){



		$('#tanggal').datepicker();

		$('#tanggal').datepicker('setDate', new Date());
		var np = $('#nop').val();
		$('#a').attr('href','<?php echo site_url('penjualan_nota/') ?>?noNota='+np+'')

	})
</script>