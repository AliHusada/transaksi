<?php 
defined("BASEPATH")or exit('NO DIRECT SCRIPT ALLOWED');

class pelanggan extends CI_Controller{

	public function index(){
		$db['title'] = "Pelanggan";
		echo  view('pelanggan',$db);
	}

	public function read(){
		$query = $this->db->query('SELECT * FROM pelanggan')->result_array();
		$no = 1;
		foreach ($query as $key) {
			?>
			<tr>
				<td>
					<div class="btn-group">	
						<button type="button" id="edit" 
						 data-toggle='modal' 
						 data-target='#form-edit'
						 data-id="<?php echo $key['id'] ?>"
						 data-kode="<?php echo $key['kode'] ?>"
						 data-nama="<?php echo $key['name'] ?>"
						 data-toko="<?php echo $key['shop'] ?>"
						 data-alamat="<?php echo $key['address'] ?>"
						 class="btn btn-warning"><i class="fa fa-edit"></i></button>
						<button onclick="hapus(<?php echo $key['id'] ?>)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>
				</td>
				<td><?php echo $no++ ?></td>
				<td><?php echo $key['kode'] ?></td>
				<td><?php echo $key['name'] ?></td>
				<td><?php echo $key['shop'] ?></td>
				<td><?php echo $key['address'] ?></td>
				
			</tr>
			<?php
		}

	}

	public function save(){
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$arr = array(
					'name'=>$this->input->post('nama'),
					'kode'=>$this->input->post('kode'),
					'shop'=>$this->input->post('toko'),
					'address'=>$this->input->post('alamat')
				);
		if ($uri3 == 'tambah') {	
			$this->db->insert('pelanggan',$arr);
			echo kode('pelanggan','P');
		}
		if ($uri3 == 'edit') {
			$this->db->where(array('id' => $uri4 ));
			$this->db->update('pelanggan',$arr);
		}
		if ($uri3 == 'hapus') {
			$this->db->where(array('id' => $uri4 ));
			$this->db->delete('pelanggan');	
		}

		
	}
 }