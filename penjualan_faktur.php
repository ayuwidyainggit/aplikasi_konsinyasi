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


$id_terima = $_GET['id_terima']; 

// "SELECT * FROM kirim r join barang p join toko q 
//                     on (p.kd_brg=r.kd_brg) AND (q.id_toko=r.id_toko)   where id_kirim='$id_kirim'"

$sql_data="SELECT * FROM terimapenjualan r join penjualan q join toko z 
                    on  (q.id_jual=r.id_jual) and (q.id_toko=z.id_toko) where id_terima='$id_terima'";
$hasil_data = $koneksidb->query($sql_data);
$data = $hasil_data->fetch_array();



?>


<head>  
				<!-- tables -->
<div class="table-heading">
<h2> PT ABC </h2>
					<h2>Bukti Penerimaan Penjualan Barang Konsinyasi</h2>
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
                      <ul class="bt-list">
                      <li><a href=cetak_penjualanfaktur.php?id_terima=<?php echo  $_GET['id_terima']; ?>  target="_blank" class="hvr-icon-fade col-7">Cetak</a></li>
                      </ul>
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
