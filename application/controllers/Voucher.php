<?php

class voucher extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login(); 
        $this->load->model('voucher_model');
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
        $data['judul'] = 'Voucher';

        // Mengambil data voucher
        $data['voucher'] = $this->voucher_model->getAllvoucher();

        // Format mata uang untuk nominal voucher
        foreach ($data['voucher'] as &$voucher) {
            $voucher['nominal'] = !is_null($voucher['nominal']) ? 'Rp ' . number_format($voucher['nominal'], 2, ',', '.') : 'Rp 0'; // Menampilkan 'Rp 0' jika data null
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('voucher/voucher', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Voucher Methode';

        $this->form_validation->set_rules('kdvoucher', 'KdVoucher', 'required|is_unique[voucher.idvoucher]');
        $this->form_validation->set_rules('voucher', 'Voucher', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('voucher/tambah', $data);
            $this->load->view('template/footer');
        } else {
            $this->voucher_model->tambahVoucher();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('voucher');
        }
    }

    public function hapus($id)
    {
        $this->voucher_model->hapusVoucher($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('voucher');
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Voucher';
        $data['voucher'] = $this->voucher_model->getVoucherById($id);

        $this->form_validation->set_rules('idvoucher', 'Id Voucher', 'required');
        $this->form_validation->set_rules('namavoucher', 'Nama Voucher', 'required');
        $this->form_validation->set_rules('nominal', 'nominal', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('voucher/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->voucher_model->updateVoucher($id);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('voucher');
        }
    }
}
