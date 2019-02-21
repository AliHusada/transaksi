<?php 
defined("BASEPATH")or exit('NO DIRECT SCRIPT ALLOWED');

class supplier extends CI_Controller{

	public function index(){
		$db['title'] = "Supplier";
		echo  view('supplier',$db);
	}

	public function read(){
		$query = $this->db->query('SELECT * FROM supplier')->result_array();
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
						 data-nama="<?php echo $key['name'] ?>"
						 data-alamat="<?php echo $key['address'] ?>"
						 data-tlp="<?php echo $key['no_tlp'] ?>"
						 class="btn btn-warning"><i class="fa fa-edit"></i></button>
						<button onclick="hapus(<?php echo $key['id'] ?>)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>
				</td>
				<td><?php echo $no++ ?></td>
				<td><?php echo $key['kode'] ?></td>
				<td><?php echo $key['name'] ?></td>
				<td><?php echo $key['address'] ?></td>
				<td><?php echo $key['no_tlp'] ?></td>
				
			</tr>
			<?php
		}

	}

	public function save(){
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$arr = array(
					'kode'=>$this->input->post('kode'),
					'name'=>$this->input->post('nama'),
					'address'=>$this->input->post('alamat'),
					'no_tlp'=>$this->input->post('tlp')
				);
		if ($uri3 == 'tambah') {	
			$this->db->insert('supplier',$arr);
		}
		if ($uri3 == 'edit') {
			$this->db->where(array('id'=>$uri4));
			$this->db->update('supplier',$arr);
		}
		if ($uri3 == 'hapus') {
			$this->db->where(array('id'=>$uri4));
			$this->db->delete('supplier');	
		}

		
	}
 }