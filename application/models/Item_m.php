<?php defined('BASEPATH') OR exit('No direct script access allowed');

class item_m extends CI_Model {

    var $column_order = array(null, 'kodebarang', 'p_item.nama', 'kategori_nama', 'unit_nama', 'harga', 'stok');
    var $column_search = array('kodebarang', 'p_item.nama', 'harga');
    var $order = array('item_id' => 'asc');

    private function _get_datatables_query() {
        $this->db->select('p_item.*, p_kategori.nama as kategori_nama, p_unit.nama as unit_nama');
        $this->db->from('p_item');
        $this->db->join('p_kategori', 'p_item.kategori_id = p_kategori.kategori_id');
        $this->db->join('p_unit', 'p_item.unit_id = p_unit.unit_id');
        $i = 0;
        foreach ($this->column_search as $item) { 
            if(@$_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        
        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('p_item');
        return $this->db->count_all_results();
    }

    public function get($id = null)
    {
        $this->db->select('p_item.*, p_kategori.nama as kategori_nama, p_unit.nama as unit_nama');
        $this->db->from('p_item');
        $this->db->join('p_kategori', 'p_kategori.kategori_id = p_item.kategori_id');
        $this->db->join('p_unit', 'p_unit.unit_id = p_item.unit_id');
        if($id != null) {
            $this->db->where('item_id', $id);
        }
        $this->db->order_by('kodebarang', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            // 'barcode' => $post['barcode'],
            'kodebarang' => $post['kodebarang'],
            'nama' => $post['nama_barang'],
            'kategori_id' => $post['kategori'],
            'unit_id' => $post['unit'],
            'harga' => $post['harga'],
        ];
        $this->db->insert('p_item', $params);
    }

    public function edit($post)
    {
        $params = [
            // 'barcode' => $post['barcode'],
            'kodebarang' => $post['kodebarang'],
            'nama' => $post['nama_barang'],
            'kategori_id' => $post['kategori'],
            'unit_id' => $post['unit'],
            'harga' => $post['harga'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('item_id', $post['id']);
        $this->db->update('p_item', $params);
    }

    function check_kodebarang($code, $id = null) {
        $this->db->from('p_item');
        $this->db->where('kodebarang', $code);
        if($id != null) {
            $this->db->where('item_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    // function check_barcode($code, $id = null) {
    //     $this->db->from('p_item');
    //     $this->db->where('barcode', $code);
    //     if($id != null) {
    //         $this->db->where('item_id !=', $id);
    //     }
    //     $query = $this->db->get();
    //     return $query;
    // }

    public function del($id)
    {
        $this->db->where('item_id', $id);
        $this->db->delete('p_item');
    }

    function update_stok_in($data)
    {
        $jumlah = $data['jumlah'];
        $id = $data['item_id'];
        $sql = "UPDATE p_item SET stok = stok + '$jumlah' WHERE item_id = '$id'";
        $this->db->query($sql);
    }

    function update_stok_out($data)
    {
        $jumlah = $data['jumlah'];
        $id = $data['item_id'];
        $sql = "UPDATE p_item SET stok = stok - '$jumlah' WHERE item_id = '$id'";
        $this->db->query($sql);
    }
}