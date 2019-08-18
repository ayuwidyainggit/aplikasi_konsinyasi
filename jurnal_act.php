<?php

require "koneksi.php";
session_start();
if (isset($_POST['tambahdata1'])) {

 $bukti    = $_POST['bukti']; 
  $tgl_jurnal    = $_POST['tgl_jurnal'];
  $keterangan  = $_POST['keterangan'];
  $total_debet1  = $_POST['total_debet1'];
   $total_kredit1  = $_POST['total_kredit1'];
   $no_ju  = $_POST['no_ju'];
  


   if ($tgl_jurnal > date('Y-m-d')){
      echo "<SCRIPT language=Javascript>
          alert('Maaf transaksi belum boleh dilakukan!Silahkan isi data dengan benar.') 
          </script>
          <script>window.location='jurnalumum.php'</script>";

    exit;
          } else {
 
}

if ($total_debet1 == 0 ){
      echo "<SCRIPT language=Javascript>
          alert('Maaf gagal simpan! silahkan isi data dengan lengkap. ') 
          </script>
          <script>window.location='jurnalumum.php'</script>";

    exit;
          } else {
 
}
if ($total_kredit1 == 0 ){
      echo "<SCRIPT language=Javascript>
          alert('Maaf gagal simpan! silahkan isi data dengan lengkap. ') 
          </script>
          <script>window.location='jurnalumum.php'</script>";

    exit;
          } else {
 
}
$sql2= "INSERT INTO jurnalumum(no_ju, bukti, tgl_jurnal, keterangan) 
                VALUES ('$no_ju','$bukti', '$tgl_jurnal', '$keterangan')";
  $hasil2 = $koneksidb->query($sql2);
  if (!$hasil2) {
      echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
      echo "<input type='button' value='Kembali'
      onClick='self.history.back()'>";
      exit;
    } else {
    }
$kd_akun=mysqli_insert_id($koneksidb);

//insert ke detail pembelian
foreach ($_SESSION['cart3'] as $key => $value){
 $kd_akun = $value['kd_akun'];
  $total_kredit = $value['total_kredit'];
  $total_debet = $value['total_debet'];
  


if ($total_debet1 != $total_kredit1){
      echo "<SCRIPT language=Javascript>
          alert('Transaksi belum balance') 
          </script>
          <script>window.location='jurnalumum.php'</script>";

    exit;
          } else {
          }

          $sql5= "UPDATE akun SET kredit = kredit +'$total_kredit' where kd_akun='$kd_akun'";
          $hasil5 = $koneksidb->query($sql5);

          $sql6= "UPDATE akun SET debet = debet +'$total_debet' where kd_akun='$kd_akun'";
          $hasil6 = $koneksidb->query($sql6);
  
   

  $sql3= "INSERT INTO detail_jurnal(no_ju, kd_akun, total_debet, total_kredit)  
  VALUES ('$no_ju', '$kd_akun' , '$total_debet','$total_kredit')";
$hasil3 = $koneksidb->query($sql3);
if (!$hasil3) {
      echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
      echo "<input type='button' value='Kembali'
      onClick='self.history.back()'>";
      exit;
    } else {
    }
}
header('location:reset3.php');
}
 ?>