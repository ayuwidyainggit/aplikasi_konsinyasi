<?php 
include 'koneksi.php';
session_start();

	//remove the id from our cart array
	$key = array_search($_GET['kd_akun'], $_SESSION['cart3']);	
	unset($_SESSION['cart3'][$key]);

	
// $kd_akun = $_GET['kd_akun'];

// $cart3 = $_SESSION["cart3"];


// // array_filter berfungsi untuk mengambil data secara spesifik
// $k = array_filter($cart3, function ($var) use ($kd_akun){
// 	return ($var['$kd_akun']==$kd_akun);
// });

// foreach ($k as $key => $value){
// 	unset($_SESSION["cart3"][$key]);
// }

// // mengembalikan urutan data
// $_SESSION['cart3'] = array_values($_SESSION['cart3']);
header('location:jurnalumum.php');

 ?>