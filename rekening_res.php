<?php

require "koneksi.php";
session_start();
if (isset($_POST['tambahdata'])) {

 $kd_rekening			= $_POST['kd_rekening'];
 $nm_rekening			= $_POST['nm_rekening'];

$sql = " INSERT INTO rekening  (kd_rekening, nm_rekening, keterangan) value ('$kd_rekening', '$nm_rekening', 'not default') " ;   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
    header("location:akun_i.php");
} 
}
?>