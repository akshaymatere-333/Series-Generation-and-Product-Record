<?php

class Mseries extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mseries_model');
        $this->load->library('session');
        $this->load->helper('url');

        if(!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'mseries') {
            redirect('auth');
        }
    }

    public function index() {
        // Get total rows first
        $total_rows = $this->mseries_model->get_total_series();
        
        // Basic pagination config
        $config = array(
            'base_url'      => site_url('mseries/index'),
            'total_rows'    => $total_rows,
            'per_page'      => 10,
            'num_links'     => 5,
            'use_page_numbers' => FALSE
        );
        
        // Load pagination library
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        // Get current offset
        $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // Get data
        $data['products'] = $this->mseries_model->get_all_products();
        $data['recent_series'] = $this->mseries_model->get_recent_series($config['per_page'], $page);
        
        // Only create pagination links if there's more than one page
        $data['pagination'] = ($total_rows > $config['per_page']) ? $this->pagination->create_links() : '';
        
        // Load view
        $this->load->view('mseries/index', $data);
    }
    public function delete_series() {
        $series_id = $this->input->post('series_id');
        
        if (empty($series_id)) {
            echo json_encode(['success' => false, 'message' => 'Invalid series ID']);
            return;
        }
    
        try {
            $this->mseries_model->delete_series($series_id);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            log_message('error', 'Series deletion error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Failed to delete series number']);
        }
    }

    public function generate_series() {
        $product_id = $this->input->post('product_id');
        
        if (empty($product_id)) {
            echo json_encode(['success' => false, 'message' => 'Invalid product selection']);
            return;
        }

        try {
            $series_number = $this->mseries_model->generate_series_number($product_id);
            echo json_encode(['success' => true, 'series_number' => $series_number]);
        } catch (Exception $e) {
            log_message('error', 'Series generation error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Failed to generate series number']);
        }
    }
}