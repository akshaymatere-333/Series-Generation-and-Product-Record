<?php
class Customers_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_available_machines() {
        $this->db->select('machines.series_number');
        $this->db->from('machines');
        $this->db->where('machines.series_number NOT IN (SELECT machine_series FROM customers)');
        return $this->db->get()->result();
    }

    public function get_product_by_series($series_number) {
        $this->db->select('products.product_name');
        $this->db->from('series_numbers');
        $this->db->join('products', 'products.id = series_numbers.product_id');
        $this->db->where('series_numbers.series_number', $series_number);
        return $this->db->get()->row();
    }

    public function save_customer($data) {
        try {
            $this->db->trans_start();
            $this->db->insert('customers', $data);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Failed to save customer data');
            }

            return ['success' => true, 'message' => 'Customer saved successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function get_recent_customers() {
        $this->db->select('customers.*, series_numbers.series_number, products.product_name');
        $this->db->from('customers');
        $this->db->join('machines', 'machines.series_number = customers.machine_series');
        $this->db->join('series_numbers', 'series_numbers.series_number = machines.series_number');
        $this->db->join('products', 'products.id = series_numbers.product_id');
        $this->db->order_by('customers.created_at', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

    public function delete_customer($id) {
        try {
            $this->db->where('id', $id);
            $this->db->delete('customers');
            return ['success' => true, 'message' => 'Customer deleted successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
