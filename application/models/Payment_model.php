<?php

class payment_model extends CI_Model{
    public function getAllpayment()
    {
        return $this->db->get('paymentmethode')->result_array();
    }

    public function tambahPayment()
    {
        $data = [
            "methode" => $this->input->post('payment',true),
        ];

        $this->db->insert('paymentmethode',$data);
    }

    public function hapusPayment($id)
    {
        $this->db->where('idMethode', $id);
        $this->db->delete('paymentmethode');
    }

    public function updatePayment($id)
    {
        $data = [
            "methode" => $this->input->post('payment', true),
        ];

        $this->db->where('idMethode', $id);
        $this->db->update('paymentmethode', $data);
    }

    public function getPaymentById($id)
    {
        $this->db->where('idMethode', $id);
        return $this->db->get('paymentmethode')->row_array();
    }
}