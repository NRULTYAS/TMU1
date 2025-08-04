<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman_utama extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Cek apakah user sudah login, jika belum redirect ke login
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        // Load model jika dibutuhkan di halaman utama
        $this->load->model('Halaman_model'); // opsional
    }

    public function index()
    {
        // Load halaman utama setelah login sukses
        $this->load->view('halaman_utama');
    }
}
