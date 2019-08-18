<?php

require "koneksi.php";
session_start();
if (isset($_POST['tambahdata1'])) {
  $no_ju    = $_POST['no_ju']; 
  $no_ju1    = $no_ju++; 
  $id_kirim    = $_POST['id_kirim']; 
  $id_toko    = $_POST['id_toko'];
  
  $tgl_kirim  = $_POST['tgl_kirim'];

  $totalbiaya = $_POST['totalbiaya'];
  $total = $_POST['total'];
 
 $penerimaan      = "0";
  $d      = "0";
  
  $f      = "Biaya Pengiriman";


    $data = mysqli_query($koneksidb, "SELECT * FROM toko WHERE id_toko='$id_toko'");

    $b = mysqli_fetch_assoc($data);

   
      $k = $b['nm_toko'];
    
      $e      = "Pengiriman $k ";
      $f      = "Biaya Pengiriman $k";

  if ($tgl_kirim > date('Y-m-d')){
    echo "<SCRIPT language=Javascript>
        alert('Maaf transaksi belum boleh dilakukan! Silahkan isi data dengan benar. ') 
        </script>
        <script>window.location='pengiriman.php'</script>";

  exit;
        } else {

}

if ($total == 0 ){
  echo "<SCRIPT language=Javascript>
      alert('Maaf transaksi tidak bisa dilakukan karena tidak ada barang yang dipilih. ') 
      </script>
      <script>window.location='pengiriman.php'</script>";

exit;
      } else {

}


$sql = " INSERT INTO kirimselesai  (id_kirim, id_toko, tgl_kirim, totalkirim, totalbiaya) value ('$id_kirim', '$id_toko', '$tgl_kirim', '$total', '$totalbiaya') " ;   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
  }



  
   $sql2= "INSERT INTO jurnalumum(no_ju, bukti, tgl_jurnal, keterangan) 
                VALUES ('$no_ju', '$id_kirim', '$tgl_kirim', '$e'),
                ('$no_ju1', '$id_kirim', '$tgl_kirim', '$f')";
  $hasil2 = $koneksidb->query($sql2);
  if (!$hasil2) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
  }
  $sql8= "INSERT INTO detail_jurnal(no_ju, kd_akun, total_debet, total_kredit) 
  VALUES ('$no_ju', 10000002 , '$total','$d'),
   ('$no_ju', 10000003 , '$d','$total'),
   ('$no_ju1', 10000006 , '$totalbiaya','$d'),
   ('$no_ju1', 10000001 , '$d','$totalbiaya')";
$hasil8 = $koneksidb->query($sql8);
if (!$hasil8) {
  echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
  echo "<input type='button' value='Kembali'
  onClick='self.history.back()'>";
  exit;
} else {
}

$sql3= "UPDATE akun SET debet = debet +'$total' where kd_akun=10000002";
  $hasil3 = $koneksidb->query($sql3);


$sql4= "UPDATE akun SET kredit = kredit +'$total' where kd_akun=10000003";
  $hasil4 = $koneksidb->query($sql4);

  $sql5= "UPDATE akun SET debet = debet +'$totalbiaya' where kd_akun=10000006";
  $hasil5 = $koneksidb->query($sql5);


$sql6= "UPDATE akun SET kredit = kredit +'$totalbiaya' where kd_akun=10000001";
  $hasil6 = $koneksidb->query($sql6);



$id_kirim=mysqli_insert_id($koneksidb);

//insert ke detail pembelian
foreach ($_SESSION['cart'] as $key => $value){
  $kd_brg = $value['kd_brg'];
  $id_kirim = $value['id_kirim'];
  $jml_kirim = $value['jml_kirim'];
  $hrg_pokok_brg = $value['hrg_pokok_brg'];
  $hrg_jual_brg = $value['hrg_jual_brg'];
  $biaya_kirim = $value['biaya_kirim'];
  $total = $value['total'];
  



 $sql1= "insert into kirimdetail ( id_kirim, kd_brg, jml_kirim, biaya_kirim, total, sisakirim, penerimaan ) values(  '$id_kirim', '$kd_brg', '$jml_kirim', '$biaya_kirim', '$total', '$jml_kirim', ''  )";
  $hasil1 = $koneksidb->query($sql1);
  if (!$hasil1) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {
  }
     $sql2= "UPDATE barang SET jml_brg = jml_brg -'$jml_kirim' where kd_brg='$kd_brg'";
 $hasil2 = $koneksidb->query($sql2);

}
header('location:reset.php');

}
 ?>
 