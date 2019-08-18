 <?php

 require "koneksi.php";
if (isset($_POST['tambahdata'])) {

 $keterangan    = "perhitungan penjualan";
 $kethpp    = "Pencatatan HPP";
 $e = "0";
 $id_jual   = $_POST['id_jual'];

 $id_kirim = $_POST['id_kirim'];

 $kd_brg    = $_POST['kd_brg'];
 $qty     = $_POST['qty'];
 $sisakirim     = $_POST['sisakirim'];

 $hrg_jual_brg  = $_POST['hrg_jual_brg'];
 $hrg_pokok_brg = $_POST['hrg_pokok_brg'];
  
 $komisi    = $_POST['komisi'];
 $hasiljual = $_POST['hasiljual'];
 $hasil_komisi  = $_POST['hasil_komisi'];
 $kas_diterima  = $_POST['kas_diterima'];
  $total_hpp = $_POST['total_hpp'];
  $total = '0';
  



 if ($_POST['qty'] > $_POST['sisakirim']){
      echo "<SCRIPT language=Javascript>
          alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan') 
          </script>
          <script>window.location='penjualan_ii.php?id_kirim=$id_kirim'</script>";

    exit;
          } else {
          }


            // $sql_umum = "UPDATE kirimdetail SET sisakirim = sisakirim - '$qty' where kd_brg='$kd_brg' and id_kirim='$id_kirim' ";
            // $hasil1 = $koneksidb->query($sql_umum);

        	// $sql_umum1 = "UPDATE kirimdetail SET penerimaan = penerimaan + '$qty' where kd_brg='$kd_brg' and id_kirim ='$id_kirim' ";
            // $hasil11 = $koneksidb->query($sql_umum1);



 
include 'koneksi.php';
session_start();


if (isset($_POST['kd_brg']))
{
	$id_jual = $_POST['id_jual'];
	$id_det_jual = $_POST['id_det_jual'];
	$kd_brg = $_POST['kd_brg'];
	$qty = $_POST['qty'];
	$hrg_jual_brg = $_POST['hrg_jual_brg'];
	$hrg_pokok_brg = $_POST['hrg_pokok_brg'];
	$hasiljual = $_POST['hasiljual'];
	$hasil_komisi = $_POST['hasil_komisi'];
	$total_hpp = $_POST['total_hpp'];
	$kas_diterima = $_POST['kas_diterima'];

	$data = mysqli_query($koneksidb, "SELECT * FROM barang WHERE kd_brg='$kd_brg'");

	$b = mysqli_fetch_assoc($data);
	
	
	
	$barang = [
		'kd_brg' => $kd_brg,
		'id_jual' => $id_jual,
		'id_det_jual' => $id_det_jual,
		'nm_brg' => $b['nm_brg'],
		'qty' => $qty,
		'hrg_jual_brg' => $hrg_jual_brg,
		'hrg_pokok_brg' => $hrg_pokok_brg,
		'hasil_komisi' => $hasil_komisi,
		'hasiljual' => $hasiljual,
		'total_hpp' => $total_hpp,
		'kas_diterima' => $kas_diterima
	];
	
	$_SESSION["cart1"][]=$barang;
	krsort($_SESSION['cart1']);
	header('location:penjualan_ii.php');
}



header("location:penjualan_ii.php?id_kirim=$id_kirim");
}
 ?>