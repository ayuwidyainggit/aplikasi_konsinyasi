<?php

 include "koneksi.php";
 // echo("<pre>");
 // print_r($_POST);

 $kd_akun			= $_POST['kd_akun'];
 $kd_rekening		= $_POST['kd_rekening'];
 $nm_akun			= $_POST['nm_akun'];
 $debet			= '0';
 $kredit			= '0';
 $keterangan = 'not default account';
 
 

$sql = "insert into akun values('$kd_akun', '$kd_rekening', '$nm_akun', '$debet', '$kredit', '$keterangan')";   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
    header("location:akun_i.php");
} 
?>