<?php 
include 'koneksi.php';
session_start();

	//remove the id from our cart array
	$key = array_search($_GET['kd'], $_SESSION['cart']);	
	unset($_SESSION['cart'][$key]);

//$key = array_search($id, $cart['data']['product_id']);
//if($key!==FALSE) {
//    unset($cart['data']['product_id'][$key]);
//    unset($cart['data']['quantity'][$key]);
//}
//print_r($cart);
//die;

//$kd = $_GET['kd'];

//$cart = $_SESSION["cart"];
//print_r($cart);

//array_filter berfungsi untuk mengambil data secara spesifik
//$k = array_filter($cart, function ($var) use ($kd){
//	return ($var['$kd']==$kd);
//});
//print_r($k);
//foreach ($k as $key => $value){
//	unset($_SESSION["cart"][$key]);
//}

//mengembalikan urutan data
//$_SESSION['cart'] = array_values($_SESSION['cart']);
header('location:penjualan.php');

 ?>