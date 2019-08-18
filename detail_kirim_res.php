<?php

require "koneksi.php";
if (isset($_POST['tambahdata'])) {

  $d      = "0";
  $e      = "Pengiriman";
  $f      = "Biaya Pengiriman";
  // $kd_det_kirim   = $_POST['kd_det_kirim']; 
  $id_kirim1    = $_POST['id_kirim']; 
  $id_toko    = $_POST['id_toko'];
  $tgl_kirim  = $_POST['tgl_kirim'];
  $totalkirim = $_POST['totalkirim'];
  $totalbiaya = $_POST['totalbiaya'];
    $total = '0';
  
      
 if ($tgl_kirim > date('Y-m-d')){
      echo "<SCRIPT language=Javascript>
          alert('Maaf belum boleh dilakukan pengiriman') 
          </script>
          <script>window.location='trans_kirim.php'</script>";

    exit;
          } else {
 
}
$sql = " INSERT INTO kirimselesai  (id_kirim, id_toko, tgl_kirim, totalkirim) value ('$id_kirim1', '$id_toko', '$tgl_kirim', '$totalkirim') " ;   
$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;

} else {
  $sql1="INSERT INTO kirimdetail (kd_det_kirim, id_kirim, kd_brg, jml_kirim, hrg_pokok_brg, hrg_jual_brg, biaya_kirim, total, sisakirim, penerimaan ) SELECT kd_det_kirim, id_kirim, kd_brg, jml_kirim, hrg_pokok_brg, hrg_jual_brg, biaya_kirim, total, sisakirim, penerimaan from kirimsementara "; 
  $hasil1 = $koneksidb->query($sql1);

  $sql9= "INSERT INTO penjualan (id_jual, tgl_jual ,id_kirim , id_toko, total) VALUES ('$id_jual', '' , '$id_kirim', '$id_toko', '$total')";
  $hasil9 = $koneksidb->query($sql9);

  
   $sql2= "INSERT INTO jurnalumum(bukti, tgl_jurnal, keterangan, kd_akun, total_debet, total_kredit) 
                VALUES ('$id_kirim1', '$tgl_kirim', '$e', 10000002 , '$totalkirim','$d'),
                 ('$id_kirim1', '$tgl_kirim', '$e', 10000003 , '$d','$totalkirim'),
                 ('$id_kirim1', '$tgl_kirim', '$f', 10000006 , '$totalbiaya','$d'),
                 ('$id_kirim1', '$tgl_kirim', '$f', 10000001 , '$d','$totalbiaya')";
  $hasil2 = $koneksidb->query($sql2);

$sql3= "UPDATE akun SET debet = debet +'$totalkirim' where kd_akun=10000002";
  $hasil3 = $koneksidb->query($sql3);


$sql4= "UPDATE akun SET kredit = kredit +'$totalkirim' where kd_akun=10000003";
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
  



 $sql1= "insert into kirimdetail ( id_kirim, kd_brg, jml_kirim, hrg_pokok_brg, hrg_jual_brg, biaya_kirim, total, sisakirim, penerimaan ) values(  '$id_kirim', '$kd_brg', '$jml_kirim', '$hrg_pokok_brg', '$hrg_jual_brg', '$biaya_kirim', '$total', '$jml_kirim', ''  )";
  $hasil1 = $koneksidb->query($sql1);



} 


    header("location:trans.php");
}

?>
