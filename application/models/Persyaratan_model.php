<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persyaratan_model extends CI_Model
{
    private $table = 'scre_persyaratan';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        // Auto-generate ID: P001, P002, dst
        $this->db->select('MAX(RIGHT(id, 3)) as max_id');
        $query = $this->db->get($this->table);
        $row = $query->row();

        $next_id = 'P001';
        if ($row && $row->max_id) {
            $next = (int) $row->max_id + 1;
            $next_id = 'P' . str_pad($next, 3, '0', STR_PAD_LEFT);
        }

        $data['id'] = $next_id;
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
    public function get_list_persyaratan()
    {
        return $this->get_all();
    }

    public function get_selected_by_diklat($diklat_id)
    {
        $this->db->select('sp.id, sp.persyaratan');
        $this->db->from('scre_diklat_persyaratan sdp');
        $this->db->join('scre_persyaratan sp', 'sdp.persyaratan_id = sp.id');
        $this->db->where('sdp.diklat_id', $diklat_id);
        return $this->db->get()->result();
    }

    public function get_template_belum_dipilih($diklat_id)
    {
        $this->db->select('*');
        $this->db->from('scre_persyaratan');
        $this->db->where("id NOT IN (SELECT persyaratan_id FROM scre_diklat_persyaratan WHERE diklat_id = '$diklat_id')", NULL, FALSE);
        return $this->db->get()->result();
    }

}
