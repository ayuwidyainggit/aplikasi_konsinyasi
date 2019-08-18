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



$id_terima = $_GET['id_terima']; 


$sql_data="SELECT * FROM terimapenjualan r join penjualan q join toko z 
                    on  (q.id_jual=r.id_jual) and (q.id_toko=z.id_toko) where id_terima='$id_terima'";
$hasil_data = $koneksidb->query($sql_data);
$data = $hasil_data->fetch_array();



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
				<!-- tables -->
<div class="table-heading">
<center><h2>PT ABC</h2></center>
					<center><h2>Bukti Penerimaan Penjualan Barang Konsinyasi</h2></center>
				</div>
				<div class="agile-tables">
					<div class="w3l-table-info">
					 

					 <?php  
                                        // $sql_cek=("SELECT * FROM kirimdetail where id_kirim='$id_kirim'");
                                 $sql_cek=("SELECT * FROM terimapenjualan r join penjualan q 
                    on  (q.id_jual=r.id_jual)  where id_terima='$id_terima'");
                                        
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                      echo "<center>Maaf Data Yang anda cari tidak ada <br> Silahkan Masukkan Data Terlebih Dahulu</center>";
                                         }

                                         else{
                                ?>
                                
					    <div class="table-responsive ">
      <table class="table-responsive">
						<thead>
            <br>
              <h4>Kami sudah mencatat hasil penjualan yang dikirimkan oleh <?php echo $data['nm_toko']; ?></h4>
											<tr>
                                                <td colspan="3">TUJUAN : <?php echo $data['nm_toko']; ?></td>

                                             
                                                <td colspan="2">No Bukti : <?php echo $data['id_terima']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                
                                                <td colspan="2">Tanggal : <?php echo $data['tgl_terima']; ?></td>
                                            </tr>
                                            <tr>
                                             
                                                <th data-breakpoints="xs">NO</th>
                                                <th>No Penjualan</th>
                                                <th></th>
                                                <th>Jumlah Penerimaan</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data1 = $query_cek->fetch_array()) {
                                            $no ++;
                                    ?>
           <tr>
                                                
                                                <td><?php echo $no; ?></td>

                                                <td><?php echo $data1['id_jual']; ?></td>
                                                <td></td>
                                                
                                                <td>Rp <?php echo number_format($data1['kas'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>

                                               
                                                
                                            </tr>
                                    <?php 
                                         }}
                                     ?>
                                     <?php 
                                         
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
		<!-- //footer -->
	</section>
	<script src="js/bootstrap.js"></script>
	<script src="js/proton.js"></script>
    
<script>
    window.print();
  </script>
</body>
</html>
