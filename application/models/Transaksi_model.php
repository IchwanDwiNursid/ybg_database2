<?php

class transaksi_model extends CI_Model
{

    public function get_transaksi()
    {

        $query = $this->db->query("
                SELECT 
                    `order`.kd_transaksi AS 'No Transaksi',
                    `order`.id AS 'id',
                    `order`.dateTransaction AS 'Tanggal',
                    CONCAT(customer.FirstName, ' ', customer.LastName) AS 'Nama Customer',
                    catcust.idCategoryCust AS 'idCategoryCust',
                    catcust.CategoryCust AS 'Category Customer',
                    salesadvisor.Name AS 'Sales Advisor',
                    salesadvisor.IdSales AS 'idSales',
                    paymentmethode.Methode AS 'Payment Method',
                    paymentmethode.idMethode AS 'idMethode',
                    catprod.CategoryProduk AS 'Category Produk',
                    catprod.idCategoryProduk AS 'idCategoryProduk',
                    `order`.QtyOrder AS 'Qty',
                    `order`.BasePrice AS 'Base Price',
                    `order`.Discount AS 'Disc',
                    `order`.Brand AS 'Brand',
                    `order`.SKUName AS 'SKU',
                    `order`.AfterDisc AS 'After Disc',
                    `order`.Point AS 'Point gained',
                    `order`.pointclaim AS 'Point claim',
                    `order`.keterangan AS 'Keterangan',
                    `order`.idvoucher AS 'Nama Voucher' 
                FROM `order`
                LEFT JOIN customer ON `order`.idCustomer = customer.idCustomer 
                LEFT JOIN catcust ON `order`.idCategoryCust = catcust.idCategoryCust 
                LEFT JOIN salesadvisor ON `order`.IdSales = salesadvisor.IdSales 
                LEFT JOIN paymentmethode ON `order`.idMethode = paymentmethode.idMethode 
                LEFT JOIN catprod ON `order`.idCategoryProduk = catprod.idCategoryProduk
                ORDER BY `order`.dateTransaction DESC;
        ");



        $res = $query->result_array();

        $res2 = [];

        foreach ($res as $order) {
            $query2 = $this->db->get('voucher')->result_array();
            $tes = [];
            foreach ($query2 as $q2) {
                $rquery3 = !empty($order['Nama Voucher']) ? explode(',', $order['Nama Voucher']) : [];
                foreach ($rquery3 as $q3) {
                    if ($q2['idvoucher'] == $q3) {
                        array_push($tes, $q2['namavoucher']);
                    }
                }
            }
            $order['Nama Voucher'] = implode(",", $tes);
            array_push($res2, $order);
        }

        return $res2;
    }


    // public function calculate_discount($voucher)
    // {
    //     $totalDiscount = 0;
    //     if (!empty($voucher)) {
    //         foreach ($voucher as $idVoucher) {
    //             $this->db->select('nominal');
    //             $this->db->where('idvoucher', $idVoucher);
    //             $query = $this->db->get('voucher');
    //             $result = $query->row();
    //             if ($result) {
    //                 $totalDiscount += $result->nominal;
    //             }
    //         }
    //     }
    //     return $totalDiscount;
    // }

    // public function calculate_final_price($basePrice, $totalDiscount)
    // {
    //     return max($basePrice - $totalDiscount, 0);
    // }

    // public function tambah()
    // {
    //     $data = [
    //         "kd_transaksi" => $this->input->post('kd_transaksi', true),
    //         "dateTransaction" => $this->input->post('dateTransaction', true),
    //         "idCustomer" => $this->input->post('idCustomer', true),
    //         "idSales" => $this->input->post('idSales', true),
    //         "instagram" => $this->input->post('instagram', true),
    //     ];

    //     $this->db->insert('customer', $data);
    // }

    // public function save_order($data)
    // {
    //     $orderData = array(
    //         'kd_transaksi' => $data['kd_transaksi'],
    //         'dateTransaction' => $data['dateTransaction'],
    //         'idCustomer' => $data['idCustomer'],
    //         'idSales' => $data['idSales'],
    //         'Brand' => $data['Brand'],
    //         'SKUName' => $data['SKUName'],
    //         'idCategoryProduk' => $data['idCategoryProduk'],
    //         'QtyOrder' => $data['QtyOrder'],
    //         'idMethode' => $data['idMethode'],
    //         'BasePrice' => $data['BasePrice'],
    //         'BeforeDisc' => $data['BeforeDisc'],
    //         'Discount' => $data['Discount'],
    //         'AfterDisc' => $data['AfterDisc'],
    //         'Point' => $data['Point'],
    //         'pointclaim' => $data['pointclaim'],
    //         'idCategoryCust' => $data['idCategoryCust'],
    //         'idvoucher' => $data['idvoucher'],
    //         'Keterangan' => $data['Keterangan']
    //     );

    //     $this->db->insert('order', $orderData);

    //     if (!empty($data['idvoucher'])) {
    //         foreach ($data['idvoucher'] as $idVoucher) {
    //             $this->db->insert('order_voucher', array(
    //                 'idOrder' => $data['kd_transaksi'],
    //                 'idvoucher' => $idVoucher
    //             ));
    //         }
    //     }
    // }

    public function get_customer_by_phone($phone)
    {
        $this->db->where('PhoneNumber', $phone);
        $query = $this->db->get('customer');
        return $query->row();
    }

    public function get_monthly_transaction_count()
    {
        $this->db->select('MONTH(dateTransaction) AS month, COUNT(*) AS transaction_count');
        $this->db->from('order');
        $this->db->group_by('month');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_transaksi_by_date($start_date, $end_date)
    {
        $query = $this->db->query("
                SELECT 
                    `order`.kd_transaksi AS 'No Transaksi',
                    `order`.id AS 'id',
                    `order`.dateTransaction AS 'Tanggal',
                    CONCAT(customer.FirstName, ' ', customer.LastName) AS 'Nama Customer',
                    catcust.idCategoryCust AS 'idCategoryCust',
                    catcust.CategoryCust AS 'Category Customer',
                    salesadvisor.Name AS 'Sales Advisor',
                    salesadvisor.IdSales AS 'idSales',
                    paymentmethode.Methode AS 'Payment Method',
                    paymentmethode.idMethode AS 'idMethode',
                    catprod.CategoryProduk AS 'Category Produk',
                    catprod.idCategoryProduk AS 'idCategoryProduk',
                    `order`.QtyOrder AS 'Qty',
                    `order`.BasePrice AS 'Base Price',
                    `order`.Discount AS 'Disc',
                    `order`.Brand AS 'Brand',
                    `order`.SKUName AS 'SKU',
                    `order`.AfterDisc AS 'After Disc',
                    `order`.Point AS 'Point gained',
                    `order`.pointclaim AS 'Point claim',
                    `order`.keterangan AS 'Keterangan',
                    `order`.idvoucher AS 'Nama Voucher' 
                FROM `order`
                LEFT JOIN customer ON `order`.idCustomer = customer.idCustomer 
                LEFT JOIN catcust ON `order`.idCategoryCust = catcust.idCategoryCust 
                LEFT JOIN salesadvisor ON `order`.IdSales = salesadvisor.IdSales 
                LEFT JOIN paymentmethode ON `order`.idMethode = paymentmethode.idMethode 
                LEFT JOIN catprod ON `order`.idCategoryProduk = catprod.idCategoryProduk
                WHERE `order`.dateTransaction >= '$start_date' AND `order`.dateTransaction <= '$end_date'
                ORDER BY `order`.dateTransaction DESC;
        ");
        return $query->result_array();
    }

    public function get_total_order()
    {
        $this->db->select('COUNT(DISTINCT kd_transaksi) AS total_order'); // Menggunakan COUNT dengan DISTINCT untuk menghitung transaksi unik
        $this->db->from('order');
        $this->db->where('MONTH(dateTransaction)', date('m')); // Filter bulan ini
        $this->db->where('YEAR(dateTransaction)', date('Y')); // Filter tahun ini
        $query = $this->db->get();
        return $query->row()->total_order;
    }


    public function get_total_produk()
    {
        $this->db->select('SUM(qtyOrder) AS total_produk'); // Menggunakan SUM untuk menjumlahkan jumlah produk
        $this->db->from('order');
        $this->db->where('MONTH(dateTransaction)', date('m')); // Filter bulan ini
        $this->db->where('YEAR(dateTransaction)', date('Y')); // Filter tahun ini
        $query = $this->db->get();
        return $query->row()->total_produk;
    }


    public function search($searchTerm)
    {
        $query = $this->db->query("
                SELECT 
                    `order`.kd_transaksi AS 'No Transaksi',
                    `order`.id AS 'id',
                    `order`.dateTransaction AS 'Tanggal',
                    CONCAT(customer.FirstName, ' ', customer.LastName) AS 'Nama Customer',
                    catcust.idCategoryCust AS 'idCategoryCust',
                    catcust.CategoryCust AS 'Category Customer',
                    salesadvisor.Name AS 'Sales Advisor',
                    salesadvisor.IdSales AS 'idSales',
                    paymentmethode.Methode AS 'Payment Method',
                    paymentmethode.idMethode AS 'idMethode',
                    catprod.CategoryProduk AS 'Category Produk',
                    catprod.idCategoryProduk AS 'idCategoryProduk',
                    `order`.QtyOrder AS 'Qty',
                    `order`.BasePrice AS 'Base Price',
                    `order`.Discount AS 'Disc',
                    `order`.Brand AS 'Brand',
                    `order`.SKUName AS 'SKU',
                    `order`.AfterDisc AS 'After Disc',
                    `order`.Point AS 'Point gained',
                    `order`.pointclaim AS 'Point claim',
                    `order`.keterangan AS 'Keterangan',
                    `order`.idvoucher AS 'Nama Voucher' 
                FROM `order`
                LEFT JOIN customer ON `order`.idCustomer = customer.idCustomer 
                LEFT JOIN catcust ON `order`.idCategoryCust = catcust.idCategoryCust 
                LEFT JOIN salesadvisor ON `order`.IdSales = salesadvisor.IdSales 
                LEFT JOIN paymentmethode ON `order`.idMethode = paymentmethode.idMethode 
                LEFT JOIN catprod ON `order`.idCategoryProduk = catprod.idCategoryProduk
                WHERE kd_transaksi LIKE '%$searchTerm%' OR Brand LIKE '%$searchTerm%' OR SKUName LIKE '%$searchTerm%'
                ORDER BY `order`.dateTransaction DESC;
        ");

        return $query->result_array();
    }

    public function getTransactionsByCustomerId($customerId)
    {
        $this->db->where('idCustomer', $customerId);
        return $this->db->get('order')->result_array(); // Mengambil data dari tabel 'orders'
    }

    public function get_categories()
    {
        return $this->db->get('catcust')->result();
    }

    public function get_customers()
    {
        return $this->db->get('customer')->result();
    }

    public function get_products()
    {
        return $this->db->get('catprod')->result();
    }

    public function get_payment_methods()
    {
        return $this->db->get('paymentmethode')->result();
    }

    public function get_vouchers()
    {
        $query = $this->db->get('voucher'); // Ambil semua voucher dari tabel vouchers
        return $query->result_array();
    }


    public function insert_order($order_data, $vouchers)
    {
        // Simpan data order ke tabel `order`
        $this->db->insert('order', $order_data);
        $order_id = $this->db->insert_id(); // Ambil ID order yang baru saja dibuat

        // Simpan voucher ke tabel `order_vouchers`
        if (!empty($vouchers)) {
            foreach ($vouchers as $voucher) {
                $voucher_data = [
                    'order_id' => $order_id,
                    'idvoucher' => trim($voucher),
                ];
                $this->db->insert('order_vouchers', $voucher_data);
            }
        }

        return $order_id;
    }

    public function addTransaction($data)
    {
        return $this->db->insert('transactions', $data);
    }




    public function simpan($data)
    {
        return $this->db->insert('order', $data);
    }

    public function getTransaksiById($id)
    {
        return $this->db->get_where('order', ['id' => $id])->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('order', $data);
    }


    public function deleteTransaksi($id)
    {
        $this->db->query("SET foreign_key_checks = 0;");
        $this->db->delete('order', ['id' => $id]);
        $this->db->query("SET foreign_key_checks = 1;");
    }
}
