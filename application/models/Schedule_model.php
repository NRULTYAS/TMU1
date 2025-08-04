
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends CI_Model
{
    public function get_all_tahun()
    {
        return $this->db->get('scre_diklat_tahun')->result();
    }

    public function get_all_diklat()
    {
        return $this->db->get('scre_diklat')->result();
    }

    public function get_tahun_pelaksanaan_from_tahun_kode($tahun_kode)
    {
        $this->db->where('id', $tahun_kode);
        $query = $this->db->get('scre_diklat_tahun')->row();
        return $query ? $query->tahun : null;
    }

    public function count_by_diklat_tahun($diklat_id, $tahun_id, $tahun_pelaksanaan = null)
    {
        $this->db->from('scre_diklat_jadwal');
        if ($diklat_id) {
            $this->db->where('diklat_id', $diklat_id);
        }
        
        // Gunakan tahun dari pelaksanaan_mulai jika tahun_id adalah angka tahun
        if ($tahun_id && is_numeric($tahun_id) && $tahun_id >= 2020 && $tahun_id <= 2030) {
            $this->db->where('YEAR(pelaksanaan_mulai)', $tahun_id);
        } else if ($tahun_id) {
            // Fallback ke diklat_tahun_id jika tahun_id bukan angka tahun
            $this->db->where('diklat_tahun_id', $tahun_id);
        }
        
        return $this->db->count_all_results();
    }

    public function get_by_diklat_tahun($diklat_id, $tahun_id, $tahun_pelaksanaan = null, $limit, $start)
    {
        $this->db->select('jd.*, d.nama_diklat, jdk.jenis_diklat, YEAR(jd.pelaksanaan_mulai) as tahun');
        $this->db->from('scre_diklat_jadwal jd');
        $this->db->join('scre_diklat d', 'jd.diklat_id = d.id', 'left');
        $this->db->join('scre_jenis_diklat jdk', 'd.jenis_diklat_id = jdk.id', 'left');

        if ($diklat_id) {
            $this->db->where('jd.diklat_id', $diklat_id);
        }
        
        // Gunakan tahun dari pelaksanaan_mulai jika tahun_id adalah angka tahun
        if ($tahun_id && is_numeric($tahun_id) && $tahun_id >= 2020 && $tahun_id <= 2030) {
            $this->db->where('YEAR(jd.pelaksanaan_mulai)', $tahun_id);
        } else if ($tahun_id) {
            // Fallback ke diklat_tahun_id jika tahun_id bukan angka tahun
            $this->db->where('jd.diklat_tahun_id', $tahun_id);
        }
        
        $this->db->order_by('jd.pelaksanaan_mulai', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function get_by_diklat($diklat_id, $limit, $start)
    {
        $this->db->select('jd.*, d.nama_diklat, jdk.jenis_diklat, dt.tahun');
        $this->db->from('scre_diklat_jadwal jd');
        $this->db->join('scre_diklat d', 'jd.diklat_id = d.id', 'left');
        $this->db->join('scre_jenis_diklat jdk', 'd.jenis_diklat_id = jdk.id', 'left');
        $this->db->join('scre_diklat_tahun dt', 'jd.diklat_tahun_id = dt.id', 'left');
        $this->db->where('jd.diklat_id', $diklat_id);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function get_diklat_name($diklat_id)
    {
        $this->db->where('id', $diklat_id);
        $query = $this->db->get('scre_diklat')->row();
        return $query ? $query->nama_diklat : '-';
    }

    public function get_jenis_diklat($diklat_id)
    {
        $this->db->select('jdk.jenis_diklat');
        $this->db->from('scre_diklat d');
        $this->db->join('scre_jenis_diklat jdk', 'd.jenis_diklat_id = jdk.id', 'left');
        $this->db->where('d.id', $diklat_id);
        $query = $this->db->get()->row();
        return $query ? $query->jenis_diklat : '-';
    }

    public function get_tahun_pelaksanaan_from_tahun_id($tahun_id)
    {
        if (!$tahun_id) return null;
        
        $this->db->where('id', $tahun_id);
        $query = $this->db->get('scre_diklat_tahun')->row();
        return $query ? $query->tahun : null;
    }
}
