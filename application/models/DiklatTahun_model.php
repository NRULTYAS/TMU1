<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DiklatTahun_model extends CI_Model
{
    // Ambil semua tahun diklat
    public function get_all()
    {
        return $this->db->get('scre_diklat_tahun')->result();
    }

    // Ambil tahun berdasarkan diklat_id
    public function get_by_diklat($diklat_id)
    {
        return $this->db->get_where('scre_diklat_tahun', ['diklat_id' => $diklat_id])->result();
    }

    // Simpan data tahun baru
    public function insert($data)
    {
        return $this->db->insert('scre_diklat_tahun', $data);
    }

    // Update data tahun berdasarkan ID
    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('scre_diklat_tahun', $data);
    }

    // Hapus tahun berdasarkan ID
    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('scre_diklat_tahun');
    }

    // Cek apakah tahun sudah ada untuk diklat tertentu (opsional)
    public function exists_in_diklat($diklat_id, $tahun)
    {
        return $this->db->get_where('scre_diklat_tahun', [
            'diklat_id' => $diklat_id,
            'tahun' => $tahun
        ])->num_rows() > 0;
    }

    // Toggle status aktif tahun diklat
    public function toggle_active_status($tahun_id, $diklat_id, $is_active)
    {
        // Mulai transaction
        $this->db->trans_start();
        
        try {
            if ($is_active == 1) {
                // Jika mengaktifkan, nonaktifkan semua tahun lain untuk diklat ini
                $this->db->where('diklat_id', $diklat_id);
                $this->db->where('id !=', $tahun_id);
                $this->db->update('scre_diklat_tahun', ['is_active' => 0]);
            }
            
            // Update status tahun yang dipilih
            $this->db->where('id', $tahun_id);
            $this->db->update('scre_diklat_tahun', ['is_active' => $is_active]);
            
            $this->db->trans_complete();
            
            return $this->db->trans_status() !== FALSE;
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }
}
