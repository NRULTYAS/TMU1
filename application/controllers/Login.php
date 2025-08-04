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
}
