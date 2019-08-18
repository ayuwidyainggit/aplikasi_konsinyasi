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


$kd_det_kirim = $_GET['kd_det_kirim']; 


?>


<head>


				<!-- tables -->
        <center><h2>PT ABC</h2></center>
					<center><h2>Laporan Alokasi Pengiriman Barang Konsinyasi</h2></center>
                <br>

					 

					  <?php                                          
                                        $sql_cek=("SELECT *, (b.jml_kirim)-(b.penerimaan) as sisa , (a.hrg_pokok_brg)*(b.penerimaan) as hpp_pj , ((b.sisakirim)*(a.hrg_pokok_brg)) as hppsisa, (b.biaya_kirim)/(b.jml_kirim)*(b.penerimaan) as biaya_terima,( ((b.biaya_kirim)/(b.jml_kirim))*(b.sisakirim)) as biaya_sisa  , (b.total)+(b.biaya_kirim) as total1 , ((a.hrg_pokok_brg)*(b.penerimaan)) +((b.biaya_kirim)/(b.jml_kirim)*(b.penerimaan)) as total2 , (((b.sisakirim)*(a.hrg_pokok_brg)) + ((b.biaya_kirim)/(b.jml_kirim)*(b.sisakirim))) as total3 from kirimdetail b join barang a join kirimselesai k join toko t on(a.kd_brg=b.kd_brg) AND (k.id_kirim=b.id_kirim) AND (t.id_toko=k.id_toko)  WHERE kd_det_kirim='$kd_det_kirim'");
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                        
                                         }

                                         else{
                                            ?> 

                                          
      <table cellpadding="7 " border="1" bordercolor="blue">
						<thead>
                            <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data = $query_cek->fetch_array()) {
                                            $no ++;
                                    ?>
											
                                                <label>Nama Toko : <?php echo $data['nm_toko']; ?></label>
                                              <br>
                                              <br>
                                               
                                                <label>NO Alamat : <?php echo $data['alamat']; ?></label>
                                                

						<tr>
                                                <th></th>
                                                <th> Harga Pokok dan Biaya Penjualan Barang Konsinyasi</th>
                                               <th> Harga Pokok Penjualan dan Biaya Penjualan Konsinyasi</th>
                                               <th> Harga Pokok Persediaan yang dikembalikan</th>
                                               <th> Harga Pokok Persediaan dan Biaya Yang Ditangguhkan Pembebanannya</th>
                        </tr>
                                          
                                   
                                   
                                            <tr>
                                                <th>Jumlah Barang</th>
                                                <td><?php echo $data['jml_kirim']; ?></td>
                                                <td><?php echo $data['penerimaan']; ?></td>
                                                <td><?php echo $data['jml_kirim']-$data['sisakirim']-$data['penerimaan']; ?></td>
                                                <td><?php echo $data['sisakirim']; ?></td>
                                                    
                                            </tr>

                                            <tr>
                                                <th>Harga Pokok Produksi</th>
                                                <td>Rp <?php echo number_format($data['total'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['hpp_pj'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['total']-$data['hpp_pj']-$data['hppsisa'] , $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['hppsisa'] , $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                
                                                
                                                    
                                            </tr>
                                             <tr>
                                                <th>Biaya Pengiriman</th>
                                                <td>Rp <?php echo number_format($data['biaya_kirim'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['biaya_terima'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['biaya_kirim']-$data['biaya_terima']-$data['biaya_sisa'] , $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                              <td>Rp <?php echo number_format($data['biaya_sisa'] , $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td> 
                                            </tr>
                                            <tr>
                                                <th>Jumlah</th>
                                                <td>Rp <?php echo number_format($data['total1'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['total2'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['total1']-$data['total2']-$data['total3'] , $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                              <td>Rp <?php echo number_format($data['total3'] , $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                            </tr>



                                          <!--   
                                            <tr>
                                                <th>Biaya Pengiriman</th>
                                                <td>Rp <?php echo number_format($data1['biaya_kirim'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                              
                                                <td>Rp <?php echo number_format($data5['biaya'] * $data55['penerimaan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data5['biaya'] * $data6['sisabarang'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                    
                                            </tr>
                                            
                                              <tr>
                                                <th>Jumlah</th>
                                                <td>Rp <?php echo number_format($data3['total'] + $data1['biaya_kirim'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data4['hpp_pj'] + ($data5['biaya'] * $data55['penerimaan']), $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data6['sisabarang']* ($data7['hrg_pokok_brg']) + ( $data5['biaya'] *$data6['sisabarang']), $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                    
                                            </tr> -->
                                 


<?php
}
}

?>
    
						</tbody>
					  </table>

		
				<!-- //tables -->
			
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
