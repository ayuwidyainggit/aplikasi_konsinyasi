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

$kd_retur = $_GET['kd_retur']; 

// "SELECT * FROM kirim r join barang p join toko q 
//                     on (p.kd_brg=r.kd_brg) AND (q.id_toko=r.id_toko)   where id_kirim='$id_kirim'"




?>


<head>

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
				<!-- tables -->
<div class="table-heading">
<center><h2>PT ABC</h2></center>
					<center><h2>Bukti Retur Pengiriman Barang Konsinyasi</h2><center>
				</div>
				<div class="agile-tables">
					<div class="w3l-table-info">
					 

					 <?php  
                                        // $sql_cek=("SELECT * FROM kirimdetail where id_kirim='$id_kirim'");
                                 $sql_cek=("SELECT * FROM detailretur r join retur q join toko z join barang b
                    on  (q.kd_retur=r.kd_retur) and (z.id_toko=q.id_toko) and (b.kd_brg=r.kd_brg) where r.kd_retur='$kd_retur'");
                                        
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
              <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data1 = $query_cek->fetch_array()) {
                                            $no ++;
                                    ?>
              <h4>Kami sudah menerima barang konsinyasi yang tidak terjual oleh <?php echo $data1['nm_toko']; ?></h4>
											<tr>
                                                <td colspan="3">TUJUAN : <?php echo $data1['nm_toko']; ?></td>

                                             
                                                <td colspan="2">No Bukti : <?php echo $data1['kd_retur']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                
                                                <td colspan="2">Tanggal : <?php echo $data1['tgl_retur']; ?></td>
                                            </tr>
                                            <tr>
                                             
                                                <th data-breakpoints="xs">NO</th>
                                                <th>No Retur</th>
                                                <th>Barang</th>
                                                <th>Jumlah Retur</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
           <tr>
                                                
                                                <td><?php echo $no; ?></td>

                                                <td><?php echo $data1['nm_brg']; ?></td>
                                                <td><?php echo $data1['qty']; ?></td>
                                                <td>Rp <?php echo number_format($data1['jmlretur'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>

                                               
                                                
                                            </tr>
                                    <?php 
                                         }}
                                     ?>
                                     <?php 
                                         
                                     ?>

                               <?php  
                                    include "koneksi.php";
                    $kd_retur = $_GET['kd_retur']; 

                                        $sql_cek1=("SELECT sum(jmlretur * qty ) as a  FROM detailretur r join retur x on (x.kd_retur=r.kd_retur)
                                        where r.kd_retur='$kd_retur'");
                                        $query_cek1 = $koneksidb->query($sql_cek1);
                                        $result_cek1 = $query_cek1->num_rows;
                                        if($result_cek1=='0'){
                                        
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
                                         while ($data2 = $query_cek1->fetch_array()) {
                                            $no ++;
                                    ?>
        <tr>
            <td>TOTAL </td>
            <td></td>
            <td></td>
           
            <td>Rp <?php echo number_format($data2['a'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
            

                                        </tbody>

          
            </table>
            <?php 
                                         }}
                                     ?>
          </div>

					</div>
      
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