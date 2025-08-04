<?php
// Simple test script to update database
$host = 'localhost';
$db = 'tugas1_tmu';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = '496-33343-16-21';
    $periode = 2;
    $pelaksanaan_mulai = '2025-01-15';
    $pelaksanaan_akhir = '2025-01-31';
    $sisa_kursi = 24;

    $stmt = $pdo->prepare("UPDATE scre_diklat_jadwal SET periode = ?, pelaksanaan_mulai = ?, pelaksanaan_akhir = ?, sisa_kursi = ? WHERE id = ?");
    $result = $stmt->execute([$periode, $pelaksanaan_mulai, $pelaksanaan_akhir, $sisa_kursi, $id]);
    
    if ($result) {
        echo "Update berhasil! Rows affected: " . $stmt->rowCount();
    } else {
        echo "Update gagal!";
    }
    
    // Cek data setelah update
    $stmt = $pdo->prepare("SELECT id, periode, pelaksanaan_mulai, pelaksanaan_akhir, sisa_kursi FROM scre_diklat_jadwal WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "\n\nData setelah update:\n";
    print_r($data);
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
