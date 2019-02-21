<div class="container">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info '">
					<div class="box-header">
						
						<div class="box-title">
							<b><h1>Pencarian Barang</h1></b>

						</div>


						<div class="box-tools">

						</div>
						<p>

						</p>

					</div>

					<!-- /.box-header -->
					<div class="box-body">
						<table class="table" >
							
							<tr>
								<th class="bg-gray"  >Filter Data</th>

							</tr>
							<tr>
								<th class="bg-default" width="175" >Sub Kategori : </th>
								<th class="bg-default"  >
									<div class="form-inline">
										<input type="text" style="width: 20%;" class="form-control" name="">/
										<input type="text" style="width: 5%;" class="form-control" name="">
									</div>
								</th>
							</tr>
							<tr>
								<th class="bg-default" width="225" >Kata Kunci :</th>
								<th class="bg-default"  >
									<div class="form-inline">
										<input type="text" style="width: 45%;" class="form-control" name="">
										<button class="btn">Cari</button>
									</div>
								</th>
							</tr>
							<tr>
								<th></th>
								<th><b>Kata Kunci:<small>Kode/Barcode/Nama Barang</small></b></th>
							</tr>
						</table>

						<table style="margin-top: 2%" class="table">
							<thead class="bg-gray">
								<tr>
									<th>No</th>
									<th>Kode</th>
									<th>Barcode/PLU</th>
									<th>Nama Barang</th>
									<th>Satuan</th>
									<th>Jenis</th>
									<th>Stok</th>
									<th>Hrg Jual(Rp)</th>
								</tr>
							</thead>
							<tbody id="tbody">
								<?php $no=1; foreach ($barang as $key): ?>
									<tr>
									<th><?php echo $no++ ?></th>
									<th><a><?php echo $key['kode'] ?></a></th>
									<th><a id="barcode" ><?php echo $key['barcode'] ?></a></th>
									<th><?php echo $key['name'] ?></th>
									<th><?php echo $key['satuan'] ?></th>
									<th><?php echo $key['jenis'] ?></th>
									<th><?php echo $key['stok'] ?></th>
									<th><?php echo $key['harga'] ?></th>

									</tr>
								<?php endforeach ?>
							</tbody>
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
	$(document).ready(function(){
		$(document).on('click','#barcode',function(){
			var data = $(this).text()
			
			$.ajax({
				url:"<?php echo site_url('cari_barang/barkode') ?>",
				type:"POST",
				data:{data:data},
				success:function(sukses){
					window.location.href = "<?php echo site_url('pembayaran?menu=').$_GET["menu"]  ?>"
				}
			})

		})
		
	})
</script>