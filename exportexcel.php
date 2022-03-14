<?php
include "koneksi.php";

// Library Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapitulasi Data Pengunjung.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
    <thead>
        <tr>
            <th colspan="5"> Rekapitulasi Data Pengunjung</th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Nama Pengunjung</th>
            <th>No. Handphone</th>
            <th>Tujuan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    
    <tbody>
    <?php
        $tgl1 = $_POST['tanggalA'];
        $tgl2 = $_POST['tanggalB'];

        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_tamu where tanggal BETWEEN '$tgl1' and '$tgl2' order by tanggal asc");
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