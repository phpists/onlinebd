<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

   function _remap($method, $params = array()) {
        $password=$this->input->post('password');
        $pars = $this->uri->segment_array(); // $pars[1]-контроллер; $pars[2]-метод; $pars[3]-параметри
		
        if($method=="exit") {
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('user_name');
            $this->session->unset_userdata('user_role');
            $this->session->unset_userdata('user_company_id');
            $this->login('Ви вышли !');
        } else {
            if($this->session->userdata('user_id'))  {
				//if(count(@$pars) == 1 ) { $this->index();  } else { $this->$pars[2](@$pars[3]); }
				return call_user_func_array(array($this, $method), $params);
            } else {
                if(!empty($password)) {
					$password = ($this->input->post('password'))?trim($this->input->post('password')):"";
					$login_in = $this->db->get_where('users', array('email' => trim($this->input->post('login')), 'pass' => $password, 'active' => 1));
					if($login_in->result()) {
						$this->session->set_userdata('user_id', $login_in->row('id'));
						$this->session->set_userdata('user_name', $login_in->row('name'));
						$this->session->set_userdata('user_role', $login_in->row('role'));
						$this->session->set_userdata('user_company_id', $login_in->row('company_id'));
						$this->index();
					} else { 
						$this->load->view('login', array("message"=>"Логин или пароль не совпадают !"));	
					}
                } else {
                    $this->login('');
                }
            }
        }
    }

	public function login($message) {
		$data['message'] = $message;
		$this->load->view('login', $data);
	}		


// проекты
	public function index() {
		if($this->session->userdata('user_role') == "1") {
			$this->db->select('progects.id, progects.nazva, progects.date_create, progects.sroki, (SELECT COUNT(*) FROM `products` WHERE progect_id = progects.id) AS cnt, companies.nazva AS company');		
			$this->db->join('companies', 'progects.company_id = companies.id', 'left');
			$this->db->from('progects');
		}
		if($this->session->userdata('user_role') == "2") {
			$this->db->select('progects.id, progects.nazva, progects.date_create, progects.sroki, (SELECT COUNT(*) FROM `products` WHERE progect_id = progects.id) AS cnt, companies.nazva AS company');		
			$this->db->join('companies', 'progects.company_id = companies.id', 'left');
			$this->db->from('progects');	
			$this->db->where('company_id', $this->session->userdata('user_company_id'));
		}

		$data['main'] = $this->db->get();
		$this->load->view('index', $data);
		//$this->output->enable_profiler(TRUE);	// профайлер
	}

	public function add_progect() {
		$data['companies'] = $this->db->get('companies');	
		$this->load->view('add_edit_progect', $data);		
	}

	public function edit_progect($id) {
		$data['companies'] = $this->db->get('companies');
		$data['main'] = $this->db->get_where('progects', array('id' => $id))->row();
		$this->load->view('add_edit_progect', $data);
	}	

	public function add_edit_progect() {
		if($this->session->userdata('user_role')=="1") $company_id=$this->input->post('company_id');
		if($this->session->userdata('user_role')=="2") $company_id=$this->session->userdata('user_company_id');
		$data['user_id'] = $this->session->userdata('user_id');
		$data['company_id'] = $company_id;
		$data['nazva'] = $this->input->post('nazva');
		$data['sroki'] = $this->input->post('sroki');
		$data['opus'] = $this->input->post('opus');
		if($this->input->post('id')) {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('progects', $data);	
		} else {
			$data['date_create'] = date("Y-m-d"); //$this->input->post('date_create');
			$this->db->insert('progects', $data);
		}
		redirect(site_url("main/index"));
		// $this->output->enable_profiler(TRUE);	// профайлер
	}

