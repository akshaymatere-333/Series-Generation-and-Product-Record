<?php
class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('download'); // Add this line
    
    // Create export directory if it doesn't exist
    $export_path = FCPATH . 'uploads/exports';
    if (!file_exists($export_path)) {
        mkdir($export_path, 0777, true);
    }
        // // Restrict access to admin only
        // if(!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
        //     redirect('auth');
        // }
    }

    public function index() {
        // Get search term from GET parameters
        $search = $this->input->get('search', TRUE);
        
        // Fetch users
        $data['users'] = $this->admin_model->get_all_users();
        
        // Pagination configuration
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/index');
        $config['total_rows'] = $this->admin_model->count_series_details($search);
        $config['per_page'] = 5;
        $config['reuse_query_string'] = TRUE; // Important for preserving search parameter
        
        // Pagination styling (keep existing styling)
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        
        // Get page from URL
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // Fetch paginated series details with search
        $data['series_details'] = $this->admin_model->get_series_details($config['per_page'], $page, $search);
        $data['pagination'] = $this->pagination->create_links();
        
        // Add search term to data array
        $data['search'] = $search;
        
        // Keep existing dashboard stats
        $data['total_series'] = $this->admin_model->get_total_series();
        $data['total_machines'] = $this->admin_model->get_total_machines();
        $data['total_customers'] = $this->admin_model->get_total_customers();
        $data['total_installations'] = $this->admin_model->get_total_installations();
        $data['total_products'] = $this->admin_model->get_total_products();
        $data['total_users'] = $this->admin_model->get_total_users();
        // $this->load->view('admin/header');

        $this->load->view('admin/dashboard', $data);
        // $this->load->view('admin/users');
        // $this->load->view('admin/series');

        // $this->load->view('admin/footer');


    }
    public function add_user() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('employee_name', 'Employee Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
            return;
        }
        
        $data = [
            'username' => $this->input->post('username'),
            'employee_name' => $this->input->post('employee_name'),
            'password' => $this->input->post('password'),
            'role' => $this->input->post('role')
        ];
        
        $result = $this->admin_model->add_user($data);
        echo json_encode($result);
    }

    public function edit_user() {
        $id = $this->input->post('id');
        $data = [
            'username' => $this->input->post('username'),
            'employee_name' => $this->input->post('employee_name'),
            'role' => $this->input->post('role')
        ];
        
        // Only update password if provided
        if ($this->input->post('password')) {
            $data['password'] = $this->input->post('password');
        }
        
        $result = $this->admin_model->update_user($id, $data);
        echo json_encode($result);
    }

    public function delete_user() {
        $id = $this->input->post('id');
        $result = $this->admin_model->delete_user($id);
        echo json_encode($result);
    }

    public function get_user() {
        $id = $this->input->get('id');
        $user = $this->admin_model->get_user($id);
        echo json_encode($user);
    }
    public function export_series() {
        try {
            $format = $this->input->post('format');
            $columns = $this->input->post('columns');
            $search = $this->input->post('search');
    
            if (empty($format) || empty($columns)) {
                throw new Exception('Format or columns are empty');
            }
    
            // Get the filtered data first
            $series_data = $this->admin_model->get_filtered_series_for_export($columns, $search);
            
            if (empty($series_data)) {
                throw new Exception('No data available to export');
            }
    
            $export_path = FCPATH . 'uploads/exports';
            if (!file_exists($export_path)) {
                if (!mkdir($export_path, 0777, true)) {
                    throw new Exception('Failed to create export directory');
                }
            }
    
            $filename = 'series_details_' . date('Y-m-d_H-i-s');
    
            if ($format === 'excel') {
                require_once APPPATH . 'third_party/PHPExcel/PHPExcel.php';
                
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0);
                
                // Add headers
                $col = 0;
                foreach ($columns as $column) {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(
                        $col, 
                        1, 
                        ucwords(str_replace('_', ' ', $column))
                    );
                    $col++;
                }
                
                // Add data
                $row = 2;
                foreach ($series_data as $data) {
                    $col = 0;
                    foreach ($columns as $column) {
                        $value = isset($data->$column) ? $data->$column : '';
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                        $col++;
                    }
                    $row++;
                }
                
                $filename .= '.xlsx';
                $filepath = $export_path . '/' . $filename;
                
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save($filepath);
                
            } elseif ($format === 'pdf') {
                require_once APPPATH . 'third_party/TCPDF/tcpdf.php';
                
                $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetTitle('Series Details Export');
                $pdf->SetHeaderData('', 0, 'Series Details', '');
                $pdf->setHeaderFont(Array('helvetica', '', 12));
                $pdf->setFooterFont(Array('helvetica', '', 10));
                $pdf->SetDefaultMonospacedFont('courier');
                $pdf->SetMargins(15, 15, 15);
                $pdf->SetAutoPageBreak(TRUE, 15);
                $pdf->AddPage();
                
                $html = '<table border="1" cellpadding="4" style="width: 100%;">';
                
                // Headers
                $html .= '<tr style="background-color: #f5f5f5; font-weight: bold;">';
                foreach ($columns as $column) {
                    $html .= '<th>' . ucwords(str_replace('_', ' ', $column)) . '</th>';
                }
                $html .= '</tr>';
                
                // Data rows
                foreach ($series_data as $data) {
                    $html .= '<tr>';
                    foreach ($columns as $column) {
                        $value = isset($data->$column) ? $data->$column : '';
                        $html .= '<td>' . htmlspecialchars($value) . '</td>';
                    }
                    $html .= '</tr>';
                }
                $html .= '</table>';
                
                $pdf->writeHTML($html, true, false, true, false, '');
                
                $filename .= '.pdf';
                $filepath = $export_path . '/' . $filename;
                
                $pdf->Output($filepath, 'F');
            }
    
            echo json_encode([
                'success' => true,
                'file' => base_url('uploads/exports/' . $filename),
                'filename' => $filename
            ]);
    
        } catch (Exception $e) {
            log_message('error', 'Export error: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            echo json_encode([
                'success' => false, 
                'message' => 'Export failed: ' . $e->getMessage()
            ]);
        }
    }
    public function search_series() {
        $search = $this->input->get('search');
        $page = $this->input->get('page', TRUE);
        
        $limit = 10;
        $offset = (int)$page * $limit;
        
        $result = $this->admin_model->search_series($search, $limit, $offset);
        
        // Configure pagination
        $config['base_url'] = site_url('admin/index');
        $config['total_rows'] = $result['total_rows'];
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $response = [
            'html' => $result['html'],
            'pagination' => $this->pagination->create_links()
        ];
        
        echo json_encode($response);
    }
    public function get_users_data() {
        try {
            // Get users data
            $users = $this->admin_model->get_all_users();
            
            // Format the data for display
            $formattedUsers = [];
            foreach ($users as $user) {
                $formattedUsers[] = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'employee_name' => $user->employee_name,
                    'role' => $user->role,
                    'created_at' => date('d M Y H:i', strtotime($user->created_at))
                ];
            }
    
            // Return success response with data
            echo json_encode([
                'success' => true,
                'users' => $formattedUsers
            ]);
        } catch (Exception $e) {
            // Return error response
            echo json_encode([
                'success' => false,
                'message' => 'Error fetching users data: ' . $e->getMessage()
            ]);
        }
    }
    // Add this new method to your Admin controller
