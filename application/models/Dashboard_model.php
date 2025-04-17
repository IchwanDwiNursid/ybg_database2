<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function get_order_data() {
        $this->db->select('idCategoryProduk, COUNT(id) as count');
        $this->db->from('order');
        $this->db->group_by('idCategoryProduk');
        $query = $this->db->get();
        return $query->result_array();
    }
}
