<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function cek_login($username, $password)
    {
        // Ambil user berdasarkan username
        $this->db->where('username', $username);
        $query = $this->db->get('scre_user');

        // Jika user ditemukan
        if ($query->num_rows() == 1) {
            $user = $query->row();

            // Cek password - support both plain text dan hashed
            if (password_verify($password, $user->password) || $user->password == $password) {
                return $user;
            }
        }

        return false; // Login gagal
    }
    
    public function register_user($data)
    {
        return $this->db->insert('scre_user', $data);
    }
}
