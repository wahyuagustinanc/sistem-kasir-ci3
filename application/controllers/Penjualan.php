<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['penjualan_m','item_m']);
	}

	public function index()
	{
		$item = $this->item_m->get()->result();
		$jual = $this->penjualan_m->get_jual();
		$data = array(
			'item' => $item,
			'jual' => $jual,
			'invoice' => $this->penjualan_m->invoice_no()
		);
		$this->template->load('template', 'penjualan/penjualan_form', $data);
	}

    public function process() 
	{
		$data = $this->input->post(null, TRUE);

		if(isset($_POST['add_jual'])) {
			$item_id = $this->input->post('item_id');
			$cek_jual = $this->penjualan_m->get_jual(['t_jual.item_id' => $item_id])->num_rows();
			if($cek_jual > 0) {
				$this->penjualan_m->update_jual_jumlah($data);
			} else {
				$this->penjualan_m->add_jual($data);
			}
			
			if($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}

		if(isset($_POST['ubah_jual'])) {
			$this->penjualan_m->edit_jual($data);
			if($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}

		if(isset($_POST['proses_jual'])) {
			$jual_id = $this->penjualan_m->tambah_jual($data);
			$jual = $this->penjualan_m->get_jual()->result();
			$row = [];
			foreach($jual as $c => $value) {
				array_push($row, array(
					    'jual_id' => $jual_id,
						'item_id' => $value->item_id,
						'harga' => $value->harga,
						'jumlah' => $value->jumlah_bar,
						'potongan_item' => $value->potongan_item,
						'total' => $value->total,
				    )
				);
			}
			$this->penjualan_m->tambah_detail_jual($row);
			$this->penjualan_m->hapus_jual(['user_id' => $this->session->userdata('userid')]);

			if($this->db->affected_rows() > 0) {
				$params = array("success" => true, "jual_id" => $jual_id);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}

	}

	function jual_data() {
		$jual = $this->penjualan_m->get_jual();
		$data['jual'] = $jual;
		$this->load->view('penjualan/jual_data', $data);
	}

	public function jual_hps()
	{
		if(isset($_POST['cancel_payment'])) {
			$this->penjualan_m->hapus_jual(['user_id' => $this->session->userdata('userid')]);
		} else {
			$jual_id = $this->input->post('jual_id');
		    $this->penjualan_m->hapus_jual(['jual_id' => $jual_id]);
		}

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
		} else {
			$params = array("success" => false);
		}
		echo json_encode($params);
	}

	public function cetak($id) {
		$data = array(
			'penjualan' => $this->penjualan_m->get_penjualan($id)->row(),
			'penjualan_detail' => $this->penjualan_m->get_penjualan_detail($id)->result(),
		);
		$this->load->view('penjualan/nota_penjualan', $data);
	}

	public function hapus($id)
	{
		$this->penjualan_m->hapus_penjualan($id);
		if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('laporan/penjualan');
	}
}
