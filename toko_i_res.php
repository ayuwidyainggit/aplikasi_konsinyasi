<?php

 include "koneksi.php";
 // echo("<pre>");
 // print_r($_POST);

 $id_toko			= $_POST['id_toko'];
 $nm_toko			= $_POST['nm_toko'];
 $alamat		= $_POST['alamat'];
 $no_telp		= $_POST['no_telp'];
 $komisi		= $_POST['komisi'];

 

$sql = "insert into toko values('$id_toko','$nm_toko', '$alamat','$no_telp', '$komisi')";   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
    header("location:toko_lap.php");
} 
?>