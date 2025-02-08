<?php
class Produk_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_produk() {
        return $this->db->select('produk.*, kategori.nama_kategori, status.nama_status')
                        ->from('produk')
                        ->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left')
                        ->join('status', 'produk.id_status = status.id_status', 'left')
                        ->get()->result();
    }

    public function get_bisa_dijual() {
        return $this->db->select('produk.*, kategori.nama_kategori, status.nama_status')
                        ->from('produk')
                        ->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left')
                        ->join('status', 'produk.id_status = status.id_status', 'left')
                        ->where('status.nama_status', 'bisa dijual')
                        ->get()->result();
    }

    public function get_or_insert_kategori($nama_kategori) {
        $this->db->where('nama_kategori', $nama_kategori);
        $query = $this->db->get('kategori');

        if ($query->num_rows() > 0) {
            return $query->row()->id_kategori;
        } else {
            $this->db->insert('kategori', ['nama_kategori' => $nama_kategori]);
            return $this->db->insert_id();
        }
    }
    
    public function get_kategori_by_name($nama_kategori) {
        return $this->db->get_where('kategori', ['nama_kategori' => $nama_kategori])->row();
    }

    public function insert_kategori($data) {
        $this->db->insert('kategori', $data);
        return $this->db->insert_id();
    }

    public function get_status() {
        return $this->db->get('status')->result();
    }

    public function get_id_status($status) {
        return ($status == 'bisa dijual') ? 1 : 2;
    }

    public function insert_produk($data) {
        return $this->db->insert('produk', $data);
    }

    public function get_produk_by_id($id) {
        return $this->db->get_where('produk', ['id_produk' => $id])->row();
    }

    public function update_produk($id, $data) {
        return $this->db->where('id_produk', $id)->update('produk', $data);
    }

    public function delete_produk($id) {
        return $this->db->delete('produk', ['id_produk' => $id]);
    }
}