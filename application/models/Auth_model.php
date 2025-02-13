<?php
class Auth_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Generate a secure password hash
    // public function hash_password($password) {
    //     // Use PHP's built-in password hashing
    //     return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    // }

    // Verify password
    // public function verify_password($input_password, $stored_password) {
    //     return $input_password === $stored_password;
    // }

    // public function check_login($username, $password) {
    //     $this->db->where('username', $username);
    //     $query = $this->db->get('users');
    //     $user = $query->row();
        
    //     // Verify password using secure comparison
    //     if ($user && $this->verify_password($password, $user->password)) {
    //         return $user;
    //     }
    //     return false;
    // }

    // Method to update user password with hashing
    public function update_password($user_id, $new_password) {
        $hashed_password = $this->hash_password($new_password);
        
        $this->db->where('id', $user_id);
        return $this->db->update('users', ['password' => $hashed_password]);
    }
    public function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    public function verify_password($input_password, $stored_password) {
        return $input_password === $stored_password;
    }

    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        $user = $query->row();
        
        if ($user && $this->verify_password($password, $user->password)) {
            return $user;
        }
        return false;
    }

    
    // Additional utility method to get user email
    public function get_user_email($user_id) {
        $this->db->select('email');
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            return $query->row()->email;
        }
        return false;
    }
    public function check_user_dob($username, $dob) {
        $this->db->select('id, username, email');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('date_of_birth', $dob);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function save_reset_token($user_id, $token, $expires) {
        $data = array(
            'reset_token' => $token,
            'reset_expires' => $expires
        );
        
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    public function check_reset_token($token) {
        $this->db->where('reset_token', $token);
        $this->db->where('reset_expires >', date('Y-m-d H:i:s'));
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function reset_password($token, $new_password) {
        $user = $this->check_reset_token($token);
        
        if (!$user) {
            return false;
        }

        $data = array(
            'password' => $new_password,
            'reset_token' => NULL,
            'reset_expires' => NULL
        );

        $this->db->where('id', $user->id);
        return $this->db->update('users', $data);
    }

}