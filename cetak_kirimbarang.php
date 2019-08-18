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

$tgl_awal            = $_POST['tgl_awal'];
$tgl_akhir            = $_POST['tgl_akhir'];
?>

<head>
 

                <div class="table-heading">
                <center><h2>PT ABC</h2></center>
                    <center><h2>Laporan Pengiriman Barang Konsinyasi Per Barang</h2></center>
                </div>
                <center><h3>Periode :  <?php echo $_POST['tgl_awal']; ?> s/ d <?php echo $_POST['tgl_akhir']; ?></h3></center><br>

          


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
        <center>            
      <table cellpadding="7 " border="1" bordercolor="blue">
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
	
		<!-- //footer -->
	</section>
	<script src="js/bootstrap.js"></script>
	<script src="js/proton.js"></script>
    
 <script>
    window.print();
  </script>
</body>
</html>
