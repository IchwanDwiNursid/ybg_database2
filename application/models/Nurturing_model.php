<?php

class nurturing_model extends CI_Model{
    public function get_birthdate_per_month($month) {

        $sql = "SELECT * FROM customer WHERE MONTH(Birthdate) = ?";
        return $this->db->query($sql, array($month))->result_array();
    }

    public function get_last_transaction_per_month() {
        $this->db->select('
            customer.idCustomer,
            customer.FirstName,
            customer.LastName,
            customer.PhoneNumber,
            customer.instagram,
            `order`.kd_transaksi,
            `order`.Point,
            MAX(`order`.created_at) AS last_order_date
        ');
        $this->db->from('`order`');
        $this->db->join('customer', 'customer.idCustomer = `order`.idCustomer', 'left');

        $this->db->where('`order`.deleted_at IS NULL');
        $this->db->where('MONTH(`order`.created_at)', date('m'));
        $this->db->where('YEAR(`order`.created_at)', date('Y'));

        $this->db->group_by([
            'customer.idCustomer',
            'customer.FirstName',
            'customer.LastName',
            'customer.PhoneNumber',
            'customer.instagram',
            '`order`.kd_transaksi',
            '`order`.Point'
        ]);
        
        $this->db->order_by('last_order_date', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_transaction_by_date_range($start_date, $end_date) {
        $start = date('Y-m-d 00:00:00', strtotime($start_date));
        $end = date('Y-m-d 23:59:59', strtotime($end_date));
    
        $sql = "
            SELECT 
                customer.idCustomer,
                customer.FirstName,
                customer.LastName,
                customer.PhoneNumber,
                customer.instagram,
                `order`.Point,
                `order`.kd_transaksi,
                `order`.created_at
            FROM `order`
            JOIN customer ON customer.idCustomer = `order`.idCustomer
            WHERE `order`.created_at BETWEEN ? AND ?
            ORDER BY `order`.created_at DESC
        ";
    
        return $this->db->query($sql, [$start, $end])->result_array();
    }
}