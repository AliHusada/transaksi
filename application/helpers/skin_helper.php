<?php 
defined("BASEPATH")or exit('NO DIRECT SCRIPT ALLOWED');

function view($dollar,$db=NULL){
	$CI 	=& get_instance();
	$CI->load->view('skin/header',$db);
	$CI->load->view('skin/navbar');
	$CI->load->view('skin/sidebar');
	$CI->load->view($dollar.'/index.php',$db);
	$CI->load->view('skin/footer');
	$CI->load->view('skin/control_sidebar');

	
}

function view2($dollar,$db=NULL){
	$CI 	=& get_instance();
	$CI->load->view('skin/header',$db);
	$CI->load->view('skin/navbar2');
	$CI->load->view('skin/sidebar2');
	$CI->load->view($dollar.'/index.php',$db);
	$CI->load->view('skin/footer');
	$CI->load->view('skin/control_sidebar');
	

	
}


function sidebar(){
	$arr = [
		'data' => 'Master Data',
		'laporan' => 'Master laporan'
	];
	$arr2 = [
		[
			'text'=>'Pelanggan',
			'url'=>'pelanggan',
			'icon'=>'fa fa-circle-o'
		],
		[
			'text'=>'Barang',
			'url'=>'barang',
			'icon'=>'fa fa-circle-o'
		],
		[
			'text'=>'Supplier',
			'url'=>'supplier',
			'icon'=>'fa fa-circle-o'
		]
	];
	$arr3 = [
		[
			'text'=>'Laporan Penjualan',
			'icon'=>'fa fa-credit-card',
			'url'=>'transaksi_penjualan'
		],
		[
			'text'=>'Laporan Pembelian',
			'icon'=>'fa fa-credit-card',
			'url'=>'transaksi_pembelian'
		],
		
	];

	$arr4 = [
		[
			'text'=>'Penjualan',
			'icon'=>'fa fa-briefcase',
			'url'=>'pembayaran?menu=penjualan'
		],
		[
			'text'=>'Pembelian',
			'icon'=>'fa fa-briefcase',
			'url'=>'pembayaran?menu=pembelian'
		]
	]
	?>
	<li class="treeview">
		<a>
			<i class="fa fa-dashboard"></i>
			<span><?php echo $arr['data'] ?></span>
			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li>
				<?php foreach ($arr2 as $key): ?>
					<a href="<?php echo $key['url']; ?>">
						<i class="<?php echo $key['icon'] ;?>"></i> <span><?php echo $key['text']; ?></span>
					</a>
				<?php endforeach ?>

			</li>
		</ul>
	</li>

	<li class="treeview">
		<a>
			<i class="fa fa-dashboard"></i>
			<span><?php echo $arr['laporan'] ?></span>
			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li>
				<?php foreach ($arr3 as $key): ?>

					<a href="<?php echo $key['url'] ?>">
						<i class="<?php echo $key['icon'] ?>"></i> <span><?php echo $key['text'] ?></span>
					</a>

				<?php endforeach ?>
			</li>
		</ul>
	</li>
	
	<?php foreach ($arr4 as $row): ?>
		<li>
			<a href="<?php echo $row['url'] ?>">
				<i class="<?php echo $row['icon'] ?>"></i> <span><?php echo $row['text'] ?></span>
			</a>
		</li>
	<?php endforeach ?>
	
	



	<?php 
}	

function sidebar2(){
	$url = site_url('login/logout');
	$array = [
		[
			'text'=>'Kembali',
			'icon'=>'fa fa-angle-double-left fa-lg',
			'url'=>'pelanggan'
		],
		[
			'text'=>'Log Out',
			'icon'=>'fa fa-arrow-left',
			'url'=>$url
		]
	];
	?>
	<?php foreach ($array as $row): ?>
		<li>
			<a href="<?php echo $row['url'] ?>">
				<i class="<?php echo $row['icon'] ?>"></i> <span><?php echo $row['text'] ?></span>
			</a>
		</li>
	<?php endforeach ?>
	<?php 
}
function kode($i,$var){
	$CI =& get_instance();
	$query  = $CI->db->query('SELECT max(kode) as kode FROM '.$i.' ')->row_array();
	$kode = $query['kode'];
	$noUrut = (int) substr($kode, 3, 3);
	$noUrut++;
	$char = "$var";
	echo $char . sprintf("%04s", $noUrut);
}	