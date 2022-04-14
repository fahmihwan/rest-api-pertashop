<?php
include './../koneksi.php';

$supir = $_POST['supir'];
$telp = $_POST['telp'];
$nopol = $_POST['nomor_polisi'];
$tgl = $_POST['tanggal'];

$select_supir = mysqli_query($conn, "SELECT id_supir, telp FROM tb_supir WHERE nama ='$supir'");
$select_nopol = mysqli_query($conn, "SELECT nomor_polisi FROM tb_kendaraan WHERE nomor_polisi ='$nopol'");

$num_supir =  mysqli_num_rows($select_supir);
$num_nopol = mysqli_num_rows($select_nopol);

if (!$num_supir) {
    mysqli_query($conn, "INSERT INTO tb_supir (id_supir,nama,telp) VALUES (0,'$supir','$telp')");
    $select_supir = mysqli_query($conn, "SELECT id_supir, telp FROM tb_supir WHERE nama ='$supir'");
}
if (!$num_nopol) {
    mysqli_query($conn, "INSERT INTO tb_kendaraan (nomor_polisi) VALUES ('$nopol')");
    $select_nopol = mysqli_query($conn, "SELECT nomor_polisi FROM tb_kendaraan WHERE nomor_polisi ='$nopol'");
};

$cekTelp = mysqli_fetch_assoc($select_supir);
$cekTelpId = $cekTelp['id_supir'];

if ($cekTelp['telp'] !==  $telp) {
    mysqli_query($conn, "UPDATE tb_supir SET telp='$telp' WHERE id_supir = '$cekTelpId'");
}

$id = mysqli_query($conn, "SELECT id_supir FROM tb_supir WHERE nama='$supir'");
$id = mysqli_fetch_assoc($id)['id_supir'];

mysqli_query($conn, "INSERT INTO tb_supplier (id_supplier,tanggal,supir,nomor_polisi) VALUES(0,'$tgl','$id','$nopol')");

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
