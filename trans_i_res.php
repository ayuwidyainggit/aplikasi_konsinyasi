<?php

require "koneksi.php";
if (isset($_POST['tambahdata'])) {


 
$ket = "pengiriman";

 $id_kirim = $_POST['id_kirim'];
 $kd_brg      = $_POST['kd_brg'];
 $jml_kirim     = $_POST['jml_kirim'];
  $jml_brg     = $_POST['jml_brg'];
 $hrg_pokok_brg     = $_POST['hrg_pokok_brg'];
 $hrg_jual_brg      = $_POST['hrg_jual_brg'];
 $biaya_kirim      = $_POST['biaya_kirim'];
 $penerimaan      = "0";
 
 $total = $_POST['jml_kirim'] * $_POST['hrg_pokok_brg'];

                         
      
 if ($_POST['jml_kirim'] > $_POST['jml_brg']){
      echo "<SCRIPT language=Javascript>
          alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan') 
          </script>
          <script>window.location='trans_kirim.php'</script>";

    exit;
          } else {

  $sql1= "insert into kirimsementara ( id_kirim, kd_brg, jml_kirim, hrg_pokok_brg, hrg_jual_brg, biaya_kirim, total, sisakirim, penerimaan ) values(  '$id_kirim', '$kd_brg', '$jml_kirim', '$hrg_pokok_brg', '$hrg_jual_brg', '$biaya_kirim', '$total', '$jml_kirim', '$penerimaan'  )";
  $hasil1 = $koneksidb->query($sql1);

  $sql2= "UPDATE barang SET jml_brg = jml_brg -'$jml_kirim' where kd_brg='$kd_brg'";
  $hasil2 = $koneksidb->query($sql2);


}

    header("location:kirim_i.php");
} 

?>