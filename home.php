<?php  session_start();
//Membuat batasan waktu sesion untuk user di PHP 
$timeout = 1; // Set timeout menit
$logout_redirect_url = "index.php"; // Set logout URL
 
$timeout = $timeout * 10; // Ubah menit ke detik
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Waktu Anda Telah Habis Broo!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?>
 
<html>
<head>
	<title>Cara Membuat Logout Otomatis Menggunakan Session PHP </title>
	<style type="">
		*{margin: 0; padding: 0; font-family: arial}
		.container{    margin: auto;
		    width: 500px;
		    background: #2ecc71;
		    padding: 25px 0;
		    text-align: center;
		    border-radius: 20px;
		}
		header {margin-bottom: 30px;}
		a{width: 215px;
			height: 25px;
			border-radius: 5px;
			border: none;background: #fff; padding: 10px; text-decoration: none;}
	</style>
</head>
<div class="container">
	<header>
		Selamat Datang <?php  echo ucwords($_SESSION['nama']);?>
	</header>
	<article>
		<a href="logout.php" title="Keluar" onClick="return confirm('Apakah anda yakin?')"> << Menu Logout</a></td>
	</article>	
</div>
</body>
</html>