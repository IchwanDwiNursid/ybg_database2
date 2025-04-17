<?php

class CategoryCust extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login(); 
        $this->load->model('categoryCust_model');
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
        $data['judul'] = 'Category Customer';

        $data['CategoryCust'] = $this->categoryCust_model->getAllCategoryCust();
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('categoryCust/categoryCust',$data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Category Cust';
    
        $this->form_validation->set_rules('category','Category Customer', 'required');
        if( $this->form_validation->run() == FALSE ) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar',$data);
            $this->load->view('categoryCust/tambah',$data);
            $this->load->view('template/footer');
        } else {
            $this->categoryCust_model->tambahCategory();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('categoryCust');
        }
    }

    public function hapus($id)
    {
        $this->categoryCust_model->hapuscategory($id);
        $this->session->set_flashdata('flash','Dihapus');
        redirect('categoryCust');
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Category Customer';
        $data['CategoryCust'] = $this->categoryCust_model->getCatCustById($id);

        $this->form_validation->set_rules('CategoryCust', 'Category Customer', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('categoryCust/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->categoryCust_model->updatecatCust($id);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('categoryCust');
        }
    }


}
