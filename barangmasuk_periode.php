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
        <script>window.location='barangmasuk_lap.php'</script>";

  exit;
        } else {

}
if ($tgl_awal == 0){
    echo "<SCRIPT language=Javascript>
        alert('Maaf masukkan tanggal dengan benar!') 
        </script>
        <script>window.location='barangmasuk_lap.php'</script>";

  exit;
        } else {

}
?>
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
<head>

<!-- input-forms -->
                <div class="grids">
                    <div class="progressbar-heading grids-heading">
                    <center><h2> PT ABC</h2></center>
                       <center><h2> LAPORAN BARANG MASUK </h2></center>
                    </div>

                   <center><h3>Periode :  <?php echo $_POST['tgl_awal']; ?> s/ d <?php echo $_POST['tgl_akhir']; ?></h3></center><br>
                    
                    
           <div class="forms">
               <div class="form-two widget-shadow">
                
                   <div class="form-body" data-example-id="simple-form-inline">
                       <form class="form-inline" action="cetak_barangmasuk_periode.php" target="_blank" method="post"> 
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




                <!-- tables -->
                
                

                                <?php  

                                 include "koneksi.php";

                            $tgl_awal            = $_POST['tgl_awal'];
                            $tgl_akhir            = $_POST['tgl_akhir'];


                                            $sql_cek=("select *  FROM barangmasuk b join barang a on (a.kd_brg=b.kd_brg) Where (tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir') ");
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
            <th>Kode Barang Masuk</th>
            <th>Tgl Masuk </th>
            <th>Nama Barang </th>
            <th>Jumlah</th>
            

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
                                                <td><?php echo $data['kd_barangmasuk']; ?></td>
                                                <td><?php echo $data['tgl_masuk']; ?></td>
                                                <td><?php echo $data['nm_brg']; ?></td>
                                                <td><?php echo $data['jml_brg']; ?></td>
                                                
                                                
                                           
                                                
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>
                                   
                        </tbody>
                      </table>
                     
	</section>
	<script src="js/bootstrap.js"></script>
    <script src="js/proton.js"></script>
    
</body>
</html>
