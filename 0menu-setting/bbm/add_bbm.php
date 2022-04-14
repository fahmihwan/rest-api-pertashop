<?php
include './../../koneksi.php';

$subsidi = $_POST['subsidi'];
$harga_jual = $_POST['harga_jual'];

$sql = "INSERT INTO tb_jenis_bbm (id_jenis, nama_bbm, stok, harga_jual) VALUES (0,'$subsidi', '0','$harga_jual')";

mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) == 1) {
    echo json_encode([
        'message' => "data berhasil di tambahkan",
        'status' => true,
    ]);
} else {
    echo json_encode([
        'message' => 'data gagal ditambahkan',
        'status' => false
    ]);
}
