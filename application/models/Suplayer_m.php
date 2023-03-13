<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Suplayer_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('suplayer');
        if($id != null) {
            $this->db->where('suplayer_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama' => $post['suplayer_nama'],
            'phone' => $post['phone'],
            'alamat' => $post['alamat'],
            'keterangan' => empty($post['keterangan']) ? null : $post['keterangan'],
        ];
        $this->db->insert('suplayer', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama' => $post['suplayer_nama'],
            'phone' => $post['phone'],
            'alamat' => $post['alamat'],
            'keterangan' => empty($post['keterangan']) ? null : $post['keterangan'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('suplayer_id', $post['id']);
        $this->db->update('suplayer', $params);
    }

    public function del($id)
    {
        $this->db->where('suplayer_id', $id);
        $this->db->delete('suplayer');
    }
}