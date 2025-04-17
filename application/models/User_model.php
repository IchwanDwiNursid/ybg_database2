<?php

class user_model extends CI_Model{
    public function getAlluser()
    {
        return $this->db->get('salesadvisor')->result_array();
    }

    public function get_user_by_username($username) {
        $this->db->where('Username', $username);
        $query = $this->db->get('salesadvisor');
        return $query->row_array();
    }

    public function tambah_salesadvisor($data) {
        return $this->db->insert('salesadvisor', $data);
    }

    public function get_salesadvisor_by_id($id) {
        $this->db->where('IdSales', $id);
        $query = $this->db->get('salesadvisor');
        return $query->row_array(); // Mengembalikan satu baris data
    }

    public function update_salesadvisor($id, $data) {
        $this->db->where('IdSales', $id);
        return $this->db->update('salesadvisor', $data);
    }

    public function hapus_salesadvisor($id) {
        $this->db->where('IdSales', $id);
        return $this->db->delete('salesadvisor');
    }
}