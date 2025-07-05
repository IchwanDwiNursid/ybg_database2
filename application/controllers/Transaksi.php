<?php

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->model('customer_model');
        $this->load->model('payment_model');
        $this->load->model('tx_model');
        $this->load->model('voucher_model');
        $this->load->model('categoryCust_model');
        $this->load->model('categoryProduk_model');
        $this->load->model('cicilan_model');
        $this->load->model('user_model');
        $this->load->model('brand_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('auth'); // Memuat helper untuk pengecekan login

        // Memeriksa apakah pengguna sudah login
        if (!is_logged_in()) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }
        // check_login(); 
    }

    public function index()
    {
        $data['judul'] = 'Detail Order';
        $data['transaksi'] = $this->transaksi_model->get_transaksi(); // Ambil semua transaksi
        $data['vouchers'] = $this->transaksi_model->get_vouchers(); // Ambil vouchers

        // echo '<pre>';
        //     print_r($data['transaksi']);
        // echo '</pre>';
        // exit;

        foreach ($data['transaksi'] as $order) {
            if (!empty($order['idvoucher'])) { // Periksa jika ada data voucher
                $vouchers = explode(',', $order['idvoucher']); // Pisahkan ID voucher berdasarkan koma
                $decoded_vouchers = [];
                foreach ($vouchers as $id) {
                    // Temukan informasi voucher berdasarkan ID
                    $voucher_info = array_filter($data['vouchers'], function ($voucher) use ($id) {
                        return $voucher['idvoucher'] == $id;
                    });
                    if ($voucher_info) {
                        $decoded_vouchers[] = array_shift($voucher_info); // Ambil info pertama (karena hanya satu per ID)
                    }
                }
                $order['Decoded Voucher'] = $decoded_vouchers;
            } else {
                $order['Decoded Voucher'] = [];
            }
        }

        $data['customer'] = $this->customer_model->getAllCustomer();
        $data['start_date'] = $this->input->get('start_date');
        $data['end_date'] = $this->input->get('end_date');

        //TODO : Filter by Range Date
        if ($data['start_date'] && $data['end_date']) {
            $data['transaksi'] = $this->transaksi_model->get_transaksi_by_date($data['start_date'], $data['end_date']);
        }



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('transaksi/transaksi', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Transaksi';

        $nohp = $this->input->post('PhoneNumber'); // Input dari form pencarian
        $data['transaksi'] = $this->transaksi_model->get_transaksi();
        $data['voucher_options'] = $this->voucher_model->getAllvoucher();
        $data['CategoryCust'] = $this->categoryCust_model->getAllCategoryCust();
        $data['CategoryProduk'] = $this->categoryProduk_model->getAllCategoryProduk();
        $data['payment'] = $this->payment_model->getAllpayment();
        $data['salesadvisors'] = $this->user_model->getAlluser();
        // Jika customer ditemukan
        // $data['customer'] = $customer;
        $data['voucher_options'] = $this->voucher_model->getAllvoucher();
        // $this->session->set_userdata('customer', $customer);

        // Load form tambah data transaksi dengan data customer
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('transaksi/tambah', $data); // Form tambah data
    }

    public function getBrandsByCategory()
    {
        $categoryId = $this->input->post('idCategoryProduk');
        $brands = $this->brand_model->getBrandByCategoryId($categoryId);
        
        echo json_encode($brands);
    }

    public function searchCustomerPhone()
    {
        $keyword = $this->input->get('term');
        $result = $this->customer_model->getCustomerByPhoneNumber($keyword);
        
        $suggestions = [];
        foreach ($result as $row) {
            $suggestions[] = [
                'PhoneNumber' => $row['PhoneNumber'],
                'FirstName' => $row['FirstName'],
                'LastName' => $row['LastName'],
                'Alamat' => $row['Alamat'],
            ];
        }

        echo json_encode($suggestions);
    }

    public function simpanCust($phonenumber)
    {
        $data_order = [
            'kd_transaksi' => $this->input->post('kd_transaksi'),
            'dateTransaction' => $this->input->post('dateTransaction'),
            'IdSales' => $this->input->post('IdSales'),
            'idMethode' => $this->input->post('idMethode'),
            'Brand' => $this->input->post('Brand'),
            'SKUName' => $this->input->post('SKUName'),
            'QtyOrder' => $this->input->post('QtyOrder'),
            'BasePrice' => $this->input->post('BasePrice'),
            'BeforeDisc' => $this->input->post('BasePrice'),
            'Discount' => $this->input->post('Discount'),
            'AfterDisc' => $this->input->post('AfterDisc'),
            'Point' => $this->input->post('Point'),
            'pointclaim' => $this->input->post('pointclaim'),
            'idCategoryCust' => $this->input->post('idCategoryCust'),
            'idCategoryProduk' => $this->input->post('idCategoryProduk'),
            'Keterangan' => $this->input->post('Keterangan'),
        ];

        // Proses Voucher (Multi-Select)
        $idVoucherArray = $this->input->post('idvoucher');
        if (is_array($idVoucherArray) && !empty($idVoucherArray)) {
            $data_order['idvoucher'] = implode(",", $idVoucherArray); // Gabungkan menjadi string
        } else {
            $data_order['idvoucher'] = "Tidak Ada Voucher"; // Atur default jika tidak ada voucher yang dipilih
        }
        // Dari form multi-select

        $data['judul'] = 'Tambah Customer';
        $d = [
            'data_order' => $data_order,
            'hp' => $phonenumber
        ];

        $this->form_validation->set_rules('FirstName', 'FirstName', 'required');
        $this->form_validation->set_rules('PhoneNumber', 'Phone Number', 'numeric|is_unique[customer.PhoneNumber]');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('transaksi/tambah_customer', $d);
            $this->load->view('template/footer');
        } else {
            $data_order['idvoucher'] = $this->input->post('idvoucher');

            $this->customer_model->tambahCustomer();
            $customer = $this->customer_model->get_customer_by_phone($this->input->post('PhoneNumber'));

            $data_order['idCustomer'] = $customer['idCustomer'];

            //Simpan ke database
            if ($this->transaksi_model->simpan($data_order)) {
                $this->session->set_flashdata('success', 'Transaksi berhasil disimpan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan transaksi.');
            }

            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('transaksi');
        }
    }

    public function generateLastRandomCode() {
        $last_code = $this->transaksi_model->getLastTransactionCode();
        $last_alpha = $last_code ? substr($last_code, -3) : null;

        $random_code = $this->generate_random_code($last_alpha);

        echo json_encode(['kode' => $random_code]);
    }

    public function simpan()
    {
        $data['judul'] = 'Simpan';
        $data['transaksi'] = $this->transaksi_model->get_transaksi();
        $data['voucher_options'] = $this->voucher_model->getAllvoucher();

        // if (empty($this->input->post('Brand')) || empty($this->input->post('Brand')[0])) {
        //     $this->form_validation->set_rules('dummyBrand', 'Brand', 'required');
        // }
        
        // if (empty($this->input->post('idCategoryProduk')) || empty($this->input->post('idCategoryProduk')[0])) {
        //     $this->form_validation->set_rules('dummyCategory', 'Category Produk', 'required');
        // }

        // Validasi input form tambah transaksi
        // $this->form_validation->set_rules('SKUName', 'Tipe', 'required');
        // $this->form_validation->set_rules('QtyOrder', 'Qty Order', 'required');
        // $this->form_validation->set_rules('BasePrice', 'Base Price', 'required');
        $this->form_validation->set_rules('idCategoryCust', 'Category Customer', 'required');
        $this->form_validation->set_rules('phonenumber', 'Phone Number', 'required|numeric');
        $this->form_validation->set_rules('dateTransaction', 'dateTransaction', 'required');
        $this->form_validation->set_rules('IdSales', 'ID Sales', 'required');
        $this->form_validation->set_rules('kd_transaksi', 'kd_transaksi', 'required');
        $this->form_validation->set_rules('Discount', 'Discount', 'required|numeric');
        $this->form_validation->set_rules('AfterDisc', 'After Discount', 'required|numeric');
        $this->form_validation->set_rules('pointclaim', 'Claim Point', 'numeric');
        $this->form_validation->set_rules('Point', 'Point', 'numeric');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, kembali ke form tambah
            $this->session->set_flashdata('error', validation_errors());
            redirect('transaksi/tambah');
        } else {
            $customer = $this->customer_model->get_customer_by_phone($this->input->post('phonenumber'));
    
            // get last code
            // $last_code = $this->transaksi_model->getLastTransactionCode();
            // $last_alpha = $last_code ? substr($last_code, -3) : null;

            $alamat = $this->input->post('alamatPilihan') === 'custom'
                        ? $this->input->post('Alamat')
                        : $customer['Alamat'];
            $brand = $this->input->post('Brand');
            $category = $this->input->post('idCategoryProduk');
            $tipe = $this->input->post('SKUName');
            $qty = $this->input->post('QtyOrder');
            $basePrice = $this->input->post('BasePrice');
            $methodePembayaran = $this->input->post('idMethode');

            if ($customer && is_array($brand) && is_array($category) && count($brand) === count($category)) {
                for ($i = 0; $i < count($brand); $i++) {

                    $data_order = [
                        'idCustomer' => $customer['idCustomer'],
                        'kd_transaksi' => $this->input->post('kd_transaksi'),
                        'dateTransaction' => $this->input->post('dateTransaction'),
                        'IdSales' => $this->input->post('IdSales'),
                        'Brand' => $brand[$i],
                        'SKUName' => $tipe[$i],
                        'QtyOrder' => $qty[$i],
                        'BasePrice' => $basePrice[$i],
                        'BeforeDisc' => $basePrice[$i],
                        'Discount' => $this->input->post('Discount'),
                        'AfterDisc' => $this->input->post('AfterDisc'),
                        'Point' => $this->input->post('Point'),
                        'pointclaim' => $this->input->post('pointclaim'),
                        'Alamat' => $alamat,
                        'idCategoryCust' => $this->input->post('idCategoryCust'),
                        'idCategoryProduk' => $category[$i],
                        'Keterangan' => $this->input->post('Keterangan'),
                        'idMethode' => $methodePembayaran
                    ];
    
                    // Proses Voucher (Multi-Select)
                    $idVoucherArray = $this->input->post('idvoucher'); // Dari form multi-select
                    if (is_array($idVoucherArray) && !empty($idVoucherArray)) {
                        $data_order['idvoucher'] = implode(",", $idVoucherArray); // Gabungkan menjadi string
                    } else {
                        $data_order['idvoucher'] = "Tidak Ada Voucher"; // Atur default jika tidak ada voucher yang dipilih
                    }

                    $insertOrderId = $this->transaksi_model->simpan($data_order);
                    
                    // create detail _transaction
                    $tx['idOrder'] = $insertOrderId;
                    $tx['status_shipping'] = 'pending';
                    $this->tx_model->createDetailOrder($tx);


                    // TODO: idMethodePembayaran harus di sesuaikan
                    if ($insertOrderId && $methodePembayaran == 10) {
                        $this->cicilan_model->createCicilan([
                            'idOrder' => $insertOrderId,
                            'totalCicilan' => $this->input->post('AfterDisc'),
                            'jumlahAngsuran' => 0,
                            'sisaCicilan' => $this->input->post('AfterDisc'),
                            'jatuhTempo' => date('Y-m-d', strtotime('+12 month')),
                            'status' => 'BELUM_LUNAS',
                            'idCustomer' => $customer['idCustomer'],
                        ]);
                        $this->session->set_flashdata('success', 'Transaksi berhasil disimpan!');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal menyimpan transaksi.');
                    }
                } 

                redirect('transaksi');
            } else {
                $this->simpanCust($this->input->post('phonenumber'));
            }
        }
    }


    public function search_transaksi()
    {
        $data['judul'] = 'Transaksi';
        $keyword = $this->input->post('keyword');
        
        $this->load->model('transaksi_model'); // Sesuaikan dengan nama model Anda
        $data['transaksi'] = $this->transaksi_model->search($keyword);

        // Tampilkan hasil pencarian di view
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('transaksi/transaksi', $data);
        $this->load->view('template/footer'); // Sesuaikan dengan view pencarian
    }


    public function delete($id)
    {
        $this->transaksi_model->deleteTransaksi($id);
        $this->session->set_flashdata('flash', 'deleted');
        redirect('transaksi');
    }

    public function edit($id)
    {

        $data['judul'] = 'Edit Transaksi';
        $data['voucher_options'] = $this->voucher_model->getAllvoucher();
        $data['CategoryCust'] = $this->categoryCust_model->getAllCategoryCust();
        $data['CategoryProduk'] = $this->categoryProduk_model->getAllCategoryProduk();
        $data['payment'] = $this->payment_model->getAllpayment();
        $data['salesadvisors'] = $this->user_model->getAlluser();

        $data['customer'] = $this->transaksi_model->getTransaksiById($id);
        $data['customer']['idvoucher'] = explode(',', $data['customer']['idvoucher']);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('transaksi/edit', $data);
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('kd_transaksi', 'Kode Transaksi', 'required');
        $this->form_validation->set_rules('dateTransaction', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('idCategoryCust', 'Category Customer', 'required');
        $this->form_validation->set_rules('IdSales', 'Sales Advisor', 'required');
        $this->form_validation->set_rules('idMethode', 'Payment Methode', 'required');
        $this->form_validation->set_rules('Brand', 'Brand', 'required');
        $this->form_validation->set_rules('SKUName', 'SKU', 'required');
        $this->form_validation->set_rules('idCategoryProduk', 'Category Produk', 'required');
        $this->form_validation->set_rules('QtyOrder', 'qty', 'required|numeric');
        $this->form_validation->set_rules('BasePrice', 'Base Price', 'required|numeric');
        $this->form_validation->set_rules('Discount', 'Discount', 'required|numeric');
        $this->form_validation->set_rules('AfterDisc', 'AfterDisc', 'required|numeric');
        $this->form_validation->set_rules('pointclaim', 'claim Point', 'numeric');
        $this->form_validation->set_rules('Point', 'Point gained', 'numeric');

        if ($this->form_validation->run() == FALSE) {
            redirect('transaksi/edit/'.$id);
            
        } else {
            $updateData = array(
                'kd_transaksi' => $this->input->post('kd_transaksi'),
                'dateTransaction' => $this->input->post('dateTransaction'),
                'idCategoryCust' => $this->input->post('idCategoryCust'),
                'IdSales' => $this->input->post('IdSales'),
                'idMethode' => $this->input->post('idMethode'),
                'Brand' => $this->input->post('Brand'),
                'SKUName' => $this->input->post('SKUName'),
                'idCategoryProduk' => $this->input->post('idCategoryProduk'),
                'QtyOrder' => $this->input->post('QtyOrder'),
                'BasePrice' => $this->input->post('BasePrice'),
                'BeforeDisc' => $this->input->post('BasePrice'),
                'Discount' => $this->input->post('Discount'),
                'AfterDisc' => $this->input->post('AfterDisc'),
                'pointclaim' => $this->input->post('pointclaim'),
                'Point' => $this->input->post('Point'),
                'Keterangan' => $this->input->post('Keterangan')
            );

            // Proses Voucher (Multi-Select)
            $idVoucherArray = $this->input->post('idvoucher'); // Dari form multi-select
            if (is_array($idVoucherArray) && !empty($idVoucherArray)) {
                $updateData['idvoucher'] = implode(",", $idVoucherArray); // Gabungkan menjadi string
            } else {
                $updateData['idvoucher'] = "Tidak Ada Voucher"; // Atur default jika tidak ada voucher yang dipilih
            }
            

            $this->transaksi_model->update($id, $updateData);
            $this->session->set_flashdata('flash', 'Updated');
            redirect('transaksi');
        }
    }

    public function generate_random_code($last_alpha_code = 'AAA')
    {
        // Ambil tanggal sekarang
        $bulan = date('m'); // ex: 04
        $hari = date('d');  // ex: 24
        $tahun = date('y'); // ex: 25


        // Hitung huruf selanjutnya
        $next_alpha = $this->next_alpha_code($last_alpha_code);

        // Gabungkan jadi kode
        return $bulan . $hari . $tahun . $next_alpha;
    }

    // Fungsi menghitung urutan abjad selanjutnya (AAA, AAB, ..., AAZ, ABA, ..., ZZZ)
    private function next_alpha_code($code)
    {
        $code = strtoupper($code); // Pastikan huruf besar
        $chars = str_split($code);

        for ($i = 2; $i >= 0; $i--) {
            if ($chars[$i] === 'Z') {
                $chars[$i] = 'A';
            } else {
                $chars[$i] = chr(ord($chars[$i]) + 1);
                break;
            }
        }

        return implode('', $chars);
    }


}
