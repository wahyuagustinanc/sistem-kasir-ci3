<?php

Class Fungsi {
    protected $ci;

    function __construct() {
        $this->ci =& get_instance();
    }
    function user_login() {
        $this->ci->load->model('user_m');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_m->get($user_id)->row();
        return $user_data;
    }

    public function count_item() {
        $this->ci->load->model('item_m');
        return $this->ci->item_m->get()->num_rows();
    }

    public function count_pemasok() {
        $this->ci->load->model('suplayer_m');
        return $this->ci->suplayer_m->get()->num_rows();
    }

    public function count_user() {
        $this->ci->load->model('user_m');
        return $this->ci->user_m->get()->num_rows();
    }

    public function count_penjualan() {
        $this->ci->load->model('penjualan_m');
        return $this->ci->penjualan_m->get_penjualan()->num_rows();
    }
}