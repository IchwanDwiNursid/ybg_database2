<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class point_model extends CI_Model {

    public function get_all_data() {
        $query = $this->db->get('point');
        return $query->result_array();
    }

    public function get_last_transaction_date($customer_id) {
        $this->db->select_max('dateTransaction');
        $query = $this->db->get_where('order', array('idCustomer' => $customer_id));
        return $query->row()->dateTransaction;
    }

    public function get_new_orders($customer_id) {
        $this->db->select('o.kd_transaksi, o.Point, o.pointclaim, o.dateTransaction');
        $this->db->from('order o');
        $this->db->join('point p', 'o.kd_transaksi = p.kd_transaksi', 'left');
        $this->db->where('o.idCustomer', $customer_id);
        $this->db->where('p.kd_transaksi IS NULL');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_customer_points($customer_id) {
        $this->db->select('p.kd_transaksi, p.ActivePoint, p.PointClaim, p.expiredDate');
        $this->db->from('point p');
        $this->db->join('order o', 'p.kd_transaksi = o.kd_transaksi', 'left');
        $this->db->where('o.idCustomer', $customer_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function search_orders_by_phone($phoneNumber)
{
    // Query untuk mengambil pesanan berdasarkan nomor telepon
    $this->db->select('o.kd_transaksi, c.PhoneNumber, o.Point, o.pointclaim, o.dateTransaction');
    $this->db->from('order o');
    $this->db->join('customer c', 'o.idCustomer = c.idCustomer'); // Join dengan tabel customer
    $this->db->where('c.PhoneNumber', $phoneNumber); // Sesuaikan nama kolom sesuai tabel customer
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result_array(); // Mengembalikan data sebagai array
    } else {
        return false; // Tidak ada data ditemukan
    }
}

    public function calculate_total_points($customer_id) {
        $this->db->select_sum('ActivePoint + PointClaim', 'totalPoints');
        $this->db->from('point');
        $this->db->where('idCustomer', $customer_id);
        $query = $this->db->get();
        return $query->row()->totalPoints;
    }

    public function get_expiry_date($customer_id) {
        $last_transaction_date = $this->get_last_transaction_date($customer_id);
        return date('Y-m-d', strtotime($last_transaction_date . ' +365 days'));
    }


}
