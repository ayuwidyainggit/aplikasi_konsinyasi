<?php
   

   include "koneksi.php";

   $tgl_awal            = $_POST['tgl_awal'];
   $tgl_akhir            = $_POST['tgl_akhir'];
?>
<center><h2>PT ABC</h2></center>
<center><h2>Laporan Penerimaan Penjualan</h2></center>
    <center><h3>Periode :  <?php echo $_POST['tgl_awal']; ?> s/ d <?php echo $_POST['tgl_akhir']; ?></h3></center><br>

 <?php  
                   include "koneksi.php";

                            $tgl_awal            = $_POST['tgl_awal'];
                            $tgl_akhir            = $_POST['tgl_akhir'];

                                        $sql_cek=("SELECT * FROM terimapenjualan r join penjualan p
                    on (p.id_jual=r.id_jual)  Where (tgl_terima BETWEEN '$tgl_awal' AND '$tgl_akhir') order by id_terima asc");
                                        
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                      echo "<center>Maaf Data Yang anda cari tidak ada <br> Silahkan Masukkan Data Terlebih Dahulu</center>";
                                         }

                                         else{
                                ?>
         <center><table cellpadding="7 " border="1" bordercolor="blue"></center>
         <thead>
						  <tr>
            <th data-breakpoints="xs">NO</th>
            <th>Id Penerimaan</th>
            <th>Tgl Penerimaan</th>
            <th>Id Penjualan </th>
            <th>Kas Diterima</th>
           
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
                                               
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>


                                    <?php  

                                        $sql_cek=("SELECT sum(kas) as total from terimapenjualan Where (tgl_terima BETWEEN '$tgl_awal' AND '$tgl_akhir') ");
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
            <td colspan="4">TOTAL </td>
           
			<td>Rp <?php echo number_format($data2['total'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		</tr>
     		<?php 
     		}}
            ?>


						</tbody>
					  </table>
<script>
    window.print();
  </script>