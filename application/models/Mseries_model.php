<?php
class Mseries_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_products() {
        return $this->db->get('products')->result();
    }

        public function get_total_series() {
            return $this->db->count_all('series_numbers');
        }
    
        public function get_recent_series($limit, $offset = 0) {
            // Ensure we have valid integers
            $limit = (int)$limit;
            $offset = (int)$offset;
            
            $this->db->select('series_numbers.*, products.product_name');
            $this->db->from('series_numbers');
            $this->db->join('products', 'products.id = series_numbers.product_id');
            $this->db->order_by('series_numbers.created_at', 'DESC');
            $this->db->limit($limit, $offset);
            
            return $this->db->get()->result();
        }
    

    public function delete_series($series_id) {
        $this->db->where('id', $series_id);
        return $this->db->delete('series_numbers');
    }

    public function generate_series_number($product_id) {
        $this->db->select_max('id', 'last_id');
        $this->db->where('product_id', $product_id);
        $last_series = $this->db->get('series_numbers')->row();

        $next_num = $last_series && $last_series->last_id ? $last_series->last_id + 1 : 1;
        $series_number = sprintf("P%05d%sQ", $next_num, $product_id);

        $data = array(
            'product_id' => $product_id,
            'series_number' => $series_number,
            'created_by' => $this->session->userdata('user_id')
        );

        $this->db->insert('series_numbers', $data);
        return $series_number;
    }
}