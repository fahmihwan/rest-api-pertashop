<?php
include './../../koneksi.php';

parse_str(file_get_contents('php://input'), $value);

$id = $value['id'];
mysqli_query($conn, "DELETE FROM tb_jenis_bbm WHERE id_jenis=$id");

if (mysqli_affected_rows($conn) == 1) {
    echo json_encode([
        'message' => "data berhasil di hapus",
        'status' => true,
    ]);
} else {
    echo json_encode([
        'message' => 'data gagal di hapus',
        'status' => false
    ]);
}
