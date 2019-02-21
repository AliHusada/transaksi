<?php 
defined("BASEPATH")or exit('NO DIRECT SCRIPT ALLOWED');

class transaksi_pembelian extends CI_Controller{

	public function index()
	{
		$db['title'] = 'Transaksi';
		echo view('transaksi_pembelian',$db);
	}

	public function read(){
		$transaksi  = $this->db->query('SELECT p.tgl_penjualan as tgl,s.NAME as nama,p.no_penjualan as nop,p.total as total,p.jumlah as jumlah FROM pembayaran p LEFT JOIN supplier s ON s.id = p.id_supplier where p.no_penjualan like "%PB%" ')->result_array();
		$no = 1;
			foreach ($transaksi as $key ){
				?>
					<tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $key['tgl']; ?></td>
                      <td><?php echo $key['nama']; ?></td>
                      <td><?php echo $key['nop']; ?></td>
                      <td><?php echo number_format($key['total']) ?></td>
                      <td><?php echo $key['jumlah']; ?></td>
                      <td><a href="<?php echo site_url('transaksi_penjualan/show_barang?np=').$key['nop'] ?>">Rincian Barang</a></td>
                    </tr>

			     <?php
			}

                    
	}

	public function show_barang(){
		$np = $_GET['np'];
		$db['query'] = $this->db->query('SELECT b.kode,b.NAME as nama,b.harga,p.discount as disc,p.jumlah,p.sub_total FROM  transaksi p LEFT JOIN barang b on b.id = p.id_barang WHERE p.no_penjualan  = "'.$np.'" ')->result_array();
		$db['query2']= $this->db->query('SELECT p.tgl_penjualan,pl.name,p.no_penjualan,p.keterangan,p.jumlah,p.total,p.uang_bayar,p.uang_kembali from pembayaran p LEFT JOIN pelanggan pl on pl.id = p.id_pelanggan where no_penjualan  = "'.$np.'" ')->row_array();
		$db['title'] = 'Lihat Barang';
		echo view2('show_barang',$db);
	}
}