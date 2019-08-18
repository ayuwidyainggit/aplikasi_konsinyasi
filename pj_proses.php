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
                    <h2>PERHITUNGAN PENJUALAN</h2>
                </div>

                <h5>Klik buat untuk melakukan pencatatan perhitungan penjualan !</h5>
                  <?php  

          $id_kirim = $_GET['id_kirim'];
          include "koneksi.php";

                                        $sql_cek=("SELECT * FROM kirimdetail r join  barang q 
                    on  (q.kd_brg=r.kd_brg) WHERE sisakirim >= 1  AND id_kirim='$id_kirim' order by id_kirim asc");
                                        
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                      echo "<center>Barang sudah habis terjual </center>";
                                         }

                                         else{
                                ?>
                <div class="agile-tables">
                    <div class="w3l-table-info">
                    
                       <div class="table-responsive bs-example widget-shadow">
      <table class="table table-bordered">
                        <thead>
                          <tr>
            <th data-breakpoints="xs">NO</th>
            <th>Kode Detail Kirim</th>
            <th>Id Kirim</th>
            <th>Barang</th>
            <th>Jml Kirim</th>
            <th>Perhitungan Penjualan</th>
           
            
                 
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
                                                <td><?php echo $data['nm_brg']; ?></td>
                                                <td><?php echo $data['jml_kirim']; ?></td>
                                                <td>
                                                <ul class="bt-list">
                                              <li><a href=penjualan_ii.php?kd_det_kirim=<?php echo $data['kd_det_kirim']; ?> class="hvr-icon-forward col-2">Buat</a></li>
                                                </ul>
                                            </td>
                                                
                                              <!--  <td class="text-primary">
                                                     <a title="Lihat Faktur Penjualan" href=penjualan_ii.php?kd_det_kirim=<?php echo $data['kd_det_kirim']; ?>>Buat</a>
                                                </td> -->
                                                
                                                    
                                                
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>


                                
                        </tbody>
                      </table>

              <div class="table-heading">
          <h2>PERHITUNGAN PENJUALAN</h2>
        </div>

        <h5>Hasil :</h5>
          <?php  

          $id_kirim = $_GET['id_kirim'];
          include "koneksi.php";

                                        $sql_cek1=("SELECT * FROM detailjual r join barang p 
                    on (p.kd_brg=r.kd_brg) where id_kirim='$id_kirim'");
                                        
                    $query_cek1 = $koneksidb->query($sql_cek1);
                                        $result_cek1 = $query_cek1->num_rows;
                                        if($result_cek1=='0'){
                                      echo "<center>Barang sudah habis terjual </center>";
                                         }

                                         else{
                                ?>
        <div class="agile-tables">
          <div class="w3l-table-info">
          
             <div class="table-responsive bs-example widget-shadow">
      <table class="table table-bordered">
            <thead>
               <tr>
            <th data-breakpoints="xs">NO</th>
            <th>Kode Detail Pengiriman</th>
            <th>Barang</th>
            <th>qty</th>
            <th>Harga Jual </th>
            <th>Total</th>
            <th>Biaya Pengiriman</th>
            <th>Action</th>
         </tr>
            </thead>
            <tbody>
              <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data1 = $query_cek1->fetch_array()) {
                                            $no ++;
                                    ?>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data1['kd_det_kirim']; ?></td>
                                                <td><?php echo $data1['nm_brg']; ?></td>
                                                <td><?php echo $data1['qty']; ?></td>
                                                <td><?php echo $data1['hrg_jual_brg']; ?></td>
                                                <td><?php echo $data1['komisi']; ?></td>
                                                <td><?php echo $data1['kas_diterima']; ?></td>
                                                
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
