 <?php

 require "koneksi.php";
 session_start();
if (isset($_POST['tambahdata1'])) {

  $no_ju    = $_POST['no_ju']; 
  $no_ju1 = $no_ju++;

 $e = "0";
 $id_jual = $_POST['id_jual'];
$tgl_jual = $_POST['tgl_jual'];
$id_kirim = $_POST['id_kirim'];
$id_toko = $_POST['id_toko'];
$kas = $_POST['kas'];
$total = $_POST['total'];
$hpptotal = $_POST['hpptotal'];
$tot_komisi = $_POST['tot_komisi'];
$d = "0";
//insert ke tabel pembelian


$data = mysqli_query($koneksidb, "SELECT * FROM toko WHERE id_toko='$id_toko'");

$b = mysqli_fetch_assoc($data);


  $k = $b['nm_toko'];

  $keterangan    = "perhitungan penjualan $k";
  $kethpp    = "Pencatatan HPP $k";
  if ($tgl_jual > date('Y-m-d')){
    echo "<SCRIPT language=Javascript>
        alert('Maaf transaksi belum boleh dilakukan! Silahkan isi data dengan benar. ') 
        </script>
        <script>window.location='penjualan_i.php'</script>";

  exit;
        } else {

}

if ($total == 0 ){
  echo "<SCRIPT language=Javascript>
      alert('Maaf transaksi tidak bisa dilakukan karena tidak ada barang yang dipilih. ') 
      </script>
      <script>window.location='penjualan_i.php'</script>";

exit;
      } else {

}



  $sql3 = "INSERT INTO penjualan(id_jual, tgl_jual,  id_kirim, id_toko, total, tot_komisi, kas, hpp_total, piutang) VALUES ('$id_jual','$tgl_jual','$id_kirim','$id_toko', '$total', '$tot_komisi', '$kas', '$hpptotal', '$kas')";
            $hasil3 = $koneksidb->query($sql3);
if (!$hasil3) {
       echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
        } else {




$sql = "INSERT INTO jurnalumum(no_ju, bukti, tgl_jurnal, keterangan) 
                VALUES ('$no_ju','$id_jual', '$tgl_jual', '$keterangan'),
                ('$no_ju1','$id_jual', '$tgl_jual', '$kethpp')";
$hasil = $koneksidb->query($sql);
if (!$hasil) {
  echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
  echo "<input type='button' value='Kembali'
  onClick='self.history.back()'>";
  exit;
} else {
}

$sql9 = "INSERT INTO detail_jurnal(no_ju, kd_akun, total_debet, total_kredit) 
                VALUES ('$no_ju',  10000005 , '$kas','$d'),
                ('$no_ju',  10000010 , '$tot_komisi','$d'),
                 ('$no_ju',  10000004 , '$d','$total'),
                 ('$no_ju1',  10000008 , '$hpptotal','$d'),
                 ('$no_ju1',  10000002 , '$d','$hpptotal')";
$hasil9 = $koneksidb->query($sql9);
if (!$hasil9) {
  echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
  echo "<input type='button' value='Kembali'
  onClick='self.history.back()'>";
  exit;
} else {
}

$sql1= "UPDATE akun SET debet = debet +'$kas' where kd_akun=10000005";
  $hasil1 = $koneksidb->query($sql1);

$sql2= "UPDATE akun SET debet = debet +'$tot_komisi' where kd_akun=10000010";
  $hasil2 = $koneksidb->query($sql2);

  $sql7= "UPDATE akun SET kredit = kredit +'$total' where kd_akun=10000004";
  $hasil7 = $koneksidb->query($sql7);

  $sql3= "UPDATE akun SET debet = debet +'$hpptotal' where kd_akun=10000008";
  $hasil3 = $koneksidb->query($sql3);

$sql4= "UPDATE akun SET kredit = kredit +'$hpptotal' where kd_akun=10000002";
  $hasil4 = $koneksidb->query($sql4);

//mendapatkan id transaksi baru
$id_det_jual=mysqli_insert_id($koneksidb);

//insert ke detail pembelian
foreach ($_SESSION['cart1'] as $key => $value){
	
	$id_det_jual = $value['id_det_jual'];
	$id_jual = $value['id_jual'];
	$kd_brg = $value['kd_brg'];
	$qty = $value['qty'];
	$hrg_jual_brg = $value['hrg_jual_brg'];
	$hrg_pokok_brg = $value['hrg_pokok_brg'];
	$hasil_komisi = $value['hasil_komisi'];
	$hasiljual = $value['hasiljual'];
	$total_hpp = $value['total_hpp'];
	$kas_diterima = $value['kas_diterima'];
	

 $sql_umum = "INSERT INTO detailjual (id_jual, kd_brg, qty, hasil_komisi, total_hpp, kas_diterima, hasiljual) VALUES ('$id_jual','$kd_brg','$qty','$hasil_komisi', '$total_hpp', '$kas_diterima', '$hasiljual')";
            $hasil8 = $koneksidb->query($sql_umum);
if (!$hasil8) {
       echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
	        } else {

	

            $sql_umum2 = "UPDATE kirimdetail SET sisakirim = sisakirim - '$qty' where kd_brg='$kd_brg' and id_kirim='$id_kirim' ";
            $hasil1 = $koneksidb->query($sql_umum2);
            
            $sql_umum1 = "UPDATE kirimdetail SET penerimaan = penerimaan + '$qty' where kd_brg='$kd_brg' and id_kirim ='$id_kirim' ";
            $hasil11 = $koneksidb->query($sql_umum1);
            
            
header('location:reset1.php');
}
}}}
 ?>