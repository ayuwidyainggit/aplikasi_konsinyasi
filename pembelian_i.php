<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<html lang="en">
<?php

session_start();
include_once "session.php";

include "koneksi.php";


    $sql="select MAX(kd_pembelian) from pembelian";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "KR".sprintf("%03s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string


?>
<?php
        $barang=("SELECT * from persediaan");
        $barang_query = mysqli_query($koneksidb,$barang);
?>

<?php
        $suplier=("SELECT kd_sup, nm_sup from suplier");
        $suplier_query = mysqli_query($koneksidb,$suplier);
?>

<script>
function hitung() {
        var qty=(document.getElementById("qty").value);
        var harga=parseInt(document.getElementById("hrg_beli").value); 
        var total = qty * harga;        
        document.getElementById('total').value = total;
 if (isNaN(qty)){ 
        document.getElementById('total').value = harga;                                 
 }
 if (isNaN(harga)){ 
        document.getElementById('total').value = qty;                                 
 }
 if ((isNaN(qty))&&(isNaN(harga))){ 
        document.getElementById('total').value = 0;                                 
 }

        var keuntungan=parseInt(document.getElementById("keuntungan").value); 
        var harga=parseInt(document.getElementById("hrg_beli").value); 
        var hrg_jual = harga + (keuntungan * harga / 100);        
        document.getElementById('hrg_jual').value = hrg_jual;
 if (isNaN(keuntungan)){ 
        document.getElementById('hrg_jual').value = harga;                                 
 }
 if (isNaN(harga)){ 
        document.getElementById('hrg_jual').value = keuntungan;                                 
 }
 if ((isNaN(keuntungan))&&(isNaN(harga))){ 
        document.getElementById('hrg_jual').value = 0;                                 
 }
      
}
</script>

<head>
<title>Pooled Admin Panel Category Flat Bootstrap Responsive Web Template | Input :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
				<div class="header-main">
					<div class="logo-w3-agile">
								<h1><a href="index.html">Pooled</a></h1>
							</div>
					<div class="w3layouts-left">
							
							<!--search-box-->
								<div class="w3-search-box">
									<form action="#" method="post">
										<input type="text" placeholder="Search..." required="">	
										<input type="submit" value="">					
									</form>
								</div><!--//end-search-box-->
							<div class="clearfix"> </div>
						 </div>
						 <div class="w3layouts-right">
							<div class="profile_details_left"><!--notifications of menu start -->
								<ul class="nofitications-dropdown">
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have 3 new messages</h3>
												</div>
											</li>
											<li><a href="#">
											   <div class="user_img"><img src="images/in11.jpg" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>	
											</a></li>
											<li class="odd"><a href="#">
												<div class="user_img"><img src="images/in10.jpg" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor </p>
												<p><span>1 hour ago</span></p>
												</div>
											  <div class="clearfix"></div>	
											</a></li>
											<li><a href="#">
											   <div class="user_img"><img src="images/in9.jpg" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>	
											</a></li>
											<li>
												<div class="notification_bottom">
													<a href="#">See all messages</a>
												</div> 
											</li>
										</ul>
									</li>
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have 3 new notification</h3>
												</div>
											</li>
											<li><a href="#">
												<div class="user_img"><img src="images/in8.jpg" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											  <div class="clearfix"></div>	
											 </a></li>
											 <li class="odd"><a href="#">
												<div class="user_img"><img src="images/in6.jpg" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>	
											 </a></li>
											 <li><a href="#">
												<div class="user_img"><img src="images/in7.jpg" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>	
											 </a></li>
											 <li>
												<div class="notification_bottom">
													<a href="#">See all notifications</a>
												</div> 
											</li>
										</ul>
									</li>	
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">9</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have 8 pending task</h3>
												</div>
											</li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Database update</span><span class="percentage">40%</span>
													<div class="clearfix"></div>	
												</div>
												<div class="progress progress-striped active">
													<div class="bar yellow" style="width:40%;"></div>
												</div>
											</a></li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
												   <div class="clearfix"></div>	
												</div>
												<div class="progress progress-striped active">
													 <div class="bar green" style="width:90%;"></div>
												</div>
											</a></li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Mobile App</span><span class="percentage">33%</span>
													<div class="clearfix"></div>	
												</div>
											   <div class="progress progress-striped active">
													 <div class="bar red" style="width: 33%;"></div>
												</div>
											</a></li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
												   <div class="clearfix"></div>	
												</div>
												<div class="progress progress-striped active">
													 <div class="bar  blue" style="width: 80%;"></div>
												</div>
											</a></li>
											<li>
												<div class="notification_bottom">
													<a href="#">See all pending tasks</a>
												</div> 
											</li>
										</ul>
									</li>	
									<div class="clearfix"> </div>
								</ul>
								<div class="clearfix"> </div>
							</div>
							<!--notification menu end -->
							
							<div class="clearfix"> </div>				
						</div>
						<div class="profile_details w3l">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="images/in4.jpg" alt=""> </span> 
												<div class="user-name">
													<p>Malorum</p>
													<span>Administrator</span>
												</div>
												<i class="fa fa-angle-down"></i>
												<i class="fa fa-angle-up"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
											<li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
											<li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							
				     <div class="clearfix"> </div>	
				</div>

 	<div class="grid-form">
 		<div class="grid-form1">
 		<h2 id="forms-example" class="">Pembelian Barang</h2>
<form action="pembelian_sementara.php" method="post">
 		
  <div class="form-group">
    <label for="kodebarang">Kode Pembelian</label>
     <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="kd_pembelian" readonly>
  </div>
  <div class="form-group">
    <label for="namabarang">Nama Barang</label>
    <select  class="form-control" name="kd_brg" id="kd_brg">  
                                                     <?php
                                                       while ($barang_tampil=mysqli_fetch_assoc($barang_query)){
                                                       echo "<option value='".$barang_tampil['kd_brg']."'>".$barang_tampil['nm_brg']."</option>";
                                                        }
                                                    ?>
                                                    </select> 
  </div>
  <div class="form-group">
    <label for="hargabeli">Qty</label>
     <input type="number" min="1"  class="form-control" name="qty" id="qty"  required  onkeyup="hitung()" >
   <div class="form-group">
    <label for="hargabeli">Harga Beli</label>
       <input type="text" class="form-control" name="hrg_beli" id="hrg_beli" required onkeyup="hitung()" >
  </div>
  <div class="form-group">
    <label for="keuntungan">Keuntungan(%)</label>
       <input type="number" class="form-control" name="keuntungan" id="keuntungan" required onkeyup="hitung()" >
  </div>
  <div class="form-group">
    <label for="Total">Total Beli</label>
       <input type="number" class="form-control" name="total" id="total" readonly>
  </div>
  <div class="form-group">
    <label for="keuntungan">Harga Jual</label>
       <input type="number" class="form-control" name="hrg_jual" id="hrg_jual" readonly>
  </div>
  



  <button  type="submit" name="tambahdata" value="Tambah Data" class="bg-primary pv15 text-white fw600 text-center">Simpan</button>
  
</div>
</form>
<form method="post" action="pembelian_sementara.php">
													<table class="table table-bordered">
														<tr class="success" style="text-align: center;">
															<th>Nama Barang</th>
															<th>Satuan</th>
															<th>Harga</th>
															<th>Stok</th>
															<th>Jml Beli</th>
															<th>Subtotal</th>
															<th>Action</th>
														</tr>
															<?php foreach ($_SESSION["cart"] as $key => $value){?>
															<tr>
																<td><?=$value['nama']?></td>
																<td><?=$value['satuan']?></td>
																<td><?=number_format($value['harga'])?></td>
																<td><?=$value['stok']?></td>
																<td class="col-md-2"><input type="number" name="qty[]" value="<?=$value['qty']?>" class="form-control"></td>
																<td><?=number_format($value['harga']*$value['qty'])?></td>
																
																<td><a href="keranjang_hapus.php?kd=<?=$value['kd']?>" class="btn btn-danger">X</a></td>
															</tr>
															<?php }?>														
													</table>

			
  <div class="grid-form">
 		<div class="grid-form1">
 		<h2 id="forms-example" class="">Proses Pembelian Barang</h2>
<form action="pembelian_sementara.php" method="post">
 		
  <div class="form-group">
    <label for="kodebarang">Kode Pembelian</label>
	<input type="text" class="form-control" value ="<?php echo $new_ID?>" name="kd_pembelian" readonly>
  </div>
  <div class="form-group">
    <label for="namabarang">Suplier</label>
    <select  class="form-control" name="kd_sup" id="kd_sup">  
                                                     <?php
                                                       while ($suplier_tampil=mysqli_fetch_assoc($suplier_query)){
                                                       echo "<option value='".$suplier_tampil['kd_sup']."'>".$suplier_tampil['nm_sup']."</option>";
                                                        }
                                                    ?>
                                                    </select> 
  </div>
  <div class="form-group">
    <label for="hargabeli">Tanggal Pembelian</label>
     <input type="date" class="form-control" name="tgl_pembelian" id="tgl_pembelian" required ">
   <div class="form-group">
    <label for="hargajual">Total</label>
       <select  class="form-control" name="total" id="total">  
                                                     <?php
                                                       while ($total_tampil=mysqli_fetch_assoc($total_query)){
                                                       echo "<option value='".$total_tampil['total']."'>".$total_tampil['total']."</option>";
                                                        }
                                                    ?>
                                                    </select> 
  </div>
  

    

  <button type="submit" name="tambahdata1" value="Tambah Data1" class="bg-primary pv15 text-white fw600 text-center">Simpan</button>

    </div>
</div>

</form>
</div>
 	<!--//grid-->

<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2016 Pooled . All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
									<ul id="menu" >
										<li><a href="index.php"><i class="fa fa-home"></i> <span>Home</span><div class="clearfix"></div></a></li>
										
										
										 
									 <li id="menu-academico" >
									 	<a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i>
									 		<span> Barang</span> 
									 		<span class="fa fa-angle-right" style="float: right"></span>
									 		<div class="clearfix"></div>
									 	</a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="barang_i.php">Input Barang</a></li>
											<li id="menu-academico-avaliacoes" ><a href="barang_lap.php">Data Barang</a></li>
										  </ul>
										</li>
									<li id="menu-academico" >
									 	<a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i>
									 		<span> Suplier</span> 
									 		<span class="fa fa-angle-right" style="float: right"></span>
									 		<div class="clearfix"></div>
									 	</a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="suplier_i.php">Input Suplier</a></li>
											<li id="menu-academico-avaliacoes" ><a href="suplier_lap.php">Daftar Suplier</a></li>
										  </ul>
										</li>
										<li id="menu-academico" >
									 	<a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i>
									 		<span> Pembelian</span> 
									 		<span class="fa fa-angle-right" style="float: right"></span>
									 		<div class="clearfix"></div>
									 	</a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="pembelian_i.php">Input Pembelian</a></li>
											<li id="menu-academico-avaliacoes" ><a href="pembelian_lap.php">Daftar Pembelian</a>
											</li>
											<li id="menu-academico-avaliacoes" ><a href="beli_lap.php">Laporan Pembelian</a>
											</li>
										  </ul>
										</li>
										<li id="menu-academico" >
									 	<a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i>
									 		<span> Penjualan</span> 
									 		<span class="fa fa-angle-right" style="float: right"></span>
									 		<div class="clearfix"></div>
									 	</a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="penjualan_i.php">Input Penjualan</a></li>
											<li id="menu-academico-avaliacoes" ><a href="penjualan_lap.php">Daftar Penjualan</a>
											</li>
										  </ul>
										</li>
									<li id="menu-academico" >
									 	<a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i>
									 		<span> Garansi</span> 
									 		<span class="fa fa-angle-right" style="float: right"></span>
									 		<div class="clearfix"></div>
									 	</a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="garansi.php">Daftar Yang Belum Diretur</a></li>
										   <li id="menu-academico-avaliacoes" ><a href="retur_jual_lap.php">Laporan Retur Jual</a></li>
										   <li id="menu-academico-avaliacoes" ><a href="garansi_lap.php">Laporan Barang Bergaransi</a></li>
										  </ul>
										</li>
								  </ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>