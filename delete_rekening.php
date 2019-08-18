<?php

require "koneksi.php";

$kd_rekening = $_GET['kd_rekening']; 

$sql = "
delete from rekening where kd_rekening='$kd_rekening' AND NOT keterangan='default'";   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
	
    header("location:rekening_lap.php");

} 

?>