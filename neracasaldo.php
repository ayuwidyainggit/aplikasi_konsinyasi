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
                    <h2> NERACA SALDO </h2>
    </div>
    <ul class="bt-list">
                      <li><a href=cetak_neraca.php  target="_blank" class="hvr-icon-fade col-7">Cetak</a></li>
                      </ul>
                                 <?php  
                                $sql_cek="select b.* , a.nm_rekening from akun b, rekening a where b.kd_rekening=a.kd_rekening order by kd_rekening";
                                
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
                          <tr>
            <th data-breakpoints="xs">NO</th>
            <th>Kode Akun</th>
            <th>Kelompok Rekening</th>
            <th>Nama Akun</th>
            <th>Debet </th>        
            <th>Kredit </th>
           
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
                                                <td><?php echo $data['kd_akun']; ?></td>
                                                <td><?php echo $data['nm_rekening']; ?></td>
                                                <td><?php echo $data['nm_akun']; ?></td>
                                                <td>Rp <?php echo number_format($data['debet'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['kredit'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                
                                            
                                            </tr>
                                            

                                    <?php 
                                         }
                                        }
                                    ?>
                                   

<?php  

                                        $sql_cek1=("SELECT sum(debet) as totaldebet from akun");
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

                                        $sql_cek=("SELECT sum(kredit) as totalkredit from akun");
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
            <th>TOTAL </th>
            <th></th>
            <th></th>
            <th></th>
<th>Rp <?php echo number_format($data1['totaldebet'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></th>
<th>Rp <?php echo number_format($data2['totalkredit'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></th>

          <!--   <th><?php echo $data1['totaldebet']; ?></th>
            <th><?php echo $data2['totalkredit']; ?></th> -->
        </tr>
                                           <!--  <tr>
                                                <th><?php echo $data1['totalkirim']; ?></th>
                                            </tr>
 -->
  <!-- <a href="deleteakun.php"><i class=" fa fa-suitcase"></i>Delete All</a> -->

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
