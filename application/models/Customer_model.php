<?php

class customer_model extends CI_Model
{
    public function getAllCustomer()
    {
        return $this->db->get('customer')->result_array();
    }

    public function tambahCustomer()
    {
        $data = [
            "FirstName" => $this->input->post('FirstName', true),
            "LastName" => $this->input->post('LastName', true),
            "Birthdate" => $this->input->post('Birthdate', true),
            "PhoneNumber" => $this->input->post('PhoneNumber', true),
            "Instagram" => $this->input->post('Instagram', true),
        ];

        $this->db->insert('customer', $data);
    }

    public function hapusCustomer($id)
    {
        $this->db->where('idCustomer', $id);
        $this->db->delete('customer');
    }

    public function get_customers_by_bulan_lahir($bulan = null)
    {
        // Jika bulan dipilih, filter data berdasarkan bulan
        if ($bulan) {
            $this->db->where('MONTH(Birthdate)', $bulan);
        }

        // Ambil semua data user jika bulan tidak dipilih
        $query = $this->db->get('customer');
        return $query->result_array();
    }

    public function get_customer_by_phone($phone)
    {
        $this->db->where('PhoneNumber', $phone);
        $query = $this->db->get('customer');
        return $query->row_array();
    }

    public function updateCustomer($id)
    {
        $data = [
            "FirstName" => $this->input->post('FirstName', true),
            "LastName" => $this->input->post('LastName', true),
            "Birthdate" => $this->input->post('Birthdate', true),
            "PhoneNumber" => $this->input->post('PhoneNumber', true),
            "instagram" => $this->input->post('instagram', true)
        ];

        $this->db->where('idCustomer', $id);
        $this->db->update('customer', $data);
    }

    public function getCustomerById($id)
    {
        $this->db->where('idCustomer', $id);
        return $this->db->get('customer')->row_array();
    }

    public function get_total_customers()
    {
        $this->db->select('COUNT(*) AS total_customer');
        $this->db->from('customer');
        $query = $this->db->get();
        return $query->row()->total_customer;
    }

    public function searchCustomer($searchTerm)
    {
        $this->db->like('FirstName', $searchTerm); // Mencari di kolom FirstName
        $this->db->or_like('LastName', $searchTerm); // Mencari di kolom LastName
        $this->db->or_like('PhoneNumber', $searchTerm); // Mencari di kolom PhoneNumber
        $query = $this->db->get('customer'); // Melakukan kueri pencarian
        return $query->result_array();
    }

    public function get_customer_details($idCustomer)
    {
        $this->db->select(
            'c.idCustomer, c.FirstName, c.LastName, c.Birthdate, c.PhoneNumber, c.instagram,
        GROUP_CONCAT(o.kd_transaksi) AS kd_transaksi_list,
        GROUP_CONCAT(o.Point) AS point_list,
        GROUP_CONCAT(o.pointclaim) AS pointclaim_list,
        GROUP_CONCAT(o.datetransaction) AS datetransaction_list'
        );
        $this->db->from('customer c');
        $this->db->join('`order` o', 'c.idCustomer = o.idCustomer', 'left');
        $this->db->where('c.idCustomer', $idCustomer);
        $this->db->group_by('c.idCustomer');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $customer = $query->row_array();

            $customer['kd_transaksi'] = !empty($customer['kd_transaksi_list']) ? explode(',', $customer['kd_transaksi_list']) : [];
            $customer['points'] = !empty($customer['point_list']) ? explode(',', $customer['point_list']) : [];
            $customer['pointclaims'] = !empty($customer['pointclaim_list']) ? explode(',', $customer['pointclaim_list']) : [];
            $customer['datetransactions'] = !empty($customer['datetransaction_list']) ? explode(',', $customer['datetransaction_list']) : [];

            unset($customer['kd_transaksi_list'], $customer['point_list'], $customer['pointclaim_list'], $customer['datetransaction_list']);

            $customer['FirstName'] = !empty($customer['FirstName']) ? htmlspecialchars($customer['FirstName']) : 'N/A';
            $customer['LastName'] = !empty($customer['LastName']) ? htmlspecialchars($customer['LastName']) : '';
            $customer['Birthdate'] = !empty($customer['Birthdate']) ? htmlspecialchars($customer['Birthdate']) : 'N/A';
            $customer['PhoneNumber'] = !empty($customer['PhoneNumber']) ? htmlspecialchars($customer['PhoneNumber']) : 'N/A';
            $customer['instagram'] = !empty($customer['instagram']) ? htmlspecialchars($customer['instagram']) : 'N/A';

            $current_date = time();
            $total_active_points = 0;
            $expiration_dates = [];

            $minSize = min(
                count($customer['kd_transaksi']),
                count($customer['points']),
                count($customer['pointclaims']),
                count($customer['datetransactions'])
            );

            $customer['kd_transaksi'] = array_slice($customer['kd_transaksi'], 0, $minSize);
            $customer['points'] = array_slice($customer['points'], 0, $minSize);
            $customer['pointclaims'] = array_slice($customer['pointclaims'], 0, $minSize);
            $customer['datetransactions'] = array_slice($customer['datetransactions'], 0, $minSize);

            foreach ($customer['datetransactions'] as $index => $transaction_date) {
                if (isset($customer['points'][$index], $customer['pointclaims'][$index])) {
                    $transaction_timestamp = strtotime($transaction_date);
                    $expiration_date = strtotime('+1 year', $transaction_timestamp);

                    $expiration_dates[] = date('Y-m-d', $expiration_date);

                    if ($current_date <= $expiration_date) {
                        $total_active_points += max(0, $customer['points'][$index] - $customer['pointclaims'][$index]);
                    }
                }
            }

            $customer['active_points'] = $total_active_points;
            $customer['expiration_date'] = !empty($expiration_dates) ? max($expiration_dates) : 'N/A';

            return $customer;
        } else {
            return null;
        }
    }
}
