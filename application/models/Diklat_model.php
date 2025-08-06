<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diklat_model extends CI_Model
{
    private $table = 'scre_diklat';

    // Ambil semua kategori dari tabel scre_jenis_diklat
    public function get_kategori()
    {
        return $this->db
            ->where('is_exist', 1)
            ->order_by('sorting', 'ASC')
            ->get('scre_jenis_diklat')
            ->result();
    }


    // Ambil semua diklat, bisa difilter per kategori
    public function get_filtered($kategori = null)
    {
        $this->db->select('d.*, j.jenis_diklat');
        $this->db->from($this->table . ' d');
        $this->db->join('scre_jenis_diklat j', 'j.id = d.jenis_diklat_id', 'left');
        $this->db->where('d.is_exist', 1);
        if ($kategori) {
            $this->db->where('d.jenis_diklat_id', $kategori);
        }
        $this->db->order_by('j.sorting ASC, d.kode_diklat ASC');
        return $this->db->get()->result();
    }

    // Ambil 1 data berdasarkan ID
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Simpan data baru
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update data berdasarkan ID
    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    // Get all diklat dengan informasi jadwal
    public function get_all_diklat_with_jadwal()
    {
        $this->db->select('
            d.id, 
            d.nama_diklat, 
            d.kode_diklat, 
            d.is_exist,
            d.check_kesehatan,
            j.jenis_diklat,
            COUNT(dj.id) as total_jadwal,
            COUNT(CASE WHEN dj.is_exist = 1 THEN 1 END) as jadwal_aktif
        ');
        $this->db->from($this->table . ' d');
        $this->db->join('scre_jenis_diklat j', 'j.id = d.jenis_diklat_id', 'left');
        $this->db->join('scre_diklat_jadwal dj', 'dj.diklat_id = d.id', 'left');
        $this->db->group_by('d.id');
        $this->db->order_by('d.is_exist DESC, j.sorting ASC, d.kode_diklat ASC');
        
        return $this->db->get()->result_array();
    }

    // Soft delete: hanya ubah is_exist = 0
    public function delete($id)
    {
        return $this->db->where('id', $id)->update($this->table, ['is_exist' => 0]);
    }
    
    // Hitung total semua diklat
    public function count_all_diklat()
    {
        return $this->db->where('is_exist', 1)->count_all_results($this->table);
    }
    
    // Ambil semua diklat
    public function get_all_diklat()
    {
        $this->db->select('d.*, j.jenis_diklat');
        $this->db->from($this->table . ' d');
        $this->db->join('scre_jenis_diklat j', 'j.id = d.jenis_diklat_id', 'left');
        $this->db->where('d.is_exist', 1);
        $this->db->order_by('d.id', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_all()
    {
        return $this->db->get_where($this->table, ['is_exist' => 1])->result();
    }
    public function get_by_nama_jenis($nama_diklat, $jenis_diklat)
    {
        $this->db->select('d.*, j.jenis_diklat');
        $this->db->from('scre_diklat d');
        $this->db->join('scre_jenis_diklat j', 'd.jenis_diklat_id = j.id');
        $this->db->where('d.nama_diklat', $nama_diklat);
        $this->db->where('j.jenis_diklat', $jenis_diklat);
        return $this->db->get()->row();
    }
    public function get_detail_by_id($id)
    {
        $this->db->select('d.*, j.jenis_diklat');
        $this->db->from('scre_diklat d');
        $this->db->join('scre_jenis_diklat j', 'j.id = d.jenis_diklat_id', 'left');
        $this->db->where('d.id', $id);
        return $this->db->get()->row();
    }

// ✅ Ambil tahun diklat berdasarkan diklat_id
    public function get_tahun_by_diklat($diklat_id)
    {
        return $this->db
            ->where('diklat_id', $diklat_id)
            ->where('is_exist', 1)
            ->order_by('tahun', 'DESC')
            ->get($this->tahun_table)
            ->result();
    }

    // ✅ Ambil 1 tahun diklat berdasarkan ID tahun
    public function get_tahun_by_id($tahun_id)
    {
        return $this->db->get_where($this->tahun_table, ['id' => $tahun_id])->row();
    }

    // ✅ Insert tahun diklat
    public function insert_tahun($data)
    {
        return $this->db->insert($this->tahun_table, $data);
    }

    // ✅ Update tahun diklat
    public function update_tahun($tahun_id, $data)
    {
        return $this->db->where('id', $tahun_id)->update($this->tahun_table, $data);
    }

    // ✅ Soft delete tahun diklat
    public function delete_tahun($tahun_id)
    {
        return $this->db->where('id', $tahun_id)->update($this->tahun_table, ['is_exist' => 0]);
    }

    // Get jadwal diklat berdasarkan diklat_id
    public function get_jadwal_by_diklat($diklat_id)
    {
        $this->db->select('j.*, dt.tahun');
        $this->db->from('scre_diklat_jadwal j');
        $this->db->join('scre_diklat_tahun dt', 'dt.id = j.diklat_tahun_id', 'left');
        $this->db->where('j.diklat_id', $diklat_id);
        $this->db->where('j.is_exist', 1);
        $this->db->where('j.is_daftar', 1); // hanya jadwal yang bisa didaftar
        $this->db->order_by('j.pelaksanaan_mulai', 'ASC');
        return $this->db->get()->result();
    }

    // Get persyaratan diklat berdasarkan diklat_id
    public function get_persyaratan_by_diklat($diklat_id)
    {
        $this->db->select('p.persyaratan');
        $this->db->from('scre_diklat_persyaratan dp');
        $this->db->join('scre_persyaratan p', 'p.id = dp.persyaratan_id');
        $this->db->where('dp.diklat_id', $diklat_id);
        return $this->db->get()->result();
    }

    // Get diklat with registration status
    public function get_filtered_with_status($kategori = null)
    {
        $this->db->select('d.*, j.jenis_diklat');
        $this->db->from($this->table . ' d');
        $this->db->join('scre_jenis_diklat j', 'j.id = d.jenis_diklat_id', 'left');
        $this->db->where('d.is_exist', 1);
        if ($kategori) {
            $this->db->where('d.jenis_diklat_id', $kategori);
        }
        $this->db->order_by('j.sorting ASC, d.kode_diklat ASC');
        $results = $this->db->get()->result();
        
        // Add status to each diklat
        foreach ($results as $diklat) {
            $diklat->status = $this->get_diklat_status($diklat->id);
        }
        
        return $results;
    }

    // Get registration status for a specific diklat
    public function get_diklat_status($diklat_id)
    {
        // Get active jadwal for this diklat
        $this->db->select('*');
        $this->db->from('scre_diklat_jadwal');
        $this->db->where('diklat_id', $diklat_id);
        $this->db->where('is_exist', 1);
        $this->db->order_by('pendaftaran_mulai', 'ASC');
        $jadwal_list = $this->db->get()->result();
        
        if (empty($jadwal_list)) {
            return 'closed';
        }
        
        // Use current date in Asia/Jakarta timezone
        date_default_timezone_set('Asia/Jakarta');
        $current_date = date('Y-m-d');
        $status = 'closed';
        $has_future_registration = false;
        
        foreach ($jadwal_list as $jadwal) {
            // Skip if registration is disabled
            if ($jadwal->is_daftar != 1) {
                continue;
            }
            
            if ($jadwal->pendaftaran_mulai && $jadwal->pendaftaran_akhir) {
                // Compare dates using string comparison for accuracy
                if ($current_date >= $jadwal->pendaftaran_mulai && $current_date <= $jadwal->pendaftaran_akhir) {
                    // Registration is currently open
                    return 'open';
                } elseif ($current_date < $jadwal->pendaftaran_mulai) {
                    // Registration will open in the future
                    $has_future_registration = true;
                    if ($status == 'closed') {
                        $status = 'not_yet_open';
                    }
                } elseif ($current_date > $jadwal->pendaftaran_akhir) {
                    // Registration has closed
                    if ($jadwal->pelaksanaan_akhir && $current_date > $jadwal->pelaksanaan_akhir) {
                        // Execution has also passed
                        if ($status != 'open' && $status != 'not_yet_open') {
                            $status = 'execution_passed';
                        }
                    } else {
                        // Registration closed but execution not yet passed
                        if ($status != 'open' && $status != 'not_yet_open') {
                            $status = 'registration_closed';
                        }
                    }
                }
            }
        }
        
        // If we found future registrations, prefer that status
        if ($has_future_registration && $status == 'closed') {
            $status = 'not_yet_open';
        }
        
        return $status;
    }
}
