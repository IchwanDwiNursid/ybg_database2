<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function get_user_by_username($username) {
        $this->db->where('Username', $username);
        $query = $this->db->get('salesadvisor');
        return $query->row_array();
    }

    public function tambah_salesadvisor($data) {
        return $this->db->insert('salesadvisor', $data);
    }
}
