<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diklat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Diklat_model');
		$this->load->model('Persyaratan_model');
		$this->load->library('form_validation');
		$this->load->model('DiklatTahun_model');
	}

	public function index()
	{
		$kategori = $this->input->get('kategori');
		$data['kategori'] = $kategori;
		$data['kategori_list'] = $this->Diklat_model->get_kategori();
		$all = $this->Diklat_model->get_filtered($kategori);
	
		if (!empty($all)) {
			usort($all, function ($a, $b) {
				return strcmp($a->id, $b->id);
			});
	
			foreach ($all as $i => $row) {
				$row->no_urut = $i + 1;
			}
		}
	
		$data['diklat'] = $all;
		$this->load->view('diklat/Diklat_List', $data);
	}

	public function add()
	{
		$data['kategori_list'] = $this->Diklat_model->get_kategori();
		$this->load->view('Diklat/Diklat_Form', $data);
	}

	public function insert()
	{
		$data = [
			'id' => $this->input->post('id'),
			'jenis_diklat_id' => $this->input->post('jenis_diklat_id'),
			'kode_diklat' => $this->input->post('kode_diklat'),
			'nama_diklat' => $this->input->post('nama_diklat')
		];

		$this->Diklat_model->insert($data);
		$this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
		redirect('Diklat');
	}

	public function edit($id)
	{
		$data['row'] = $this->Diklat_model->get_by_id($id);
		$data['kategori_list'] = $this->Diklat_model->get_kategori();
		$this->load->view('Diklat/Diklat_Form', $data);
	}

	public function update($id)
	{
		$data = [
			'jenis_diklat_id' => $this->input->post('jenis_diklat_id'),
			'kode_diklat' => $this->input->post('kode_diklat'),
			'nama_diklat' => $this->input->post('nama_diklat')
		];

		$this->Diklat_model->update($id, $data);
		redirect('Diklat');
	}

	public function delete($id)
	{
		$this->Diklat_model->delete($id);
		redirect('Diklat');
	}

	public function destroy($id)
	{
		$this->Diklat_model->delete($id);
		redirect('Diklat');
	}

	public function persyaratan($id)
	{
		$this->load->model('Diklat_model');
		$this->load->model('Persyaratan_model');

		$diklat = $this->Diklat_model->get_detail_by_id($id);

		if (!$diklat) {
			show_404();
		}

		$data['diklat_id'] = $id;
		$data['diklat_nama'] = $diklat->nama_diklat;

		// Ganti tanda hubung dengan spasi
		$data['jenis_diklat'] = str_replace('-', ' ', $diklat->jenis_diklat);

		$data['template_persyaratan'] = $this->Persyaratan_model->get_template_belum_dipilih($id);
		$data['persyaratan_dipilih'] = $this->Persyaratan_model->get_selected_by_diklat($id);

		$this->load->view('diklat/Persyaratan_view', $data);
	}

	public function tambah_persyaratan($diklat_id, $persyaratan_id)
	{
		$data = [
			'id' => uniqid(),
			'diklat_id' => $diklat_id,
			'persyaratan_id' => $persyaratan_id
		];
		$this->db->insert('scre_diklat_persyaratan', $data);
		$this->session->set_flashdata('success', 'Persyaratan berhasil ditambahkan.');
		redirect('Diklat/persyaratan/' . $diklat_id);
	}

	public function hapus_persyaratan($diklat_id, $persyaratan_id)
	{
		$this->db->where('diklat_id', $diklat_id);
		$this->db->where('persyaratan_id', $persyaratan_id);
		$this->db->delete('scre_diklat_persyaratan');

		$this->session->set_flashdata('success', 'Persyaratan berhasil dihapus.');
		redirect('Diklat/persyaratan/' . $diklat_id);
	}

	public function ajax_tambah_persyaratan()
	{
		$diklat_id = $this->input->post('diklat_id');
		$persyaratan_id = $this->input->post('persyaratan_id');

		$exists = $this->db->get_where('scre_diklat_persyaratan', [
			'diklat_id' => $diklat_id,
			'persyaratan_id' => $persyaratan_id
		])->row();

		if (!$exists) {
			$this->db->insert('scre_diklat_persyaratan', [
				'id' => uniqid(),
				'diklat_id' => $diklat_id,
				'persyaratan_id' => $persyaratan_id
			]);
		}

		$persyaratan = $this->db->get_where('scre_persyaratan', ['id' => $persyaratan_id])->row();

		header('Content-Type: application/json');
		echo json_encode([
			'id' => $persyaratan_id,
			'persyaratan' => $persyaratan ? $persyaratan->persyaratan : ''
		]);
		exit;
	}

	public function ajax_hapus_persyaratan()
	{
		$diklat_id = $this->input->post('diklat_id');
		$persyaratan_id = $this->input->post('persyaratan_id');

		$this->db->where('diklat_id', $diklat_id);
		$this->db->where('persyaratan_id', $persyaratan_id);
		$this->db->delete('scre_diklat_persyaratan');

		$persyaratan = $this->db->get_where('scre_persyaratan', ['id' => $persyaratan_id])->row();

		header('Content-Type: application/json');
		echo json_encode([
			'status' => 'deleted',
			'id' => $persyaratan_id,
			'persyaratan' => $persyaratan ? $persyaratan->persyaratan : ''
		]);
		exit;
	}

	public function tahun($id)
	{
		$this->load->model('Diklat_model');
		$this->load->model('DiklatTahun_model');

		$diklat = $this->Diklat_model->get_detail_by_id($id);

		if (!$diklat) {
			show_error("Diklat tidak ditemukan");
		}

		$tahun_diklat = $this->DiklatTahun_model->get_by_diklat($id);

		$data = [
			'tahun_diklat' => $tahun_diklat,
			'diklat_id' => $id,
			'diklat_nama' => $diklat->nama_diklat,
			'jenis_diklat' => str_replace('-', ' ', $diklat->jenis_diklat)
		];

		$this->load->view('diklat/DiklatTahun_list', $data);
	}


	public function tambah_tahun($diklat_id)
	{
		$this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');

		if ($this->form_validation->run()) {
			$this->load->helper('string');
			do {
				$id = random_string('alnum', 15);
			} while ($this->db->get_where('scre_diklat_tahun', ['id' => $id])->num_rows() > 0);

			$data = [
				'id' => $id,
				'tahun' => $this->input->post('tahun', true),
				'diklat_id' => $diklat_id,
				'is_exist' => 1
			];
			$this->DiklatTahun_model->insert($data);
			$this->session->set_flashdata('success', 'Tahun diklat berhasil ditambahkan.');
		} else {
			$this->session->set_flashdata('error', 'Tahun tidak valid.');
		}

		redirect('Diklat/tahun/' . $diklat_id);
	}

	public function update_tahun($diklat_id)
	{
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'required|trim');

		if ($this->form_validation->run()) {
			$id = $this->input->post('id', true);
			$data = ['tahun' => $this->input->post('tahun', true)];
			$this->DiklatTahun_model->update($id, $data);
			$this->session->set_flashdata('success', 'Tahun diklat berhasil diperbarui.');
		} else {
			$this->session->set_flashdata('error', 'Gagal memperbarui tahun.');
		}

		redirect('Diklat/tahun/' . $diklat_id);
	}

	public function hapus_tahun($diklat_id, $tahun_id)
	{
		$this->DiklatTahun_model->delete($tahun_id);
		$this->session->set_flashdata('success', 'Tahun diklat berhasil dihapus.');
		redirect('Diklat/tahun/' . $diklat_id);
	}

	private function _rules()
	{
		$this->form_validation->set_rules('nama_diklat', 'Nama Diklat', 'required');
		$this->form_validation->set_rules('kode_diklat', 'Kode Diklat', 'required');
		$this->form_validation->set_rules('jenis_diklat_id', 'Kategori', 'required');
		$this->form_validation->set_rules('check_kesehatan', 'Pemeriksaan Kesehatan', 'required');
	}

	public function toggle_active_tahun()
	{
		// Set header untuk JSON response
		header('Content-Type: application/json');
		
		$tahun_id = $this->input->post('tahun_id');
		$diklat_id = $this->input->post('diklat_id');
		$is_active = (int) $this->input->post('is_active');
		
		if (!$tahun_id || !$diklat_id) {
			echo json_encode(['success' => false, 'message' => 'Parameter tidak lengkap']);
			return;
		}
		
		// Gunakan model untuk toggle status
		$result = $this->DiklatTahun_model->toggle_active_status($tahun_id, $diklat_id, $is_active);
		
		if ($result) {
			$status_text = $is_active ? 'diaktifkan' : 'dinonaktifkan';
			echo json_encode([
				'success' => true, 
				'message' => "Status tahun berhasil $status_text"
			]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Gagal mengupdate status aktif']);
		}
	}
}
