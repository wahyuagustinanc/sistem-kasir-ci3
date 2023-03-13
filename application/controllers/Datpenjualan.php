<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Datpenjualan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('penjualan_m');
	}

	public function index()
	{
		$data['row'] = $this->penjualan_m->get_penjualan();
		$this->template->load('template', 'laporan/datpenjualan', $data);
	}

	public function cetak($id) {
		$data = array(
			'penjualan' => $this->penjualan_m->get_penjualan($id)->row(),
			'penjualan_detail' => $this->penjualan_m->get_penjualan_detail($id)->result(),
		);
		$this->load->view('penjualan/nota_penjualan', $data);
	}
}