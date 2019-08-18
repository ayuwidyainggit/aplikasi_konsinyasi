<?php

require "koneksi.php";

$sql2 = "delete from detail_jurnal";   
$hasil2 = $koneksidb->query($sql2);


$sql = "delete from jurnalumum";   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
	$sql1 = "delete from akun";   
$hasil1 = $koneksidb->query($sql1);


    header("location:createakun.php");

} 

?>