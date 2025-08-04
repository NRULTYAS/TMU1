<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Schedule_model');
        $this->load->library('pagination');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
    }

    public function index()
    {
        // Redirect ke halaman diklat jika tidak ada parameter
        redirect('Diklat');
    }

    public function show_by_diklat($diklat_id)
    {
        $limit = 200;
        $start = 0;

        $jadwal = $this->Schedule_model->get_by_diklat($diklat_id, $limit, $start);

        $data = [
            'jadwal' => $jadwal,
            'pagination' => '',
            'diklat_nama' => $this->Schedule_model->get_diklat_name($diklat_id),
            'jenis_diklat' => $this->Schedule_model->get_jenis_diklat($diklat_id),
            'diklat_id' => $diklat_id,
            'back_id' => $diklat_id,
            'list_tahun' => $this->Schedule_model->get_all_tahun(),
            'start' => $start,
            'tahun_id' => null
        ];

        $this->load->view('schedule/Schedule_list', $data);
    }

    public function show_by_tahun_diklat($diklat_id = null, $tahun_id = null)
    {
        // Validasi parameter
        if (!$tahun_id || !$diklat_id) {
            show_404();
            return;
        }

        // Ambil semua jadwal untuk kombinasi tahun + diklat
        $jadwal = $this->Schedule_model->get_by_diklat_tahun($diklat_id, $tahun_id, null, 1000, 0);

        $data = [
            'jadwal' => $jadwal,
            'diklat_nama' => $this->Schedule_model->get_diklat_name($diklat_id),
            'jenis_diklat' => $this->Schedule_model->get_jenis_diklat($diklat_id),
            'diklat_id' => $diklat_id,
            'tahun_id' => $tahun_id,
            'back_id' => $diklat_id,
            'pagination' => '',
            'start' => 0
        ];

        $this->load->view('schedule/Schedule_list', $data);
    }

    public function upload_form($diklat_id = null, $tahun_id = null)
    {
        if (!$diklat_id || !$tahun_id) {
            show_404();
            return;
        }

        $data = [
            'diklat_id' => $diklat_id,
            'tahun_id' => $tahun_id,
            'diklat_nama' => $this->Schedule_model->get_diklat_name($diklat_id),
            'jenis_diklat' => $this->Schedule_model->get_jenis_diklat($diklat_id)
        ];

        $this->load->view('schedule/upload_excel', $data);
    }

    public function process_upload()
    {
        $diklat_id = $this->input->post('diklat_id');
        $tahun_id = $this->input->post('tahun_id');

        if (!$diklat_id || !$tahun_id) {
            $this->session->set_flashdata('error', 'Parameter diklat dan tahun harus ada!');
            redirect('Diklat');
            return;
        }

        // Check if file was uploaded
        if (empty($_FILES['excel_file']['name'])) {
            $this->session->set_flashdata('error', 'Silakan pilih file Excel yang akan diupload!');
            redirect("Schedule/upload_form/$tahun_id/$diklat_id");
            return;
        }

        // Load composer autoloader
        require_once FCPATH . 'vendor/autoload.php';

        $config['upload_path'] = './uploads/temp/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 2048; // 2MB
        
        // Create directory if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('excel_file')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Upload failed: ' . $error);
            redirect("Schedule/upload_form/$tahun_id/$diklat_id");
            return;
        }

        $upload_data = $this->upload->data();
        $file_path = $upload_data['full_path'];

        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();
            
            $success_count = 0;
            $error_messages = [];

            // Start from row 2 (skip header)
            $row = 2;
            while (true) {
                $periode = $worksheet->getCell("A$row")->getCalculatedValue();
                if (empty($periode)) break; // Stop if no more data

                $pendaftaran_mulai = $worksheet->getCell("B$row")->getFormattedValue();
                $pendaftaran_akhir = $worksheet->getCell("C$row")->getFormattedValue();
                $pelaksanaan_mulai = $worksheet->getCell("D$row")->getFormattedValue();
                $pelaksanaan_akhir = $worksheet->getCell("E$row")->getFormattedValue();
                $jumlah_kelas = $worksheet->getCell("F$row")->getCalculatedValue();
                $kuota = $worksheet->getCell("G$row")->getCalculatedValue();
                $kuota_per_kelas = $worksheet->getCell("H$row")->getCalculatedValue();

                // Convert Excel date to MySQL format
                try {
                    if (is_numeric($pendaftaran_mulai)) {
                        $pendaftaran_mulai = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pendaftaran_mulai)->format('Y-m-d');
                    } else {
                        $pendaftaran_mulai = date('Y-m-d', strtotime($pendaftaran_mulai));
                    }
                    
                    if (is_numeric($pendaftaran_akhir)) {
                        $pendaftaran_akhir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pendaftaran_akhir)->format('Y-m-d');
                    } else {
                        $pendaftaran_akhir = date('Y-m-d', strtotime($pendaftaran_akhir));
                    }

                    if (is_numeric($pelaksanaan_mulai)) {
                        $pelaksanaan_mulai = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pelaksanaan_mulai)->format('Y-m-d');
                    } else {
                        $pelaksanaan_mulai = date('Y-m-d', strtotime($pelaksanaan_mulai));
                    }

                    if (is_numeric($pelaksanaan_akhir)) {
                        $pelaksanaan_akhir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($pelaksanaan_akhir)->format('Y-m-d');
                    } else {
                        $pelaksanaan_akhir = date('Y-m-d', strtotime($pelaksanaan_akhir));
                    }
                } catch (Exception $e) {
                    $error_messages[] = "Row $row: Error parsing date - " . $e->getMessage();
                    $row++;
                    continue;
                }

                // Generate unique ID
                $this->load->helper('string');
                do {
                    $jadwal_id = random_string('alnum', 15);
                } while ($this->db->get_where('scre_diklat_jadwal', ['id' => $jadwal_id])->num_rows() > 0);

                // Insert data
                $data_jadwal = [
                    'id' => $jadwal_id,
                    'diklat_id' => $diklat_id,
                    'diklat_tahun_id' => $tahun_id,
                    'periode' => $periode,
                    'pendaftaran_mulai' => $pendaftaran_mulai,
                    'pendaftaran_akhir' => $pendaftaran_akhir,
                    'pelaksanaan_mulai' => $pelaksanaan_mulai,
                    'pelaksanaan_akhir' => $pelaksanaan_akhir,
                    'jumlah_kelas' => (int)$jumlah_kelas,
                    'kouta' => (int)$kuota,
                    'kuota_per_kelas' => (int)$kuota_per_kelas,
                    'sisa_kursi' => (int)$kuota,
                    'is_daftar' => 1,
                    'is_exist' => 1
                ];

                if ($this->db->insert('scre_diklat_jadwal', $data_jadwal)) {
                    $success_count++;
                } else {
                    $error_messages[] = "Row $row: Failed to insert data";
                }

                $row++;
            }

            // Clean up temp file
            unlink($file_path);

            if ($success_count > 0) {
                $message = "$success_count jadwal berhasil diupload!";
                if (!empty($error_messages)) {
                    $message .= " Dengan " . count($error_messages) . " error.";
                }
                $this->session->set_flashdata('success', $message);
            } else {
                $this->session->set_flashdata('error', 'Tidak ada data yang berhasil diupload. Errors: ' . implode(', ', $error_messages));
            }

        } catch (Exception $e) {
            unlink($file_path);
            $this->session->set_flashdata('error', 'Error reading Excel file: ' . $e->getMessage());
        }

        redirect("Schedule/$tahun_id/$diklat_id");
    }

    public function download_template($diklat_id = null, $tahun_id = null)
    {
        // Load composer autoloader
        require_once FCPATH . 'vendor/autoload.php';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Periode');
        $sheet->setCellValue('B1', 'Pendaftaran Mulai');
        $sheet->setCellValue('C1', 'Pendaftaran Akhir');
        $sheet->setCellValue('D1', 'Pelaksanaan Mulai');
        $sheet->setCellValue('E1', 'Pelaksanaan Akhir');
        $sheet->setCellValue('F1', 'Jumlah Kelas');
        $sheet->setCellValue('G1', 'Kuota');
        $sheet->setCellValue('H1', 'Kuota Per Kelas');

        // Style headers
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setRGB('D3D3D3');

        // Add sample data
        $sheet->setCellValue('A2', '1');
        $sheet->setCellValue('B2', '2025-01-01');
        $sheet->setCellValue('C2', '2025-01-25');
        $sheet->setCellValue('D2', '2025-02-01');
        $sheet->setCellValue('E2', '2025-02-15');
        $sheet->setCellValue('F2', '2');
        $sheet->setCellValue('G2', '40');
        $sheet->setCellValue('H2', '20');

        $sheet->setCellValue('A3', '2');
        $sheet->setCellValue('B3', '2025-03-01');
        $sheet->setCellValue('C3', '2025-03-25');
        $sheet->setCellValue('D3', '2025-04-01');
        $sheet->setCellValue('E3', '2025-04-15');
        $sheet->setCellValue('F3', '3');
        $sheet->setCellValue('G3', '60');
        $sheet->setCellValue('H3', '20');

        // Auto width
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create writer and download
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        $filename = 'template_schedule_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }

    public function update_jadwal()
    {
        $this->load->library('session');
        $this->load->helper('url');
        
        $jadwal_id = $this->input->post('jadwal_id');
        $diklat_id = $this->input->post('diklat_id');
        $tahun_id = $this->input->post('tahun_id');
        
        if (!$jadwal_id) {
            $this->session->set_flashdata('error', 'ID jadwal tidak valid!');
            redirect('Schedule');
            return;
        }

        $data = array(
            'periode' => $this->input->post('periode'),
            'pelaksanaan_mulai' => $this->input->post('pelaksanaan_mulai') ?: null,
            'pelaksanaan_akhir' => $this->input->post('pelaksanaan_akhir') ?: null,
            'pendaftaran_mulai' => $this->input->post('pendaftaran_mulai') ?: null,
            'pendaftaran_akhir' => $this->input->post('pendaftaran_akhir') ?: null,
            'jumlah_kelas' => $this->input->post('jumlah_kelas'),
            'kouta' => $this->input->post('kouta') ?: 0,
            'kuota_per_kelas' => $this->input->post('kuota_per_kelas') ?: 0,
            'sisa_kursi' => $this->input->post('sisa_kursi') ?: 0
        );

        $this->db->where('id', $jadwal_id);
        
        if ($this->db->update('scre_diklat_jadwal', $data)) {
            $this->session->set_flashdata('success', 'Jadwal berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui jadwal!');
        }

        // Redirect back to the schedule list
        if ($diklat_id && $tahun_id) {
            redirect("Schedule/show_by_tahun_diklat/$diklat_id/$tahun_id");
        } else {
            redirect('Schedule');
        }
    }

    public function delete_jadwal($jadwal_id = null, $diklat_id = null, $tahun_id = null)
    {
        if (!$jadwal_id) {
            $this->session->set_flashdata('error', 'ID jadwal tidak valid!');
            redirect($_SERVER['HTTP_REFERER']);
            return;
        }

        // Check if the record exists
        $this->db->where('id', $jadwal_id);
        $jadwal = $this->db->get('scre_diklat_jadwal')->row();
        
        if (!$jadwal) {
            $this->session->set_flashdata('error', 'Jadwal tidak ditemukan!');
            redirect($_SERVER['HTTP_REFERER']);
            return;
        }

        // Delete the record
        $this->db->where('id', $jadwal_id);
        
        if ($this->db->delete('scre_diklat_jadwal')) {
            $this->session->set_flashdata('success', 'Jadwal berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus jadwal!');
        }

        // Redirect back to the schedule list
        if ($diklat_id && $tahun_id) {
            redirect("Schedule/$diklat_id/$tahun_id");
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
