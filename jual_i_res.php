<?php

require "koneksi.php";
if (isset($_POST['tambahdata'])) {


 
$ket = "pengiriman";

 $id_jualr = $_POST['id_jualr'];
 $tgl_jual      = $_POST['tgl_jual'];
 $kd_brg     = $_POST['kd_brg'];
 $jml_brg     = '1';
 $hrg_jual_brg      = $_POST['hrg_jual_brg'];
 
                         
      
 
  $sql1= "insert into penjualanreguler ( id_jualr, tgl_jual, kd_brg, jml_brg, hrg_jual_brg) values(  '$id_jualr', '$tgl_jual', '$kd_brg', '$jml_brg', '$hrg_jual_brg')";
  $hasil1 = $koneksidb->query($sql1);

  $sql2= "UPDATE barang SET jml_brg = jml_brg -'$jml_brg' where kd_brg='$kd_brg'";
  $hasil2 = $koneksidb->query($sql2);


}

    header("location:jual_i.php");


?>