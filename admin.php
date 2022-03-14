<!-- call header -->
<?php include "header.php"; ?>


<?php

if (isset($_POST['bsimpan'])) {
    $tgl = date('Y-m-d');

    // htmlspecialchars
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);

    // Persiapan query simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO tbl_tamu VALUES ('','$nama','$nope','$tujuan','$tgl')");

    // 
    if ($simpan) {
        echo "<script>alert('Pendaftaran kunjungan berhasil! Silahkan simpan QR Code ini dan tunjukkan kepada petugas di kantor. Terimakasih.');document.location='?'</script>";
    } else {
        echo "<script>alert('Daftar gagal, harap ulangi pendaftaran.');document.location='?'</script>";
    }
}

?>

        <!-- Head -->
        <div class="head text-center">
            <img src="assets/img/logo.png" alt="logo" width="100">
            <h2 class="text-white">Daftar Visitor <br> Badan Pengawas Obat dan Makanan</h2>
        </div>
        <!-- End Head -->

        <!-- Awal Row -->
        <div class="row mt-2">
            <!-- awal col-lg-7 -->
            <div class="col-lg-7 mb-3">
                <div class="card shadow bg-gradient-light">
                    <!-- card-body -->
                    <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                            </div>
                            <!-- form -->
                            <form class="user" method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nope" placeholder="No. Handphone" required>
                                </div>
                                <div class="form-group">
                                <input type="text-area" class="form-control form-control-user" name="tujuan" placeholder="Tujuan" required>
                                </div>

                                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Daftar</button>
                               <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                                    Daftar
                                </a> -->

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Powered by Badan Pengawas Obat dan Makanan | 2022 - <?= date('Y') ?></a>
                            </div>
                    </div>
                    <!-- end card-body -->
                </div>
            </div>
            <!-- end col-lg-7 -->

            <!-- awal col-lg-5 -->
            <div class="col-lg-5 mb-3">
                <div class="card shadow">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                        </div>
                        <?php
                        // deklarasi tanggal

                        // menampilkan tanggal sekarang
                        $tgl_sekarang = date('Y-m-d');

                        // menampilkan tanggal kemarin
                        $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                        // mendapatkan 6 hari kebelakang
                        $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));

                        $sekarang = date('Y-m-d h:i:s');

                        // menampilkan per bulan
                        $bulan_ini = date('m');

                        // persiapan query tampilkan statistik pengunjung
                        $tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) FROM tbl_tamu where tanggal like '%$tgl_sekarang%'"));

                        $kemarin = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) FROM tbl_tamu where tanggal like '%$kemarin%'"));

                        $sebulan = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) FROM tbl_tamu where month(tanggal) = '$bulan_ini'"));

                        $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) FROM tbl_tamu"));

                        ?>
                        <table class="table table-bordered">
                            <tr>
                                <td>Hari ini</td>
                                <td>: <?= $tgl_sekarang[0] ?></td>
                            </tr>
                            <tr>
                                <td>Kemarin</td>
                                <td>: <?= $kemarin[0] ?></td>
                            </tr>
                            <tr>
                                <td>Bulan ini</td>
                                <td>: <?= $sebulan[0] ?></td>
                            </tr>
                            <tr>
                                <td>Keseluruhan</td>
                                <td>: <?= $keseluruhan[0] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- end Row -->

        <!-- tabel -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengunjung Hari Ini [<?= date('d-m-Y') ?>]</h6>
            </div>
            <div class="card-body">
                <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"></i> Rekapitulasi Pengunjung</a>
                <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"> Logout</i></a>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pengunjung</th>
                                <th>No. Handphone</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pengunjung</th>
                                <th>No. Handphone</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                $tgl = date('Y-m-d');
                                $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_tamu where tanggal like '%$tgl%' order by id desc");
                                $no = 1;
                                while($data = mysqli_fetch_array($tampil)) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['nope'] ?></td>
                                    <td><?= $data['tujuan'] ?></td>
                                    <td><?= $data['tanggal'] ?></td>
                                </tr>
                                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<!-- call footer -->
<?php include "footer.php"; ?>