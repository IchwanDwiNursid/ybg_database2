<?php

class voucher_model extends CI_Model{
    public function getAllvoucher()
    {
        return $this->db->get('voucher')->result_array();
    }

    public function tambahVoucher()
    {
        $data = [
            "idvoucher" => $this->input->post('kdvoucher',true),
            "namavoucher" => $this->input->post('voucher',true),
            "nominal" => $this->input->post('nominal',true),
        ];

        $this->db->insert('voucher',$data);
    }

    public function hapusVoucher($id)
    {
        $this->db->where('idvoucher', $id);
        $this->db->delete('voucher');
    }

    public function updateVoucher($id)
    {
        $data = [
            "idvoucher" => $this->input->post('idvoucher', true),
            "namavoucher" => $this->input->post('namavoucher', true),
            "nominal" => $this->input->post('nominal', true),
        ];

        $this->db->where('idvoucher', $id);
        $this->db->update('voucher', $data);
    }

    public function getVoucherById($id)
    {
        $this->db->where('idvoucher', $id);
        return $this->db->get('voucher')->row_array();
    }
}