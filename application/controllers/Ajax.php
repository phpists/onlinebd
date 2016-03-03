<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function ajax_edit_user() {
		$user = $this->db->get_where('users', array('id' => $this->input->post('user_id')))->row();
		echo json_encode($user);
	}	

	public function ajax_edit_product() {
		$products = $this->db->get_where('products', array('id' => $this->input->post('id')))->row();
		echo json_encode($products);
	}

	public function ajax_get_progect_detail() {
		$id = $this->input->post('id');
		$progects = $this->db->get_where('progects', array('id' => $id))->row();
		echo '
		<div class="media">
			<a class="pull-left">
				<img class="media-object img-circle user_img" src="'.base_url().'application/views/front/img/user.png" alt=" ">
			</a>
			<div class="media-body">
				<h4 class="media-heading">'.$progects->nazva.'</h4><br>
				<p><strong>Дата создания:</strong> '.$progects->date_create.'</p>
				<p><strong>Сроки проведения:</strong> '.$progects->sroki.'</p>
				<p><strong>Описание:</strong><br>'.$progects->opus.'</p>
			</div>
		</div>';
	}

	public function ajax_get_progect_products() {
		$products = $this->db->get_where('products', array('progect_id' => $this->input->post('id')));
		$a=1;
		foreach ($products->result() as $row) { 
			echo '
			<tr>
				<td><center>'.$a++.'</center></td>
				<td>'.$row->nazva.'</td>
				<td><center>'.$row->artikl.'</center></td>
				<td><center>'.$row->edinica_izm.'</center></td>
				<td><center>'.$row->kilk.'</center></td>
				<td><center><input type="number" name="count['.$row->id.']" class="form-control" min="1" max="'.$row->kilk.'" value="1"></center></td>
				<td><center><input type="checkbox" name="product[]" value="'.$row->id.'" class="form-control sel_ch"></center></td>
			</tr>';
		}
	}

// заявки (type=0-расход  type=1-приход)
	function create_zayavka_rashod() {
		$product=$this->input->post('product');
		$count=$this->input->post('count');

		// print_r($product);
		// foreach ($product as $value) {
		// 	echo $value." - ".$count[$value]."\n";
		// }

		$nazva_progect = $this->db->get_where('progects', array('id' => $this->input->post('progect_id')))->row('nazva');
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'progect_id' => $this->input->post('progect_id'),
			'nazva_progect' => $nazva_progect,
			'date_otgruzki' => $this->input->post('date_otgruzki'),
			'fio' => $this->input->post('fio'),
			'tel' => $this->input->post('tel'),
			'nom_avto' => $this->input->post('nom_avto'),
			'comment' => $this->input->post('comment'),
			'date_create' => date("Y-m-d"),
			'status' => 1,
			'type' => 0
		);
		$this->db->insert('zayavki', $data);
		$return_id = $this->db->insert_id();

		$sql = "INSERT INTO zayavki_rashod (zayavka_id, product_id, cnt) VALUES ";
		$insertArray = array();
		foreach ($product as $value) {
			array_push($insertArray, "(".$return_id.", ".$value.", ".$count[$value].")");
		}
		$sql .= implode(", ", $insertArray);
		$this->db->query($sql);

		// віднімаємо остаток з products
		// foreach ($product as $value) {
		//  	$this->db->query("UPDATE products SET `kilk`=kilk-".$count[$value]." WHERE `id`=".$value);
		// }
	}

	public function do_rashod() {
		$zayavka_id = 2;
		$zayavki_rashod = $this->db->get_where('zayavki_rashod', array('zayavka_id' => $zayavka_id));
		foreach ($zayavki_rashod->result() as $row) {
			echo $row->cnt;
		}		

	}


	function update_zayavka() {
		$id=$this->input->post('id');
		$product=$this->input->post('product');
		$count=$this->input->post('count');

		//$nazva_progect = $this->db->get_where('progects', array('id' => $this->input->post('progect_id')))->row('nazva');
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			//'progect_id' => $this->input->post('progect_id'),
			//'nazva_progect' => $nazva_progect,
			'date_otgruzki' => $this->input->post('date_otgruzki'),
			'fio' => $this->input->post('fio'),
			'tel' => $this->input->post('tel'),
			'nom_avto' => $this->input->post('nom_avto'),
			'comment' => $this->input->post('comment'),
			//'date_create' => date("Y-m-d"),
			//'status' => $this->input->post('status'),
		);
		$this->db->where('id', $id);
		$this->db->update('zayavki', $data); 
	}






	function create_zayavka_prihod() {
		$product=$this->input->post('nazva');
		// існуючий проект
		if($this->input->post('radios') == 1) {
			$progect_id = $this->input->post('progect_id');
			$nazva_progect = $this->db->get_where('progects', array('id' => $progect_id))->row('nazva');
		}
		// новий проект
		if($this->input->post('radios') == 2) {
			$nazva_progect = $this->input->post('nazva_progect');
			$this->db->insert('progects', array(
				'user_id'=>$this->session->userdata('user_id'),
				'company_id'=>$this->session->userdata('user_company_id'),
				'nazva'=>$nazva_progect,
				'date_create'=>date("Y-m-d")));
			$progect_id = $this->db->insert_id();
		}

		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'progect_id' => $progect_id,
			'nazva_progect' => $nazva_progect,
			'date_otgruzki' => $this->input->post('date_otgruzki'),
			'fio' => $this->input->post('fio'),
			'tel' => $this->input->post('tel'),
			'nom_avto' => $this->input->post('nom_avto'),
			'comment' => $this->input->post('comment'),
			'date_create' => date("Y-m-d"),
			'status' => 1,
			'type' => 1
		);
		$this->db->insert('zayavki', $data);
		$return_z_id = $this->db->insert_id();

		// товар (zayavki_prihod)
		$artikl=$this->input->post('artikl');
		$edinica_izm=$this->input->post('edinica_izm');
		$kilk=$this->input->post('kilk');
		foreach ($product as $k=>$value) {
			$data = array(
				'zayavka_id' => $return_z_id,
				'nazva' => $value,
				'kilk' => $kilk[$k],
				'edinica_izm' => $edinica_izm[$k],
				'opus' => 'нет',
				'artikl' => $artikl[$k]
			);
			$this->db->insert('zayavki_prihod', $data);
			//$return_p_id = $this->db->insert_id();
		// товар zayavki_rashod
			//$this->db->insert('zayavki_rashod', array('zayavka_id'=>$return_z_id, 'product_id'=>$return_p_id, 'cnt'=>$kilk[$k]));
		}
	}

	public function do_prihod() {
		$zayavka_id = $this->input->post('id');
		$progect_id = $this->input->post('progect_id');
		$products = $this->db->get_where('zayavki_prihod', array('zayavka_id' => $zayavka_id));
		foreach ($products->result() as $row) {
			//echo $row->nazva;
			$this->db->insert('products', 
				array(
					//'zayavka_id'=>$return_z_id, 
					'progect_id'=>$progect_id, 
					'nazva'=>$row->nazva, 
					'kilk'=>$row->kilk, 
					'edinica_izm'=>$row->edinica_izm, 
					'opus'=>$row->opus, 
					'artikl'=>$row->artikl
				)
			);
		}
		$this->db->where('id', $zayavka_id)->update('zayavki', array('status' => 0)); 
	}	








	public function del_tmc($id) {
		$this->db->delete('zayavki_rashod', array('id' => $id));
	}	

	public function change_status_prihod() {
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('zayavki', array('status' => $this->input->post('status')));
	}










}
