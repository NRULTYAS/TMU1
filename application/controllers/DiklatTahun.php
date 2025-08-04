<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DiklatTahun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DiklatTahun_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['tahun_diklat'] = $this->DiklatTahun_model->get_all();
        $this->load->view('diklat/DiklatTahun_list', $data);
    }

    public function insert()
    {
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            redirect('DiklatTahun');
        } else {
            // Generate id unik yang benar-benar random dan kecil kemungkinan duplikat
            $this->load->helper('string');
			$id = unique_code();
			$data = [
				'id' => $id,
				'tahun' => $this->input->post('tahun', true)
			];
            // do {
            //     $exists = $this->db->get_where('scre_diklat_tahun', ['id' => $id])->num_rows();
            // } while ($exists > 0);
            $this->DiklatTahun_model->insert($data);
            $this->session->set_flashdata('success', 'Data tahun diklat berhasil ditambahkan.');
            redirect('DiklatTahun');
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('id', 'ID', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Gagal mengedit data tahun diklat.');
            redirect('DiklatTahun');
        } else {
            $id = $this->input->post('id', true);
            $data = [
                'tahun' => $this->input->post('tahun', true)
            ];
            $this->DiklatTahun_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data tahun diklat berhasil diperbarui.');
            redirect('DiklatTahun');
        }
    }

    public function hapus($id = null)
{
    if (!$id) {
        show_error('ID tidak valid');
    }
    $this->DiklatTahun_model->delete($id);
    $this->session->set_flashdata('success', 'Data tahun diklat berhasil dihapus.');
    redirect('DiklatTahun');
}
}
