<?php

class brand_model extends CI_Model{
    public function getBrandByCategoryId($catId)
    {
        return $this->db->where('idCategoryProduk', $catId)->get('brand')->result_array();
    }

    public function getAllBrand(){
        $sql = "SELECT b.idBrand,b.Brand, c.CategoryProduk FROM brand as b
                LEFT JOIN catprod as c ON b.idCategoryProduk = c.idCategoryProduk
                ORDER BY b.idBrand DESC";
        return $this->db->query($sql)->result_array();
    }

    public function addBrand($data){
        $sql = "INSERT INTO brand (Brand,idCategoryProduk) VALUES (?,?)";
        $this->db->query($sql, [$data['brand'], $data['id_catprod']]);
    }

    public function deleteBrand($idBrand){
        $sql = "DELETE FROM brand WHERE idBrand = ?";
        return $this->db->query($sql, [$idBrand]);
    }
}