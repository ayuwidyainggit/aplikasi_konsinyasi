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

$id_jual = $_GET['id_jual']; 

// "SELECT * FROM kirim r join barang p join toko q 
//                     on (p.kd_brg=r.kd_brg) AND (q.id_toko=r.id_toko)   where id_kirim='$id_kirim'"

$sql_data="SELECT * FROM penjualan r join toko q 
                    on  (q.id_toko=r.id_toko)   where id_jual='$id_jual'";
$hasil_data = $koneksidb->query($sql_data);
$data1 = $hasil_data->fetch_array();



?>


<head>

        <!-- tables -->
<div class="table-heading">
<h2> PT ABC </h2>
          <h2>Bukti Penerimaan Perhitungan Penjualan</h2>
        </div>
        <div class="agile-tables">
          <div class="w3l-table-info">
           

  <?php    
    $id_jual = $_GET['id_jual']; 

    $sql_cek=("SELECT * FROM detailjual r join barang q  
                    on  (q.kd_brg=r.kd_brg)  where r.id_jual='$id_jual'");
                                        
    $query_cek = $koneksidb->query($sql_cek);
    $result_cek = $query_cek->num_rows;
      if($result_cek=='0'){
        echo "<center>Maaf Data Yang anda cari tidak ada <br> Silahkan Masukkan Data Terlebih Dahulu</center>";
      }

      else{
  ?>
                       
              <div class="table-responsive ">
      <table class="table-responsive">
            <thead>
          
                      <tr>
                                            <td colspan="3">TUJUAN : <?php echo $data1['nm_toko']; ?></td>
                                                <td></td>
                                                <td></td>
                                                
                                                <td colspan="2">NO Pengiriman : <?php echo $data1['id_jual']; ?></td>
                                            </tr>
                                            <tr>
                                            <td></td>
                                                <td></td>
                                                
                                                <td colspan="3"></td>
                                                <td colspan="2">Tgl Kirim : <?php echo $data1['tgl_jual']; ?></td>
                                            </tr>
                                            <tr>
                                    
                                                <th data-breakpoints="xs">NO</th>
                                                <th>Nama Barang</th>
                                                <th>Kuantitas</th>
                                                <th>Harga Jual</th>
                                                
                                                <th>Komisi</th>
                                                <th>Kas yang diterima </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                  
           <tr>
           <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data = $query_cek->fetch_array()) {
                                            $no ++;
                                    ?>
                                             
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data['nm_brg']; ?></td>
                                                <td><?php echo $data['qty']; ?></td>
                                                
                                                 <td>Rp <?php echo number_format($data['hrg_jual_brg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                 <td>Rp <?php echo number_format($data['hasil_komisi'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['kas_diterima'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                               

                                               
                                                
                                            </tr>
                                    <?php 
                                         }}
                                     ?>
                                     <?php  
                                    include "koneksi.php";
                    $id_jual = $_GET['id_jual']; 

                                        $sql_cek1=("SELECT sum(hrg_jual_brg) as a, sum(hasil_komisi) as b, sum(kas_diterima) as c FROM detailjual r join barang q  
                                        on  (q.kd_brg=r.kd_brg)  where r.id_jual='$id_jual'");
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
            <td>Rp <?php echo number_format($data2['a'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
            <td>Rp <?php echo number_format($data2['b'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
            <td>Rp <?php echo number_format($data2['c'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>

                                  
                                        </tbody>

          
            </table>
            <ul class="bt-list">
                                              <li><a href=cetak_perhitunganbukti.php?id_jual=<?php echo  $_GET['id_jual']; ?>  target="_blank" class="hvr-icon-fade col-7">Cetak</a></li>
                                                </ul>
            <?php 
                                         }}
                                     ?>
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
