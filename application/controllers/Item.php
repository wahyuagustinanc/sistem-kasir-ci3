<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['item_m', 'kategori_m', 'unit_m']);
	}

	function get_ajax() {
        $list = $this->item_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
			// $row[] = $item->barcode;
            $row[] = $item->kodebarang;
            $row[] = $item->nama;
            $row[] = $item->kategori_nama;
            $row[] = $item->unit_nama;
            $row[] = indo_currency($item->harga);
            $row[] = $item->stok;
            $row[] = '<a href="'.site_url('item/edit/'.$item->item_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="'.site_url('item/del/'.$item->item_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->item_m->count_all(),
                    "recordsFiltered" => $this->item_m->count_filtered(),
                    "data" => $data,
                );
        echo json_encode($output);
    }

	public function index()
	{
		$data['row'] = $this->item_m->get();
		$this->template->load('template', 'produk/item/item_data', $data);
	}

	public function edit($id)
	{
		$query = $this->item_m->get($id);
		if($query->num_rows() > 0) {
			$item = $query->row();
			$kategori = $this->kategori_m->get();
            $unit = $this->unit_m->get();

			$data = array(
				'page' => 'edit',
				'row' => $item,
				'kategori' => $kategori,
				'unit' => $unit,
			);
			$this->template->load('template','produk/item/item_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('user')."';</script>";
		}
	}

	public function add()
	{
		$item = new stdClass();
		// $item->barcode = null;
		$item->item_id = null;
        $item->kodebarang = null;
		$item->nama = null;
		$item->kategori_id = null;
		$item->unit_id = null;
		$item->harga = null;

        $kategori = $this->kategori_m->get();
        $unit = $this->unit_m->get();

		$data = array(
			'page' => 'add',
			'row' => $item,
            'kategori' => $kategori,
            'unit' => $unit,
		);
		$this->template->load('template','produk/item/item_form', $data);
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			if($this->item_m->check_kodebarang($post['kodebarang'])->num_rows() > 0) {
				$this->session->set_flashdata('error', "Kode barang $post[kodebarang] sudah dipakai");
				redirect('item/add');
			} else {
				$this->item_m->add($post);
			}
		} else if(isset($_POST['edit'])) {
			if($this->item_m->check_kodebarang($post['kodebarang'], $post['id'])->num_rows() > 0) {
				$this->session->set_flashdata('error', "Kode barang $post[kodebarang] sudah dipakai");
				redirect('item/edit/'.$post['id']);
			} else {
				$this->item_m->edit($post);
			}
		}
		if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('item');
	}

	public function del($id)
	{
		$this->item_m->del($id);
		if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('item');
	}


	// function barcode_qrcode($id){
	// 	$data['row'] = $this->item_m->get($id)->row;
	// 	$this->template->load('template', 'produk/item/barcode_qrcode', $data);
	// }


}
