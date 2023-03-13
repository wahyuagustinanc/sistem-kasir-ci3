<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_m extends CI_Model {

    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no
                FROM t_penjualan
                WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "AJ".date('ymd').$no;
        return $invoice;
    }

    public function get_jual($params = null)
    {
        $this->db->select('*, p_item.nama as item_nama, t_jual.harga as jual_harga');
        $this->db->from('t_jual');
        $this->db->join('p_item', 't_jual.item_id = p_item.item_id');
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_jual($post)
    {
        $query = $this->db->query("SELECT MAX(jual_id) AS jual_no FROM t_jual");
        if($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->jual_no) + 1;
        } else {
            $car_no = "1";
        }

        $params = array(
            'jual_id' => $car_no,
            'item_id' => $post['item_id'],
            'harga' => $post['harga'],
            'jumlah_bar' => $post['jumlah_bar'],
            'total' => ($post['harga'] * $post['jumlah_bar']),
            'user_id' => $this->session->userdata('userid')
        );
        $this->db->insert('t_jual', $params);
    }

    function update_jual_jumlah($post) {
        $sql = "UPDATE t_jual SET harga = '$post[harga]',
               jumlah_bar = jumlah_bar + '$post[jumlah_bar]',
               total = '$post[harga]' * jumlah_bar
               WHERE item_id = '$post[item_id]'";
        $this->db->query($sql);
    }

    public function hapus_jual($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('t_jual');
    }

    public function edit_jual($post)
    {
        $params = array(
            'harga' => $post['harga'],
            'jumlah_bar' => $post['jumlah_bar'],
            'potongan_item' => $post['potongan'],
            'total' => $post['total'],
        );
        $this->db->where('jual_id', $post['jual_id']);
        $this->db->update('t_jual', $params);
    }

    public function tambah_jual($post)
    {
        $params = array(
            'invoice' => $this->invoice_no(),
            'total_harga' => $post['subtotal'],
            'diskon' => $post['diskon'],
            'final_harga' => $post['grandtotal'],
            'pembayaran' => $post['bayar'],
            'kembalian' => $post['kembalian'],
            'catatan' => $post['catatan'],
            'tanggal' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid')
        );
        $this->db->insert('t_penjualan', $params);
        return $this->db->insert_id();
    }

    function tambah_detail_jual($params) {
        $this->db->insert_batch('t_detailpenjualan', $params);
    }

    public function get_penjualan($id = null)
    {
        $this->db->select('*, user.username as user_name, t_penjualan.created as jual_created');
        $this->db->from('t_penjualan');
        $this->db->join('user', 't_penjualan.user_id = user.user_id');
        if($id != null) {
            $this->db->where('penjualan_id', $id);
        }
        $this->db->order_by('tanggal', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_penjualan_pagination($limit = null, $start = null)
    {
        $post = $this->session->userdata('search');
        $this->db->select('*, user.username as user_name, t_penjualan.created as jual_created');
        $this->db->from('t_penjualan');
        $this->db->join('user', 't_penjualan.user_id = user.user_id');

        if(!empty($post['date1']) && !empty($post['date2'])) {
            $this->db->where("t_penjualan.tanggal BETWEEN '$post[date1]' AND '$post[date2]'");
        }

        if(!empty($post['invoice'])) {
            $this->db->like("invoice", $post['invoice']);
        }

        $this->db->limit($limit, $start);
        $this->db->order_by('tanggal', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_penjualan_detail($jual_id = null)
    {
        $this->db->from('t_detailpenjualan');
        $this->db->join('p_item', 't_detailpenjualan.item_id = p_item.item_id');
        if($jual_id != null) {
            $this->db->where('t_detailpenjualan.jual_id', $jual_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function hapus_penjualan($id)
    {
        $this->db->where('penjualan_id', $id);
        $this->db->delete('t_penjualan');
    }
}