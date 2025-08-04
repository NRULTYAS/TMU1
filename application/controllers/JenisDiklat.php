<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisDiklat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('JenisDiklat_model');
    }

    public function index()
    {
        $data['jenis_diklat'] = $this->JenisDiklat_model->get_all();
        $data['dropdown_jenis_diklat'] = $this->JenisDiklat_model->get_all();
        $this->load->view('JenisDiklat/Jenis_Diklat_List', $data);
    }

    public function insert()
    {
        $data = [
            'jenis_diklat' => $this->input->post('jenis_diklat'),
            'sorting' => $this->input->post('sorting')
        ];

        $this->JenisDiklat_model->insert($data);
        redirect('JenisDiklat');
    }

    public function update()
    {
        $id = $this->input->post('id');
        if (empty($id)) {
            show_error("Parameter id tidak boleh kosong");
        }

        $data = [
            'jenis_diklat' => $this->input->post('jenis_diklat'),
            'sorting' => $this->input->post('sorting')
        ];

        $this->JenisDiklat_model->update($id, $data);
        redirect('JenisDiklat');
    }

    public function destroy($id)
    {
        $this->JenisDiklat_model->delete($id);
        redirect('JenisDiklat');
    }
}
