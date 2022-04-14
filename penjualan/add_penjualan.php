<?php

include './../koneksi.php';



$tgl = $_POST['tanggal'];
$jenis_bbm = $_POST['jenis_bbm'];
$sonding = $_POST['sonding'];
$speed_awal = $_POST['speed_awal'];
$speed_akhir = $_POST['speed_akhir'];
$penjualan = $_POST['penjualan'];

$query_subsidi = mysqli_query($conn, "SELECT stok, harga_jual FROM tb_jenis_bbm WHERE id_jenis = '$jenis_bbm'");
if (mysqli_num_rows($query_subsidi)) {
    $data_subsidi = mysqli_fetch_assoc($query_subsidi);
} else {
    echo json_encode([
        'message' => "jenis_bbm tidak ada",
        'status' => false,
    ]);
    die;
}

if ($data_subsidi['stok'] > $penjualan) {
    if ($speed_akhir > $speed_awal) {
        $qty = $penjualan * $data_subsidi['harga_jual'];
        $updateStok = $data_subsidi['stok'] - $penjualan;
        $sqlInsert = "INSERT INTO tb_penjualan 
            (id_penjualan, tanggal, penjualan, total_penjualan, sonding, speed_awal, speed_akhir, fk_jenis_bbm)
            VALUES (0,'$tgl','$penjualan','$qty','$sonding','$speed_awal','$speed_akhir','$jenis_bbm')";
        $sqlUpdate = "UPDATE tb_jenis_bbm SET stok='$updateStok' WHERE id_jenis='$jenis_bbm'";
        try {
            $db = new PDO(dsn: 'mysql:host=localhost;dbname=db_api_pertashop', username: 'root', password: 'root');
            $db->beginTransaction();

            $db->exec(statement: $sqlInsert);
            $db->exec(statement: $sqlUpdate);

            $db->commit();
        } catch (\Throwable $e) {
            $db->rollback();
            throw $e;
        }
        if (mysqli_affected_rows($conn) > 0) {
            echo json_encode([
                'message' => "data berhasil di tambahkan",
                'status' => true,
            ]);
        } else {
            echo json_encode([
                'message' => "not found",
                'status' => false,
            ]);
        }
    }
}
