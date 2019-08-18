 <?php 
include 'koneksi.php';
session_start();

 $id_kirim		= $_POST['id_kirim'];
 $kd_brg   		= $_POST['kd_brg'];
 $qty     		= $_POST['qty'];
 $sisakirim     = $_POST['sisakirim'];
 $hrg_pokok_brg = $_POST['hrg_pokok_brg']; 
 $jmlretur      = $_POST['jmlretur'];

 

                         
      
 if ($_POST['qty'] > $_POST['sisakirim']){
      echo "<SCRIPT language=Javascript>
          alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan') 
          </script>
          <script>window.location='returirim.php?id_kirim=$id_kirim'</script>";

    exit;
          } else {

 // $sql1= "insert into kirimdetail ( id_kirim, kd_brg, jml_kirim, hrg_pokok_brg, hrg_jual_brg, biaya_kirim, total, sisakirim, penerimaan ) values(  '$id_kirim', '$kd_brg', '$jml_kirim', '$hrg_pokok_brg', '$hrg_jual_brg', '$biaya_kirim', '$total', '$jml_kirim', ''  )";
 //  $hasil1 = $koneksidb->query($sql1);

    $sql2= "UPDATE kirimdetail SET sisakirim = sisakirim -'$qty' where kd_brg='$kd_brg' and id_kirim='$id_kirim'";
  $hasil2 = $koneksidb->query($sql2);





if (isset($_POST['kd_brg']))
{
	$kd_brg = $_POST['kd_brg'];
	$id_kirim = $_POST['id_kirim'];
	$qty = $_POST['qty'];
	$hrg_pokok_brg = $_POST['hrg_pokok_brg'];
	$jmlretur = $_POST['jmlretur'];
	

	$data = mysqli_query($koneksidb, "SELECT * FROM barang WHERE kd_brg='$kd_brg'");

	$b = mysqli_fetch_assoc($data);
	
	
	$kirim = [
		'kd_brg' => $kd_brg,
		'id_kirim' => $id_kirim,
		'nm_brg' => $b['nm_brg'],
		'qty' => $qty,
		'hrg_pokok_brg' => $hrg_pokok_brg,
		'jmlretur' => $jmlretur,
		
	];
	
	$_SESSION["cart2"][]=$kirim;
	krsort($_SESSION['cart2']);
	header('location:pengiriman.php');
}



header("location:returirim.php?id_kirim=$id_kirim");
}
 ?>