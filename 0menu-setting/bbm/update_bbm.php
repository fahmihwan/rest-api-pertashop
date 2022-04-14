<?php

include './../../koneksi.php';

parse_str(file_get_contents('php://input'), $value);

$id = $value['id'];
$nama_bbm = $value['nama_bbm'];
$stok = $value['stok'];
$harga_jual = $value['harga_jual'];

$sql = "UPDATE tb_jenis_bbm SET nama_bbm='$nama_bbm', stok='$stok', harga_jual='$harga_jual' WHERE id_jenis='$id'";
$data = mysqli_query($conn, $sql);


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
