<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
        check_admin();
		$this->load->model('penjualan_m');
	}

    public function penjualan()
    {
        $this->load->library('pagination');
		
		if(isset($_POST['reset'])) {
            $this->session->unset_userdata('search');
        }
        if(isset($_POST['filter'])) {
            $post = $this->input->post(null, TRUE);
            $this->session->set_userdata('search', $post);
        } else {
            $post = $this->session->userdata('search');
        }

        $config['base_url'] = site_url('laporan/penjualan');
		$config['total_rows'] = $this->penjualan_m->get_penjualan_pagination()->num_rows();
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
 
        $this->pagination->initialize($config);
 
        $data['pagination'] = $this->pagination->create_links();
        $data['row'] = $this->penjualan_m->get_penjualan_pagination($config['per_page'], $this->uri->segment(3));
		$data['post'] = $post;
        $this->template->load('template', 'laporan/laporan_penjualan', $data);
    }

	public function penjualan_produk($penjualan_id = null)
	{
		$detail = $this->penjualan_m->get_penjualan_detail($penjualan_id)->result();
		echo json_encode($detail);
	}

}
