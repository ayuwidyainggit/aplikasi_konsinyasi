<?php 
include 'koneksi.php';
session_start();


if (isset($_POST['kd_brg']))
{
	$kd_brg = $_POST['kd_brg'];
	$qty = $_POST['qty'];
	$hrg_jual_brg = $_POST['hrg_jual_brg'];
	$hrg_pokok_brg = $_POST['hrg_pokok_brg'];
	$komisi = $_POST['komisi'];
	$kas_diterima = $_POST['kas_diterima'];
	
	
	$barang = [
		'kd_brg' => $kd_brg,
		'qty' => $qty,
		'hrg_jual_brg' => $hrg_pokok_brg,
		'hrg_pokok_brg' => $hrg_jual_brg,
		'komisi' => $komisi,
		'kas_diterima' => $kas_diterima
	];
	
	$_SESSION["cart"][]=$barang;
	krsort($_SESSION['cart']);
	header('location:penjualan_ii.php');
}
 ?>