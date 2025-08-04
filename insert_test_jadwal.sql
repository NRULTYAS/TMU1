-- Insert test data for scre_diklat_jadwal table
-- This will create Gelombang 1, 2, 3 for the DP-III NAUTIKA program

-- First, make sure we have proper diklat_tahun records
INSERT INTO scre_diklat_tahun (id, diklat_id, tahun, is_active, is_exist) VALUES
('DT-2024-001', '14-01807-46', 2024, 1, 1),
('DT-2025-001', '14-01807-46', 2025, 1, 1)
ON DUPLICATE KEY UPDATE is_active = VALUES(is_active);

-- Insert Gelombang 1 (Open for registration)
INSERT INTO scre_diklat_jadwal (
    id, diklat_id, diklat_tahun_id, periode, 
    pendaftaran_mulai, pendaftaran_akhir,
    pelaksanaan_mulai, pelaksanaan_akhir,
    jumlah_kelas, kouta, kuota_per_kelas, sisa_kursi,
    is_daftar, is_exist
) VALUES (
    'DJ-2024-001', '14-01807-46', 'DT-2024-001', '1',
    '2024-01-15', '2024-02-15',
    '2024-03-01', '2024-08-31',
    1, 30, 30, 12,
    1, 1
),
-- Insert Gelombang 2 (Open for registration)
(
    'DJ-2024-002', '14-01807-46', 'DT-2024-001', '2',
    '2024-04-15', '2024-05-15',
    '2024-06-01', '2024-11-30',
    1, 30, 30, 8,
    1, 1
),
-- Insert Gelombang 3 (Closed for registration)
(
    'DJ-2024-003', '14-01807-46', 'DT-2024-001', '3',
    '2024-07-15', '2024-08-15',
    '2024-09-01', '2025-02-28',
    1, 30, 30, 25,
    0, 1
),
-- Insert additional entries for next year
(
    'DJ-2025-001', '14-01807-46', 'DT-2025-001', '1',
    '2025-01-15', '2025-02-15',
    '2025-03-01', '2025-08-31',
    1, 30, 30, 30,
    1, 1
)
ON DUPLICATE KEY UPDATE 
    sisa_kursi = VALUES(sisa_kursi),
    is_daftar = VALUES(is_daftar);
