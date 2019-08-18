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
 
				<!-- tables -->
				<div class="table-heading">
                <center><h2>PT ABC</h2></center>
                    <center><h2>Daftar Piutang</h2> </center>
                </div>
 

				 


				  <?php  

                               
                                        $sql_cek=("SELECT * FROM penjualan r join  toko q 
                    on  (q.id_toko=r.id_toko)  ");
                                        
										$query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                      echo "<center>Maaf Data Yang anda cari tidak ada <br> Silahkan Masukkan Data Terlebih Dahulu</center>";
                                         }

                                         else{
                                ?>
				<div class="agile-tables">
					<div class="w3l-table-info">
					
<center>      <table cellpadding="7 " border="1" bordercolor="blue"">
						<thead>
						  <tr>
            <th data-breakpoints="xs">NO</th>
            <th>Nama Toko</th>
            <th>Jumlah Piutang</th>
           
            
                 
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
                                                <td><?php echo $data['nm_toko']; ?></td>
                                                
												<td>Rp <?php echo number_format($data['piutang'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                 

                                              
                                                
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>

                                    <?php  
                                        $sql_cek1=("SELECT sum(piutang) as piutang1 FROM penjualan  ");
                                        
										$query_cek1 = $koneksidb->query($sql_cek1);
                                        $result_cek1 = $query_cek1->num_rows;
                                        if($result_cek1=='0'){
                                      echo "<center>Maaf Data Yang anda cari tidak ada <br> Silahkan Masukkan Data Terlebih Dahulu</center>";
                                         }

                                         else{
                                ?>
                                <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data1 = $query_cek1->fetch_array()) {
                                            $no ++;
                                    ?>
                                <tr>
           						 <td colspan="2">TOTAL</td>
           					
           						 <td>Rp <?php echo number_format($data1['piutang1'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td> 
          						</tr>
          						 
                                    <?php 
                                         }
                                        }
                                    ?>
						</tbody>
					  </table>
                      
 <script>
    window.print();
  </script>
               
					</div>
				  
			</div>
		</div>
		
				<!-- //tables -->
			</div>
		</div>
	
	</section>
	
</body>
</html>
