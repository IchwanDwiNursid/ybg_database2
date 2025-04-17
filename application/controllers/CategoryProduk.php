<?php

class CategoryProduk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login(); 
        $this->load->model('categoryProduk_model');
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
        $data['judul'] = 'Category Produk';

        $data['CategoryProduk'] = $this->categoryProduk_model->getAllCategoryProduk();
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('categoryProduk/categoryProduk',$data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Category Produk';
    
        $this->form_validation->set_rules('category','Category Produk', 'required');
        if( $this->form_validation->run() == FALSE ) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar',$data);
            $this->load->view('categoryProduk/tambah',$data);
            $this->load->view('template/footer');
        } else {
            $this->categoryProduk_model->tambahCategory();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('categoryProduk');
        }
    }

    public function hapus($id)
    {
        $this->categoryProduk_model->hapuscategory($id);
        $this->session->set_flashdata('flash','Dihapus');
        redirect('categoryProduk');
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Category Produk';
        $data['CategoryProduk'] = $this->categoryProduk_model->getCategoryProdukById($id);

        $this->form_validation->set_rules('category', 'Category Produk', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('categoryProduk/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->categoryProduk_model->updateCategoryProduk($id);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('categoryProduk');
        }
    }


}
