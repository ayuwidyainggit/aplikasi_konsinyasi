<?php

 include "koneksi.php";
 // echo("<pre>");
 // print_r($_POST);

 $kd_brg			= $_POST['kd_brg'];
 $tgl_masuk			= $_POST['tgl_masuk'];
 $jml_brg			= $_POST['jml_brg'];

if ($tgl_masuk > date('Y-m-d')){
      echo "<SCRIPT language=Javascript>
          alert('Maaf belum boleh dilakukan pencatatan') 
          </script>
          <script>window.location='barangmasuk_lap.php'</script>";

    exit;
          } else {
 
}


$sql1= "insert into barangmasuk ( tgl_masuk, kd_brg, jml_brg ) values(  '$tgl_masuk', '$kd_brg', '$jml_brg' )";
  $hasil1 = $koneksidb->query($sql1);
if (!$hasil1) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {

	

  $sql = "UPDATE barang SET jml_brg = jml_brg + '$jml_brg' where kd_brg='$kd_brg'";
$hasil = $koneksidb->query($sql);

    header("location:barangmasuk_lap.php");
} 
?>