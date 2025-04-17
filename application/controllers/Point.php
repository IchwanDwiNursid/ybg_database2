<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('point_model');
        $this->load->library('session');
        $this->load->helper('auth'); // Memuat helper untuk pengecekan login

        // Memeriksa apakah pengguna sudah login
        if (!is_logged_in()) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }
    }

    public function index() {
        $data['judul'] = 'Point Information Form';
    
        if ($this->input->post('search_and_save')) {
            $phone_number = $this->input->post('search');
            $orders = $this->point_model->search_orders_by_phone($phone_number);
    
            if ($orders) {
                $data['orders'] = $orders;
                $data['total_points'] = $this->point_model->calculate_total_points($orders[0]['idCustomer']);
                $data['expiry_date'] = $this->point_model->get_expiry_date($orders[0]['idCustomer']);
            } else {
                $data['warning'] = 'Tidak ada pesanan ditemukan untuk nomor telepon ini.';
            }
        }
    
        if ($this->input->post('process_expired')) {
            $phone_number = $this->input->post('search');
            $data['customer_points'] = $this->point_model->process_expired_points($phone_number);
        }
    
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('point/point', $data);
        $this->load->view('template/footer');
    }
    
    

    public function get_last_transaction_date($customer_id) {
        $this->db->select_max('dateTransaction');
        $query = $this->db->get_where('order', array('idCustomer' => $customer_id));
        return $query->row()->dateTransaction;
    }

    public function search_and_save() {
        $phoneNumber = $this->input->post('search'); // Ambil nomor telepon dari input form
        
        if ($phoneNumber) {
            $orders = $this->point_model->search_orders_by_phone($phoneNumber); // Panggil model untuk mencari pesanan berdasarkan nomor telepon
        
            if ($orders) {
                $data['orders'] = $orders; // Jika ada data, kirimkan ke view
            } else {
                $data['warning'] = 'Tidak ada pesanan ditemukan untuk nomor telepon ini.'; // Jika tidak ada data, tampilkan pesan peringatan
            }
        }
        
        $data['judul'] = 'Point Information';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('point/result', $data); // Load view dengan data yang telah dikirim
        $this->load->view('template/footer');
    }

    public function process_expired() {
        $expired_points = $this->point_model->get_expired_points(); // Dapatkan data poin kadaluarsa

        if ($expired_points) {
            foreach ($expired_points as $point) {
                $this->point_model->mark_point_as_expired($point['id']);
            }
            $data['warning'] = 'Poin kadaluarsa berhasil diproses.';
        } else {
            $data['warning'] = 'Tidak ada poin kadaluarsa untuk diproses.';
        }

        $data['judul'] = 'Point Management';
        $this->load->view('point_form', $data);
    }
}
