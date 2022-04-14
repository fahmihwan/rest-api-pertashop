<?php

include './../../koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM tb_jenis_bbm");

if (mysqli_num_rows($query) > 0) {
    $arr = [];
    while ($data = mysqli_fetch_assoc($query)) {
        $arr[] = $data;
    }
    echo json_encode($arr);
} else {
    echo json_encode([
        'message' => "not found",
        'status' => false,
    ]);
}
