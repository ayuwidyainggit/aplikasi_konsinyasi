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
					<center><h2>JURNAL UMUM</h2><center>
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
                                        <button type="submit" class="btn btn-default w3ls-button">Lihat Laporan</button> 
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div> 

                    <tr>
                    <td class="bt-list">
                    
                       <li> <a href=jurnal_pengiriman.php class="hvr-icon-fade col-7">Jurnal Kirim</a>
                        <a href=jurnal_penerimaan.php class="hvr-icon-fade col-7">Jurnal Penerimaan Perhitungan</a>
                        <a href=jurnal_pj.php class="hvr-icon-fade col-7">Jurnal Penerimaan Penjualan</a>
                        <a href=jurnalkirim.php class="hvr-icon-fade col-7">Jurnal Retur</a>
                        <a href=laporan.php class="hvr-icon-fade col-7">Semua Jurnal</a>  </li>
                    </td>
                    </tr>
				    <?php
mysql_connect('localhost','root','');
mysql_select_db('kons');
$sql = mysql_query("select *,concat('Rp ', format ((total_debet), 0)) as debet,
concat('Rp ', format ((total_kredit), 0)) as kredit,
 b.keterangan as k,(select count(no_ju) from detail_jurnal where no_ju=A.no_ju) as jumlah from detail_jurnal A join jurnalumum B 
join akun C
on(b.no_ju=a.no_ju) AND (c.kd_akun=A.kd_akun) where bukti like 'KR%' order by A.no_ju");


 
$no = 1;
$jum = 1;
?>
				<div class="agile-tables">
					<div class="w3l-table-info">
					
					   <div class="table-responsive bs-example widget-shadow">
      <table class="table table-bordered">
						<thead>
						  <tr>
            <th>No</th>
            <th>Bukti</th>
            <th>Tgl</th>
            <th>Keterangan</th>
            <th>Cek</th>
            <th>Akun</th>
            <th>Debet</th>
            <th>Kredit</th>
            
          </tr>

						</thead>
						<tbody>
                        <?php 
                            


                                      while($row = mysql_fetch_array($sql)) {       
                                        echo '<tr>';
                                        if($jum <= 1) {
                                        echo '<td align="center" rowspan="'.$row['jumlah'].'">'.$no.'</td>';
                                        echo '<td rowspan="'.$row['jumlah'].'">'.$row['no_ju'].'</td>'; 
                                        
                                        echo '<td rowspan="'.$row['jumlah'].'">'.$row['tgl_jurnal'].'</td>';
                                        
                                        echo '<td rowspan="'.$row['jumlah'].'">'.$row['k'].'</td>';  
                                        echo '<td rowspan="'.$row['jumlah'].'">';
                                        echo "<a href='kirim.php?bukti=" . $row['bukti'] . " '>CEK </a>";
                                        $jum = $row['jumlah'];       
                                        $no++;                     
                                        } else {
                                        $jum = $jum - 1;
                                        }
                                        echo '<td>'.$row['nm_akun'].'</td>'; 
                                        echo '<td>'.$row['debet'].'</td>';   
                                        echo '<td>'.$row['kredit'].'</td>'; 
                                       
                                        echo '</td>';    
                                        echo '</tr>';    

                                    }                              
?>
<?php  

                                        $sql_cek1=("SELECT sum(total_debet) as totaldebet from detail_jurnal d join jurnalumum c on (c.no_ju=d.no_ju)  where bukti like 'KR%'");
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

                                        $sql_cek=("SELECT sum(total_kredit) as totalkredit from detail_jurnal d join jurnalumum c on (c.no_ju=d.no_ju)  where bukti like 'KR%' ");
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
            <th colspan="6">TOTAL </th>
            
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
