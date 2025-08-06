<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_New extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    // URL: /pendaftaran (default page - redirect to first available diklat)
    public function index() 
    {
        // Check if diklat_id is provided via query string
        $diklat_id = $this->input->get('diklat_id');
        
        if ($diklat_id) {
            // If diklat_id provided, show that specific diklat
            $this->diklat($diklat_id);
            return;
        }
        
        // Get first available diklat and redirect to it
        $first_diklat = $this->db->get_where('scre_diklat', ['is_exist' => 1], 1)->row();
        
        if ($first_diklat) {
            // Redirect to first available diklat
            redirect('pendaftaran/' . $first_diklat->id);
        } else {
            // If no diklat available, show error
            show_error('Tidak ada program diklat yang tersedia saat ini.');
        }
    }
    
    // URL: /pendaftaran/form - langsung ke form pendaftaran dengan diklat pertama
    public function form_direct() 
    {
        // Get first available diklat
        $first_diklat = $this->db->get_where('scre_diklat', ['is_exist' => 1], 1)->row();
        
        if (!$first_diklat) {
            show_error('Tidak ada program diklat yang tersedia saat ini.');
        }
        
        // Get first jadwal from this diklat
        $first_jadwal = $this->db->get_where('scre_diklat_jadwal', [
            'diklat_id' => $first_diklat->id,
            'is_exist' => 1
        ], 1)->row();
        
        if (!$first_jadwal) {
            show_error('Tidak ada jadwal yang tersedia untuk program diklat ini.');
        }
        
        // Redirect to form with jadwal_id and diklat_id
        redirect('pendaftaran/form/' . $first_jadwal->id . '?diklat_id=' . $first_diklat->id);
    }

    // URL: /pendaftaran/{diklat_id}
    public function diklat($diklat_id = null)
    {
        if (!$diklat_id) {
            redirect('pendaftaran');
        }

        // Headers
        $this->output->set_header("Cache-Control: no-cache, must-revalidate");
        $this->output->set_header("Expires: 0");
        
        // Get diklat info with jenis_diklat
        $sql = "SELECT d.*, jd.jenis_diklat as kategori_diklat 
                FROM scre_diklat d 
                LEFT JOIN scre_jenis_diklat jd ON d.jenis_diklat_id = jd.id 
                WHERE d.id = ? AND d.is_exist = 1";
        $diklat_info = $this->db->query($sql, [$diklat_id])->row_array();
        
        if (!$diklat_info) {
            show_404('Diklat tidak ditemukan');
        }
        
        // Get jadwal for this diklat with proper ordering
        $sql = "SELECT * FROM scre_diklat_jadwal 
                WHERE diklat_id = ? AND is_exist = 1 
                ORDER BY COALESCE(pendaftaran_mulai, pelaksanaan_mulai) ASC";
        $jadwal_list = $this->db->query($sql, [$diklat_id])->result_array();
        
        // Calculate kuota info for each jadwal
        foreach ($jadwal_list as &$jadwal) {
            // Add pendaftar count (simulation for now)
            $jadwal['pendaftar_count'] = max(0, $jadwal['kouta'] - $jadwal['sisa_kursi']);
            $jadwal['kuota_max'] = $jadwal['kouta'];
            $jadwal['kuota_terisi'] = $jadwal['pendaftar_count'];
            $jadwal['sisa_kuota'] = $jadwal['sisa_kursi'];
            $jadwal['progress_percent'] = $jadwal['kouta'] > 0 ? 
                round(($jadwal['pendaftar_count'] / $jadwal['kouta']) * 100) : 0;
            $jadwal['status_pendaftaran'] = $jadwal['is_daftar'] ? 'buka' : 'tutup';
            $jadwal['jadwal_id'] = $jadwal['id'];
            
            // Fix column names for dates - use correct database column names
            $jadwal['tgl_mulai_daftar'] = $jadwal['pendaftaran_mulai'];
            $jadwal['tgl_selesai_daftar'] = $jadwal['pendaftaran_akhir'];
            $jadwal['tgl_mulai_diklat'] = $jadwal['pelaksanaan_mulai'];
            $jadwal['tgl_selesai_diklat'] = $jadwal['pelaksanaan_akhir'];
        }
        
        $data = [
            'diklat_id' => $diklat_id,
            'diklat_info' => $diklat_info,
            'jadwal_list' => $jadwal_list,
            'persyaratan_list' => []
        ];
        
        $this->load->view('frontend/pendaftaran_simple', $data);
    }

    // URL: /pendaftaran/{diklat_id}/{periode}
    public function periode($diklat_id = null, $periode = null)
    {
        if (!$diklat_id || !$periode) {
            redirect('pendaftaran');
        }

        // Headers
        $this->output->set_header("Cache-Control: no-cache, must-revalidate");
        
        // Get diklat info
        $diklat_info = $this->db->get_where('scre_diklat', [
            'id' => $diklat_id,
            'is_exist' => 1
        ])->row_array();
        
        if (!$diklat_info) {
            show_404('Diklat tidak ditemukan');
        }
        
        // Get specific jadwal by periode
        $jadwal_info = $this->db->get_where('scre_diklat_jadwal', [
            'diklat_id' => $diklat_id,
            'periode' => $periode,
            'is_exist' => 1
        ])->row_array();
        
        if (!$jadwal_info) {
            show_404('Periode tidak ditemukan');
        }
        
        // Calculate kuota info
        $jadwal_info['kuota_max'] = $jadwal_info['kouta'];
        $jadwal_info['kuota_terisi'] = max(0, $jadwal_info['kouta'] - $jadwal_info['sisa_kursi']);
        $jadwal_info['sisa_kuota'] = $jadwal_info['sisa_kursi'];
        $jadwal_info['progress_percent'] = $jadwal_info['kouta'] > 0 ? 
            round((($jadwal_info['kouta'] - $jadwal_info['sisa_kursi']) / $jadwal_info['kouta']) * 100) : 0;
        $jadwal_info['status_pendaftaran'] = $jadwal_info['is_daftar'] ? 'buka' : 'tutup';
        
        $data = [
            'diklat_id' => $diklat_id,
            'periode' => $periode,
            'diklat_info' => $diklat_info,
            'jadwal_info' => $jadwal_info,
            'jadwal_list' => [$jadwal_info], // Convert single jadwal to array for consistency
            'persyaratan_list' => [],
            'single_periode_mode' => true // Flag untuk mode single periode
        ];
        
        $this->load->view('frontend/pendaftaran_simple', $data);
    }

    // API endpoint untuk mendapatkan jadwal
    public function api_jadwal($diklat_id = null)
    {
        if (!$diklat_id) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Diklat ID required']));
            return;
        }

        $jadwal_list = $this->db->get_where('scre_diklat_jadwal', [
            'diklat_id' => $diklat_id,
            'is_exist' => 1
        ])->result_array();

        // Process jadwal data
        foreach ($jadwal_list as &$jadwal) {
            $jadwal['kuota_max'] = $jadwal['kouta'];
            $jadwal['kuota_terisi'] = max(0, $jadwal['kouta'] - $jadwal['sisa_kursi']);
            $jadwal['sisa_kuota'] = $jadwal['sisa_kursi'];
            $jadwal['progress_percent'] = $jadwal['kouta'] > 0 ? 
                round((($jadwal['kouta'] - $jadwal['sisa_kursi']) / $jadwal['kouta']) * 100) : 0;
            $jadwal['status_pendaftaran'] = $jadwal['is_daftar'] ? 'buka' : 'tutup';
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $jadwal_list
            ]));
    }
}
?>
