<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		check_not_login();

		$query = $this->db->query("SELECT t_detailpenjualan.item_id, p_item.nama, (SELECT SUM(t_detailpenjualan.jumlah)) AS terjual
		FROM t_detailpenjualan
			INNER JOIN t_penjualan ON t_detailpenjualan.jual_id = t_penjualan.penjualan_id
			INNER JOIN p_item ON t_detailpenjualan.item_id = p_item.item_id
			WHERE MID(t_penjualan.tanggal, 6, 2) = DATE_FORMAT(CURDATE(), '%m')
		GROUP BY t_detailpenjualan.item_id
		ORDER BY terjual DESC
		LIMIT 10");

		$data['row'] = $query->result();

		$this->template->load('template', 'dashboard', $data);
	}
}
