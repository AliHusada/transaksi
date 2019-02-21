<?php 
defined("BASEPATH")or exit('NO DIRECT SCRIPT ALLOWED');

class barang extends CI_Controller{


	public function index(){
		
		$db['title'] = "barang";
		echo  view('barang',$db);
	}

	public function read(){
		$query = $this->db->query('SELECT * FROM barang')->result_array();
		$no = 1;
		foreach ($query as $key) {
			?>
			<tr>
				<td>
					<div class="btn-group">	
						<button type="button" id="edit" 
						 data-toggle='modal' 
						 data-target='#update'
						 data-id="<?php echo $key['id'] ?>"
						 data-kode="<?php echo $key['kode'] ?>"
						 data-barcode="<?php echo $key['barcode'] ?>"
						 data-nama="<?php echo $key['name'] ?>"
						 data-satuan="<?php echo $key['satuan'] ?>"
						 data-jenis="<?php echo $key['jenis'] ?>"
						 data-stok="<?php echo $key['stok'] ?>"
						 data-harga="<?php echo $key['harga'] ?>"
						 class="btn btn-warning"><i class="fa fa-edit"></i></button>
						<button onclick="hapus(<?php echo $key['id'] ?>)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>
				</td>
				<td><?php echo $no++ ?></td>
				<td><?php echo $key['kode'] ?></td>
				<td><?php echo $key['barcode'] ?></td>
				<td><?php echo $key['name'] ?></td>
				<td><?php echo $key['satuan'] ?></td>
				<td><?php echo $key['jenis'] ?></td>
				<td><?php echo $key['stok'] ?></td>
				<td><?php echo number_format($key['harga'])  ?></td>
				
			</tr>
			<?php
		}	}

	public function save(){
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$arr = array(
					'kode'=>$this->input->post('kode'),
					'barcode'=>$this->input->post('barcode'),
					'name'=>$this->input->post('name'),
					'satuan'=>$this->input->post('satuan'),
					'jenis'=>$this->input->post('jenis'),
					'stok'=>$this->input->post('stok'),
					'harga'=>$this->input->post('harga')
				);
		if ($uri3 == 'tambah') {	
			$this->db->insert('barang',$arr);
			echo kode('barang','B');
		}
		if ($uri3 == 'edit') {
			 $this->db->where(array('id'=>$uri4));
			 $this->db->update('barang',$arr);
		}
		if ($uri3 == 'hapus') {
			$this->db->query('DELETE from barang where id = "'.$uri4.'"');		
		}

		
	}
	

}