public function get_series_data() {
    try {
        // Get current page and search term from request
        $search = $this->input->get('search', TRUE);
        $page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $limit = 10;
        
        // Get paginated series data
        $series_details = $this->admin_model->get_series_details($limit, $page, $search);
        $total_rows = $this->admin_model->count_series_details($search);
        
        // Configure pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $config['reuse_query_string'] = TRUE;
        
        // Pagination styling
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        
        // Format the data for display
        $formattedSeries = [];
        foreach ($series_details as $series) {
            $formattedSeries[] = [
                'mseries' => $series->mseries,
                'product_name' => $series->product_name,
                'machine_pump' => [
                    'series' => $series->machine_pump_series,
                    'maker' => $series->machine_pump_maker,
                    'detail' => $series->machine_pump_detail
                ],
                'customer' => [
                    'name' => $series->customer_name,
                    'phone' => $series->customer_phone
                ],
                'installation' => [
                    'dealer' => $series->installation_dealer,
                    'purchase_date' => $series->installation_purchase_date,
                    'installed_by' => $series->installation_installed_by,
                    'date' => $series->installation_date
                ],
                'status' => $series->status,
                'status_color' => $series->status_color
            ];
        }

        // Return success response with data
        echo json_encode([
            'success' => true,
            'series' => $formattedSeries,
            'pagination' => $this->pagination->create_links()
        ]);
    } catch (Exception $e) {
        // Return error response
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching series data: ' . $e->getMessage()
        ]);
    }
}
// In Admin.php controller, add this new method
public function export_filtered_series() {
    try {
        $format = $this->input->post('format');
        $columns = $this->input->post('columns');
        $search = $this->input->post('search');

        if (empty($format) || empty($columns)) {
            throw new Exception('Format or columns are empty');
        }

        // Get filtered data from the model
        $series_data = $this->admin_model->get_filtered_series_for_export($columns, $search);

        if (empty($series_data)) {
            throw new Exception('No data to export');
        }

        $export_path = FCPATH . 'uploads/exports';
        if (!file_exists($export_path)) {
            if (!mkdir($export_path, 0777, true)) {
                throw new Exception('Failed to create export directory');
            }
        }

        $filename = 'filtered_series_' . date('Y-m-d_H-i-s');

        if ($format === 'excel') {
            require_once APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            
            // Add headers
            $col = 0;
            foreach ($columns as $column) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(
                    $col, 
                    1, 
                    ucwords(str_replace('_', ' ', $column))
                );
                $col++;
            }
            
            // Add data
            $row = 2;
            foreach ($series_data as $data) {
                $col = 0;
                foreach ($columns as $column) {
                    $value = isset($data->$column) ? $data->$column : '';
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                    $col++;
                }
                $row++;
            }
            
            $filename .= '.xlsx';
            $filepath = $export_path . '/' . $filename;
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save($filepath);
            
        } elseif ($format === 'pdf') {
            require_once APPPATH . 'third_party/TCPDF/tcpdf.php';
            
            $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetTitle('Filtered Series Details Export');
            $pdf->SetHeaderData('', 0, 'Filtered Series Details', '');
            $pdf->setHeaderFont(Array('helvetica', '', 12));
            $pdf->setFooterFont(Array('helvetica', '', 10));
            $pdf->SetDefaultMonospacedFont('courier');
            $pdf->SetMargins(15, 15, 15);
            $pdf->SetAutoPageBreak(TRUE, 15);
            $pdf->AddPage();
            
            $html = '<table border="1" cellpadding="4" style="width: 100%;">';
            
            // Headers
            $html .= '<tr style="background-color: #f5f5f5; font-weight: bold;">';
            foreach ($columns as $column) {
                $html .= '<th>' . ucwords(str_replace('_', ' ', $column)) . '</th>';
            }
            $html .= '</tr>';
            
            // Data rows
            foreach ($series_data as $data) {
                $html .= '<tr>';
                foreach ($columns as $column) {
                    $value = isset($data->$column) ? $data->$column : '';
                    $html .= '<td>' . htmlspecialchars($value) . '</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</table>';
            
            $pdf->writeHTML($html, true, false, true, false, '');
            
            $filename .= '.pdf';
            $filepath = $export_path . '/' . $filename;
            
            $pdf->Output($filepath, 'F');
        }

        echo json_encode([
            'success' => true,
            'file' => base_url('uploads/exports/' . $filename),
            'filename' => $filename
        ]);

    } catch (Exception $e) {
        log_message('error', 'Export error: ' . $e->getMessage());
        echo json_encode([
            'success' => false, 
            'message' => 'Export failed: ' . $e->getMessage()
        ]);
    }
}
// In your Admin controller
public function get_products_data() {
    // Load the product model if not already loaded
    $this->load->model('product_model');
    
    try {
        $products = $this->product_model->get_all_products();
        
        echo json_encode([
            'success' => true,
            'products' => $products
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching products: ' . $e->getMessage()
        ]);
    }
}

public function add_product() {
    $this->load->model('product_model');
    
    $product_name = $this->input->post('product_name');
    
    if (empty($product_name)) {
        echo json_encode([
            'success' => false,
            'message' => 'Product name is required'
        ]);
        return;
    }
    
    try {
        $result = $this->product_model->add_product([
            'product_name' => $product_name
        ]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Product added successfully'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error adding product: ' . $e->getMessage()
        ]);
    }
}

public function edit_product() {
    $this->load->model('product_model');
    
    $id = $this->input->post('id');
    $product_name = $this->input->post('product_name');
    
    if (empty($id) || empty($product_name)) {
        echo json_encode([
            'success' => false,
            'message' => 'Product ID and name are required'
        ]);
        return;
    }
    
    try {
        $this->product_model->update_product($id, [
            'product_name' => $product_name
        ]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Product updated successfully'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error updating product: ' . $e->getMessage()
        ]);
    }
}

public function delete_product() {
    $this->load->model('product_model');
    
    $id = $this->input->post('id');
    
    if (empty($id)) {
        echo json_encode([
            'success' => false,
            'message' => 'Product ID is required'
        ]);
        return;
    }
    
    try {
        $this->product_model->delete_product($id);
        
        echo json_encode([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error deleting product: ' . $e->getMessage()
        ]);
    }
}
}