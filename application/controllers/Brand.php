<?php

class Brand extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login();
        $this->load->model('brand_model');
        $this->load->model('categoryProduk_model');
        $this->load->library('session');
        $this->load->helper('auth'); // Memuat helper untuk pengecekan login

        // Memeriksa apakah pengguna sudah login
        if (!is_logged_in()) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }
    }

    public function index()
    {
        $data['judul'] = 'Brand';
        $data['brands'] = $this->brand_model->getAllBrand();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('brand/brand', $data);
        $this->load->view('template/footer');
    }

    public function add_brand(){
        $data['judul'] = 'Add Brand';

        $data['catprod'] = $this->categoryProduk_model->getAllCategoryProduk();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('brand/add', $data);
        $this->load->view('template/footer');
    }

    public function simpan(){
        $data['id_catprod'] = $this->input->post('catprod');
        $data['brand'] = $this->input->post('brand');

        $this->brand_model->addBrand($data);

        redirect('brand');
    }

    public function delete($idBrand) {
        $this->brand_model->deleteBrand($idBrand);
        redirect("brand");
    }
}