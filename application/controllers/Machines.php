<?php
class Machines extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('machines_model');
        $this->load->library('session');
        $this->load->helper('url');
    
        if(!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'machine') {
            redirect('auth');
        }
    }
    public function index() {
        $data['available_series'] = $this->machines_model->get_available_series_numbers();
        $data['recent_machines'] = $this->machines_model->get_recent_machines();
        $this->load->view('machines/index', $data);
    }

    public function get_product_by_series() {
        $series_number = $this->input->post('series_number');
        
        if (empty($series_number)) {
            echo json_encode(['error' => 'No series number provided']);
            return;
        }

        $product = $this->machines_model->get_product_by_series($series_number);
        
        if ($product) {
            echo json_encode($product);
        } else {
            echo json_encode(['error' => 'Product not found']);
        }
    }

    public function save_machine_details() {
        // Enable error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    
        try {
            // Validate input
            $this->load->library('form_validation');
            $this->form_validation->set_rules('series_number', 'Series Number', 'required|trim');
            $this->form_validation->set_rules('pump_detail', 'Pump Detail', 'required|trim');
            $this->form_validation->set_rules('pump_maker', 'Pump Maker', 'required|trim');
            $this->form_validation->set_rules('pump_series_no', 'Pump Series Number', 'required|trim');
    
            if ($this->form_validation->run() == FALSE) {
                throw new Exception(strip_tags(validation_errors()));
            }
    
            $data = [
                'series_number' => $this->input->post('series_number'),
                'pump_detail' => $this->input->post('pump_detail'),
                'pump_maker' => $this->input->post('pump_maker'),
                'pump_series_no' => $this->input->post('pump_series_no'),
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            // Additional logging
            log_message('debug', 'Attempting to save machine details: ' . print_r($data, true));
    
            $result = $this->machines_model->save_machine_details($data);
    
            if ($result) {
                echo json_encode([
                    'success' => true, 
                    'message' => 'Machine details saved successfully'
                ]);
            } else {
                throw new Exception('Failed to save machine details');
            }
        } catch (Exception $e) {
            // Log the full error
            log_message('error', 'Machine details save error: ' . $e->getMessage());
    
            // Return error response
            echo json_encode([
                'success' => false, 
                'message' => $e->getMessage()
            ]);
            
            // Ensure script stops after error
            exit;
        }
    }
    public function delete_machine($machine_id) {
        // Validate machine_id
        if (empty($machine_id)) {
            echo json_encode([
                'success' => false, 
                'message' => 'Invalid machine ID'
            ]);
            return;
        }

        try {
            $result = $this->machines_model->delete_machine($machine_id);

            if ($result) {
                echo json_encode([
                    'success' => true, 
                    'message' => 'Machine deleted successfully'
                ]);
            } else {
                echo json_encode([
                    'success' => false, 
                    'message' => 'Failed to delete machine'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false, 
                'message' => $e->getMessage()
            ]);
        }
    }
    


}