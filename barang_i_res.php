<?php

require "koneksi.php";
session_start();
if (isset($_POST['tambahdata'])) {

 $kd_brg			= $_POST['kd_brg'];
 $nm_brg			= $_POST['nm_brg'];
 $jml_brg			="0";
 $hrg_pokok_brg		= $_POST['hrg_pokok_brg'];	
 $hargapokok_new = str_replace(".", "", $hrg_pokok_brg);	
 $hrg_jual_brg		= $_POST['hrg_jual_brg'];
 $hargajual_new = str_replace(".", "", $hrg_jual_brg);  

 if ($hargajual_new < $hargapokok_new){
      echo "<SCRIPT language=Javascript>
          alert('Maaf harga jual harus lebih besar dari harga pokok') 
          </script>
          <script>window.location='barang_lap.php'</script>";

    exit;
          } else {}


$sql = " INSERT INTO barang  (kd_brg, nm_brg, jml_brg, hrg_pokok_brg, hrg_jual_brg) value ('$kd_brg', '$nm_brg', '$jml_brg', '$hargapokok_new', '$hargajual_new') " ;   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
}
    header("location:barang_lap.php");
 }

?>