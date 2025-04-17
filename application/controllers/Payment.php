<?php

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login(); 
        $this->load->model('payment_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('auth'); // Memuat helper untuk pengecekan login

        // Memeriksa apakah pengguna sudah login
        if (!is_logged_in()) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }
    }

    public function index()
    {
        $data['judul'] = 'Payment Methode';

        $data['payment'] = $this->payment_model->getAllpayment();
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('payment/payment',$data);
        $this->load->view('template/footer');
    }


    public function tambah()
    {
        $data['judul'] = 'Tambah Payment Methode';
    
        $this->form_validation->set_rules('payment','Payment Methode', 'required');
        if( $this->form_validation->run() == FALSE ) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar',$data);
            $this->load->view('payment/tambah',$data);
            $this->load->view('template/footer');
        } else {
            $this->payment_model->tambahPayment();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('payment');
        }
    }

    public function hapus($id)
    {
        $this->payment_model->hapusPayment($id);
        $this->session->set_flashdata('flash','Dihapus');
        redirect('payment');
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Payment Methode';
        $data['payment'] = $this->payment_model->getPaymentById($id);

        $this->form_validation->set_rules('payment', 'Payment Methode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('payment/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->payment_model->updatePayment($id);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('payment');
        }
    }
}
