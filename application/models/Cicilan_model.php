<?php

class Cicilan_model extends CI_Model
{
    public function getAllCicilan()
    {
        $this->db->select('
        cicilan.id,
        cicilan.totalCicilan,
        cicilan.cicilan_ke,
        cicilan.jumlahAngsuran,
        cicilan.sisaCicilan,
        cicilan.jatuhTempo,
        cicilan.status,
        customer.FirstName,
        customer.LastName,
        `order`.kd_transaksi,
        brand.Brand
    ');
        $this->db->from('cicilan');
        $this->db->join('customer', 'customer.idCustomer = cicilan.idCustomer', 'left');
        $this->db->join('order', 'order.id = cicilan.idOrder', 'left');
        $this->db->join('brand', 'brand.idBrand = order.Brand', 'left');
        $this->db->where('cicilan.deleted_at IS NULL');
        $this->db->order_by('cicilan.jatuhTempo', 'ASC');
        
        return $this->db->get()->result_array();
    }

    public function createCicilan($data)
    {
        $this->db->insert('cicilan', $data);
    }

    public function deleteCicilan($id)
    {
        $this->db->where('idCicilan', $id);
        $this->db->update('bayar_cicilan', ['deleted_at' => date('Y-m-d H:i:s')]);

        $this->db->where('id', $id);
        $this->db->update('cicilan', ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function get_all_bayar_cicilan($idCicilan) 
    {
           $this->db->select('bayar_cicilan.*, salesadvisor.Username');
           $this->db->from('bayar_cicilan');
           $this->db->where('idCicilan', $idCicilan);
           $this->db->join('salesadvisor', 'salesadvisor.IdSales = bayar_cicilan.idSales', 'left');
           return $this->db->get()->result_array();
    }

    public function create_bayar_cicilan($data) 
    {
        return $this->db->insert('bayar_cicilan', $data);
    }

    public function update_cicilan($id, $data) {
        if ($data["status"]) {
            $this->db->set('cicilan_ke', 'cicilan_ke + 1', FALSE);
            $this->db->set('sisaCicilan', $data['sisaCicilanBaru']); 
            $this->db->set('status', $data['status']);
            $this->db->set('jumlahAngsuran', 'jumlahAngsuran + ' . $data['amount'], FALSE);
            $this->db->where('id', $id);
            $this->db->update('cicilan');
        } else {
            $this->db->set('cicilan_ke', 'cicilan_ke + 1', FALSE);
            $this->db->set('sisaCicilan', $data['sisaCicilanBaru']); 
            $this->db->set('jumlahAngsuran', 'jumlahAngsuran + ' . $data['amount'], FALSE);
            $this->db->where('id', $id);
            $this->db->update('cicilan');
        }
        
    }

    public function get_sisa_cicilan($id) 
    {
        $this->db->select('sisaCicilan');
        $this->db->where('id', $id);
        $query = $this->db->get('cicilan');
        $row = $query->row();
        return $row;
    }
}