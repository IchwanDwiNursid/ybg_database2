<?php

class categoryProduk_model extends CI_Model{
    public function getAllCategoryProduk()
    {
        return $this->db->get('catprod')->result_array();
    }

    public function tambahCategory()
    {
        $data = [
            "CategoryProduk" => $this->input->post('category',true),
        ];

        $this->db->insert('catprod',$data);
    }

    public function hapuscategory($id)
    {
        $this->db->where('idCategoryProduk', $id);
        $this->db->delete('catprod');
    }

    public function updateCategoryProduk($id)
    {
        $data = [
            "CategoryProduk" => $this->input->post('category', true),
        ];

        $this->db->where('idCategoryProduk', $id);
        $this->db->update('catprod', $data);
    }

    public function getCategoryProdukById($id)
    {
        $this->db->where('idCategoryProduk', $id);
        return $this->db->get('catprod')->row_array();
    }
}