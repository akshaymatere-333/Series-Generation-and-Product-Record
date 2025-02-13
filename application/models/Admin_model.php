<?php
class Admin_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
public function index() {
    $data['products'] = $this->db->get('products')->result();
}
    public function get_all_users() {
        return $this->db->get('users')->result();
    }

    public function add_user($data) {
        try {
            $this->db->insert('users', $data);
            return ['success' => true, 'message' => 'User added successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function update_user($id, $data) {
        try {
            $this->db->where('id', $id);
            $this->db->update('users', $data);
            return ['success' => true, 'message' => 'User updated successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function delete_user($id) {
        try {
            $this->db->where('id', $id);
            $this->db->delete('users');
            return ['success' => true, 'message' => 'User deleted successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function get_user($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function get_series_details($limit = 10, $offset = 0, $search = '') {
        $this->db->select('
            m.series_number as mseries, 
            COALESCE(p.product_name, "N/A") as product_name,
            m.pump_detail as machine_pump_detail,
            m.pump_maker as machine_pump_maker,
            m.pump_series_no as machine_pump_series,
            c.company_name as customer_name,
            c.phone as customer_phone,
            c.email as customer_email,
            c.dealer as installation_dealer,
            c.purchase_date as installation_purchase_date,
            i.installed_by as installation_installed_by,
            i.installation_date as installation_date
        ');
        $this->db->from('machines m');
        $this->db->join('series_numbers sn', 'sn.series_number = m.series_number', 'left');
        $this->db->join('products p', 'p.id = sn.product_id', 'left');
        $this->db->join('customers c', 'c.machine_series = m.series_number', 'left');
        $this->db->join('installations i', 'i.machine_id = m.id', 'left');

        // Add search conditions if search term is provided
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('m.series_number', $search);
            $this->db->or_like('p.product_name', $search);
            $this->db->or_like('m.pump_detail', $search);
            $this->db->or_like('m.pump_maker', $search);
            $this->db->or_like('m.pump_series_no', $search);
            $this->db->or_like('c.company_name', $search);
            $this->db->or_like('c.phone', $search);
            $this->db->or_like('c.dealer', $search);
            $this->db->or_like('i.installed_by', $search);
            $this->db->or_like('c.purchase_date', $search);
            $this->db->or_like('i.installation_date', $search);
            $this->db->group_end();
        }

        $this->db->limit($limit, $offset);
        
        $result = $this->db->get()->result();
        
        // Process status as before
        foreach ($result as &$series) {
            if (!$series->machine_pump_detail) {
                $series->status = 'Under Production';
                $series->status_color = 'warning';
            } elseif (!$series->customer_name) {
                $series->status = 'Manufactured';
                $series->status_color = 'secondary';
            } elseif (!$series->installation_date) {
                $series->status = 'Dispatched';
                $series->status_color = 'info';
            } else {
                $series->status = 'Deployed';
                $series->status_color = 'success';
            }
        }
        
        return $result;
    }

    public function count_series_details($search = '') {
        $this->db->from('machines m');
        $this->db->join('series_numbers sn', 'sn.series_number = m.series_number', 'left');
        $this->db->join('products p', 'p.id = sn.product_id', 'left');
        $this->db->join('customers c', 'c.machine_series = m.series_number', 'left');
        $this->db->join('installations i', 'i.machine_id = m.id', 'left');

        // Add search conditions if search term is provided
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('m.series_number', $search);
            $this->db->or_like('p.product_name', $search);
            $this->db->or_like('m.pump_detail', $search);
            $this->db->or_like('m.pump_maker', $search);
            $this->db->or_like('m.pump_series_no', $search);
            $this->db->or_like('c.company_name', $search);
            $this->db->or_like('c.phone', $search);
            $this->db->or_like('c.dealer', $search);
            $this->db->or_like('i.installed_by', $search);
            $this->db->group_end();
        }
        
        return $this->db->count_all_results();
    }
    public function get_total_series() {
        return $this->db->count_all_results('series_numbers');
    }
    
    public function get_total_machines() {
        return $this->db->count_all_results('machines');
    }
    
    public function get_total_customers() {
        return $this->db->count_all_results('customers');
    }
    
    public function get_total_installations() {
        return $this->db->count_all_results('installations');
    }
    
    public function get_total_products() {
        return $this->db->count_all_results('products');
    }
    
    public function get_total_users() {
        return $this->db->count_all_results('users');
    }
    public function get_series_for_export($columns) {
        $select_columns = [];
        
        // Map column names to their database equivalents
        $column_map = [
            'mseries' => 'm.series_number as mseries',
            'product_name' => 'COALESCE(p.product_name, "N/A") as product_name',
            'pump_detail' => 'm.pump_detail',
            'pump_maker' => 'm.pump_maker',
            'pump_series' => 'm.pump_series_no as pump_series',
            'customer_name' => 'c.company_name as customer_name',
            'customer_phone' => 'c.phone as customer_phone',
            'customer_email' => 'c.email as customer_email',
            'dealer' => 'c.dealer',
            'purchase_date' => 'c.purchase_date',
            'installation_date' => 'i.installation_date',
            'status' => 'CASE 
                WHEN i.installation_date IS NOT NULL THEN "Deployed"
                WHEN c.company_name IS NOT NULL THEN "Dispatched"
                WHEN m.pump_detail IS NOT NULL THEN "Manufactured"
                ELSE "Under Production"
            END as status'
        ];
        
        // Build select statement based on requested columns
        foreach ($columns as $column) {
            if (isset($column_map[$column])) {
                $select_columns[] = $column_map[$column];
            }
        }
        
        if (empty($select_columns)) {
            return [];
        }
        
        $this->db->select(implode(', ', $select_columns));
        $this->db->from('machines m');
        $this->db->join('series_numbers sn', 'sn.series_number = m.series_number', 'left');
        $this->db->join('products p', 'p.id = sn.product_id', 'left');
        $this->db->join('customers c', 'c.machine_series = m.series_number', 'left');
        $this->db->join('installations i', 'i.machine_id = m.id', 'left');
        
        return $this->db->get()->result();
    }
    public function search_series($search = '', $limit = 10, $offset = 0) {
        // Get the series details with search
        $series = $this->get_series_details($limit, $offset, $search);
        
        // Build the HTML for table rows
        $html = '';
        $serial = $offset + 1;
        
        foreach ($series as $series_item) {
            $html .= '<tr>';
            $html .= '<td>' . $serial++ . '</td>';
            $html .= '<td>' . $series_item->mseries . '</td>';
            $html .= '<td>' . $series_item->product_name . '</td>';
            $html .= '<td>';
            if ($series_item->machine_pump_detail) {
                $html .= '<strong><i>Series:</i></strong> ' . $series_item->machine_pump_series . '<br>';
                $html .= '<strong><i>Maker:</i> </strong>' . $series_item->machine_pump_maker . '<br>';
                $html .= '<strong><i>Detail:</i></strong> ' . $series_item->machine_pump_detail;
            } else {
                $html .= '<i>Machine detail not available</i>';
            }
            $html .= '</td>';
            $html .= '<td>';
            if ($series_item->customer_name) {
                $html .= '<strong><i>Name:</i></strong> ' . $series_item->customer_name . '<br>';
                $html .= '<strong><i>Phone: </i></strong>' . $series_item->customer_phone . '<br>';
            } else {
                $html .= '<i>Customer detail not available</i>';
            }
            $html .= '</td>';
            $html .= '<td>';
            if ($series_item->installation_date) {
                $html .= '<strong><i>Dealer: </i></strong>' . $series_item->installation_dealer . '<br>';
                $html .= '<strong><i>Purchase Date: </i></strong>' . $series_item->installation_purchase_date . '<br>';
                $html .= '<strong><i>Install By: </i></strong>' . $series_item->installation_installed_by . '<br>';
                $html .= '<strong><i>Date: </i></strong>' . $series_item->installation_date;
            } else {
                $html .= '<i>Installation detail not available</i>';
            }
            $html .= '</td>';
            $html .= '<td>';
            $html .= '<span class="status-' . $series_item->status_color . '">' . $series_item->status . '</span>';
            $html .= '</td>';
            $html .= '</tr>';
        }
        
        return [
            'html' => $html,
            'total_rows' => $this->count_series_details($search)
        ];
    }
    // Add this new method to Admin_model.php
public function get_filtered_series_for_export($columns, $search = '') {
    $select_columns = [];
    
    // Map column names to their database equivalents
    $column_map = [
        'mseries' => 'm.series_number as mseries',
        'product_name' => 'COALESCE(p.product_name, "N/A") as product_name',
        'pump_detail' => 'm.pump_detail',
        'pump_maker' => 'm.pump_maker',
        'pump_series' => 'm.pump_series_no as pump_series',
        'customer_name' => 'c.company_name as customer_name',
        'customer_phone' => 'c.phone as customer_phone',
        'customer_email' => 'c.email as customer_email',
        'dealer' => 'c.dealer',
        'purchase_date' => 'c.purchase_date',
        'installation_date' => 'i.installation_date',
        'status' => 'CASE 
            WHEN i.installation_date IS NOT NULL THEN "Deployed"
            WHEN c.company_name IS NOT NULL THEN "Dispatched"
            WHEN m.pump_detail IS NOT NULL THEN "Manufactured"
            ELSE "Under Production"
        END as status'
    ];
    
    // Build select statement based on requested columns
    foreach ($columns as $column) {
        if (isset($column_map[$column])) {
            $select_columns[] = $column_map[$column];
        }
    }
    
    if (empty($select_columns)) {
        return [];
    }
    
    $this->db->select(implode(', ', $select_columns));
    $this->db->from('machines m');
    $this->db->join('series_numbers sn', 'sn.series_number = m.series_number', 'left');
    $this->db->join('products p', 'p.id = sn.product_id', 'left');
    $this->db->join('customers c', 'c.machine_series = m.series_number', 'left');
    $this->db->join('installations i', 'i.machine_id = m.id', 'left');
    
    // Add search conditions if search term is provided
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like('m.series_number', $search);
        $this->db->or_like('p.product_name', $search);
        $this->db->or_like('m.pump_detail', $search);
        $this->db->or_like('m.pump_maker', $search);
        $this->db->or_like('m.pump_series_no', $search);
        $this->db->or_like('c.company_name', $search);
        $this->db->or_like('c.phone', $search);
        $this->db->or_like('c.dealer', $search);
        $this->db->or_like('i.installed_by', $search);
        $this->db->group_end();
    }
    
    return $this->db->get()->result();
}

}