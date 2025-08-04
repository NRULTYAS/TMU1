<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
        // Load new registration page
        $this->load->view('frontend/pendaftaran',);
    }

    public function form($jadwal_id = null) {
        // Load simple registration form for now
        $data['jadwal_id'] = $jadwal_id;
        $this->load->view('pendaftaran/form', $data);
    }

    public function get_diklat_info($diklat_id) {
        $diklat = $this->db->get_where('scre_diklat', ['id' => $diklat_id])->row();
        if ($diklat) {
            // Ambil nama jenis diklat dari relasi
            $jenis_nama = '-';
            if (!empty($diklat->jenis_diklat_id)) {
                $jenis = $this->db->get_where('scre_jenis_diklat', ['id' => $diklat->jenis_diklat_id])->row();
                if ($jenis && !empty($jenis->jenis_diklat)) {
                    $jenis_nama = $jenis->jenis_diklat;
                }
            }
            // Cek di tabel jadwal: jika ada pelaksanaan_mulai/akhir NULL, maka gelombang, jika ada tanggal maka tanggal
            $jadwal = $this->db->get_where('scre_diklat_jadwal', ['diklat_id' => $diklat_id, 'is_exist' => 1])->result();
            $is_gelombang = false;
            $is_tanggal = false;
            foreach ($jadwal as $j) {
                if (empty($j->pelaksanaan_mulai) && empty($j->pelaksanaan_akhir)) {
                    $is_gelombang = true;
                } else if (!empty($j->pelaksanaan_mulai) && !empty($j->pelaksanaan_akhir)) {
                    $is_tanggal = true;
                }
            }
            $response = array(
                'success' => true,
                'is_gelombang' => $is_gelombang,
                'is_tanggal' => $is_tanggal,
                'nama_diklat' => $diklat->nama_diklat,
                'kode_diklat' => $diklat->kode_diklat,
                'jenis_diklat' => $jenis_nama,
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Diklat tidak ditemukan'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_periode_list($diklat_id) {
        // Get all jadwal/periode for specific diklat without JOIN to avoid empty results
        $this->db->select('j.*');
        $this->db->from('scre_diklat_jadwal j');
        $this->db->where('j.diklat_id', $diklat_id);
        $this->db->where('j.is_exist', 1);
        $this->db->order_by('j.periode', 'ASC');
        
        $jadwal = $this->db->get()->result();
        
        // Count total periods
        $total_periode = count($jadwal);
        
        // Always use date mode (tanggal) for all diklat
        $response = array(
            'total_periode' => $total_periode,
            'use_gelombang' => false,  // Always false = always use date mode
            'data' => $jadwal
        );
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_tahun($diklat_id) {
        $tahun = $this->db->get_where('scre_diklat_tahun', ['diklat_id' => $diklat_id, 'is_exist' => 1])->result();
        header('Content-Type: application/json');
        echo json_encode($tahun);
    }

    public function get_schedule($tahun_id) {
        $jadwal = $this->db->get_where('scre_diklat_jadwal', ['diklat_tahun_id' => $tahun_id, 'is_exist' => 1])->result();
        header('Content-Type: application/json');
        echo json_encode($jadwal);
    }

    public function simpan() {
        // Proses simpan pendaftaran di sini
        // ...
        $this->session->set_flashdata('success', 'Pendaftaran berhasil!');
        redirect('pendaftaran');
    }
}
