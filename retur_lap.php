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
include "menu.php";
include "koneksi.php";
?>

<head>

            <!-- input-forms -->
                <div class="grids">
                    <div class="progressbar-heading grids-heading">
                    <h2> PT ABC </h2>
                       <h2> LAPORAN RETUR PENGIRIMAN </h2>
                    </div>

                    <div class="panel panel-widget forms-panel">
                        <div class="forms">
                            <div class="form-two widget-shadow">
                                <div class="form-title">
                                    <h4> Masukkan Tanggal Periode</h4>
                                </div>
                                <div class="form-body" data-example-id="simple-form-inline">
                                    <form class="form-inline" action="retur_periode.php" method="post"> 
                                        <div class="form-group"> 
                                            <label for="exampleInputName2">Tanggal Awal</label> 
                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" placeholder="Tanggal Awal"> 
                                        </div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail2">Tanggal Akhir</label> 
                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" placeholder="Tanggal Akhir
                                            "> 
                                        </div> 
                                        <button type="submit" class="btn btn-default w3ls-button">Lihat laporan</button> 
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>  


                    
  
				<!-- tables -->
			


				<?php  
                                        $sql_cek=("SELECT * FROM retur r join  toko q 
                    on  (q.id_toko=r.id_toko)  order by kd_retur asc");
                                        
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
            <th>Id Retur</th>
            <th>Id Kirim</th>
            <th>Tgl Retur  </th>
            <th>Toko</th>
            <th>Total Retur</th>
            <th>Nota</th>
            <th>Lihat Jurnal</th>
            
                 
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
                                                <td><?php echo $data['kd_retur']; ?></td>
                                                <td><?php echo $data['id_kirim']; ?></td>
                                                 <td><?php echo $data['tgl_retur']; ?></td>
                                                 <td><?php echo $data['nm_toko']; ?></td>
                                                <td>Rp <?php echo number_format($data['totalretur'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>

                                               <td class="text-primary">
                                                     <a title="Lihat Faktur Penjualan" href=retur_faktur.php?kd_retur=<?php echo $data['kd_retur']; ?>>Cek</a>
                                                </td>


                                                <td class="text-primary">
                                                     <a title="Lihat Faktur Penjualan" href=jurnalretur.php?kd_retur=<?php echo $data['kd_retur']; ?>>Lihat</a>
                                                </td>
                                                
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>
                                    <?php  
                                        $sql_cek1=("SELECT sum(totalretur) as total FROM retur r join  toko q 
                    on  (q.id_toko=r.id_toko)  order by kd_retur asc");
                                        
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
                                                <td colspan="5">TOTAL</td>
                                             
                                                <td colspan="3">Rp <?php echo number_format($data1['total'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
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
