<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function count_diklat()
    {
        return $this->db->count_all('scre_diklat');
    }

    public function count_jenis_diklat()
    {
        return $this->db->count_all('scre_jenis_diklat');
    }

    public function count_pendaftar()
    {
        // Asumsikan ada tabel pendaftar, jika tidak ada return default
        if ($this->db->table_exists('scre_user')) {
            return $this->db->count_all('scre_user');
        }
        return 100; // Default value
    }

    public function get_latest_diklat($limit = 5)
    {
        $this->db->select('d.*, jd.jenis_diklat');
        $this->db->from('scre_diklat d');
        $this->db->join('scre_jenis_diklat jd', 'd.jenis_diklat_id = jd.id', 'left');
        $this->db->order_by('d.id', 'DESC');
        $this->db->limit($limit);
        
        return $this->db->get()->result();
    }
}
