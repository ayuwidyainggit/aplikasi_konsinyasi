
<?php

require "koneksi.php";

$sql = " INSERT INTO jurnalumum  (bukti, tgl_jurnal, keterangan, kd_akun, total_debet, total_kredit) SELECT  bukti, tgl_jurnal, keterangan, kd_akun, total_debet, total_kredit from jurnalsementara " ;  
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
    header("location:jurnal.php");
} 

?>