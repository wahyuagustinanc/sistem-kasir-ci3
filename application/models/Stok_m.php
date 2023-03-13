<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_m extends CI_Model {

    public function get($id = null) {
        $this->db->from('t_stok');
        if($id != null) {
            $this->db->where('stok_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id) {
        $this->db->where('stok_id', $id);
        $this->db->delete('t_stok');
    }

    public function get_stok_in()
    {
        $this->db->select('t_stok.stok_id, p_item.kodebarang,
        p_item.nama as item_nama, jumlah, tanggal, ditail,
        suplayer.nama as suplayer_nama, p_item.item_id');
        $this->db->from('t_stok');
        $this->db->join('p_item', 't_stok.item_id = p_item.item_id');
        $this->db->join('suplayer', 't_stok.suplayer_id = suplayer.suplayer_id', 'left');
        $this->db->where('tipe', 'in');
        $this->db->order_by('stok_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function add_stok_in($post) {
        $params = [
            'item_id' => $post['item_id'],
            'tipe' => 'in',
            'ditail' => $post['detail'],
            'suplayer_id' => $post['suplayer'] == '' ? null : $post['suplayer'],
            'jumlah' => $post['jumlah'],
            'tanggal' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid'),
        ];
        $this->db->insert('t_stok', $params);
    }

    public function add_stok_out($post) {
        $params = [
            'item_id' => $post['item_id'],
            'tipe' => 'out',
            'ditail' => $post['detail'],
            'suplayer_id' => $post['suplayer'] == '' ? null : $post['suplayer'],
            'jumlah' => $post['jumlah'],
            'tanggal' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid'),
        ];
        $this->db->insert('t_stok', $params);
    }

    public function get_stok_out()
    {
        $this->db->select('t_stok.stok_id, p_item.kodebarang,
        p_item.nama as item_nama, jumlah, tanggal, ditail, p_item.item_id');
        $this->db->from('t_stok');
        $this->db->join('p_item', 't_stok.item_id = p_item.item_id');
        $this->db->join('user', 't_stok.user_id = user.user_id');
        $this->db->where('tipe', 'out');
        $this->db->order_by('stok_id', 'desc');
        $query = $this->db->get();
        return $query;
    }
}