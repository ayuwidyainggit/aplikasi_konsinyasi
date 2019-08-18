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
				
                    <H3>Buat Perhitungan berdasarkan kode pengiriman sebelumnya </H3>
                   
				    <?php
mysql_connect('localhost','root','');
mysql_select_db('kons');
$sql = mysql_query("SELECT * , (select count(id_kirim) from kirimdetail where id_kirim=p.id_kirim)  as jumlah 
FROM kirimselesai r  join toko d join kirimdetail p on (d.id_toko=r.id_toko)  
and (p.id_kirim=r.id_kirim)where sisakirim > 0 ");


 
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
            <th>Id Kirim</th>
            <th>Toko</th>
            <th>Perhitungan Penjualan</th>
            
          </tr>

						</thead>
						<tbody>
                        <?php 
                            


                                      while($row = mysql_fetch_array($sql)) {       
                                        echo '<tr>';
                                        if($jum <= 1) {
                                        echo '<td align="center" rowspan="'.$row['jumlah'].'">'.$no.'</td>';
                                        echo '<td rowspan="'.$row['jumlah'].'">'.$row['id_kirim'].'</td>'; 
                                        
                                        echo '<td rowspan="'.$row['jumlah'].'">'.$row['nm_toko'].'</td>';
                                        echo '<td rowspan="'.$row['jumlah'].'">';
                                        echo "<a href='penjualan_ii.php?id_kirim=" . $row['id_kirim'] . " '>Catat Penjualan </a>";
                                        $jum = $row['jumlah'];       
                                        $no++;                     
                                        } else {
                                        $jum = $jum - 1;
                                        }
                                        
                                       
                                        
                                        echo '</tr>';    

                                    }                              
?>
                                     <?php 
                                                                    ?>

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
		<div class="footer">
			<p>© 2016 Colored . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></p>
		</div>
		<!-- //footer -->
	</section>
	<script src="js/bootstrap.js"></script>
	<script src="js/proton.js"></script>
</body>
</html>
