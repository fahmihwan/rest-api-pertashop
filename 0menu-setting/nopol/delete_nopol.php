<?php
include './koneksi.php';
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM tb_kendaraan WHERE nomor_polisi='$id'");

if (mysqli_affected_rows($conn) == 1) {
    echo "<script>
    alert('data berhasil di hapus');
    window.location.href = 'index.php?setting=pengaturan_bbm';
    </script>";
} else {
    echo "<script>
    alert('data gagal di hapus');
    window.location.href = 'index.php?setting=pengaturan_bbm';
    </script>";
}
