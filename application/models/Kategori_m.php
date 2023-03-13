<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('p_kategori');
        if($id != null) {
            $this->db->where('kategori_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama' => $post['kategori_nama'],
        ];
        $this->db->insert('p_kategori', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama' => $post['kategori_nama'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('kategori_id', $post['id']);
        $this->db->update('p_kategori', $params);
    }

    public function del($id)
    {
        $this->db->where('kategori_id', $id);
        $this->db->delete('p_kategori');
    }
}