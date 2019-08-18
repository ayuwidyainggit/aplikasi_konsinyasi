 <?php 
include 'koneksi.php';
session_start();



if (isset($_POST['kd_akun']))
{
	$kd_akun = $_POST['kd_akun'];
	$debet = $_POST['debet'];
	$kredit = $_POST['kredit'];
	$total_debet = str_replace(".", "", $debet);
	$total_kredit = str_replace(".", "", $kredit);


	$data = mysqli_query($koneksidb, "SELECT * FROM akun WHERE kd_akun='$kd_akun'");

	$b = mysqli_fetch_assoc($data);
	
	
	$kirim = [
		'kd_akun' => $kd_akun,
		'nm_akun' => $b['nm_akun'],
		'total_debet' => $total_debet,
		'total_kredit' => $total_kredit,
		
	];
	
	$_SESSION["cart3"][]=$kirim;
	krsort($_SESSION['cart3']);
	header('location:jurnalumum.php');
}



header("location:jurnalumum.php");

 ?>