// контрагенты (компании)
	public function companies() {
		$data['main'] = $this->db->get('companies');	
		$this->load->view('companies', $data);
	}	

	public function add_company() {
		$data['title'] = "Новая компания";
		$data['users'] = $this->db->get('users');	
		$this->load->view('add_edit_company', $data);
	}

	public function edit_company($id) {
		if($this->session->userdata('user_role')==2) { 
			if($this->session->userdata('user_company_id')!=$id) { redirect(site_url()); }
		}
		$data['title'] = "Изменить данные компании";
		$data['users'] = $this->db->get('users');	
		$data['main'] = $this->db->get_where('companies', array('id' => $id))->row();
		$this->load->view('add_edit_company', $data);
	}

	public function add_edit_company() {
		$data['nazva'] = $this->input->post('nazva');
		$data['contragent'] = $this->input->post('contragent');
		$data['status'] = $this->input->post('status');
		$data['inn'] = $this->input->post('inn');
		$data['kpp'] = $this->input->post('kpp');
		$data['ogrn'] = $this->input->post('ogrn');
		$data['date_c'] = $this->input->post('date_c');
		$data['ur_adress'] = $this->input->post('ur_adress');
		$data['fac_adress'] = $this->input->post('fac_adress');
		$data['nomer_dogovora'] = $this->input->post('nomer_dogovora');
		$data['contact_lico'] = $this->input->post('contact_lico');
		$data['tel'] = $this->input->post('tel');
		$data['bic'] = $this->input->post('bic');
		$data['rs'] = $this->input->post('rs');
		$data['primechanie'] = $this->input->post('primechanie');
		$data['bank'] = $this->input->post('bank');
		$data['ks'] = $this->input->post('ks');
		$data['gen_dir'] = $this->input->post('gen_dir');
		if($this->input->post('id')) {
			//$data['status'] = $this->input->post('status');
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('companies', $data);	
		} else {
			$this->db->insert('companies', $data);
		}
		redirect(site_url("main/companies"));
	}		

