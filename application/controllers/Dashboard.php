<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->helper('auth');
        $this->load->model('transaksi_model');
        $this->load->model('customer_model');
        $this->load->model('dashboard_model');
        $this->load->library('session');
        $this->load->helper('auth'); // Memuat helper untuk pengecekan login

        // Memeriksa apakah pengguna sudah login
        if (!is_logged_in()) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }
        // check_login(); 
    }

    public function index()
    {
        $data['chart_data'] = $this->dashboard_model->get_order_data();
        $total_customers = $this->customer_model->get_total_customers();
        $total_order = $this->transaksi_model->get_total_order();
        $total_produk = $this->transaksi_model->get_total_produk();

        $data['total_customers'] = $total_customers;
        $data['total_order'] = $total_order;
        $data['total_produk'] = $total_produk;
        $data['judul'] = 'Dashboard';


        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('Dashboard',$data);
        $this->load->view('template/footer');
    }
}

