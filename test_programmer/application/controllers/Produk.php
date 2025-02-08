<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
    }

    public function ambil_data_api(){
        date_default_timezone_set('Asia/Makassar');

        $url ="https://recruitment.fastprint.co.id/tes/api_tes_programmer";

        $tanggal = date('d');
        $bulan = date('m');
        $tahun = date('y');
        $jam = date ('H');

        $username = "tesprogrammer{$tanggal}{$bulan}{$tahun}C{$jam}";
        $password = md5("bisacoding-{$tanggal}-{$bulan}-{$tahun}");

        $data = array(
            'username' => $username,
            'password' => $password
        );
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if ($response_data && $response_data['error'] == 0) {
            foreach ($response_data['data'] as $produk) {
                $id_kategori = $this->Produk_model->get_or_insert_kategori($produk['kategori']);
                $id_status = $this->Produk_model->get_id_status($produk['status']);

                $data_produk = [
                    'id_produk' => $produk['id_produk'],
                    'nama_produk' => $produk['nama_produk'],
                    'harga' => $produk['harga'],
                    'id_kategori' => $id_kategori,
                    'id_status' => $id_status
                ];

                $this->Produk_model->insert_produk($data_produk);
            }
            echo "Data berhasil dimasukkan ke dalam database!";
        } else {
            echo "Terjadi kesalahan saat mengambil data dari API.";
        }
    }

    public function index() {
        $filter_status = $this->input->get('status');
    
        $this->db->select('produk.*, kategori.nama_kategori, status.nama_status');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left');
        $this->db->join('status', 'produk.id_status = status.id_status', 'left');
    
        if ($filter_status == '1') {
            $this->db->where('produk.id_status', 1);
        }
    
        $data['produk_list'] = $this->db->get()->result();
        $data['filter_status'] = $filter_status;
    
        $this->load->view('produk/index', $data);
    }    

    public function tambah() {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
    
        if ($this->form_validation->run() == FALSE) {
            $data['kategori_list'] = $this->db->get('kategori')->result();
            $this->load->view('produk/tambah', $data);
        } else {
            $id_kategori = $this->input->post('id_kategori');
            $nama_kategori = $this->input->post('nama_kategori');
            $id_status = $this->input->post('status');

            if ($id_kategori == "new" && !empty($nama_kategori)) {
                $kategori_data = ['nama_kategori' => $nama_kategori];
                $this->db->insert('kategori', $kategori_data);
                $id_kategori = $this->db->insert_id();
            }
    
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'id_kategori' => $id_kategori,
                'id_status' => $id_status
            ];
    
            $this->db->insert('produk', $data);
            redirect('produk');
        }
    }    
    
    public function edit($id) {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        $data['produk'] = $this->Produk_model->get_produk_by_id($id);
        $data['kategori_list'] = $this->db->get('kategori')->result();
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('produk/edit', $data);
        } else {
            $id_kategori = $this->input->post('id_kategori');
            $nama_kategori_baru = trim($this->input->post('nama_kategori'));
    
            if ($id_kategori == 'new' && !empty($nama_kategori_baru)) {
                $this->db->insert('kategori', ['nama_kategori' => $nama_kategori_baru]);
                $id_kategori = $this->db->insert_id(); 
            }
    
            $update_data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'id_kategori' => $id_kategori,
                'id_status' => $this->input->post('id_status')
            ];
    
            $this->Produk_model->update_produk($id, $update_data);
            redirect('produk');
        }
    }

    public function update($id_produk) {
        $this->load->library('form_validation');
    
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
    
        if ($this->form_validation->run() == FALSE) {
            $produk = $this->db->get_where('produk', ['id_produk' => $id_produk])->row();
            $kategori_list = $this->db->get('kategori')->result();
            $this->load->view('produk/edit', [
                'produk' => $produk,
                'kategori_list' => $kategori_list
            ]);
        } else {
            $id_kategori = $this->input->post('id_kategori');
            $nama_kategori_baru = trim($this->input->post('nama_kategori'));

            if ($id_kategori == 'new' && !empty($nama_kategori_baru)) {
                $this->db->insert('kategori', ['nama_kategori' => $nama_kategori_baru]);
                $id_kategori = $this->db->insert_id();
            }
    
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'id_kategori' => $id_kategori,
                'id_status' => $this->input->post('status')
            ];

            $this->db->update('produk', $data, ['id_produk' => $id_produk]);
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            redirect('produk');
        }
    }
    

    public function hapus($id) {
        $this->Produk_model->delete_produk($id);
        redirect('produk');
    }



}