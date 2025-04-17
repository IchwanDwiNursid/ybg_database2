<?php

class categoryCust_model extends CI_Model{
    public function getAllCategoryCust()
    {
        return $this->db->get('catcust')->result_array();
    }

    public function tambahCategory()
    {
        $data = [
            "categoryCust" => $this->input->post('category',true),
        ];

        $this->db->insert('catcust',$data);
    }

    public function hapuscategory($id)
    {
        $this->db->where('idCategoryCust', $id);
        $this->db->delete('catcust');
    }

    public function updatecatCust($id)
    {
        $data = [
            "CategoryCust" => $this->input->post('CategoryCust', true),
        ];

        $this->db->where('idCategoryCust', $id);
        $this->db->update('catcust', $data);
    }

    public function getCatCustById($id)
    {
        $this->db->where('idCategoryCust', $id);
        return $this->db->get('catcust')->row_array();
    }
}