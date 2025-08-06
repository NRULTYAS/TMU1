<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function index() {
        // Get data for homepage
        $data['title'] = 'Portal Pendaftaran Diklat Online';
        
        // Load model safely
        $this->load->model('Diklat_model');
        
        // Get data with error handling
        try {
            $data['total_diklat'] = $this->Diklat_model->count_all_diklat() ?? 0;
            $data['jenis_diklat'] = $this->Diklat_model->get_kategori() ?? [];
        } catch (Exception $e) {
            $data['total_diklat'] = 0;
            $data['jenis_diklat'] = [];
        }
        
        $this->load->view('frontend/home', $data);
    }

    public function about() {
        $data['title'] = 'Tentang Kami - Portal Pendaftaran Diklat';
        $this->load->view('frontend/about', $data);
    }

    public function contact() {
        $data['title'] = 'Kontak - Portal Pendaftaran Diklat';
        $this->load->view('frontend/contact', $data);
    }

    public function detail_jenis($id = null) {
        if (!$id) {
            redirect('/');
        }
        
        $this->load->database();
        $this->load->model('Diklat_model');
        
        // Get jenis diklat detail
        $jenis_diklat = $this->db->get_where('scre_jenis_diklat', ['id' => $id, 'is_exist' => 1])->row();
        
        if (!$jenis_diklat) {
            redirect('/');
        }
        
        // Get diklat programs under this category
        $data['jenis_diklat'] = $jenis_diklat;
        $data['diklat_programs'] = $this->Diklat_model->get_filtered_with_status($id);
        $data['title'] = 'Detail ' . $jenis_diklat->jenis_diklat . ' - Portal Pendaftaran Diklat';
        
        $this->load->view('frontend/detail_jenis', $data);
    }

    public function detail_program($id = null) {
        if (!$id) {
            redirect('/');
        }
        
        $this->load->database();
        $this->load->model('Diklat_model');
        
        // Get program diklat detail
        $program = $this->Diklat_model->get_detail_by_id($id);
        
        if (!$program || $program->is_exist != 1) {
            redirect('/');
        }
        
        // Get jadwal dan persyaratan
        $data['program'] = $program;
        $data['jadwal_list'] = $this->Diklat_model->get_jadwal_by_diklat($id);
        $data['persyaratan_list'] = $this->Diklat_model->get_persyaratan_by_diklat($id);
        $data['title'] = 'Detail ' . $program->nama_diklat . ' - Portal Pendaftaran Diklat';
        
        $this->load->view('frontend/detail_program', $data);
    }
}
