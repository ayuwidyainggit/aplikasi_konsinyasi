
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
include "menu.php";

$tgl_awal            = $_POST['tgl_awal'];
$tgl_akhir            = $_POST['tgl_akhir'];
if ($tgl_awal >  date($_POST['tgl_akhir'])){
    echo "<SCRIPT language=Javascript>
        alert('Maaf masukkan tanggal dengan benar!') 
        </script>
        <script>window.location='terima_penjualan_lap.php'</script>";

  exit;
        } else {

}
if ($tgl_awal == 0){
    echo "<SCRIPT language=Javascript>
        alert('Maaf masukkan tanggal dengan benar!') 
        </script>
        <script>window.location='terima_penjualan_lap.php'</script>";

  exit;
        } else {

}

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

        
        <div class="main-grid">
            <div class="agile-grids">   
				<!-- tables -->
				
				<div class="table-heading">
                <h2> PT ABC </h2>
					<h2>Laporan Penerimaan Penjualan</h2>
				</div>

                     <center><h3>Periode :  <?php echo $_POST['tgl_awal']; ?> s/ d <?php echo $_POST['tgl_akhir']; ?></h3></center><br>

                     <div class="forms">
               <div class="form-two widget-shadow">
                
                   <div class="form-body" data-example-id="simple-form-inline">
                       <form class="form-inline" action="cetak_terimaperiode.php" target="_blank" method="post"> 
                           <div class="form-group"> 
                             
                               <input type="hidden" name="tgl_awal" class="form-control" id="tgl_awal" value="<?php echo $tgl_awal?>" readonly> 
                           </div> 
                           <div class="form-group"> 
                               
                               <input type="hidden" name="tgl_akhir" class="form-control" id="tgl_akhir"  value="<?php echo $tgl_akhir?>" readonly > 
                           </div> 
                           <button type="submit" class="btn btn-default w3ls-button" >CETAK</button> 
                       </form> 
                   </div>
               </div>
           </div>
				  <?php  
                   include "koneksi.php";

                            $tgl_awal            = $_POST['tgl_awal'];
                            $tgl_akhir            = $_POST['tgl_akhir'];

                                        $sql_cek=("SELECT * FROM terimapenjualan r join penjualan p
                    on (p.id_jual=r.id_jual)  Where (tgl_terima BETWEEN '$tgl_awal' AND '$tgl_akhir') order by id_terima asc");
                                        
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
            <th>Id Penerimaan</th>
            <th>Tgl Penerimaan</th>
            <th>Id Penjualan </th>
            <th>Kas Diterima</th>
            <th>Lihat  Jurnal</th>
            <th>Bukti Penerimaan</th>
            
                 
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
                                                <td><?php echo $data['id_terima']; ?></td>
                                                <td><?php echo $data['tgl_terima']; ?></td>
                                                <td><?php echo $data['id_jual']; ?></td>
                                                <td>Rp <?php echo number_format($data['kas'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>
                                                 <ul class="bt-list">
                                              <li><a href=terima_jurnal.php?id_terima=<?php echo $data['id_terima']; ?> class="hvr-icon-fade col-7">Lihat</a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                 <ul class="bt-list">
                                              <li><a href=penjualan_faktur.php?id_terima=<?php echo $data['id_terima']; ?> class="hvr-icon-fade col-7">Lihat</a></li>
                                                </ul>
                                            </td>
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>


                                    <?php  

                                        $sql_cek=("SELECT sum(kas) as total from terimapenjualan Where (tgl_terima BETWEEN '$tgl_awal' AND '$tgl_akhir') ");
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                        
                                         }

                                         else{
                                         //   $sqltotal=("SELECT sum(total) as totalkirim from kirimsementara");
                                         //   $query= $koneksidb->query($sqltotal);
                                         //   $result= $query->num_rows;
                                           
                                ?>
                                    <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data2 = $query_cek->fetch_array()) {
                                            $no ++;
                                    ?>
        <tr>
            <td colspan="4">TOTAL </td>
            
			<td colspan="3">Rp <?php echo number_format($data2['total'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		</tr>
     		<?php 
     		}}
            ?>


						</tbody>
					  </table>
                      <br>
                     
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
