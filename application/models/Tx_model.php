<?php

class tx_model extends CI_Model{
    public function getDetailOrder() {
        $sql = "SELECT o.id, o.kd_transaksi, o.SKUName as Tipe,  o.Alamat, b.Brand , c.CategoryProduk, d.status_shipping, d.ongkir, d.asuransi  FROM `order` as o 
        LEFT JOIN detail_order as d on o.id = d.idOrder
        LEFT JOIN catprod as c ON o.idCategoryProduk = c.idCategoryProduk
        LEFT JOIN Brand as b ON o.Brand = b.idBrand 
        WHERE o.deleted_at IS NULL
        ORDER BY o.id DESC";
        return $this->db->query($sql)->result_array();
    }

    public function get_detail_order_by_range($data) {
        $sql = "SELECT o.id, o.kd_transaksi, o.SKUName as Tipe,  o.Alamat, b.Brand , c.CategoryProduk, d.status_shipping, d.ongkir, d.asuransi  FROM `order` as o 
        LEFT JOIN detail_order as d on o.id = d.idOrder
        LEFT JOIN catprod as c ON o.idCategoryProduk = c.idCategoryProduk
        LEFT JOIN Brand as b ON o.Brand = b.idBrand 
        WHERE o.deleted_at IS NULL
        AND o.created_at BETWEEN ? AND ?
        ORDER BY o.id DESC";
        return $this->db->query($sql,[$data['start_date'], $data['end_date']])->result_array();
    }

    public function createDetailOrder($tx) {
        $this->db->insert('detail_order', $tx);
    }

    public function updateDetailOrder($data) {
        $this->db->where('idOrder' , $data['id']);
        return $this->db->update('detail_order', $data);
    }

    public function search($searchTerm)
    {
        $query = $this->db->query("
                SELECT 
                    o.id,
                    o.kd_transaksi,
                    o.SKUName as Tipe,
                    o.Alamat, b.Brand,
                    c.CategoryProduk,
                    d.status_shipping,
                    d.ongkir,
                    d.asuransi 
                FROM `order` as o
                LEFT JOIN detail_order as d on o.id = d.idOrder
                LEFT JOIN catprod as c ON o.idCategoryProduk = c.idCategoryProduk
                LEFT JOIN Brand as b ON o.Brand = b.idBrand
                WHERE (
                    o.kd_transaksi LIKE '%$searchTerm%' 
                    OR b.Brand LIKE '%$searchTerm%' 
                    OR o.SKUName LIKE '%$searchTerm%'
                )
                AND o.deleted_at IS NULL
                ORDER BY o.dateTransaction DESC;
        ");

        return $query->result_array();
    }

    public function edit($data) {
        $this->db->where('id', $data['id']);
        return $this->db->update('detail_order', $data);
    }
}