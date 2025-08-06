<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('url');
    }

    public function index($diklat_id = '13-63654-47') 
    {
        // Simple no-cache headers
        $this->output->set_header("Cache-Control: no-cache, must-revalidate");
        $this->output->set_header("Expires: 0");
        
        // Default to SSO diklat if empty
        if (empty($diklat_id)) $diklat_id = '13-63654-47';
        
        // Get diklat info
        $diklat_info = $this->db->get_where('scre_diklat', [
            'id' => $diklat_id
        ])->row_array();
        
        if (!$diklat_info) {
            // Try first available diklat
            $first_diklat = $this->db->get('scre_diklat', 1)->row_array();
            if ($first_diklat) {
                $diklat_id = $first_diklat['id'];
                $diklat_info = $first_diklat;
            } else {
                show_error('No diklat available in database');
            }
        }
        
        // Get jadwal for this diklat
        $jadwal_list = $this->db->get_where('scre_diklat_jadwal', [
            'diklat_id' => $diklat_id,
            'is_exist' => 1
        ])->result_array();
        
        // Calculate kuota info for each jadwal
        foreach ($jadwal_list as &$jadwal) {
            $jadwal['kuota_max'] = $jadwal['kouta']; // Note: database has 'kouta' typo
            $jadwal['kuota_terisi'] = max(0, $jadwal['kouta'] - $jadwal['sisa_kursi']);
            $jadwal['sisa_kuota'] = $jadwal['sisa_kursi'];
            $jadwal['progress_percent'] = $jadwal['kouta'] > 0 ? 
                round((($jadwal['kouta'] - $jadwal['sisa_kursi']) / $jadwal['kouta']) * 100) : 0;
            $jadwal['status_pendaftaran'] = $jadwal['is_daftar'] ? 'buka' : 'tutup';
            $jadwal['jadwal_id'] = $jadwal['id']; // For compatibility
        }
        
        // Get persyaratan (may be empty for now)
        $persyaratan_list = [];
        
        $data = [
            'diklat_id' => $diklat_id,
            'diklat_info' => $diklat_info,
            'jadwal_list' => $jadwal_list,
            'persyaratan_list' => $persyaratan_list
        ];
        
        $this->load->view('frontend/pendaftaran_simple', $data);
    }

    // AJAX method to get jadwal by diklat_id
    public function get_jadwal_by_diklat($diklat_id = null) {
        if (!$diklat_id) {
            $diklat_id = $this->input->get('diklat_id');
        }
        
        if (!$diklat_id) {
            $response = array(
                'success' => false,
                'message' => 'Diklat ID diperlukan'
            );
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
        
        // Get jadwal list for selected diklat
        $this->db->where('diklat_id', $diklat_id);
        $this->db->where('is_exist', 1);
        $this->db->order_by('periode', 'ASC');
        $jadwal_query = $this->db->get('scre_diklat_jadwal');
        
        $jadwal_list = array();
        if ($jadwal_query->num_rows() > 0) {
            $jadwal_list = $jadwal_query->result_array();
            
            // Add calculated fields
            foreach ($jadwal_list as &$jadwal) {
                $kuota = (int)$jadwal['kouta'];
                $jadwal['terdaftar'] = 0;
                $jadwal['sisa_kursi'] = $kuota;
            }
        }
        
        $response = array(
            'success' => true,
            'data' => $jadwal_list
        );
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    public function test_api() {
        echo "API Test Working!";
        echo "<br>Base URL: " . base_url();
        echo "<br>Current URI: " . uri_string();
    }

    public function form($jadwal_id = null) {
        // Load registration form page
        $diklat_id = $_GET['diklat_id'] ?? '14-01807-46';
        
        // Get diklat information
        $diklat = $this->db->get_where('scre_diklat', ['id' => $diklat_id])->row();
        
        $data = [
            'jadwal_id' => $jadwal_id,
            'diklat_info' => [
                'nama_diklat' => $diklat ? $diklat->nama_diklat : 'DP-III NAUTIKA',
                'kode_diklat' => $diklat ? $diklat->kode_diklat : '14-01807-46',
                'diklat_id' => $diklat_id
            ]
        ];
        
        $this->load->view('frontend/form_pendaftaran', $data);
    }

    public function get_diklat_info($diklat_id = null) {
        // Simple test to ensure function is called
        if (!$diklat_id) {
            $diklat_id = $this->input->get('diklat_id');
        }
        
        // Always return success response with sample data for now
        $response = array(
            'success' => true,
            'nama_diklat' => 'DP-III NAUTIKA',
            'kode_diklat' => $diklat_id ?: 'TEST-001',
            'jenis_diklat' => 'SIPENCATAR DIKLAT PELAUT',
            'tempat' => 'Jakarta Utara - Balai Diklat',
            'biaya' => '1750000',
            'kouta' => '30',
            'pendaftaran_mulai' => '2025-08-10',
            'pendaftaran_akhir' => '2025-08-25',
            'pelaksanaan_mulai' => '2025-09-15',
            'pelaksanaan_akhir' => '2025-10-15',
        );
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Ensure no additional output
    }

    public function get_diklat_info_detailed() {
        $diklat_id = $this->input->get('diklat_id');
        $jadwal_id = $this->input->get('jadwal_id');
        $periode = $this->input->get('periode');
        
        if (!$diklat_id) {
            $response = array(
                'status' => 'error',
                'message' => 'Parameter diklat_id diperlukan'
            );
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
        
        // Get diklat information with kategori diklat
        $sql = "SELECT d.*, jd.jenis_diklat as jenis_nama 
                FROM scre_diklat d 
                LEFT JOIN scre_jenis_diklat jd ON d.jenis_diklat_id = jd.id 
                WHERE d.id = ? AND d.is_exist = 1";
        $diklat = $this->db->query($sql, [$diklat_id])->row();
        
        if (!$diklat) {
            $response = array(
                'status' => 'error',
                'message' => 'Diklat tidak ditemukan'
            );
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
        
        // Get jadwal information from URL jadwal_id parameter
        $jadwal_info = null;
        if ($jadwal_id) {
            $jadwal_info = $this->db->get_where('scre_diklat_jadwal', [
                'id' => $jadwal_id,
                'diklat_id' => $diklat_id,
                'is_exist' => 1
            ])->row();
        }
        
        // If no specific jadwal, get first available
        if (!$jadwal_info) {
            $jadwal_info = $this->db->get_where('scre_diklat_jadwal', [
                'diklat_id' => $diklat_id,
                'is_exist' => 1
            ], 1)->row();
        }
        
        // Calculate registered participants (simulate for now)
        $kuota = $jadwal_info ? $jadwal_info->kouta : 0;
        $sisa_kuota = $jadwal_info ? $jadwal_info->sisa_kursi : 0;
        $terdaftar = $kuota - $sisa_kuota;
        
        // Determine status based on dates - also check is_daftar flag
        $status = 'closed';
        $current_date = date('Y-m-d');
        
        if ($jadwal_info) {
            // First check if registration is enabled in database
            if (!$jadwal_info->is_daftar) {
                $status = 'closed';
            }
            // Check if quota is full
            else if ($sisa_kuota <= 0) {
                $status = 'closed';
            }
            // Check registration dates
            else if ($jadwal_info->pendaftaran_mulai && $jadwal_info->pendaftaran_akhir) {
                if ($current_date >= $jadwal_info->pendaftaran_mulai && $current_date <= $jadwal_info->pendaftaran_akhir) {
                    $status = 'open';
                } else if ($current_date < $jadwal_info->pendaftaran_mulai) {
                    $status = 'not_yet_open';
                } else if ($jadwal_info->pelaksanaan_akhir && $current_date > $jadwal_info->pelaksanaan_akhir) {
                    $status = 'execution_passed';
                } else {
                    $status = 'closed';
                }
            }
            // If no registration dates, check execution dates
            else if ($jadwal_info->pelaksanaan_mulai && $jadwal_info->pelaksanaan_akhir) {
                $pelaksanaan_mulai = new DateTime($jadwal_info->pelaksanaan_mulai);
                $pelaksanaan_akhir = new DateTime($jadwal_info->pelaksanaan_akhir);
                $now = new DateTime();
                
                if ($now > $pelaksanaan_akhir) {
                    $status = 'execution_passed';
                } else if ($now > $pelaksanaan_mulai) {
                    $status = 'closed'; // Program sedang berlangsung
                } else {
                    $status = 'open'; // Default open if before execution
                }
            }
            // Default fallback - check is_daftar flag
            else {
                $status = $jadwal_info->is_daftar ? 'open' : 'closed';
            }
        }
        
        $jenis_diklat = 'PROGRAM DIKLAT';
        if (!empty($diklat->jenis_nama)) {
            $jenis_diklat = $diklat->jenis_nama;
        }
        
        $biaya = 0;
        if ($jadwal_info && !empty($jadwal_info->biaya)) {
            $biaya = $jadwal_info->biaya;
        }
        
        $response = array(
            'status' => 'success',
            'data' => array(
                'nama_diklat' => $diklat->nama_diklat,
                'kode_diklat' => $diklat->kode_diklat,
                'jenis_diklat' => $jenis_diklat,
                'tahun' => date('Y'),
                'kuota' => $kuota,
                'terdaftar' => $terdaftar,
                'sisa_kuota' => $sisa_kuota,
                'biaya' => $biaya,
                'status' => $status
            )
        );
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_periode_list($diklat_id) {
        try {
            // Simple query without complex logic
            $this->db->select('*');
            $this->db->from('scre_diklat_jadwal');
            $this->db->where('diklat_id', $diklat_id);
            $this->db->where('is_exist', 1);
            $this->db->order_by('periode', 'ASC');
            
            $jadwal = $this->db->get()->result();
            
            $response = array(
                'success' => true,
                'diklat_id' => $diklat_id,
                'total' => count($jadwal),
                'data' => $jadwal
            );
            
            header('Content-Type: application/json');
            echo json_encode($response);
            
        } catch (Exception $e) {
            $response = array(
                'success' => false,
                'error' => $e->getMessage(),
                'diklat_id' => $diklat_id
            );
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function get_persyaratan($diklat_id) {
        // Get persyaratan for specific diklat with join
        $this->db->select('p.persyaratan, p.jenis_persyaratan');
        $this->db->from('scre_diklat_persyaratan dp');
        $this->db->join('scre_persyaratan p', 'dp.persyaratan_id = p.id');
        $this->db->where('dp.diklat_id', $diklat_id);
        $this->db->where('p.jenis_persyaratan', 0); // 0 = administrasi, 1 = medis
        $this->db->order_by('p.persyaratan', 'ASC');
        
        $persyaratan = $this->db->get()->result();
        
        $response = array(
            'success' => true,
            'data' => $persyaratan
        );
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_tahun($diklat_id) {
        $tahun = $this->db->get_where('scre_diklat_tahun', [
            'diklat_id' => $diklat_id,
            'is_exist' => 1
        ])->result();
        
        header('Content-Type: application/json');
        echo json_encode($tahun);
    }

    public function get_all_diklat_with_status() {
        $this->load->model('Diklat_model');
        
        // Get all diklat with status
        $all_diklat = $this->Diklat_model->get_filtered_with_status();
        
        $response = array(
            'status' => 'success',
            'data' => $all_diklat
        );
        
        header('Content-Type: application/json');
        echo json_encode($response);
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
