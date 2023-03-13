<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Suplayer extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('suplayer_m');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['row'] = $this->suplayer_m->get();
		$this->template->load('template', 'suplayer/suplayer_data', $data);
	}

	public function edit($id)
	{
		$query = $this->suplayer_m->get($id);
		if($query->num_rows() > 0) {
			$suplayer = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $suplayer
			);
			$this->template->load('template', 'suplayer/suplayer_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('user')."';</script>";
		}
	}

	public function add()
	{
		$suplayer = new stdClass();
		$suplayer->suplayer_id = null;
		$suplayer->nama = null;
		$suplayer->phone = null;
		$suplayer->alamat = null;
		$suplayer->keterangan = null;
		$data = array(
			'page' => 'add',
			'row' => $suplayer
		);
		$this->template->load('template','suplayer/suplayer_form', $data);
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			$this->suplayer_m->add($post);
		} else if(isset($_POST['edit'])) {
			$this->suplayer_m->edit($post);
		}
		if($this->db->affected_rows() > 0) {
			echo "<script>alert('Data berhasil disimpan');</script>";
		}
		echo "<script>window.location='".site_url('suplayer')."';</script>";
	}

	public function del($id)
	{
		$this->suplayer_m->del($id);
		$error = $this->db->error();
		if($error['code'] != 0){
			echo "<script>alert('Data tidak bisa dihapus (Karena data sudah dipakai)');</script>";
		} else {
            echo "<script>alert('Data berhasil dihapus');</script>";
        }
        echo "<script>window.location='".site_url('suplayer')."';</script>";
	}

}
