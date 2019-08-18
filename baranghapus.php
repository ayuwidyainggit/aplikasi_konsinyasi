<?php

require "koneksi.php";

$kd_brg = $_GET['kd_brg']; 

$sql = "delete from barang where kd_brg='$kd_brg'";   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
  header("location:error.html" );
    exit;
} else {
	
    header("location:barang_lap.php");

} 

?>