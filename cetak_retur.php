<center><h2>PT ABC</h2></center>
<center><h2> LAPORAN RETUR PENGIRIMAN</h2></center>
    <center><h3>Periode :  <?php echo $_POST['tgl_awal']; ?> s/ d <?php echo $_POST['tgl_akhir']; ?></h3></center><br>

  <?php  




include "koneksi.php";

$tgl_awal            = $_POST['tgl_awal'];
$tgl_akhir            = $_POST['tgl_akhir'];

        $sql_cek=("SELECT * FROM retur r join  toko q 
on  (q.id_toko=r.id_toko)  Where (tgl_retur BETWEEN '$tgl_awal' AND '$tgl_akhir') order by kd_retur asc");
        
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
            <th>Id Retur</th>
            <th>Id Kirim</th>
            <th>Tgl Retur  </th>
            <th>Toko</th>
            <th>Total Retur</th>
          
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
                                                <td><?php echo $data['kd_retur']; ?></td>
                                                <td><?php echo $data['id_kirim']; ?></td>
                                                 <td><?php echo $data['tgl_retur']; ?></td>
                                                 <td><?php echo $data['nm_toko']; ?></td>
                                                <td>Rp <?php echo number_format($data['totalretur'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>

                                              
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>
                                     <?php  
                                       include "koneksi.php";

                                       $tgl_awal            = $_POST['tgl_awal'];
                                       $tgl_akhir            = $_POST['tgl_akhir'];
                                        $sql_cek1=("SELECT sum(totalretur) as total FROM retur r join  toko q 
                    on  (q.id_toko=r.id_toko)   Where (tgl_retur BETWEEN '$tgl_awal' AND '$tgl_akhir') order by kd_retur asc");
                                        
                                        $query_cek1 = $koneksidb->query($sql_cek1);
                                        $result_cek1 = $query_cek1->num_rows;
                                        if($result_cek1=='0'){
                                      echo "<center>Maaf Data Yang anda cari tidak ada <br> Silahkan Masukkan Data Terlebih Dahulu</center>";
                                         }

                                         else{
                                ?>
                                 <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data1 = $query_cek1->fetch_array()) {
                                            $no ++;
                                    ?>
                                            <tr>
                                                <td colspan="5">TOTAL</td>
                                             
                                                <td >Rp <?php echo number_format($data1['total'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                            </tr>
                                            <?php 
                                         }
                                        }
                                    ?>
                        </tbody>
                      </table>

<script>
    window.print();
  </script>