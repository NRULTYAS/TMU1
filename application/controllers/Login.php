<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->helper('url'); 
        $this->load->library('session'); 
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('halaman_utama');
        }

        $this->load->view('login/login');
    }

    public function proses()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $user = $this->Login_model->cek_login($username, $password);

        if ($user) {
            
            $session_data = array(
                'id'        => $user->id,
                'username'  => $user->username,
                'nama'      => $user->nama_lengkap,
                'type'      => $user->type,
                'logged_in' => true
            );
            $this->session->set_userdata($session_data);

            
            redirect('halaman_utama');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('login');
        }
    }

    // Logout 
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Dashboard'); 
    }
    
    // Registrasi user baru
    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('halaman_utama');
        }

        $this->load->view('login/register');
    }
    
    // Proses registrasi
    public function proses_register()
    {
        $this->load->library('form_validation');
        
        // Validasi form
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[scre_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/register');
        } else {
            // Generate ID user baru
            $user_id = $this->generate_user_id();
            
            $data = array(
                'id' => $user_id,
                'nip' => $this->input->post('nip', true),
                'nama_lengkap' => $this->input->post('nama_lengkap', true),
                'username' => $this->input->post('username', true),
                'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
                'type' => 5 // Default type untuk user biasa
            );
            
            if ($this->Login_model->register_user($data)) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal! Silakan coba lagi.');
                redirect('login/register');
            }
        }
    }
    
    // Generate ID user baru
    private function generate_user_id()
    {
        $this->load->database();
        
        // Get last user ID
        $this->db->select_max('id');
        $query = $this->db->get('scre_user');
        $last_id = $query->row()->id;
        
        if (!$last_id) {
            return 'USR001';
        }
        
        // Extract number and increment
        $number = intval(substr($last_id, 3));
        $new_number = $number + 1;
        
        return 'USR' . str_pad($new_number, 3, '0', STR_PAD_LEFT);
    }
}
