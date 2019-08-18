<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once "session.php";

include "koneksi.php";

    $sql="select MAX(id_jualr) from penjualanreguler";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "JR".sprintf("%03s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string


$barang=("SELECT kd_brg, nm_brg from barang");
$barang_query = mysqli_query($koneksidb,$barang);

?>

<?php

    $sql1="select MAX(kd_det_kirim) from kirimdetail";
    $hasil1 = $koneksidb->query($sql1);
    $data1 = $hasil1->fetch_array();

    $MaxID1 = $data1[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut1 = (int) substr($MaxID1,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut1++;               //lalu variabel no_urut ditambah 1

    $new_ID1 = "DK".sprintf("%03s","$no_urut1");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string


?>


<?php
        $toko=("SELECT id_toko, nm_toko from toko");
        $toko_query = mysqli_query($koneksidb,$toko);
?>



<?php
$total=("SELECT sum(total) as totalkirim from kirimsementara");
$total_query = mysqli_query($koneksidb,$total); 
?>
<?php
$totalb=("SELECT sum(biaya_kirim) as totalbiaya from kirimsementara");
$totalb_query = mysqli_query($koneksidb,$totalb); 
?>


<head>
<title>Colored  an Admin Panel Category Flat Bootstrap Responsive Website Template | Tables :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Colored Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.css">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/modernizr.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/screenfull.js"></script>
<script>
    $(function () {
        $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

        if (!screenfull.enabled) {
            return false;
        }

        $('#toggle').click(function () {
            screenfull.toggle($('#container')[0]);
        }); 
    });
</script>
<!-- tables -->
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<!-- //tables -->
</head>
<body class="dashboard-page">

    <nav class="main-menu">
        <ul>
            <li>
                <a href="index.html">
                    <i class="fa fa-home nav_icon"></i>
                    <span class="nav-text">
                    Dashboard
                    </span>
                </a>
            </li>

            <li class="has-subnav">
                <a href="javascript:;">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                    <span class="nav-text">Akun</span>
                    <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
                </a>
                <ul>
                    <li>
                        <a class="subnav-text" href="akun_i.php">Input Data Akun</a>
                    </li>
                    <li>
                        <a class="subnav-text" href="akun_lap.php">Daftar Akun</a>
                    </li>
                </ul>
            </li>

            <li class="has-subnav">
                <a href="javascript:;">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                    <span class="nav-text">Toko</span>
                    <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
                </a>
                <ul>
                    <li>
                        <a class="subnav-text" href="toko_i.php">Input Data Toko</a>
                    </li>
                    <li>
                        <a class="subnav-text" href="toko_lap.php">Daftar Toko</a>
                    </li>
                </ul>
            </li>
 <li class="has-subnav">
                <a href="javascript:;">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                    <span class="nav-text">Barang</span>
                    <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
                </a>
                <ul>
                    <li>
                        <a class="subnav-text" href="barang_i.php">Input Data Barang</a>
                    </li>
                    <li>
                        <a class="subnav-text" href="barang_masuk.php">Input Barang Masuk</a>
                    </li>
                    <li>
                        <a class="subnav-text" href="barang_lap.php">Daftar Barang</a>
                    </li>
                </ul>
            </li>
            
            <li class="has-subnav">
                <a href="javascript:;">
                <i class="fa fa-check-square-o nav_icon"></i>
                <span class="nav-text">
                Input Data Transaksi 
                </span>
                <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
                </a>
                <ul>
                    <li>
                        <a class="subnav-text" href="kirim_i.php">Input Data Pengiriman </a>
                    </li>
                    <li>
                        <a class="subnav-text" href="penjualan_i.php">Input Perhitungan Penjualan</a>
                    </li>
                    <li>
                        <a class="subnav-text" href="terima_penjualan.php">Input Data Penerimaan Penjualan  </a>
                    </li>
                    <li>
                        <a class="subnav-text" href="jurnalumum.php">Input Jurnal Umum</a>
                    </li>
                </ul>
            </li>
            <li class="has-subnav">
                <a href="javascript:;">
                    <i class="fa fa-file-text-o nav_icon"></i>
                        <span class="nav-text">Laporan</span>
                    <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
                </a>
                <ul>
                    <li>
                        <a class="subnav-text" href="kirim_lap.php">
                            Laporan Pengiriman 
                        </a>
                    </li>
                    <li>
                        <a class="subnav-text" href="Konsinyasi_lap.php">
                            laporan Pengiriman Per Barang dan Laporan Alokasi Penjualan Konsinyasi
                        </a>
                    </li>
                    <li>
                        <a class="subnav-text" href="perhitungan_lap.php">
                            laporan Penerimaan Perhitungan Penjualan 
                        </a>
                    </li>
                    
                    <li>
                        <a class="subnav-text" href="terima_penjualan_lap.php">
                            Laporan Penerimaan Penjualan
                        </a>
                    </li>
                    <li>
                        <a class="subnav-text" href="daftar_piutang.php">
                            Daftar Piutang
                        </a>
                    </li>
                </ul>
            </li>
            <li class="has-subnav">
                <a href="javascript:;">
                    <i class="fa fa-file-text-o nav_icon"></i>
                        <span class="nav-text">Laporan Keuangan</span>
                    <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
                </a>
                <ul>
                   
                    <li>
                        <a class="subnav-text" href="laporan.php">
                            Laporan Jurnal Umum
                        </a>
                    </li>
                    <li>
                        <a class="subnav-text" href="labarugi.php">
                            laporan Laba Rugi Penjualan Konsinyasi
                        </a>
                    </li>
                    <li>
                        <a class="subnav-text" href="neracasaldo.php">
                            Laporan Neraca Saldo
                        </a>
                    </li>
                </ul>
            </li>
            

           
    </nav>
    <section class="wrapper scrollable">
        <nav class="user-menu">
            <a href="javascript:;" class="main-menu-access">
            <i class="icon-proton-logo"></i>
            <i class="icon-reorder"></i>
            </a>
        </nav>
        <section class="title-bar">
            <div class="logo">
                <h1><a href="index.html"><img src="images/logo.png" alt="" />Kons.Id</a></h1>
            </div>
            <div class="full-screen">
                <section class="full-top">
                    <button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>    
                </section>
            </div>
            <div class="w3l_search">
                <form action="#" method="post">
                    <input type="text" name="search" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="header-right">
                <div class="profile_details_left">
                    <div class="header-right-left">
                        <!--notifications of menu start -->
                        <ul class="nofitications-dropdown">
                               
                            <div class="clearfix"> </div>
                        </ul>
                    </div>  
                    <div class="profile_details">       
                        <ul>
                            <li class="dropdown profile_details_drop">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <div class="profile_img">   
                                        <span class="prfil-img"><i class="fa fa-user" aria-hidden="true"></i></span> 
                                        <div class="clearfix"></div>    
                                    </div>  
                                </a>
                                <ul class="dropdown-menu drp-mnu">
                                   
                                    <li> <a href="profil.php"><i class="fa fa-user"></i> Profile</a> </li> 
                                    <li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </section>
        <div class="main-grid">
            <div class="agile-grids">   
				<!-- input-forms -->
				<div class="grids">
					<div class="progressbar-heading grids-heading">
						<h2>Input Data Penjualan Reguler</h2>
					</div>
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Penjualan reguler :</h4>
								</div>
								<div class="form-body">
									<form action="jual_i_res.php" method="post"> 
										<div class="form-group"> 
											<label for="exampleInputEmail1">Kode Pengiriman</label> 
											<input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_jualr" readonly>
										</div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1">Tanggal </label> 
                                            <input type="date" class="form-control" name="tgl_jual" id="tgl_jual" required  > 
                                        </div> 
										<div class="form-group"> 

											<label for="exampleInputPassword1">Barang</label> 
											<?php   
                          $con = mysqli_connect("localhost","root","","ayu");  
                      ?> 
                            <select name="kd_brg" id="kd_brg" class="form-control" onchange='changeValue(this.value)' required >  
                              <option>pilih</option>
                          <?php   
                          $query = mysqli_query($con, "select * from barang where jml_brg >= 1 order by kd_brg
                           esc");  
                          $result = mysqli_query($con, "select * from barang where jml_brg >= 1");  
                          
                          $b          = "var hrg_jual_brg = new Array();\n;";
                         
                           
                          while ($row = mysqli_fetch_array($result)) {  
                               echo '<option name="nm_brg" value="'.$row['kd_brg'] . '">' . $row['nm_brg'] . '</option>';   
                         
                          $b .= "hrg_jual_brg['" . $row['kd_brg'] . "'] = {hrg_jual_brg:'" . addslashes($row['hrg_jual_brg'])."'};\n";  
                          
                          }  

                          ?>  
                     </select>
										</div> 

										
										<div class="form-group"> 
											<label for="exampleInputEmail1">Qty </label> 
											 <input type="number" min="1" value="1"  id="jml_brg" class="form-control" name="jml_kirim" id="jml_kirim"  placeholder="Masukkan jumlah pengiriman " readonly=""> 
										</div> 
										
					
										<div class="form-group"> 
											<label for="exampleInputEmail1">Harga Jual Barang </label> 
											 <input type="text" class="form-control" name="hrg_jual_brg" id="hrg_jual_brg" required="">
										</div> 
										
										<button type="submit" name="tambahdata" value="Tambah Data" class="btn btn-default w3ls-button">Submit</button> 
									</form>  
										
								</div>
							</div>
						</div>
					</div>		

					

                                    
				<!-- //input-forms -->
			</div>
		</div>

		<!-- footer -->
		<div class="footer">
			<p>© 2016 Colored . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></p>
		</div>
		<!-- //footer -->
	</section>
	<script src="js/bootstrap.js"></script>
	<script src="js/proton.js"></script>
	  <script type="text/javascript">   
                          <?php   
                          
                          echo $b; 
                           ?>  
                          function changeValue(kd_brg){  
                  
                            document.getElementById('hrg_jual_brg').value = hrg_jual_brg[kd_brg].hrg_jual_brg;
                        
                          };  
                          </script>  
</body>
</html>
