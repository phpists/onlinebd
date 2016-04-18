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

	public function ajax_edit_usluga() {
		$uslugi = $this->db->get_where('uslugi', array('id' => $this->input->post('id')))->row();
		echo json_encode($uslugi);
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
		$this->load->model('Main_model');
		$products = $this->db->get_where('products', array('progect_id' => $this->input->post('id')));
		$a=1;
		foreach ($products->result() as $row) { 
			$ostatok_tmc = $this->Main_model->ostatok_tmc($row->id);
			echo '
			<tr>
				<td><center>'.$a++.'</center></td>
				<td>'.$row->nazva.'</td>
				<td><center>'.$row->artikl.'</center></td>
				<td><center>'.$row->edinica_izm.'</center></td>
				<td><center>'.$row->kilk.'</center></td>
				<td><center>'.$ostatok_tmc.'</center></td>
				<td><center><input type="number" name="count['.$row->id.']" class="form-control" min="0" max="'.($row->kilk - $ostatok_tmc).'" value="0"></center></td>
				<td><center>';
				if($row->kilk - $ostatok_tmc != 0) {
					echo '<input type="checkbox" name="product[]" value="'.$row->id.'" class="form-control sel_ch">';
				}
				echo '</center></td>
			</tr>';
			//<td><center><input type="number" name="count['.$row->id.']" class="form-control" min="1" max="'.(($this->ostatok_tmc($row->id)>0)?$this->ostatok_tmc($row->id):$row->kilk).'" value="1"></center></td>
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
		$zayavka_id = $this->input->post('id');
		$zayavki_rashod = $this->db->get_where('zayavki_rashod', array('zayavka_id' => $zayavka_id));
		foreach ($zayavki_rashod->result() as $row) {
			//echo $row->cnt;
			$this->db->query("UPDATE products SET kilk=kilk-".$row->cnt." WHERE id=".$row->product_id);
		}
		// апдейт статуса заявки
		$this->db->where('id', $zayavka_id)->update('zayavki', array('status' => 0)); 
	}

	function update_zayavka() {
		$id=$this->input->post('id');
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
		if($this->input->post('status') == 1) $data['status'] = 1;
		if($this->input->post('status') == 2) $data['status'] = 2;

		$this->db->where('id', $id);
		$this->db->update('zayavki', $data); 
	}



// створення заявки на приход
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

		$max_id = $this->db->select_max("id")->get("zayavki_prihod")->row("id");
		if(!$max_id) { $max_id=1; } else { $max_id++; }
		$artikl = $this->generate_nomer($progect_id, $max_id);

		// товар (zayavki_prihod)
		//$artikl=$this->input->post('artikl');
		$edinica_izm=$this->input->post('edinica_izm');
		$kilk=$this->input->post('kilk');
		$opus=$this->input->post('opus');
		$product_id = $this->input->post('id_tmc'); // hidden поле з автокомпліта id існуючого ТМЦ
		foreach ($product as $k=>$value) {
			$data_p = array(
				'zayavka_id' => $return_z_id,
				'nazva' => $value,
				'kilk' => $kilk[$k],
				'edinica_izm' => $edinica_izm[$k],
				'opus' => $opus[$k],
				'artikl' => $this->generate_nomer($progect_id, $max_id),
				'product_id' => $product_id[$k]
			);
			$this->db->insert('zayavki_prihod', $data_p);
			$max_id = $this->db->insert_id()+1;
		}
		//print_r($data_p);
	}

// прийняти приход
	public function do_prihod() {
		$zayavka_id = $this->input->post('id');
		$progect_id = $this->input->post('progect_id');
		$products = $this->db->get_where('zayavki_prihod', array('zayavka_id' => $zayavka_id));
		foreach ($products->result() as $row) {
			if($row->product_id == 0) {		// новий ТМЦ
				$this->db->insert('products', 
					array(
						'progect_id'=>$progect_id, 
						'nazva'=>$row->nazva, 
						'kilk'=>$row->kilk, 
						'edinica_izm'=>$row->edinica_izm, 
						'opus'=>$row->opus, 
						'artikl'=>$row->artikl
					)
				);
			} else {	// існуючий ТМЦ (апдейтимо тільки к-сть)
				//$this->db->where('id', $row->product_id);
				//$this->db->update('products', array('kilk'=>$row->kilk));
				$this->db->set('kilk', 'kilk+'.$row->kilk, FALSE);
				$this->db->where('id', $row->product_id);
				$this->db->update('products');
			}
		}
		// апдейт статуса заявки
		$this->db->where('id', $zayavka_id)->update('zayavki', array('status' => 0)); 
	}	




	public function del_tmc_rashod($id) {
		$this->db->delete('zayavki_rashod', array('id' => $id));
	}	

	public function del_tmc_prihod($id) {
		$this->db->delete('zayavki_prihod', array('id' => $id));
	}	

	public function upd_cnt_rashod() {
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('zayavki_rashod', array('cnt' => $this->input->post('cnt')));
	}	

	public function change_status_rashod() {
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('zayavki', array('status' => $this->input->post('status')));
	}
	
	public function change_status_prihod() {
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('zayavki', array('status' => $this->input->post('status')));
	}




	public function generate_nomer($id_progect, $id_products) {
		//$tpl = "00-000-000"; // № клиента-№ проекта-№ ТМЦ
		// $id_user = 4;
		// $id_progect = 7;
		// $id_products = 1345;
		$id_user = $this->session->userdata('user_id');
		//$id_progect = 7;
		//$id_products = 13456344967;

		if(strlen($id_user) == 1) $id_user = '0'.$id_user;
		if(strlen($id_progect) == 1) $id_progect = '00'.$id_progect;
		if(strlen($id_progect) == 2) $id_progect = '0'.$id_progect;
		if(strlen($id_products) == 1) $id_products = '00'.$id_products;
		if(strlen($id_products) == 2) $id_products = '0'.$id_products;
		if(strlen($id_products) >= 4) $id_products = substr($id_products, -4);

		$tpl = $id_user.'-'.$id_progect.'-'.$id_products;

		return $tpl;
	}





