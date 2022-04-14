<?php

include './../koneksi.php';

$subsidi = mysqli_query($conn, "SELECT count(id_jenis) FROM tb_jenis_bbm");
$subsidi = mysqli_fetch_assoc($subsidi)["count(id_jenis)"];

$sql = "SELECT id_pembelian, tb_pembelian.tanggal, jumlah_pemesanan, harga, nama_bbm, nama FROM tb_pembelian 
INNER JOIN tb_jenis_bbm ON tb_pembelian.fk_jenis_bbm=tb_jenis_bbm.id_jenis
INNER JOIN tb_supplier ON tb_pembelian.fk_supplier=tb_supplier.id_supplier
INNER JOIN tb_supir ON tb_supplier.supir=tb_supir.id_supir";

$result =  mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $arr = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $arr[] = $data;
    }
    echo json_encode($arr);
} else {
    echo json_encode([
        'message' => "not found",
        'status' => false,
    ]);
}
