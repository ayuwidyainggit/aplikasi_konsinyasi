<?php

require "koneksi.php";

$kd_akun = $_GET['kd_akun']; 

$sql = "
delete from akun where kd_akun='$kd_akun' AND NOT keterangan='default account'";   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
	
    header("location:akun_lap.php");

} 

?>