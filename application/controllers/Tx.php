<?php

class Tx extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tx_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('auth');

        if (!is_logged_in()) {
            redirect('login'); 
        }
    }

    public function index(){

        $data['judul'] = 'Transaction Detail';

        $data['orders'] = $this->tx_model->getDetailOrder();

        $data['start_date'] =  $this->input->get('start_date');
        $data['end_date'] =  $this->input->get('end_date');

        if ($data['start_date'] && $data['end_date']) {
            $data['orders'] = $this->tx_model->get_detail_order_by_range($data);
        }

        $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('tx/tx', $data);
            $this->load->view('template/footer');
    }

    public function edit($kd_transaksi, $tipe, $id, $ongkir, $asuransi, $status_shipping) {
        $data['judul'] = 'Edit Transaction Detail';
        $data['kd_transaksi'] = $kd_transaksi;
        $data['Tipe'] = $tipe;
        $data['id'] = $id;
        $data['ongkir'] = $ongkir;
        $data['asuransi'] = $asuransi;
        $data['status_shipping'] = $status_shipping;

        // $this->tx_model->edit($data);


        $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('tx/edit', $data);
            $this->load->view('template/footer');
    }

    public function simpan() {

        $data['status_shipping'] =  $this->input->post('status');
        $data['ongkir'] =  str_replace('.', '', $this->input->post('ongkir'));
        $data['asuransi'] =  str_replace('.', '', $this->input->post('asuransi'));
        $data['id'] = $this->input->post('id');

        $update = $this->tx_model->updateDetailOrder($data);
        if ($update) {
            redirect('tx');
        }
    }

    public function search_tx()
    {
        $data['judul'] = 'Transaksi Detail';
        $keyword = $this->input->post('keyword');
        
        $this->load->model('transaksi_model'); // Sesuaikan dengan nama model Anda
        $data['orders'] = $this->tx_model->search($keyword);

        // Tampilkan hasil pencarian di view
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('tx/tx', $data);
        $this->load->view('template/footer'); // Sesuaikan dengan view pencarian
    }


}