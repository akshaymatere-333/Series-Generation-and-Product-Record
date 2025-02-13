<?php
class Machines_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_available_series_numbers() {
        $used_series = $this->db->select('series_number')
                                ->from('machines')
                                ->get()
                                ->result_array();
        
        $used_series_numbers = array_column($used_series, 'series_number');

        $this->db->select('series_numbers.series_number, products.product_name');
        $this->db->from('series_numbers');
        $this->db->join('products', 'products.id = series_numbers.product_id');
        
        if (!empty($used_series_numbers)) {
            $this->db->where_not_in('series_numbers.series_number', $used_series_numbers);
        }
        
        return $this->db->get()->result();
    }

    public function get_product_by_series($series_number) {
        $this->db->select('products.product_name');
        $this->db->from('series_numbers');
        $this->db->join('products', 'products.id = series_numbers.product_id');
        $this->db->where('series_numbers.series_number', $series_number);
        
        $result = $this->db->get()->row();
        return $result ? $result : null;
    }

    public function save_machine_details($data) {
        try {
            // Validate data before insertion
            if (empty($data['series_number'])) {
                throw new Exception('Series number is required');
            }
    
            // Check if series number already exists
            $existing = $this->db->get_where('machines', ['series_number' => $data['series_number']])->row();
            
            if ($existing) {
                throw new Exception('Series number already used');
            }
            
            // Attempt to insert
            $insert_result = $this->db->insert('machines', $data);
            
            if (!$insert_result) {
                // Get database error
                $error = $this->db->error();
                throw new Exception('Database insert error: ' . $error['message']);
            }
            
            return true;
        } catch (Exception $e) {
            // Log the error
            log_message('error', 'Machine save error: ' . $e->getMessage());
            return false;
        }
    }

    public function get_recent_machines($limit = 10) {
        $this->db->select('machines.*, series_numbers.series_number, products.product_name');
        $this->db->from('machines');
        $this->db->join('series_numbers', 'series_numbers.series_number = machines.series_number');
        $this->db->join('products', 'products.id = series_numbers.product_id');
        $this->db->order_by('machines.id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    public function delete_machine($machine_id) {
        try {
            // First, check if the machine exists
            $existing = $this->db->get_where('machines', ['id' => $machine_id])->row();
            
            if (!$existing) {
                throw new Exception('Machine not found');
            }
            
            // Attempt to delete the machine
            $this->db->where('id', $machine_id);
            $delete_result = $this->db->delete('machines');
            
            if (!$delete_result) {
                // Get database error
                $error = $this->db->error();
                throw new Exception('Database delete error: ' . $error['message']);
            }
            
            return true;
        } catch (Exception $e) {
            // Log the error
            log_message('error', 'Machine delete error: ' . $e->getMessage());
            return false;
        }
    }


}