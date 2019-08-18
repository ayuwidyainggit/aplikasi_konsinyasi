 <?php

 require "koneksi.php";
 session_start();
if (isset($_POST['tambahdata1'])) {
  $no_ju   = $_POST['no_ju'];
  $kd_retur   = $_POST['kd_retur'];
 $id_kirim			= $_POST['id_kirim'];
 $id_toko			= $_POST['id_toko'];
 $tgl_retur			= $_POST['tgl_retur'];
 $jmlretur			= $_POST['jmlretur'];
 
 $data = mysqli_query($koneksidb, "SELECT * FROM toko WHERE id_toko='$id_toko'");

 $b = mysqli_fetch_assoc($data);


   $k = $b['nm_toko'];
 
   $keterangan    = "Retur pengiriman $k";

 
  $sql3 = "INSERT INTO retur(kd_retur, id_kirim,  tgl_retur, id_toko, totalretur) VALUES ('$kd_retur','$id_kirim','$tgl_retur','$id_toko', '$jmlretur')";
            $hasil3 = $koneksidb->query($sql3);
if (!$hasil3) {
       echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
        } else {

if ($tgl_retur > date('Y-m-d')){
            echo "<SCRIPT language=Javascript>
                alert('Maaf transaksi belum boleh dilakukan! Silahkan isi data dengan benar. ') 
                </script>
                <script>window.location='returirim.php?id_kirim=$id_kirim'</script>";
        
          exit;
                } else {
        
        }


$sql = "INSERT INTO jurnalumum(no_ju, bukti, tgl_jurnal, keterangan)  
                VALUES ('$no_ju','$kd_retur', '$tgl_retur', '$keterangan')";
$hasil = $koneksidb->query($sql);
if (!$hasil) {
  echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
echo "<input type='button' value='Kembali'
onClick='self.history.back()'>";
exit;
   } else {
   }

$sql10 = "INSERT INTO detail_jurnal(no_ju, kd_akun, total_debet, total_kredit) 
                VALUES ('$no_ju',  10000003 , '$jmlretur','$d'),
                 ('$no_ju',  10000002 , '$d','$jmlretur')";
$hasil10 = $koneksidb->query($sql10);
if (!$hasil10) {
  echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
echo "<input type='button' value='Kembali'
onClick='self.history.back()'>";
exit;
   } else {
   }

$sql1= "UPDATE akun SET debet = debet +'$jmlretur' where kd_akun=10000003";
  $hasil1 = $koneksidb->query($sql1);

$sql2= "UPDATE akun SET kredit = kredit +'$jmlretur' where kd_akun=10000002";
  $hasil2 = $koneksidb->query($sql2);


//mendapatkan id transaksi baru
$id_det_jual=mysqli_insert_id($koneksidb);

//insert ke detail pembelian
foreach ($_SESSION['cart2'] as $key => $value){
  
  $id_kirim = $value['id_kirim'];
  $kd_brg = $value['kd_brg'];
  $qty = $value['qty'];
  $hrg_pokok_brg = $value['hrg_pokok_brg'];
  $jmlretur    = $value['jmlretur'];
  
  

 $sql_umum = "INSERT INTO detailretur (kd_retur, kd_brg, qty, jmlretur) VALUES ('$kd_retur','$kd_brg','$qty','$jmlretur')";
            $hasil = $koneksidb->query($sql_umum);
if (!$hasil) {
       echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
          } else {

  // mysqli_query($koneksidb, "INSERT INTO detailjual (id_det_jual, id_jual, kd_brg, qty, hrg_jual_brg, hrg_pokok_brg, komisi, total_hpp, kas_diterima, piutang) VALUES ('$id_det_jual','$id_jual','$kd_brg','$qty','$hrg_jual_brg', '$hrg_pokok_brg', '$komisi', '$total_hpp', '$kas_diterima', '$kas_diterima')");

header('location:reset2.php');
}
}}}
 ?>