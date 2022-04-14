<?php
include './../koneksi.php';


$sql = "SELECT tb_pembelian.id_pembelian, tb_pembelian.tanggal, nama, tb_kendaraan.nomor_polisi, harga, tb_jenis_bbm.nama_bbm, jumlah_pemesanan  FROM tb_pembelian
INNER JOIN tb_jenis_bbm ON tb_pembelian.fk_jenis_bbm = tb_jenis_bbm.id_jenis
INNER JOIN tb_supplier ON tb_pembelian.fk_supplier = tb_supplier.id_supplier
INNER JOIN tb_kendaraan ON tb_supplier.nomor_polisi = tb_kendaraan.nomor_polisi
INNER JOIN tb_supir ON tb_supplier.supir = tb_supir.id_supir";

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
