<?php 
defined('BASEPATH')or exit('NO DIRECT SCRIPT ALLOWED');

class nota extends CI_Controller{

	public function index(){
		if (isset($_GET['noNota']) != '') {
			$nop = $_GET['noNota'];
			$db['query'] = $this->db->query("SELECT t.no_penjualan,t.tgl_penjualan,b.name as barang,b.harga,t.discount,t.jumlah,t.sub_total as st FROM transaksi t LEFT JOIN barang b on b.id = t.id_barang where t.no_penjualan = '".$nop."' ")->result_array();
			$db['total'] = $this->db->query('SELECT sum(sub_total) as total from transaksi where no_penjualan = "'.$nop.'" ')->row_array();
			$db['bayar'] = $this->db->query('SELECT uang_bayar as bayar from pembayaran where 
				no_penjualan = "'.$nop.'" ')->row_array();
			$db['kembali'] = $this->db->query('SELECT uang_kembali as kembali from pembayaran where 
				no_penjualan = "'.$nop.'" ')->row_array();
			$this->load->view('nota/index',$db);
		}
		
	}
}