// услуги
	public function ajax_get_usluga_to_zayavka() {
		$zayavka_id = $this->input->post('zayavka_id');
		// $uslugi = $this->db->get_where('uslugi', array('zayavka_id' => $this->input->post('zayavka_id')));
		$this->db->select('uslugi.id, uslugi.nazva, uslugi.cena, (SELECT COUNT(*) FROM uslugi_zayavki WHERE usluga_id = uslugi.id AND uslugi_zayavki.zayavka_id = '.$zayavka_id.') AS cena2');		
		//$this->db->join('uslugi_zayavki', 'uslugi.id = uslugi_zayavki.usluga_id', 'left');
		//$this->db->where('zayavki_rashod.zayavka_id', $this->input->post('zayavka_id'));
		$uslugi = $this->db->get('uslugi');
		foreach ($uslugi->result() as $row) { 
			($row->cena2)?$checkbox='checked':$checkbox='';
			($row->cena2)?$style=' style="background-color: #d9534f;"':$style='';
			echo '
				<tr'.$style.'>
					<td>'.$row->nazva.'<input type="hidden" name="nazva['.$row->id.']" value="'.$row->nazva.'" /></td>
					<td><center><input type="number" name="cena['.$row->id.']" class="form-control" min="1" value="'.$row->cena.'"></center></td>
					<td><center><input type="checkbox" '.$checkbox.' name="availability['.$row->id.']" value="'.$row->id.'" class="form-control checked_usluga"></center></td>
				</tr>';
		}
		//$this->output->enable_profiler(TRUE);	// профайлер
	}

	public function add_usluga_to_zayavka() {
		$zayavka_id = $this->input->post('zayavka_id');
		$availability=$this->input->post('availability');
		$nazva=$this->input->post('nazva');
		$cena=$this->input->post('cena');
		$data_p = array();
		foreach ($availability as $value) {
			array_push($data_p, array(
				'zayavka_id' => $zayavka_id,
				'usluga_id' => $value,
				'nazva' => $nazva[$value],
				'cena' => $cena[$value],
			));
		}
		if($this->input->post('availability_custom')) {
			array_push($data_p, array(
				'zayavka_id' => $zayavka_id,
				'usluga_id' => '0',
				'nazva' => $this->input->post('nazva_custom'),
				'cena' =>  $this->input->post('cena_custom')
			));			
		}
		// echo '<pre>';
		// print_r($data_p);

		$this->db->delete('uslugi_zayavki', array('zayavka_id' => $zayavka_id));
		foreach ($data_p as $d_v) {
			$this->db->insert('uslugi_zayavki', $d_v);
		}

		/*
		$uslugi_zayavki = $this->db->get_where('uslugi_zayavki', array('zayavka_id' => $zayavka_id));
		if($uslugi_zayavki->result()) {
			//$this->db->where('id', $this->input->post('id'));
			//$this->db->update('progects', $data);	
		} else {
			foreach ($data_p as $d_v) {
				$this->db->insert('uslugi_zayavki', $d_v);
			}
		}		
		*/
		redirect(site_url("main/uslugi"));
		//$this->output->enable_profiler(TRUE);	// профайлер
	}


// автокомпліт на приход
	public function ajax_autocomplete_tmc() {
		$nazva = $this->input->get('term');
		// $this->db->select('id, nazva AS value, artikl AS label');
		$this->db->select('id, CONCAT(nazva," (",artikl,")") AS label, nazva AS value');
		if($nazva) { $this->db->like('nazva', $nazva); } // фільтр пошуку
		$this->db->from('products');
		$res = $this->db->order_by('id', 'DESC')->get();
		echo json_encode($res->result());
	}



}
