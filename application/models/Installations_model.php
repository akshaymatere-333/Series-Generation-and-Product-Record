<?php
class Installations_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // public function get_customer_machines() {
    //     $this->db->select('c.id, c.machine_series as series_number, c.company_name');
    //     $this->db->from('customers c');
    //     $this->db->where('c.machine_series NOT IN (SELECT m.series_number FROM machines m 
    //                       JOIN installations i ON m.id = i.machine_id)');
    //     $this->db->order_by('c.machine_series', 'ASC');
    //     return $this->db->get()->result();
    // }   

    public function get_customer_details($series_number) {
        $this->db->select('m.id as machine_id, p.product_name, c.company_name, c.phone');
        $this->db->from('machines m');
        $this->db->join('series_numbers sn', 'sn.series_number = m.series_number');
        $this->db->join('products p', 'p.id = sn.product_id');
        $this->db->join('customers c', 'c.machine_series = m.series_number');
        $this->db->where('m.series_number', $series_number);
        return $this->db->get()->row();
    }

    public function get_customer_machines() {
        $this->db->select('m.id, m.series_number, c.company_name');
        $this->db->from('machines m');
        $this->db->join('customers c', 'c.machine_series = m.series_number');
        $this->db->where('m.id NOT IN (SELECT machine_id FROM installations WHERE machine_id IS NOT NULL)', NULL, FALSE);
        $this->db->order_by('m.series_number', 'ASC');
        return $this->db->get()->result();
    }
    
    public function save_installation($data) {
        try {
            // Start transaction
            $this->db->trans_start();
            
            // Check if machine_id exists and not already installed
            $existing = $this->db->get_where('installations', ['machine_id' => $data['machine_id']])->num_rows();
            if ($existing > 0) {
                throw new Exception('This machine is already installed');
            }
    
            // Insert the installation data
            $success = $this->db->insert('installations', [
                'machine_id' => $data['machine_id'],
                'installation_date' => $data['installation_date'],
                'installed_by' => $data['installed_by'],
                'tractor_name' => $data['tractor_name'],
                'tractor_hp' => $data['tractor_hp'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
    
            if (!$success) {
                throw new Exception('Failed to insert installation data');
            }
    
            // Complete transaction
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }
    
            return ['success' => true, 'message' => 'Installation saved successfully'];
        } catch (Exception $e) {
            // Rollback transaction
            $this->db->trans_rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function get_recent_installations() {
        $this->db->select('i.*, m.series_number, p.product_name, c.company_name');
        $this->db->from('installations i');
        $this->db->join('machines m', 'm.id = i.machine_id');
        $this->db->join('series_numbers sn', 'sn.series_number = m.series_number');
        $this->db->join('products p', 'p.id = sn.product_id');
        $this->db->join('customers c', 'c.machine_series = m.series_number');
        $this->db->order_by('i.created_at', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
    public function delete_installation($id) {
        try {
            $this->db->where('id', $id);
            $this->db->delete('installations');
            return ['success' => true, 'message' => 'Installation deleted successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function get_installation($id) {
        return $this->db->get_where('installations', ['id' => $id])->row();
    }

    public function update_installation($id, $data) {
        try {
            $this->db->where('id', $id);
            $this->db->update('installations', $data);
            return ['success' => true, 'message' => 'Installation updated successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}