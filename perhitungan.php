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
                            laporan Penjualan dan Laporan Alokasi Penjualan Konsinyasi
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
				<!-- tables -->
				
				<div class="table-heading">
					<h2>Laporan Pengiriman</h2>
				</div>
				  <?php  
                                        $sql_cek=("SELECT * FROM penjualan r join  barang q 
                    on  (q.kd_brg=r.kd_brg)  order by id_kirim asc");
                                        
										$query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                      echo "<center>Maaf Data Yang anda cari tidak ada <br> Silahkan Masukkan Data Terlebih Dahulu</center>";
                                         }

                                         else{
                                ?>
				<div class="agile-tables">
					<div class="w3l-table-info">
					
					   <div class="table-responsive bs-example widget-shadow">
      <table class="table table-bordered">
						<thead>
						  <tr>
            <th data-breakpoints="xs">NO</th>
            <th>I</th>
            <th>Id Kirim</th>
            <th>Barang</th>
            <th>Jml Kirim</th>
            <th>Harga Pokok</th>
            <th>Status Pengiriman</th>
            <th>Lihat Status penjualan</th>
            
                 
          </tr>
						</thead>
						<tbody>
						 <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data = $query_cek->fetch_array()) {
                                            $no ++;
                                    ?>
                                    <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data['kd_det_kirim']; ?></td>
                                                <td><?php echo $data['id_kirim']; ?></td>
                                                <td><?php echo $data['nm_brg']; ?></td>
                                                <td><?php echo $data['jml_kirim']; ?></td>

												<td>Rp <?php echo number_format($data['hrg_pokok_brg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td><?php echo $data['sisakirim']; ?> belum laku terjual</td>
                                                 <td>
                                                 <ul class="bt-list">
                                              <li><a href=perhitungan.php?kd_det_kirim=<?php echo $data['kd_det_kirim']; ?> class="hvr-icon-fade col-7">Lihat</a></li>
                                                </ul>
                                            </td>

                                              
                                                
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>
						</tbody>
					  </table>
					</div>
				  
			</div>
		</div>
		
				<!-- //tables -->
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
</body>
</html>
