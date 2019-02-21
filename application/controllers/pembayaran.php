<?php 
defined("BASEPATH") or exit('NO DIRECT SCRIPT ALLOWED');

class pembayaran extends CI_Controller{

	public function index(){
		if ($_GET['menu'] == 'penjualan') {
			$this->penjualan();
		}
		else if ($_GET['menu'] == 'pembelian') {
			$this->pembelian();
		}
		else{

		}
		
	}

	public function penjualan(){
		$db['pelanggan']  = $this->db->get('pelanggan')->result_array();
		$query  = $this->db->query('SELECT max(no_penjualan) as nop FROM transaksi')->row_array();
		$np = $query['nop'];
		$noUrut = (int) substr($np, 3, 3);
		$noUrut++;
		$char = "JL";
		$db['no_penjualan'] = $char . sprintf("%04s", $noUrut);
		$db['title'] = 'penjualan';
		echo view2('penjualan',$db);
	}	

	public function pembelian(){
		$query  = $this->db->query('SELECT max(no_penjualan) as nop FROM transaksi')->row_array();
		$np = $query['nop'];
		$noUrut = (int) substr($np, 3, 3);
		$noUrut++;
		$char = "PB";
		$db['no_penjualan'] = $char . sprintf("%04s", $noUrut);
		$db['title'] = 'Pembelian';
		$db['supp'] = $this->db->get('supplier')->result_array();
		echo view2('pembelian',$db);
	}
	public function kode(){
		$barkode = $this->session->userdata('barkode');
		$query = $this->db->query('SELECT barcode,name,harga from barang where barcode = "'.$barkode.'" ')->result_array();
		$barcode = '';
		$name    = '';
		$harga   = '';
		foreach ($query as $key) {
			$barcode = $key['barcode'];
			$name = $key['name'];
			$harga =$key['harga'];
		}
		echo json_encode(array('barcode'=>$barcode,'name'=>$name,'harga'=>$harga));
	}

	public function kode2(){
		$barkode = $this->input->post('barkode');
		$query = $this->db->query('SELECT barcode,name,harga from barang where barcode = "'.$barkode.'" ')->result_array();
		$barcode = '';
		$name    = '';
		$harga   = '';
		foreach ($query as $key) {
			$barcode = $key['barcode'];
			$name = $key['name'];
			$harga =$key['harga'];
		}
		echo json_encode(array('barcode'=>$barcode,'name'=>$name,'harga'=>$harga));
	}

	public function jual(){
		$this->session->unset_userdata('barkode');
		$barcode = $this->input->post('barcode');
		$nop     = $this->input->post('nop');
		$harga   = $this->input->post('harga');
		$disc    = $this->input->post('disc');
		$jumlah  = $this->input->post('jumlah');
		$all     = $this->input->post('all');

		$sql = $this->db->query('SELECT id,kode from barang where barcode = "'.$barcode.'" ')->row_array();
		$kode =  $sql['id'];

		$this->db->query('INSERT INTO sementara(id_barang,no_penjualan,discount,jumlah,sub_total) values("'.$kode.'","'.$nop.'","'.$disc.'","'.$jumlah.'","'.$all.'")');
	}

	public function sementara(){
		$query = $this->db->query('SELECT s.id,b.kode as kode,no_penjualan as np,b.name as nama,b.harga as harga,s.discount as disc,s.jumlah as jumlah,s.sub_total as sub_total FROM sementara s LEFT JOIN barang b on b.id = s.id_barang')->result_array();
		$no = 1;
			foreach ($query as $key ){
				?>
					<tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $key['kode']; ?></td>
                      <td><?php echo $key['nama']; ?></td>
                      <td><?php echo number_format($key['harga']) ?></td>
                      <td><?php echo $key['disc']; ?></td>
                      <td><?php echo $key['jumlah']; ?></td>
                      <td><?php echo number_format($key['sub_total']) ?></td>
                      <td><a onclick="hapus('<?php echo $key['id'];?>')"><b>Delete</b></a></td>
                    </tr>

			     <?php
			}

	}

	public function hapus(){
		$url = $this->uri->segment(3);
		$where = array('id'=>$url);
		$this->db->where($where);
		$this->db->delete('sementara');

	}

	public function jmltot(){
		$query = $this->db->query('SELECT SUM(jumlah) as jumlah,SUM(sub_total) as total FROM sementara ')->result_array();
		$jumlah   = '';

		foreach ($query as $key) {
			$jumlah = $key['jumlah'];
			$total  = number_format($key['total']);
		}
		echo json_encode(array('jumlah'=>$jumlah,'total'=>$total));
	}

	public function bayar(){
		$plg         = $this->input->post('plg');
		$bayar       = $this->input->post('bayar');
		$kembali     = $this->input->post('kembali');
		$total       = $this->input->post('total');
		$nop         = $this->input->post('nop');
		$ket         = $this->input->post('ket');
		$tgl         = $this->input->post('tgl');
		$jumlah      = $this->input->post('jumlah');
		$supp        = $this->input->post('supp');

		$query = $this->db->query('SELECT id,id_barang,no_penjualan,discount,jumlah,sub_total FROM sementara')->result_array();
		$this->db->query('TRUNCATE TABLE sementara;');
		foreach ($query as $key) {
			$this->db->query('INSERT INTO transaksi(id_barang,no_penjualan,discount,jumlah,sub_total) 
				values("'.$key['id_barang'].'","'.$nop.'","'.$key['discount'].'","'.$key['jumlah'].'","'.$key['sub_total'].'")');
			
		}

		$this->db->query('INSERT INTO pembayaran(tgl_penjualan,id_pelanggan,id_supplier,no_penjualan,jumlah,total,uang_bayar,uang_kembali,keterangan) values("'.$tgl.'","'.$plg.'","'.$supp.'","'.$nop.'","'.$jumlah.'","'.$total.'","'.$bayar.'","'.$kembali.'","'.$ket.'")');
	}

	public function clear(){
		$this->db->query('TRUNCATE TABLE sementara');
	}
}