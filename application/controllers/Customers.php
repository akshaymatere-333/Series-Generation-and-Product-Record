<?php
class Customers extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('customers_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');

    
        if(!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'customer') {
            redirect('auth');
        }
    }

    public function index() {
        $data['available_machines'] = $this->customers_model->get_available_machines();
        $data['recent_customers'] = $this->customers_model->get_recent_customers();
        $this->load->view('customers/index', $data);
    }

    public function get_product_by_series() {
        $series_number = $this->input->post('series_number');
        $product = $this->customers_model->get_product_by_series($series_number);
        echo json_encode($product);
    }

    public function save_customer() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('series_number', 'Series Number', 'required');
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
        $this->form_validation->set_rules('dealer', 'Dealer', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
            return;
        }

        $data = [
            'company_name' => $this->input->post('customer_name'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'dealer' => $this->input->post('dealer'),
            'purchase_date' => $this->input->post('purchase_date'),
            'machine_series' => $this->input->post('series_number'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->customers_model->save_customer($data);
        echo json_encode($result);
    }
    public function delete_customer() {
        $id = $this->input->post('id');
        $result = $this->customers_model->delete_customer($id);
        echo json_encode($result);
    }
}
