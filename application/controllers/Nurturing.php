<?php

class Nurturing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login();
        $this->load->model('nurturing_model');
        $this->load->library('session');
        $this->load->helper('auth'); // Memuat helper untuk pengecekan login

        // Memeriksa apakah pengguna sudah login
        if (!is_logged_in()) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }
    }

    public function index($month = 1) {
        $data['judul'] = 'Nurturing';
        $data['customer'] = $this->nurturing_model->get_birthdate_per_month($month);
        $data['month'] = $month;

        $data['last_transaction'] = $this->nurturing_model->get_last_transaction_per_month();

        $data['tx_start_date'] = $this->input->get('tx_start_date');
        $data['tx_end_date'] = $this->input->get('tx_end_date');

        if ($data['tx_start_date'] && $data['tx_end_date']) {
            $data['last_transaction'] = $this->nurturing_model->get_transaction_by_date_range($data['tx_start_date'], $data['tx_end_date']);
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('nurturing/nurturing', $data);
    }

    public function download_csv_birthdate()
    {
        $month = $this->input->get('month');
    
        $customers = $this->nurturing_model->get_birthdate_per_month($month);
    
        // Set header CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="birthdate.csv"');
    
        // Output langsung ke browser
        $output = fopen('php://output', 'w');
    
        // Header kolom sesuai database
        fputcsv($output, ['ID Customer', 'First Name', 'Last Name', 'Birthdate', 'Phone Number', 'Instagram','Age']);
    
        // Isi data baris per baris
        foreach ($customers as $row) {
            $birthdate = new DateTime($row['Birthdate']);
            $today = new DateTime();
            $age = $today->diff($birthdate)->y;
            fputcsv($output, [
                $row['idCustomer'],
                $row['FirstName'],
                $row['LastName'],
                $row['Birthdate'],
                $row['PhoneNumber'],
                $row['instagram'],
                $age. ' tahun'
            ]);
        }
    
        fclose($output);
        exit;
    }
    
    public function download_csv_transaction(){

        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $orders = $this->nurturing_model->get_last_transaction_per_month();

        if ($start_date && $end_date) {
            $orders = $this->nurturing_model->get_transaction_by_date_range($start_date, $end_date);
        }

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="transaction.csv"');
    
        // Output langsung ke browser
        $output = fopen('php://output', 'w');
    
        // Header kolom sesuai database
        fputcsv($output, ['Kode Transaksi', 'Name', 'No Hp','Instagram','Point Gained']);
        foreach ($orders as $row) {
            fputcsv($output, [
                $row['kd_transaksi'],
                $row['FirstName'],
                $row['PhoneNumber'],
                $row['instagram'],
                $row['Point']
            ]);
        }
    }
}