<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
    }

    public function index()
    {
        $data['judul'] = 'Login';
        $this->load->view('auth/login');
    }

    public function authenticate()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Validasi input
        if (empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Username dan Password harus diisi.');
            redirect('login');
        }

        // Cek user di database
        $user = $this->Auth_model->get_user_by_username($username);

        if ($user && password_verify($password, $user['Password'])) {
            // Set session data
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('id_sales', $user['IdSales']);
            $this->session->set_userdata('username', $user['Username']);
            $this->session->set_userdata('name', $user['Name']);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah.');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    
}
