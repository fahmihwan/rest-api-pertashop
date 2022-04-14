<?php
include './koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM tb_jenis_bbm");

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $jenis_bbm = $_POST['jenis_bbm'];
    $stok = $_POST['stok'];
    $harga_jual = $_POST['harga_jual'];

    $sql = "UPDATE tb_jenis_bbm SET nama_bbm='$jenis_bbm', stok='$stok', harga_jual='$harga_jual' WHERE id_jenis='$id'";
    $data = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn)) {
        echo "<script>
        alert('data berhasil di tambahkan');
        window.location.href = 'index.php?setting=pengaturan_bbm';
        </script>";
    }
}

if (isset($_POST['submitBBM'])) {
    $subsidi = htmlspecialchars($_POST['subsidi']);
    $harga_jual = htmlspecialchars($_POST['harga_jual']);

    $sql = "INSERT INTO tb_jenis_bbm (id_jenis, nama_bbm, stok, harga_jual) VALUES (0,'$subsidi', '0','$harga_jual')";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) <= 1) {
        echo "<script>
        alert('data berhasil di tambahkan');
        window.location.href = 'index.php?setting=pengaturan_bbm';
        </script>";
    }
}


$quePengemudi = mysqli_query($conn, "SELECT id_supir, nama, telp FROM tb_supir");

$queKendaraan = mysqli_query($conn, "SELECT nomor_polisi FROM tb_kendaraan");

?>
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            Pengaturan BBM
            <a class="btn btn-primary btn-md float-end" href="index.php?menu=dashboard" role="button"><i class="fas fa-arrow-left"></i> Kembali</a>

            <!-- Button trigger nopol-->
            <button type="button" class="btn btn-outline-info float-end me-3" data-bs-toggle="modal" data-bs-target="#pengemudi">
                Nomor Polisi
            </button>

            <!-- nopol-->
            <div class="modal fade" id="pengemudi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informasi Tentang Nomor Kendaraan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nomor Polisi</th>
                                        <th scope="col" style="width: 50px;">Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($kendaraan = mysqli_fetch_assoc($queKendaraan)) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $kendaraan['nomor_polisi']; ?></td>
                                            <td><a class="btn btn-warning " href="index.php?setting=delete_kendaraan&id=<?= $kendaraan['nomor_polisi']; ?>" role="button"><i class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                    <?php
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger supir-->
            <button type="button" class="btn btn-outline-info float-end me-3" data-bs-toggle="modal" data-bs-target="#pengemudi">
                Pengemudi
            </button>

            <!-- supir-->
            <div class="modal fade" id="pengemudi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informasi Tentang Pengemudi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col" style="width: 50px;">Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($pengemudi = mysqli_fetch_assoc($quePengemudi)) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $pengemudi['nama']; ?></td>
                                            <td><?= $pengemudi['telp']; ?></td>
                                            <td><a class="btn btn-warning " href="index.php?setting=delete_supir&id=<?= $pengemudi['id_supir']; ?>" role="button"><i class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                    <?php
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger tambah subisidi-->
            <button type="button" class="btn btn-outline-warning float-end me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Subsidi
            </button>

            <!-- tambah subisidi-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Subsidi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="namaBBM" class="form-label">Subsidi</label>
                                    <input type="text" class="form-control" id="namaBBM" placeholder="" name="subsidi" autocomplete="off" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Jual</label>
                                    <input type="number" class="form-control" id="harga" placeholder="" name="harga_jual" autocomplete="off" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4" name="submitBBM">Simpan</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h3 class="text-center">SUBSIDI</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title float-start"><?= $data['nama_bbm']; ?></h5>

                                <a class="btn-del-bbm btn btn-danger btn-sm float-end " href="index.php?setting=delete&id=<?= $data['id_jenis']; ?>" role="button"><i class="fas fa-trash-alt"></i></a>

                                <div class="clearfix"></div>
                                <p class="card-text">
                                    Stok : <?= $data['stok']; ?> Lt<br>
                                    Harga Jual : Rp. <?= $data['harga_jual']; ?><br>
                                </p>

                                <!-- Button trigger modal -->
                                <div class="d-grid gap-2">

                                    <button type="button" class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#<?= $data['nama_bbm']; ?>">
                                        Setting
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="<?= $data['nama_bbm']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel " aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="form_setting_bbm" method="POST">
                                                    <input type=" text" value="<?= $data['id_jenis']; ?>" name="id" hidden>
                                                    <div class="mb-3">
                                                        <label for="bbm" class="form-label"> <b>subsidi</b> </label>
                                                        <input type="text" class="form-control" id="bbm" value="<?= $data['nama_bbm']; ?>" name="jenis_bbm">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="stok" class="form-label"> <b>Stok Sekarang</b> </label>
                                                        <input type="text" class="form-control" id="stok" value="<?= $data['stok']; ?>" name="stok">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="harga_jual" class="form-label"><b>Harga Jual</b></label>
                                                        <input type="number" class="form-control" id="harga_jual" value="<?= $data['harga_jual']; ?>" name="harga_jual">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-4" name="submit">Simpan</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        </div>
    </div>
</div>