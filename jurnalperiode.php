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
$tgl_awal            = $_POST['tgl_awal'];
$tgl_akhir            = $_POST['tgl_akhir'];
if ($tgl_awal >  date($_POST['tgl_akhir'])){
    echo "<SCRIPT language=Javascript>
        alert('Maaf masukkan tanggal dengan benar!') 
        </script>
        <script>window.location='laporan.php'</script>";

  exit;
        } else {

}
if ($tgl_awal == 0){
    echo "<SCRIPT language=Javascript>
        alert('Maaf masukkan tanggal dengan benar!') 
        </script>
        <script>window.location='laporan.php'</script>";

  exit;
        } else {

}
?>
		

			<!-- tables -->
				
      <div class="table-heading">
      <h2>PT ABC </h2>
					<center><h2>JURNAL UMUM</h2></center>
				</div>
                
                <center><h3>Periode :  <?php echo $_POST['tgl_awal']; ?> s/ d <?php echo $_POST['tgl_akhir']; ?></h3></center><br>
           
                        <div class="forms">
                            <div class="form-two widget-shadow">
                             
                                <div class="form-body" data-example-id="simple-form-inline">
                                    <form class="form-inline" action="cetak.php" target="_blank" method="post"> 
                                        <div class="form-group"> 
                                          
                                            <input type="hidden" name="tgl_awal" class="form-control" id="tgl_awal" value="<?php echo $tgl_awal?>" readonly> 
                                        </div> 
                                        <div class="form-group"> 
                                            
                                            <input type="hidden" name="tgl_akhir" class="form-control" id="tgl_akhir"  value="<?php echo $tgl_akhir?>" readonly > 
                                        </div> 
                                        <button type="submit" class="btn btn-default w3ls-button" >CETAK</button> 
                                    </form> 
                                </div>
                            </div>
                        </div>
             

                    

				    	    <?php

mysql_connect('localhost','root','');
mysql_select_db('kons');
  include "koneksi.php";

                            $tgl_awal            = $_POST['tgl_awal'];
                            $tgl_akhir            = $_POST['tgl_akhir'];

$sql = mysql_query("select *,concat('Rp ', format ((total_debet), 0)) as debet,
concat('Rp ', format ((total_kredit), 0)) as kredit,
 b.keterangan as k,(select count(no_ju) from detail_jurnal where no_ju=A.no_ju) as jumlah from detail_jurnal A join jurnalumum B 
join akun C
on(b.no_ju=a.no_ju) AND (c.kd_akun=A.kd_akun) Where (tgl_jurnal BETWEEN '$tgl_awal' AND '$tgl_akhir') order by A.no_ju");


 
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

						</tbody>

            
          <?php  
                                  
  include "koneksi.php";

  $tgl_awal            = $_POST['tgl_awal'];
  $tgl_akhir            = $_POST['tgl_akhir'];

 $sql_cek1=("select sum(j.total_debet) as d,  sum(j.total_kredit) as k  from detail_jurnal j join jurnalumum k on(k.no_ju=j.no_ju) 
 where (tgl_jurnal between '$tgl_awal' and '$tgl_akhir ')");
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
            <td></td>
            <td>Rp <?php echo number_format($data2['d'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
            <td>Rp <?php echo number_format($data2['k'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
            

                                  
                                        </tbody>
                                        
          
            </table>
            <?php 
                                         }}
                                     ?>
          </div>

					</div>
            </table>
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
