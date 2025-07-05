<?php

class customer_model extends CI_Model
{
    public function getAllCustomer()
    {
        $this->db->select('customer.*, alamat.Alamat');
        $this->db->from('customer');
        $this->db->join('alamat', 'alamat.idCustomer = customer.idCustomer', 'left')->order_by('customer.FirstName', 'ASC');
        return $this->db->get()->result_array();
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

        $idCustomer = $this->db->insert_id();

        $alamatData = [
            "Alamat" => $this->input->post('Alamat', true),
            "KodePos" => $this->input->post('KodePos', true),
            "idCustomer" => $idCustomer
        ];

        $this->db->insert('alamat', $alamatData);
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
        $this->db->where('customer.PhoneNumber', $phone);
        $this->db->join('alamat', 'alamat.idCustomer = customer.idCustomer');
        $query = $this->db->get('customer');
        return $query->row_array();
    }

    public function updateCustomer($id)
    {
        $customerData = [
            "FirstName" => $this->input->post('FirstName', true),
            "LastName" => $this->input->post('LastName', true),
            "Birthdate" => $this->input->post('Birthdate', true),
            "PhoneNumber" => $this->input->post('PhoneNumber', true),
            "instagram" => $this->input->post('instagram', true)
        ];
        
        $this->db->where('idCustomer', $id);
        $this->db->update('customer', $customerData);
        
        // Check if address exists
        $this->db->where('idCustomer', $id);
        $addressExists = $this->db->get('alamat')->row();

        $addressData = [
        "Alamat" => $this->input->post('Alamat', true),
        "KodePos" => $this->input->post('KodePos', true),
        "idCustomer" => $id
        ];

        // If address exists, UPDATE; else, INSERT
        if ($addressExists) {
            $this->db->where('idCustomer', $id);
            $this->db->update('alamat', $addressData);
        } else {
            $this->db->insert('alamat', $addressData);
        }
    }

    public function getCustomerById($id)
    {
        $this->db->select('customer.*, alamat.Alamat, alamat.KodePos');
        $this->db->from('customer');
        $this->db->join('alamat', 'alamat.idCustomer = customer.idCustomer', 'left');
        $this->db->where('customer.idCustomer', $id);
        return $this->db->get()->row_array();
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
        $this->db->select('customer.*, alamat.Alamat'); // Memilih semua kolom dari customer dan alamat
        $this->db->from('customer');
        $this->db->join('alamat', 'alamat.idCustomer = customer.idCustomer', 'left'); // Lakukan JOIN
        
        $this->db->like('FirstName', $searchTerm);
        $this->db->or_like('LastName', $searchTerm);
        $this->db->or_like('PhoneNumber', $searchTerm);
        
        $query = $this->db->get();
        return $query->result_array();
        
    }

    public function get_customer_details($idCustomer)
    {
        
        $this->db->select(
            'c.idCustomer, c.FirstName, c.LastName, c.Birthdate, c.PhoneNumber, c.instagram,
            GROUP_CONCAT(o.kd_transaksi) AS kd_transaksi_list,
            GROUP_CONCAT(o.Point) AS point_list,
            GROUP_CONCAT(o.pointclaim) AS pointclaim_list,
            GROUP_CONCAT(o.dateTransaction) AS datetransaction_list'
        );
        $this->db->from('customer c');
        $this->db->join('`order` o', 'c.idCustomer = o.idCustomer', 'left');
        $this->db->where('c.idCustomer', $idCustomer);
        $this->db->where('o.deleted_at IS NULL');
        $this->db->group_by('c.idCustomer');
        
        $query = $this->db->get();

        
        if ($query->num_rows() > 0) {

            $customer = $query->row_array();

            // TODO: Have Problem
            $customer['kd_transaksi'] = !empty($customer['kd_transaksi_list']) ? explode(',', $customer['kd_transaksi_list']) : [];
            $customer['points'] = !empty($customer['point_list']) ? explode(',', $customer['point_list']) : ["0"];
            $customer['pointclaims'] = !empty($customer['pointclaim_list']) ? explode(',', $customer['pointclaim_list']) : ["0"];
            $customer['datetransactions'] = !empty($customer['datetransaction_list']) ? explode(',', $customer['datetransaction_list']) : [];
            
            unset($customer['kd_transaksi_list'], $customer['point_list'], $customer['pointclaim_list'], $customer['datetransaction_list']);
            
            $customer['FirstName'] = !empty($customer['FirstName']) ? htmlspecialchars($customer['FirstName']) : 'N/A';
            $customer['LastName'] = !empty($customer['LastName']) ? htmlspecialchars($customer['LastName']) : '';
            $customer['Birthdate'] = !empty($customer['Birthdate']) ? htmlspecialchars($customer['Birthdate']) : 'N/A';
            $customer['PhoneNumber'] = !empty($customer['PhoneNumber']) ? htmlspecialchars($customer['PhoneNumber']) : 'N/A';
            $customer['instagram'] = !empty($customer['instagram']) ? htmlspecialchars($customer['instagram']) : 'N/A';
            
            $current_date = time();
            $expiration_dates = [];
            
            
            // log_message('info', 'Points'.json_encode($customer['pointclaims']));
            // TODO : ---------------------- Problem in Here --------------------
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

            $all_points = [];
            $all_claims = [];

            foreach ($customer['datetransactions'] as $index => $transaction_date) {
                if (isset($customer['points'][$index], $customer['pointclaims'][$index])) {
                    $transaction_timestamp = strtotime($transaction_date);
                    $expiration_date = strtotime('+1 year', $transaction_timestamp);

                    $expiration_dates[] = date('Y-m-d', $expiration_date);

                    // TODO : Perlu Perbaikan logic
                    if ($current_date <= $expiration_date) {
                        $point = (int) $customer['points'][$index] ?? 0;  // konversi ke int, jika null/jangan error
                        $claim = (int) $customer['pointclaims'][$index];
                        $all_points[] = $point;
                        $all_claims[] = $claim;
                    }
                }
            }
           
            $total_active_points = array_sum($all_points) - array_sum($all_claims);

            $customer['active_points'] = $total_active_points;
            $customer['expiration_date'] = !empty($expiration_dates) ? max($expiration_dates) : 'N/A';

            return $customer;
        } else {
            return null;
        }
    }

    public function getCustomerByPhoneNumber($phoneNumber)
    {
        $this->db->select('customer.PhoneNumber, customer.FirstName, alamat.Alamat, customer.LastName');
        $this->db->from('customer');
        $this->db->join('alamat', 'customer.idCustomer = alamat.idCustomer', 'left');
        $this->db->like('customer.PhoneNumber', $phoneNumber);
        $this->db->limit(10);
        return $this->db->get()->result_array();
    }
}
