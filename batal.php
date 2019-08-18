<?php
include 'koneksi.php';
 session_start();

 foreach ($_SESSION['cart'] as $key => $value){
    $kd_brg = $value['kd_brg'];
    $id_kirim = $value['id_kirim'];
    $jml_kirim = $value['jml_kirim'];
    $hrg_pokok_brg = $value['hrg_pokok_brg'];
    $hrg_jual_brg = $value['hrg_jual_brg'];
    $biaya_kirim = $value['biaya_kirim'];
    $total = $value['total'];
  
    
    $sql2= "UPDATE barang SET jml_brg = jml_brg +'$jml_kirim' where kd_brg='$kd_brg'";
    $hasil2 = $koneksidb->query($sql2);
    if (!$hasil2) {
        echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
        echo "<input type='button' value='Kembali'
        onClick='self.history.back()'>";
        exit;
    } else {
      }
 }
 
 header('location:batal1.php')

?>