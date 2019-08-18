<?php

require "koneksi.php";
if (isset($_POST['tambahdata'])) {

      $no_ju    = $_POST['no_ju']; 
 $keterangan    = "Penerimaan penjualan";
 $e = "0";
 $id_terima		= $_POST['id_terima'];
 $nm_toko		= $_POST['nm_toko'];
 $tgl_terima		= $_POST['tgl_terima'];
 $id_jual		= $_POST['id_jual'];
 $piutang		= $_POST['piutang'];
 $hpp_total   = $_POST['hpp_total'];
 
 $keterangan    = "Penerimaan penjualan $nm_toko";

 if ($tgl_terima > date('Y-m-d')){
      echo "<SCRIPT language=Javascript>
          alert('Maaf transaksi belum boleh dilakukan!Silahkan isi data dengan benar.') 
          </script>
          <script>window.location='terima_penjualan.php'</script>";

    exit;
          } else {
 
}

 if ($piutang == 0){
      echo "<SCRIPT language=Javascript>
          alert('Transaksi gagal disimpan ! silahkan isi data dengan benar. ') 
          </script>
          <script>window.location='terima_penjualan.php'</script>";

    exit;
          } else {
 
}

  $sql_umum = "INSERT INTO terimapenjualan (id_terima, tgl_terima, id_jual, kas, hpp_total) VALUES ('$id_terima', '$tgl_terima', '$id_jual', '$piutang', '$hpp_total')";
  $hasil1 = $koneksidb->query($sql_umum);
  if (!$hasil1) {
			 echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
        } else {
  $sql11 = "INSERT INTO jurnalumum(no_ju, bukti, tgl_jurnal, keterangan)  
              VALUES ('$no_ju', '$id_terima', '$tgl_terima', '$keterangan')";
$hasil11 = $koneksidb->query($sql11);
if (!$hasil11) {
      echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
echo "<input type='button' value='Kembali'
onClick='self.history.back()'>";
exit;
} else {
}

  $sql10 = "INSERT INTO detail_jurnal(no_ju, kd_akun, total_debet, total_kredit) 
  VALUES    ('$no_ju',  10000001 , '$piutang','$d'),
            ('$no_ju',  10000005 , '$d','$piutang')";
      $hasil10 = $koneksidb->query($sql10);
      if (!$hasil10) {
            echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
echo "<input type='button' value='Kembali'
onClick='self.history.back()'>";
exit;
 } else {
 }
  $sql3= "UPDATE akun SET debet = debet +'$piutang' where kd_akun=10000001";
  $hasil3 = $koneksidb->query($sql3);


  $sql4= "UPDATE akun SET kredit = kredit +'$piutang' where kd_akun=10000005";
  $hasil4 = $koneksidb->query($sql4);

  $sql1= "UPDATE penjualan SET piutang = piutang - '$piutang' where id_jual='$id_jual'";
  $hasil1 = $koneksidb->query($sql1);

//   $sql7= "UPDATE penjualan SET hpp_total = hpp_total - '$hpp_total' where id_jual='$id_jual'";
//   $hasil7 = $koneksidb->query($sql7);

}
header("location:terima_penjualan.php");
}

?>