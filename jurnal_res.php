<?php

require "koneksi.php";
if (isset($_POST['tambahdata'])) {

 $bukti = $_POST['bukti'];
 $tgl_jurnal = $_POST['tgl_jurnal'];
 $keterangan			= $_POST['keterangan'];
 $kd_akun	    = $_POST['kd_akun'];
 $total_debet	    = $_POST['total_debet'];
 $total_kredit = $_POST['total_kredit'];

$sql = "insert into jurnalsementara (bukti, tgl_jurnal, keterangan, kd_akun, total_debet, total_kredit ) values('$bukti', '$tgl_jurnal', '$keterangan', '$kd_akun', '$total_debet', '$total_kredit' )";   

$hasil = $koneksidb->query($sql);
if (!$hasil) {
    echo "Gagal Simpan, silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;

} else {
	
$sqltotal="select sum(total) as totalkirim from kirimsementara";
$hasil = $koneksidb->query($sqltotal);
	
}

    header("location:jurnalumum.php");
} 

?>