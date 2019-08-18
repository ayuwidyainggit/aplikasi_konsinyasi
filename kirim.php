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

$bukti = $_GET['bukti']; 

// "SELECT * FROM kirim r join barang p join toko q 
//                     on (p.kd_brg=r.kd_brg) AND (q.id_toko=r.id_toko)   where id_kirim='$id_kirim'"

$sql_data="SELECT * FROM kirimselesai r join toko q 
                    on  (q.id_toko=r.id_toko)   where id_kirim='$bukti'";
$hasil_data = $koneksidb->query($sql_data);
$data = $hasil_data->fetch_array();



?>


<head>

				<!-- tables -->
<div class="table-heading">
<h2>PT ABC </h2>
					<h2> Pengiriman Barang Konsinyasi</h2>
				</div>
             
                

				<div class="agile-tables">
					<div class="w3l-table-info">
					 

					 <?php  
                                        // $sql_cek=("SELECT * FROM kirimdetail where id_kirim='$id_kirim'");
                                 $sql_cek=("SELECT * FROM kirimdetail r join barang q join kirimselesai a 
                    on  (q.kd_brg=r.kd_brg) and (a.id_kirim=r.id_kirim)  where r.id_kirim='$bukti'");
                                        
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
											<tr>
                                                <td colspan="3">TUJUAN : <?php echo $data['nm_toko']; ?></td>
                                                <td colspan="2">NO Pengiriman : <?php echo $data['id_kirim']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2">Tgl Kirim : <?php echo $data['tgl_kirim']; ?></td>
                                            </tr>
                                            <tr>
                                             
                                                <th data-breakpoints="xs">NO</th>
                                                <th>Nama Barang</th>
                                                <th>Kuantitas</th>
                                                <th>Harga Pokok</th>
                                                <th>Biaya Kirim</th>
                                                <th>Total</th>
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
                                                <td><?php echo $data1['nm_brg']; ?></td>
                                                <td><?php echo $data1['jml_kirim']; ?></td>
                                                
                                                 <td>Rp <?php echo number_format($data1['hrg_pokok_brg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                 <td>Rp <?php echo number_format($data1['totalbiaya'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data1['hrg_pokok_brg']*$data1['jml_kirim'  ], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>

                                               
                                                
                                            </tr>
                                    <?php 
                                         }}
                                     ?>
                                     <?php 
                                         
                                     ?>
                                     </tbody>

          
          <?php  
                                    include "koneksi.php";
                    $id_kirim = $_GET['id_kirim']; 

                                        $sql_cek1=("SELECT sum(hrg_pokok_brg * jml_kirim) as a , sum(totalbiaya) as b FROM kirimdetail r join barang q join kirimselesai c 
                                        on  (q.kd_brg=r.kd_brg) and (c.id_kirim=r.id_kirim)  where r.id_kirim='$bukti'");
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
            <td></td>
            <td>Rp <?php echo number_format($data2['b'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
            <td>Rp <?php echo number_format($data2['a'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
            

                                        </tbody>

          
            </table>
            <?php 
                                         }}
                                     ?>
          </div>

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
