<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('auth'); // Memuat helper untuk pengecekan login

        // Memeriksa apakah pengguna sudah login
        if (!is_logged_in()) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }


        
    }

    public function index()
    {
        $data['salesadvisors'] = $this->user_model->getAlluser();
        $userId = $this->session->userdata('id_sales'); // Mengambil id_sales dari session
        $data['user'] = $this->user_model->get_salesadvisor_by_id($userId);
        $data['judul'] = 'Data User';
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('user/user',$data);
        $this->load->view('template/footer');
    }

    public function tambah_salesadvisor() {
        $data['judul'] = 'Tambah User';
        // Validasi input
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[salesadvisor.Username]');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() == FALSE) {
            // Gagal validasi
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar',$data);
            $this->load->view('user/tambah');
            $this->load->view('template/footer');
        } else {
            // Simpan data ke database
            $data = array(
                'IdSales' => $this->input->post('IdSales'),
                'Username' => $this->input->post('username'),
                'Password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), // Enkripsi password
                'Name' => $this->input->post('name')
            );
            if ($this->user_model->tambah_salesadvisor($data)) {
                $this->session->set_flashdata('success', 'Sales advisor berhasil ditambahkan.');
                redirect('User');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan sales advisor.');
                redirect('User');
            }
        }
    }


    public function edit_salesadvisor($id) {
        $data['judul'] = 'Edit User';
        // Ambil data sales advisor yang akan diedit
        $data['salesadvisor'] = $this->user_model->get_salesadvisor_by_id($id);

        if (empty($data['salesadvisor'])) {
            $this->session->set_flashdata('error', 'Sales advisor tidak ditemukan.');
            redirect('user');
        }

        // Validasi input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar',$data);
            $this->load->view('user/edit');
            $this->load->view('template/footer');
        } else {
            // Perbarui data di database
            $data_update = array(
                'Username' => $this->input->post('username'),
                'Password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), // Enkripsi password
                'Name' => $this->input->post('name')
            );
            if ($this->user_model->update_salesadvisor($id, $data_update)) {
                $this->session->set_flashdata('success', 'Sales advisor berhasil diperbarui.');
                redirect('user');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui sales advisor.');
                redirect('user/edit_salesadvisor/'.$id);
            }
        }
    }

    public function hapus_salesadvisor($id) {
        if ($this->user_model->hapus_salesadvisor($id)) {
            $this->session->set_flashdata('success', 'Sales advisor berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus sales advisor.');
        }
        redirect('user');
    }
}
