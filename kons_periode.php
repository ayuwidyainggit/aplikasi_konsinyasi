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

$tgl_awal            = $_POST['tgl_awal'];
$tgl_akhir            = $_POST['tgl_akhir'];
if ($tgl_awal >  date($_POST['tgl_akhir'])){
    echo "<SCRIPT language=Javascript>
        alert('Maaf masukkan tanggal dengan benar!') 
        </script>
        <script>window.location='konsinyasi_lap.php'</script>";

  exit;
        } else {

}
if ($tgl_awal == 0 ){
    echo "<SCRIPT language=Javascript>
        alert('Maaf masukkan tanggal dengan benar!') 
        </script>
        <script>window.location='konsinyasi_lap.php'</script>";

  exit;
        } else {

}
?>

<head>
 

                <div class="table-heading">
                    <h2>PT ABC</h2>
                    <h2>Laporan Pengiriman Barang Konsinyasi Per Barang</h2>
                </div>
                <center><h3>Periode :  <?php echo $_POST['tgl_awal']; ?> s/ d <?php echo $_POST['tgl_akhir']; ?></h3></center><br>

                
           <div class="forms">
               <div class="form-two widget-shadow">
                
                   <div class="form-body" data-example-id="simple-form-inline">
                       <form class="form-inline" action="cetak_kirimbarang.php" target="_blank" method="post"> 
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


				<!-- tables -->
				
  <?php  

  
$tgl_awal            = $_POST['tgl_awal'];
$tgl_akhir            = $_POST['tgl_akhir'];
                                        $sql_cek=("SELECT * FROM kirimdetail r join  barang q join kirimselesai x join toko a  on  (q.kd_brg=r.kd_brg) AND (x.id_kirim=r.id_kirim) AND (a.id_toko=x.id_toko)  Where (tgl_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir') order by kd_det_kirim asc");
                                        
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

                               <h3>Klik lihat untuk melihat laporan alokasi pengiriman barang konsinyasi!</h3>

                          <tr>
            <th data-breakpoints="xs">NO</th>
            <th>Kode Detail Kirim</th>
            <th>Id Kirim</th>
            <th>Toko Tujuan</th>
            <th>Tanggal</th>
            <th>Barang</th>
            <th>Jml Kirim</th>
            <th>Harga Pokok</th>
            <th>Status Pengiriman</th>
           
            <th>Laporan Alokasi</th>
            
                 
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
                                                <td><?php echo $data['kd_det_kirim']; ?></td>
                                                <td><?php echo $data['id_kirim']; ?></td>
                                                <td><?php echo $data['nm_toko']; ?></td>
                                                <td><?php echo $data['tgl_kirim']; ?></td>
                                                <td><?php echo $data['nm_brg']; ?></td>
                                                <td><?php echo $data['jml_kirim']; ?></td>

                                                <td>Rp <?php echo number_format($data['hrg_pokok_brg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td><?php echo $data['sisakirim']; ?> belum laku terjual</td>
                                                
                                                <td>
                                                 <ul class="bt-list">
                                              <li><a href=alokasi.php?kd_det_kirim=<?php echo $data['kd_det_kirim']; ?> class="hvr-icon-fade col-7">Lihat</a></li>
                                                </ul>
                                            </td>

                                                <!-- <td class="text-primary">
                                                     <a title="lapkons" href=alokasi.php?kd_det_kirim=<?php echo $data['kd_det_kirim']; ?>>Lihat</a>
                                                </td> -->
                                                
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
