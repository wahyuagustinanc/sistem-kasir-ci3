<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_not_login();
        $this->load->model(['item_m', 'suplayer_m', 'stok_m']);
	}

    public function stok_in_data() {
        $data['row'] = $this->stok_m->get_stok_in()->result();
        $this->template->load('template', 'data_barang/stok_in/stok_in_data', $data);
    }

    public function stok_in_add(){
        $item = $this->item_m->get()->result();
        $suplayer = $this->suplayer_m->get()->result();
        $data = ['item' => $item, 'suplayer' => $suplayer];
        $this->template->load('template', 'data_barang/stok_in/stok_in_form', $data);
    }

    public function stok_in_del() {
        $stok_id = $this->uri->segment(4);
        $item_id = $this->uri->segment(5);
        $jumlah = $this->stok_m->get($stok_id)->row()->jumlah;
        $data = ['jumlah' => $jumlah, 'item_id' => $item_id];
        $this->item_m->update_stok_out($data);
        $this->stok_m->del($stok_id);
        if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('stok/in');
    }

    public function process(){
        if(isset($_POST['in_add'])) {
            $post = $this->input->post(null, TRUE);
            $this->stok_m->add_stok_in($post);
            $this->item_m->update_stok_in($post);
            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('stok/in');
        }

        if(isset($_POST['out_add'])) {
            $post = $this->input->post(null, TRUE);
            $this->stok_m->add_stok_out($post);
            $this->item_m->update_stok_out($post);
            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('stok/out');
        }
    }

    public function stok_out_data() {
        $data['row'] = $this->stok_m->get_stok_out()->result();
        $this->template->load('template', 'data_barang/stok_out/stok_out_data', $data);
    }

    public function stok_out_add() {
        $item = $this->item_m->get()->result();
        $data = ['item' => $item];
        $this->template->load('template', 'data_barang/stok_out/stok_out_form', $data);
    }

    public function stok_out_del() {
        $stok_id = $this->uri->segment(4);
        $item_id = $this->uri->segment(5);
        $jumlah = $this->stok_m->get($stok_id)->row()->jumlah;
        $data = ['jumlah' => $jumlah, 'item_id' => $item_id];
        $this->item_m->update_stok_in($data);
        $this->stok_m->del($stok_id);
        if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('stok/out');
    }
}