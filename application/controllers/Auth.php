<?php
class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library(['session', 'form_validation', 'email']);
        $this->load->helper(['url', 'security', 'string']);
        
        // Configure email settings
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'zeteshubham@gmail.com', // Your Gmail address
            'smtp_pass' => 'lkcgotuvjanrfkrg', // Your Gmail app password
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'smtp_crypto' => 'tls',
            'newline' => "\r\n",
            'wordwrap' => TRUE,
            'validate' => TRUE
        );
        
        $this->email->initialize($config);
    }

    public function index() {
        $this->session->unset_userdata('login_attempts');
        $this->load->view('auth/login');
    }

    public function login() {
        // Custom error delimiters
        $this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');

        // Validation rules with custom error messages
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[50]', 
            array(
                'required' => 'The Username field is required.',
                'max_length' => 'The Username cannot exceed 50 characters.'
            )
        );
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[50]', 
            array(
                'required' => 'The Password field is required.',
                'min_length' => 'The Password must be at least 4 characters long.',
                'max_length' => 'The Password cannot exceed 50 characters.'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, return to login page with errors
            $this->load->view('auth/login');
            return;
        }

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->input->post('password');

        // Implement login attempt tracking
        $login_attempts = $this->session->userdata('login_attempts') ?? 0;
        
        if ($login_attempts >= 5) {
            $this->session->set_flashdata('error', 'Too many login attempts. Please try again later.');
            redirect('auth');
        }

        $user = $this->auth_model->check_login($username, $password);

        if($user) {
            // Reset login attempts on successful login
            $this->session->unset_userdata('login_attempts');

            $user_data = array(
                'user_id' => $user->id,
                'username' => $user->username,
                'employee_name' => $user->employee_name,
                'role' => $user->role,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($user_data);

            // Redirect based on user role
            switch($user->role) {
                case 'admin':
                    redirect('admin');
                    break;
                case 'mseries':
                    redirect('mseries');
                    break;
                case 'machine':
                    redirect('machines');
                    break;
                case 'customer':
                    redirect('customers');
                    break;
                case 'installation':
                    redirect('installations');
                    break;
                default:
                    redirect('auth');
            }
        } else {
            // Increment login attempts
            $login_attempts++;
            $this->session->set_userdata('login_attempts', $login_attempts);

            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
    public function forgot_password() {
        $this->load->view('auth/forgot_password');
    }

   
    public function reset_password($token = null) {
        if (!$token) {
            show_404();
        }

        $user = $this->auth_model->check_reset_token($token);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'Invalid or expired reset token.');
            redirect('auth');
        }

        $this->load->view('auth/reset_password', ['token' => $token]);
    }

    public function process_reset_password() {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
        $this->form_validation->set_rules('token', 'Token', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/reset_password', ['token' => $this->input->post('token')]);
            return;
        }

        $token = $this->input->post('token');
        $password = $this->input->post('password');

        if ($this->auth_model->reset_password($token, $password)) {
            $this->session->set_flashdata('success', 'Password has been reset successfully. Please login with your new password.');
        } else {
            $this->session->set_flashdata('error', 'Failed to reset password. Please try again.');
        }

        redirect('auth');
    }
    public function process_forgot_password() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/forgot_password');
            return;
        }

        $username = $this->security->xss_clean($this->input->post('username'));
        $dob = $this->security->xss_clean($this->input->post('dob'));

        $user = $this->auth_model->check_user_dob($username, $dob);

        if ($user) {
            // Generate reset token
            $reset_token = random_string('alnum', 32);
            $reset_expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Save token in database
            if ($this->auth_model->save_reset_token($user->id, $reset_token, $reset_expires)) {
                // Prepare and send email
                $reset_link = site_url("auth/reset_password/{$reset_token}");
                
                try {
                    $this->email->clear(); // Clear any previous email data
                    
                    $this->email->from('zeteshubham@gmail.com', 'Sahyadri Farm Machinery');
                    $this->email->to($user->email);
                    $this->email->subject('Password Reset Request');
                    
                    $email_message = "
                        <h2>Password Reset Request</h2>
                        <p>Hello {$user->username},</p>
                        <p>We received a request to reset your password. Click the link below to set a new password:</p>
                        <p><a href='{$reset_link}'>{$reset_link}</a></p>
                        <p>This link will expire in 1 hour.</p>
                        <p>If you didn't request this, please ignore this email.</p>
                        <br>
                        <p>Best regards,<br>Sahyadri Farm Machinery Team</p>
                    ";
                    
                    $this->email->message($email_message);
                    
                    if ($this->email->send()) {
                        $this->session->set_flashdata('success', 'Password reset instructions have been sent to your email.');
                    } else {
                        // Log the error for debugging
                        log_message('error', 'Email sending failed: ' . $this->email->print_debugger(['headers']));
                        $this->session->set_flashdata('error', 'Failed to send reset email. Please try again later.');
                    }
                } catch (Exception $e) {
                    log_message('error', 'Email exception: ' . $e->getMessage());
                    $this->session->set_flashdata('error', 'Failed to send reset email. Please try again later.');
                }
            } else {
                $this->session->set_flashdata('error', 'Failed to process reset request. Please try again.');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid username or date of birth.');
        }
        
        redirect('auth/forgot_password');
    }
}