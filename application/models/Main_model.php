<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function zayavki_prihod($zayavka_id) {
		$zayavki_prihod = $this->db->get_where('zayavki_prihod', array('zayavka_id' => $zayavka_id));
		$a=1;
		echo '
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Название</th>
							<th>Артикул</th>
							<th>Един. измер.</th>
							<th>Количество</th>
						</tr>
					</thead>
					<tbody>';
		foreach ($zayavki_prihod->result() as $row) {
			echo '
						<tr>
							<td>'.$a++.'</td>
							<td>'.$row->nazva.'</td>
							<td>'.$row->artikl.'</td>
							<td>'.$row->edinica_izm.'</td>
							<td>'.$row->kilk.'</td>
						</tr>';
		}
		echo '		</tbody>
				</table>';
	}


	public function zayavki_rashod($zayavka_id) {
		$this->db->select('zayavki_rashod.id, zayavki_rashod.product_id, zayavki_rashod.cnt, products.nazva, products.artikl, products.edinica_izm, products.kilk');		
		$this->db->join('products', 'zayavki_rashod.product_id = products.id', 'left');
		$this->db->where('zayavki_rashod.zayavka_id', $zayavka_id);
		$zayavki_rashod = $this->db->get('zayavki_rashod');
		$a=1;
		echo '
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Название</th>
							<th>Артикул</th>
							<th>Един. измер.</th>
							<th>Количество</th>
						</tr>
					</thead>
					<tbody>';
		foreach ($zayavki_rashod->result() as $row) {
			echo '
						<tr>
							<td>'.$a++.'</td>
							<td>'.$row->nazva.'</td>
							<td>'.$row->artikl.'</td>
							<td>'.$row->edinica_izm.'</td>
							<td>'.$row->cnt.'</td>
						</tr>';
		}
		echo '		</tbody>
				</table>';
	}


	// ф-ція виводить остаток даного ТМЦ по всім не закритим заявкам
	public function ostatok_tmc($product_id) {
		$header = $this->db->query('SELECT SUM(cnt) AS ostatok FROM zayavki_rashod 
			LEFT JOIN zayavki ON zayavki_rashod.zayavka_id = zayavki.id
			WHERE product_id = '.$product_id.' AND (zayavki.status = 1 OR zayavki.status = 2)');
		// $data['header'] = $header->row();
		return $header->row('ostatok');
	}


}

