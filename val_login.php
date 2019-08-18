<?php
include('koneksi.php');

session_start();

// terima data dari form login
$username = $_POST['username'];
$password = $_POST['password'];
$pass     = MD5($password);

$sql="select * from user WHERE username='$username' AND password='$pass'";
	$query = $koneksidb->query($sql);
	
	$result = $query->num_rows;
	$r 		= $query->fetch_array();

	if ($result > 0) {
		session_start();

		$_SESSION['username'] 	= $r['username'];
		$_SESSION['jabatan'] 	= $r['Jabatan'];

		header('location:index.php');

	}else{
	// kalau username ataupun password tidak terdaftar di database
	header('location:index.php?error=1');
}
?>
