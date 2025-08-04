<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisDiklat_model extends CI_Model
{
    private $table = 'scre_jenis_diklat';

    public function __construct()
    {
        parent::__construct();
    }

    // Ambil semua data
    public function get_all()
    {
        $this->db->order_by('sorting', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Tambah data
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update data berdasarkan ID
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Hapus data berdasarkan ID
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Ambil satu data berdasarkan ID (opsional)
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
}