// товары
	public function products($progects_id) {
		//$data['progects'] = $this->db->get_where('products');	
		$data['progects'] = $this->db->get_where('progects', array('id' => $progects_id))->row();		
		$data['main'] = $this->db->get_where('products', array('progect_id' => $progects_id));
		$data['progects_id'] = $progects_id;
		$data['zayavok'] = $this->db->get_where('zayavki', array('progect_id' => $progects_id));
		$this->load->view('products', $data);
	}

	public function add_product() {
		$data = array(
			'progect_id' => $this->input->post('progect_id'),
			//'company_id' => $this->input->post('company_id'),	
			'nazva' => $this->input->post('nazva'),	
			'kilk' => $this->input->post('kilk'),
			'edinica_izm' => $this->input->post('edinica_izm'),
			'opus' => $this->input->post('opus'),
			'artikl' => $this->input->post('artikl'),
		);
		$this->db->insert('products', $data);
		redirect(site_url("main/products/".$this->input->post('progect_id')));
	}

	public function edit_product() {
		$data = array(
			//'progect_id' => $this->input->post('progect_id'),
			//'company_id' => $this->input->post('company_id'),	
			'nazva' => $this->input->post('nazva'),	
			'kilk' => $this->input->post('kilk'),
			'edinica_izm' => $this->input->post('edinica_izm'),
			'opus' => $this->input->post('opus'),
			'artikl' => $this->input->post('artikl'),
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('products', $data);	
		redirect(site_url("main/products/".$this->input->post('progect_id')));
	}

	public function del_product($id) {
		$progect_id = $this->db->get_where('products', array('id' => $id))->row("progect_id");	
		$this->db->delete('products', array('id' => $id));
		redirect(site_url("main/products/".$progect_id));
	}

// заявки проекта
	public function progect_zayavki($progects_id) {
		$data['progects'] = $this->db->get_where('progects', array('id' => $progects_id))->row();		
		$data['zayavki'] = $this->db->get_where('zayavki', array('progect_id' => $progects_id));
		$this->load->model('Main_model');
		// $this->Main_model->zayavki_prihod(1);
		$this->load->view('progect_zayavki', $data);
	}

// пользователи
	public function users() {
		if($this->session->userdata('user_role')==2) { redirect(site_url()); }
		$this->db->select('users.id, users.name, users.email, users.active,  users.tel, users.role, companies.id AS c_id, companies.nazva');		
		$this->db->join('companies', 'users.company_id = companies.id', 'left');
		$data['main'] = $this->db->get('users');
		$data['companies'] = $this->db->get_where('companies');
		$this->load->view('users', $data);
	}

	public function add_edit_user() {
		$data = array(
			'name' => $this->input->post('name'),	
			//'login' => $this->input->post('login'),
			'pass' => $this->input->post('pass'),
			'tel' => $this->input->post('tel'),
			'email' => $this->input->post('email'),
			'role' => $this->input->post('role'),
			'company_id' => $this->input->post('company_id'),
			'active' => 1
		);
		if($this->input->post('user_id')) {
			if($this->input->post('role')==1) $data['company_id'] = '';
			$this->db->where('id', $this->input->post('user_id'));
			$this->db->update('users', $data);	
		} else {
			$this->db->insert('users', $data);
		}
		redirect(site_url("main/users"));
	}

	public function del_user($id) {
		if($id!=1) {
			$this->db->delete('users', array('id' => $id));
		}
		redirect(site_url("main/users"));
	}	

	public function deactevate_user($id) {
		if($id != 1) {
			$active = $this->db->get_where('users', array('id' => $id))->row("active");
			if($active == 1) {
				$data = array('active' => 0);
			} else {
				$data = array('active' => 1);
			}
			$this->db->where('id', $id);
			$this->db->update('users', $data); 
		}
		redirect(site_url("main/users"));
	}

// заявки (type=0-расход  type=1-приход)
	public function zayavki() {
		$data['rashod'] = $this->db->get_where('zayavki', array('type' => 0));	
		$data['prihod'] = $this->db->get_where('zayavki', array('type' => 1));	
		$this->load->view('zayavki', $data);
	}	
		
	public function zayavka($id) {
		$data['main'] = $zayavka = $this->db->get_where('zayavki', array('id' => $id))->row();
		if($zayavka->type == 0) {	// расход
			$data['title'] = "Изменить заявку на расход №".$id;
			$this->db->select('zayavki_rashod.id, zayavki_rashod.product_id, zayavki_rashod.cnt, products.nazva, products.artikl, products.edinica_izm, products.kilk');		
			$this->db->join('products', 'zayavki_rashod.product_id = products.id', 'left');
			$this->db->where('zayavki_rashod.zayavka_id', $id);
			$data['products'] = $this->db->get('zayavki_rashod');
			$this->load->view('edit_zayavka_rashod', $data);
		}
		if($zayavka->type == 1) {	// приход
			$data['title'] = "Изменить заявку на приход №".$id;
			$this->db->select('zayavki_prihod.id, zayavki_prihod.nazva, zayavki_prihod.kilk, zayavki_prihod.edinica_izm, zayavki_prihod.artikl');		
			$this->db->where('zayavki_prihod.zayavka_id', $id);
			$data['products'] = $this->db->get('zayavki_prihod');
			$this->load->view('edit_zayavka_prihod', $data);
		}
		//$this->output->enable_profiler(TRUE);	// профайлер
	}

	public function add_zayavka() {
		$data['title'] = "Новая заявка на отгрузку";
		$this->db->select('id, nazva');
		if($this->session->userdata('user_role')==2) { 
			$this->db->where('progects.company_id', $this->session->userdata('user_company_id'));
			//$this->db->where('progects.user_id', $id); // можна по юзеру звязати
		}
		$data['progects'] = $this->db->get('progects');
		$this->load->view('add_zayavka', $data);
	}
	
	public function add_zayavka_prihod() {
		$data['title'] = "Новая заявка на приход";
		$this->db->select('id, nazva');
		if($this->session->userdata('user_role')==2) { 
			$this->db->where('progects.company_id', $this->session->userdata('user_company_id'));
			//$this->db->where('progects.user_id', $id); // можна по юзеру звязати
		}
		$data['progects'] = $this->db->get('progects');
		$this->load->view('add_zayavka_prihod', $data);
	}



	public function generate_nomer() {
		$tpl = "00/000/000"; // № клиента/№ проекта/№ ТМЦ

		$id_user = 4;
		$id_progect = 7;
		$id_products = 13456344967;

		if(strlen($id_user) == 1) $id_user = '0'.$id_user;
		if(strlen($id_progect) == 1) $id_progect = '00'.$id_progect;
		if(strlen($id_progect) == 2) $id_progect = '0'.$id_progect;
		if(strlen($id_products) == 1) $id_products = '00'.$id_products;
		if(strlen($id_products) == 2) $id_products = '0'.$id_products;
		if(strlen($id_products) >= 4) $id_products = substr($id_products, -4);

		$tpl = $id_user.'-'.$id_progect.'-'.$id_products;

		echo $tpl;
	}





/*	public function test() {
		if($this->input->post('nazva')) {
			$nazva=$this->input->post('nazva');
			$artikl=$this->input->post('artikl');
			print_r($artikl);
			foreach ($nazva as $k=>$value) {
				echo $value.' - '.$artikl[$k]."<br>";
			}

		}
		$this->output->enable_profiler(TRUE);	// профайлер
	}*/

}
