<?php
include './../koneksi.php';

// $cekSubisdi = mysqli_query($conn, "SELECT id_jenis, stok, nama_bbm FROM tb_jenis_bbm");
// $arr = [];
// while ($fetch = mysqli_fetch_assoc($cekSubisdi)) {
//     $arr[] = $fetch;
// }

$queryFk = mysqli_query($conn, "SELECT id_supplier FROM tb_supplier ORDER BY id_supplier DESC LIMIT 1");

$fk_supplier = isset(mysqli_fetch_assoc($queryFk)['id_supplier']);



$tgl = $_POST['tanggal'];
$jenis_bbm = $_POST['jenis_bbm'];
$jumlah_pemesanan = $_POST['jumlah_pemesanan'];
$harga = $_POST['harga'];



$stok = mysqli_query($conn, "SELECT stok FROM tb_jenis_bbm WHERE id_jenis='$jenis_bbm'");
$stok = mysqli_fetch_assoc($stok)['stok'];

if (!$fk_supplier) {
    echo json_encode([
        'message' => "data supplier anda kosong, isi terlebih dahulu",
        'status' => false,
    ]);
    die;
} else {
    $sqlInsert = "INSERT INTO tb_pembelian 
    (id_pembelian, tanggal, jumlah_pemesanan, harga, fk_supplier, fk_jenis_bbm)
     VALUES (0,'$tgl','$jumlah_pemesanan','$harga','$fk_supplier','$jenis_bbm');";
}

$qty = $jumlah_pemesanan * 1000;
$qty += $stok;

$sqlUpdate = "UPDATE tb_jenis_bbm SET stok='$qty' WHERE id_jenis='$jenis_bbm'";

try {
    $db = new PDO(dsn: 'mysql:host=localhost;dbname=db_api_pertashop', username: 'root', password: 'root');
    $db->beginTransaction();
    $db->exec(statement: $sqlInsert);
    $db->exec(statement: $sqlUpdate);
    $db->commit();
} catch (\Throwable $e) {
    $db->rollBack();
    throw $e;
}

if (mysqli_affected_rows($conn) == "1") {
    echo json_encode([
        'message' => "data berhasil di tambahkan",
        'status' => true,
    ]);
}
