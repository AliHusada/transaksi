<?php 
defined("BASEPATH") or exit('NO DIRECT SCRIPT ALLOWED');
 
 class cari_barang extends CI_Controller{

 	public function index(){

 		$db['title'] = 'Cari Barang';
 		$db['barang']  = $this->db->get('barang')->result_array();
 		echo view2('cari_barang',$db);
 	}

 	public function barkode(){
    		 $this->session->unset_userdata('barkode');
 		     $barkode = $this->input->post('data');
	 		 $sess = array(
						'barkode' => $barkode
					);
			$this->session->set_userdata($sess);

 
 	}
 }