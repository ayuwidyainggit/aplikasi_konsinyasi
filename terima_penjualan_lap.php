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
?>

<head>

				<!-- tables -->
				
				<div class="table-heading">
                <h2> PT ABC </h2>
					<h2>Laporan Penerimaan Penjualan</h2>
				</div>

                     <div class="panel panel-widget forms-panel">
                        <div class="forms">
                            <div class="form-two widget-shadow">
                                <div class="form-title">
                                    <h4> Masukkan Tanggal Periode</h4>
                                </div>
                                <div class="form-body" data-example-id="simple-form-inline">
                                    <form class="form-inline" action="terimaperiode.php" method="post"> 
                                        <div class="form-group"> 
                                            <label for="exampleInputName2">Tanggal Awal</label> 
                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" placeholder="Tanggal Awal"> 
                                        </div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail2">Tanggal Akhir</label> 
                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" placeholder="Tanggal Akhir
                                            "> 
                                        </div> 
                                        <button type="submit" class="btn btn-default w3ls-button">Lihat Laporan</button> 
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>  

				  <?php  
                                        $sql_cek=("SELECT * FROM terimapenjualan r join penjualan p
                    on (p.id_jual=r.id_jual)  order by id_terima asc");
                                        
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

                                        $sql_cek=("SELECT sum(kas) as total from terimapenjualan");
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
            <td>TOTAL </td>
            <td></td>
            <td></td>
            <td></td>
			<td>Rp <?php echo number_format($data2['total'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		</tr>
     		<?php 
     		}}
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
