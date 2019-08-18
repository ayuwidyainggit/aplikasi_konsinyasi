<?php

 include "koneksi.php";
 // echo("<pre>");
 // print_r($_POST);

 $kd_brg			= $_POST['kd_brg'];
 $nm_brg			= $_POST['nm_brg'];
 $jml_brg			="0";
 $hrg_pokok_brg		= "0";
 $hrg_jual_brg		= "0";

 

$sql = "UPDATE barang SET nm_brg = '$nm_brg' where kd_brg='$kd_brg'";
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
    header("location:barang_lap.php");
} 
?>