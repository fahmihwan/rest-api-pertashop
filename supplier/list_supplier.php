<?php

include './../koneksi.php';

$sql = "SELECT * FROM tb_supplier 
INNER JOIN tb_supir ON tb_supplier.supir = tb_supir.id_supir
INNER JOIN tb_kendaraan ON tb_supplier.nomor_polisi = tb_kendaraan.nomor_polisi";
$no = 1;
$query = mysqli_query($conn, $sql);


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
