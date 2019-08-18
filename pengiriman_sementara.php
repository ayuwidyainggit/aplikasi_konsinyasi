 <?php 
include 'koneksi.php';
session_start();

$id_kirim = $_POST['id_kirim'];
 $kd_brg      = $_POST['kd_brg'];
 $jml_kirim     = $_POST['jml_kirim'];
  $jml_brg     = $_POST['jml_brg'];
 $hrg_pokok_brg     = $_POST['hrg_pokok_brg'];
 $hrg_jual_brg      = $_POST['hrg_jual_brg'];
 $biaya_kirim1      = $_POST['biaya_kirim1'];
 $biaya_kirim = str_replace(".", "", $biaya_kirim1);
 $penerimaan      = "0";
 $total = $_POST['total']; 

                         
      
 if ($_POST['jml_kirim'] > $_POST['jml_brg']){
      echo "<SCRIPT language=Javascript>
          alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan') 
          </script>
          <script>window.location='pengiriman.php'</script>";

    exit;
          } else {

			
 if ($_POST['total'] == 0 ){
	echo "<SCRIPT language=Javascript>
		alert('Total masih 0, silahkan isi jumlah penerimaan dengen mengetik di keyboard!') 
		</script>
		<script>window.location='pengiriman.php'</script>";

  exit;
		} else {
		}

		if ($_POST['biaya_kirim1'] == 0 ){
			echo "<SCRIPT language=Javascript>
				alert('Silahkan masukkan jumlah biaya pengiriman ') 
				</script>
				<script>window.location='pengiriman.php'</script>";
		
		  exit;
				} else {
				}
 // $sql1= "insert into kirimdetail ( id_kirim, kd_brg, jml_kirim, hrg_pokok_brg, hrg_jual_brg, biaya_kirim, total, sisakirim, penerimaan ) values(  '$id_kirim', '$kd_brg', '$jml_kirim', '$hrg_pokok_brg', '$hrg_jual_brg', '$biaya_kirim', '$total', '$jml_kirim', ''  )";
 //  $hasil1 = $koneksidb->query($sql1);

//     $sql2= "UPDATE barang SET jml_brg = jml_brg -'$jml_kirim' where kd_brg='$kd_brg'";
//   $hasil2 = $koneksidb->query($sql2);





if (isset($_POST['kd_brg']))
{
	$kd_brg = $_POST['kd_brg'];
	$id_kirim = $_POST['id_kirim'];
	$jml_kirim = $_POST['jml_kirim'];
	$hrg_pokok_brg = $_POST['hrg_pokok_brg'];
	$hrg_jual_brg = $_POST['hrg_jual_brg'];
	$biaya_kirim1 = $_POST['biaya_kirim1'];
	$biaya_kirim = str_replace(".", "", $biaya_kirim1);
	$total = $_POST['total'];


	$data = mysqli_query($koneksidb, "SELECT * FROM barang WHERE kd_brg='$kd_brg'");

	$b = mysqli_fetch_assoc($data);
	
	
	$kirim = [
		'kd_brg' => $kd_brg,
		'id_kirim' => $id_kirim,
		'nm_brg' => $b['nm_brg'],
		'jml_kirim' => $jml_kirim,
		'hrg_pokok_brg' => $hrg_pokok_brg,
		'hrg_jual_brg' => $hrg_jual_brg,
		'biaya_kirim' => $biaya_kirim,
		'total' => $total,
	];
	
	$_SESSION["cart"][]=$kirim;
	krsort($_SESSION['cart']);
	header('location:pengiriman.php');
}



header("location:pengiriman.php");
}
 ?>