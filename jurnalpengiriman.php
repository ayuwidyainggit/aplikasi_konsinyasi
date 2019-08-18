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
                <h2>PT ABC </h2>
					<h2>JURNAL UMUM</h2>
				</div>

                    <div class="panel panel-widget forms-panel">
                        <div class="forms">
                            <div class="form-two widget-shadow">
                                <div class="form-title">
                                    <h4> Masukkan Tanggal Periode</h4>
                                </div>
                                <div class="form-body" data-example-id="simple-form-inline">
                                    <form class="form-inline" action="jurnalperiode.php" method="post"> 
                                        <div class="form-group"> 
                                            <label for="exampleInputName2">Tanggal Awal</label> 
                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" placeholder="Tanggal Awal"> 
                                        </div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail2">Tanggal Akhir</label> 
                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" placeholder="Tanggal Akhir
                                            "> 
                                        </div> 
                                        <button type="submit" class="btn btn-default w3ls-button">Send invitation</button> 
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div> 

				    <?php  
                                $sql_cek="SELECT * FROM detail_jurnal r join akun p join jurnalumum j
                    on (p.kd_akun=r.kd_akun)  and (j.no_ju=r.no_ju) order by r.no_ju asc";
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                        echo "<center>Maaf Data Yang anda cari tidak ada <br> Silahkan Masukkan Data Terlebih Dahulu</center>";
                                         }

                                         else{
                                            
                                            $total=mysql_query("select sum(total_debet) as tot_debet, sum(total_kredit) as tot_kredit from detail_jurnal");
                               

                                                                               
                                ?>
				<div class="agile-tables">
					<div class="w3l-table-info">
					
					   <div class="table-responsive bs-example widget-shadow">
      <table class="table table-bordered">
						<thead>
						  <tr>
            <th>Bukti</th>
            <th>Tgl</th>
            <th>Keterangan</th>
            <th>Akun</th>

            <th>Debet</th>
            <th>Kredit</th>
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
                                                <td><?php echo $data['bukti']; ?></td>
                                                <td><?php echo $data['tgl_jurnal']; ?></td>
                                                <td><?php echo $data['keterangan']; ?></td>
                                                
                                                <td><?php echo $data['nm_akun']; ?></td>
                                              	<td>Rp <?php echo number_format($data['total_debet'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
												<td>Rp <?php echo number_format($data['total_kredit'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
										       
                                            </tr>
                                            

                                    <?php 
                                         }
                                        }
                                    ?>

<?php  

                                        $sql_cek1=("SELECT sum(total_debet) as totaldebet from detail_jurnal");
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
                                         while ($data1 = $query_cek1->fetch_array()) {
                                            $no ++;
                                    ?>

                                    <?php  

                                        $sql_cek=("SELECT sum(total_kredit) as totalkredit from detail_jurnal");
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
            <th>TOTAL </th>
            <th></th>
            <th></th>
            <th></th>
<th>Rp <?php echo number_format($data1['totaldebet'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></th>
<th>Rp <?php echo number_format($data2['totalkredit'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></th>

          <!--   <th><?php echo $data1['totaldebet']; ?></th>
            <th><?php echo $data2['totalkredit']; ?></th> -->
        </tr>
                                           <!--  <tr>
                                                <th><?php echo $data1['totalkirim']; ?></th>
                                            </tr>
 -->
                                                     <?php 
                                         }
                                        }
                                    ?>
                                     <?php 
                                         }
                                        }
                                    ?>

						</tbody>
					  </table>
                      <br>
                      <input type="button" onclick="window.print()" value="cetak">
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
