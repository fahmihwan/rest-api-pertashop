<?php


include './../koneksi.php';

$sql = "SELECT * FROM tb_penjualan INNER JOIN tb_jenis_bbm ON fk_jenis_bbm = id_jenis";
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
