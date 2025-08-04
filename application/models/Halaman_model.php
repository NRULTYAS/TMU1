<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Halaman_model extends CI_Model {
    public function get_total_diklat()
    {
        return $this->db->count_all('diklat');
    }
    public function get_total_jenis_diklat()
    {
        return $this->db->count_all('jenis_diklat');
    }
    public function get_total_pendaftar()
    {
        return $this->db->count_all('pendaftar');
    }
    public function get_total_persyaratan()
    {
        return $this->db->count_all('persyaratan');
    }
	public function get_total_diklat_tahun()
    {
        return $this->db->count_all('scre_diklat_tahun');
    }
}
