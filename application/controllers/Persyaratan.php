<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persyaratan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Persyaratan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['persyaratan'] = $this->Persyaratan_model->get_all();
        $this->load->view('persyaratan/Persyaratan_list', $data);
    }

    public function insert()
    {
        $this->form_validation->set_rules('persyaratan', 'Persyaratan', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            redirect('persyaratan');
        } else {
            $data = [
                'id' => uniqid(),
                'persyaratan' => $this->input->post('persyaratan', true)
            ];
            $this->Persyaratan_model->insert($data);
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
            redirect('persyaratan');
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('persyaratan', 'Persyaratan', 'required|trim');
        $this->form_validation->set_rules('id', 'ID', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Gagal mengedit data.');
            redirect('persyaratan');
        } else {
            $id = $this->input->post('id', true);
            $data = [
                'persyaratan' => $this->input->post('persyaratan', true)
            ];
            $this->Persyaratan_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
            redirect('persyaratan');
        }
    }

    public function hapus($id)
    {
        $this->Persyaratan_model->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect('persyaratan');
    }
}
