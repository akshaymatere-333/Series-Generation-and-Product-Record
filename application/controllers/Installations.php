<?php
class Installations extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('installations_model');
        $this->load->library('session');
        $this->load->helper('url');
    
        if(!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'installation') {
            redirect('auth');
        }
    }

    public function index() {
        $data['customer_machines'] = $this->installations_model->get_customer_machines();
        $data['recent_installations'] = $this->installations_model->get_recent_installations();
        $data['tractor_hp_options'] = [
            '20hp' => '20 HP',
            '22hp' => '22 HP',
            '24hp' => '24 HP',
            '28hp' => '28 HP',
            '30hp' => '30 HP',
            '32hp' => '32 HP'
        ];
        $this->load->view('installations/index', $data);
    }

    public function get_customer_details() {
        $series_number = $this->input->post('series_number');
        $details = $this->installations_model->get_customer_details($series_number);
        echo json_encode($details);
    }

    public function save_installation() {
        $this->load->library('form_validation');
        
        // Change validation rule from series_number to machine_id
        $this->form_validation->set_rules('machine_id', 'Machine ID', 'required');
        $this->form_validation->set_rules('installation_date', 'Installation Date', 'required');
        $this->form_validation->set_rules('installed_by', 'Installed By', 'required');
        $this->form_validation->set_rules('tractor_name', 'Tractor Name', 'required');
        $this->form_validation->set_rules('tractor_hp', 'Tractor HP', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
            return;
        }
    
        $data = [
            'machine_id' => $this->input->post('machine_id'),
            'customer_id' => $this->input->post('customer_id'),
            'installation_date' => $this->input->post('installation_date'),
            'installed_by' => $this->input->post('installed_by'),
            'tractor_name' => $this->input->post('tractor_name'),
            'tractor_hp' => $this->input->post('tractor_hp'),
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        $result = $this->installations_model->save_installation($data);
        echo json_encode($result);
    }
    public function delete_installation() {
        $id = $this->input->post('id');
        $result = $this->installations_model->delete_installation($id);
        echo json_encode($result);
    }
    
    public function get_installation() {
        $id = $this->input->get('id');
        $installation = $this->installations_model->get_installation($id);
        echo json_encode($installation);
    }
    
    public function update_installation() {
        $id = $this->input->post('id');
        $data = [
            'installation_date' => $this->input->post('installation_date'),
            'installed_by' => $this->input->post('installed_by'),
            'tractor_name' => $this->input->post('tractor_name'),
            'tractor_hp' => $this->input->post('tractor_hp')
        ];
        
        $result = $this->installations_model->update_installation($id, $data);
        echo json_encode($result);
    }
}