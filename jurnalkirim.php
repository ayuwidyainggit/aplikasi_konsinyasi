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

$id_kirim = $_GET['id_kirim']; 



?>
<head>
 
				<!-- tables -->
				
				<div class="table-heading">
					<h2>Jurnal Umum</h2>
				</div>

                    <?php
mysql_connect('localhost','root','');
mysql_select_db('kons');
 $id_kirim = $_GET['id_kirim']; 
$sql = mysql_query("select *,concat('Rp ', format ((total_debet), 0)) as debet,
concat('Rp ', format ((total_kredit), 0)) as kredit,
 b.keterangan as k,(select count(no_ju) from detail_jurnal where no_ju=A.no_ju) as jumlah from detail_jurnal A join jurnalumum B 
join akun C
on(b.no_ju=a.no_ju) AND (c.kd_akun=A.kd_akun) where bukti='$id_kirim'  order by A.no_ju");


 
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
            
            <th>Akun</th>
            <th> Keterangan </th>
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
                                        $jum = $row['jumlah'];       
                                        $no++;                     
                                        } else {
                                        $jum = $jum - 1;
                                        }
                                        echo '<td>'.$row['nm_akun'].'</td>'; 
                                        echo '<td>'.$row['debet'].'</td>';   
                                        echo '<td>'.$row['kredit'].'</td>'; 
                                        
                                        echo '</tr>';    

                                    }                              
?>



<?php  
                    include "koneksi.php";
                    $id_kirim = $_GET['id_kirim']; 

                                        $sql_cek1=("SELECT sum(total_debet) as totaldebet from detail_jurnal j join jurnalumum p on (p.no_ju=j.no_ju) where  bukti='$id_kirim'");
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
                                    include "koneksi.php";
                    $id_kirim = $_GET['id_kirim']; 

                                        $sql_cek=("SELECT sum(total_kredit) as totalkredit from detail_jurnal j join jurnalumum p on (p.no_ju=j.no_ju) where  bukti='$id_kirim'");
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
            <td></td>
<td>Rp <?php echo number_format($data1['totaldebet'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
<td>Rp <?php echo number_format($data2['totalkredit'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>

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
