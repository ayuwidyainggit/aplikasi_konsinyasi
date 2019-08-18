<?php

require "koneksi.php";

$id_toko = $_GET['id_toko']; 

$sql = "delete from toko where id_toko='$id_toko'";   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
	 header("location:error.html" );
 exit;
    
} else {
	
    header("location:toko_lap.php");

} 

?>