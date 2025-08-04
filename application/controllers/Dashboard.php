<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
        // Tidak ada cek login di sini agar halaman bisa diakses publik
    }

    public function index() {
        // Jika sudah login, tampilkan nama; jika belum, beri default
        $data['nama_lengkap'] = $this->session->userdata('nama_lengkap') ?? 'Pengunjung';

        // Ambil statistik dari database
        $data['total_diklat'] = $this->Dashboard_model->count_diklat();
        $data['total_jenis_diklat'] = $this->Dashboard_model->count_jenis_diklat();
        $data['total_pendaftar'] = $this->Dashboard_model->count_pendaftar();
        
        // Ambil diklat terbaru untuk ditampilkan di tabel
        $data['diklat_terbaru'] = $this->Dashboard_model->get_latest_diklat(5);

        // Tampilkan view dashboard
        $this->load->view('dashboard', $data);
    }
}
