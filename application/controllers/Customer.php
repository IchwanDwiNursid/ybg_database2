<?php

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login();
        $this->load->model('customer_model');
        $this->load->model('transaksi_model');
        $this->load->library('session');
        $this->load->helper('auth'); // Memuat helper untuk pengecekan login

        // Memeriksa apakah pengguna sudah login
        if (!is_logged_in()) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }
    }

    public function index()
    {
        $data['judul'] = 'Customer';

        $data['customer'] = $this->customer_model->getAllCustomer();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('customer/customer', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Customer';

        $this->form_validation->set_rules('FirstName', 'FirstName', 'required');
        $this->form_validation->set_rules('birthday', 'Birthday');
        $this->form_validation->set_rules('PhoneNumber', 'Phone Number', 'required|numeric|is_unique[customer.PhoneNumber]');
        $this->form_validation->set_rules('instagram', 'Instagram');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('customer/tambah', $data);
            $this->load->view('template/footer');
        } else {
            $this->customer_model->tambahCustomer();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('customer');
        }
    }

    public function hapus($id)
    {
        $this->customer_model->hapusCustomer($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('customer');
    }

    public function sortByBulanLahir()
    {
        // Mengambil bulan dari input GET
        $bulan = $this->input->get('bulan');

        // Redirect ke halaman utama jika bulan tidak ada
        if ($bulan === null || $bulan === '') {
            redirect('customer');
        }

        // Ambil data customer berdasarkan bulan lahir
        $data['judul'] = 'Data Customer';
        $data['customer'] = $this->customer_model->get_customers_by_bulan_lahir($bulan);

        // Memuat view yang sama setelah sortir
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('customer/customer', $data);
        $this->load->view('template/footer');
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Customer';
        $data['Customer'] = $this->customer_model->getCustomerById($id);

        $this->form_validation->set_rules('FirstName', 'FirstName', 'required');
        $this->form_validation->set_rules('Birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'required|numeric');
        $this->form_validation->set_rules('instagram', 'instagram', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('customer/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->customer_model->updateCustomer($id);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Customer');
        }
    }

    public function search()
    {
        $keyword = $this->input->post('search');

        $data['judul'] = 'Data Customer';

        // Mengambil hasil pencarian dari model
        $data['customer'] = $this->customer_model->searchCustomer($keyword);

        // Memanggil view dan mengirimkan data pencarian pelanggan
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('customer/customer', $data);
        $this->load->view('template/footer');
    }

    public function detail($idCustomer)
    {
        $data['judul'] = 'Customer Detail';
        // Load model
        $this->load->model('customer_model');

        // Ambil data customer
        try {
            $data['customer'] = $this->customer_model->get_customer_details($idCustomer);
            
        } catch (ValueError $e) {
            $data['customer'] = null; // Menangani jika customer tidak ditemukan
        }

        // Tampilkan view dengan data customer
        if ($data['customer'] === null) {
            // Jika tidak ada data pelanggan ditemukan
            $data['customer'] = [
                'FirstName' => 'N/A',
                'LastName' => '',
                'Birthdate' => 'N/A',
                'PhoneNumber' => 'N/A',
                'instagram' => 'N/A',
                'kd_transaksi' => [],
                'points' => [],
                'pointclaims' => [],
                'datetransactions' => [],
                'active_points' => 0,
                'expiration_date' => 'N/A'
            ];
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('customer/detail', $data);
        $this->load->view('template/footer');
    }
}
