<?php

class Cicilan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login();
        $this->load->model('cicilan_model');
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
        $data['judul'] = 'Cicilan';
        $data['cicilan'] = $this->cicilan_model->getAllCicilan();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('cicilan/cicilan', $data);
        $this->load->view('template/footer');
    }

    public function delete($id) 
    {
        $this->cicilan_model->deleteCicilan($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('cicilan');
    }

    public function detail($id) 
    {
        $data['judul'] = 'Detail Cicilan';
        $data['cicilan'] = $this->cicilan_model->get_all_bayar_cicilan($id);
        $data['salesadvisors'] = $this->user_model->getAlluser();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('cicilan/detail', $data);
        $this->load->view('template/footer');
    }

    public function simpan()
    {
        $this->form_validation->set_rules('paydate', 'Tanggal Bayar', 'required');
        $this->form_validation->set_rules('amount', 'Jumlah Uang', 'required');
        $this->form_validation->set_rules('IdSales', 'ID Sales', 'required');

        
        $idCicilan = $this->input->post('idCicilan');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, kembali ke form tambah
            $this->session->set_flashdata('error', validation_errors());
            redirect('cicilan/detail/' . $idCicilan);
        } else {
            $data["idCicilan"] = $idCicilan;
            $data["idSales"] = $this->input->post("IdSales");
            $data["tanggalBayar"] = $this->input->post("paydate");
            $data["jumlahBayar"] = $this->input->post("amount");
            $data["ket"] = $this->input->post("ket");

            $b_cicilan = $this->cicilan_model->create_bayar_cicilan($data);

            if ($b_cicilan) {

                $sisaCicilan = $this->cicilan_model->get_sisa_cicilan($idCicilan)->sisaCicilan;
                $jumlahBayar = $this->input->post("amount");
                $sisaCicilanSekarang = $sisaCicilan - $jumlahBayar;

                if ($sisaCicilanSekarang <= 0 ) {
                    $update["status"] = "LUNAS";
                    $update["sisaCicilanBaru"] = 0;
                    $update["amount"] = $jumlahBayar;
                    $this->cicilan_model->update_cicilan($idCicilan,$update);
                } else {
                    $update["sisaCicilanBaru"] = $sisaCicilanSekarang;
                    $update["amount"] = $jumlahBayar;
                    $this->cicilan_model->update_cicilan($idCicilan,$update);
                }
            };
            redirect('cicilan/detail/' . $idCicilan);
        }
    }

}