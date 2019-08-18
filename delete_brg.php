<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<?php
include "koneksi.php";
$kd_det_kirim = $_GET['kd_det_kirim']; 
?>

<?php
        $qty=("SELECT jml_kirim from kirimsementara where kd_det_kirim='$kd_det_kirim'");
        $qty_query = mysqli_query($koneksidb,$qty);
?>
<?php
        $barang=("SELECT r.kd_brg, p.nm_brg FROM kirimsementara r join barang p  
                    on (p.kd_brg=r.kd_brg) where r.kd_det_kirim='$kd_det_kirim'  ;");
        $barang_query = mysqli_query($koneksidb,$barang);
?>

<?php
        $jual=("
SELECT r.kd_brg, p.hrg_jual_brg FROM kirimsementara r join barang p  
                    on (p.kd_brg=r.kd_brg) where r.kd_det_kirim='$kd_det_kirim'  ;");
        $jual_query = mysqli_query($koneksidb,$jual);
?>

<?php
        $hpp=("
SELECT r.kd_brg, p.hrg_pokok_brg FROM kirimsementara r join barang p  
                    on (p.kd_brg=r.kd_brg) where r.kd_det_kirim='$kd_det_kirim'  ;");
        $hpp_query = mysqli_query($koneksidb,$hpp);
?>


</script>
<head>
<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.php" class="logo">
        KONSINYASIKU
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/j.jpg">
                <span class="username">Setting</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="about_us.php"><i class=" fa fa-suitcase"></i>About Us</a></li>
                <li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
<li>
                    <a class="active" href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Home</span>
                    </a>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book" ></i>
                        <span>Barang</span>
                    </a>
                    <ul class="sub">
                        <li><a href="barang_i.php">Input Barang</a></li>
                        <li><a href="barang_lap.php">Daftar Barang</a></li>
                    </ul>
                </li>

                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book" ></i>
                        <span>Toko</span>
                    </a>
                    <ul class="sub">
                        <li><a href="toko_i.php">Input Toko</a></li>
                        <li><a href="toko_lap.php">Daftar Toko</a></li>
                    </ul>
                </li>
                  <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book" ></i>
                        <span>Transaksi</span>
                    </a>
                    <ul class="sub">
                        <li><a href="kirim_i.php">Pengiriman</a></li>
                        <li><a href="bkk_i.php">Pengeluaran</a></li>
                    </ul>
                </li>
                 
                
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book" ></i>
                        <span>Laporan Keuangan </span>
                    </a>
                    <ul class="sub">
                        <li><a href="jurnal_umum.php">Jurnal Umum</a></li>
                        <li><a href="lap_kons.php">Laporan Konsinyasi</a></li>
                        <li><a href="lap_lr.php">Laporan Laba/Rugi</a></li>
                    </ul>
                </li>
                <li>
                    <a href="registration.html">
                        <i class="fa fa-user"></i>
                        <span>Login Page</span>
                    </a>
                </li>
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end--><html>
<!--main content start-->

<section id="main-content">
    <section class="wrapper">
        <!-- //market-->
        
        
        <div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Input Jurnal Pengiriman 
            </header>
            <div class="panel-body">

               <form  name="autosumform" class="form-horizontal bucket-form" action="d.php" method="post">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Barang</label>
                        <div class="col-sm-6">
                                 <input type="text" class="form-control"  name="kd_brg" id="kd_brg"  readonly    <?php
                                                       while ($barang_tampil=mysqli_fetch_assoc($barang_query)){
                                                       echo "<option value='".$barang_tampil['kd_brg']."'>"."</option>";
                                                        }
                                                    ?>
                                                  
                            
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Qty</label>
                        <div class="col-sm-6">
                                 <input type="text" class="form-control"  name="jml_kirim" id="jml_kirim"  readonly    <?php
                                                       while ($qty_tampil=mysqli_fetch_assoc($qty_query)){
                                                       echo "<option value='".$qty_tampil['jml_kirim']."'>"."</option>";
                                                        }
                                                    ?>
                                                  
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga Jual</label>
                        <div class="col-sm-6">
                                 <input type="text" class="form-control"  name="hrg_jual_brg" id="hrg_jual_brg"  readonly    <?php
                                                       while ($jual_tampil=mysqli_fetch_assoc($jual_query)){
                                                       echo "<option value='".$jual_tampil['hrg_jual_brg']."'>"."</option>";
                                                        }
                                                    ?>
                                                  
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga Pokok</label>
                        <div class="col-sm-6">
                                 <input type="text" class="form-control"  name="hrg_pokok_brg" id="hrg_pokok_brg"  readonly    <?php
                                                       while ($hpp_tampil=mysqli_fetch_assoc($hpp_query)){
                                                       echo "<option value='".$hpp_tampil['hrg_pokok_brg']."'>"."</option>";
                                                        }
                                                    ?>
                                                  
                            
                        </div>
                    </div>
                  

                        
            </div> 
            <input type="submit" name="tambahdata" value="Hapus" class="btn btn-success">
       
                </form>
            </div>
        </section>       
</body>

</html>

</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->  
<script>
    $(document).ready(function() {
        //BOX BUTTON SHOW AND CLOSE
       jQuery('.small-graph-box').hover(function() {
          jQuery(this).find('.box-button').fadeIn('fast');
       }, function() {
          jQuery(this).find('.box-button').fadeOut('fast');
       });
       jQuery('.small-graph-box .box-close').click(function() {
          jQuery(this).closest('.small-graph-box').fadeOut(200);
          return false;
       });
       
        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }
        
        graphArea2 = Morris.Area({
            element: 'hero-area',
            padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
            data: [
                {period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
                {period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
                {period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
                {period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
                {period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
                {period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
                {period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
                {period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
                {period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
            
            ],
            lineColors:['#eb6f6f','#926383','#eb6f6f'],
            xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });
        
       
    });
    </script>
<!-- calendar -->
    <script type="text/javascript" src="js/monthly.js"></script>
    <script type="text/javascript">
        $(window).load( function() {
            $('#mycalendar').monthly({
                mode: 'event',
                
            });
            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });
        switch(window.location.protocol) {
        case 'http:':
        case 'https:':
        // running on a server, should be good.
        break;
        case 'file:':
        alert('Just a heads-up, events will not work when run locally.');
        }
        });
    </script>
    <!-- //calendar -->
           <script type="text/javascript">   
                          <?php   
                          echo $a;   
                           ?>  
                          function changeValue(id_toko){  
                            document.getElementById('komisi').value = komisi[id_toko].komisi;  
                             
                          };  
                          </script> 

</body>
</html>