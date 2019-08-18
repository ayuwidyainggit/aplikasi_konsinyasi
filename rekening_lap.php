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
                <h2> PT ABC </h2>
                    <h2> DAFTAR REKENING </h2>
    </div>

                                <?php  
                                $sql_cek="select * from rekening order by kd_rekening";
                                
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
            <th>Kode Rekening</th>
            <th>Nama Rekening</th>
                    
            <th>Hapus</th>
            <th>Edit</th>
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
                                                <td><?php echo $data['kd_rekening']; ?></td>
                                                <td><?php echo $data['nm_rekening']; ?></td>
                                                
                                                <td>
                                                 <ul class="bt-list">
                                              <li><a href=delete_rekening.php?kd_rekening=<?php echo $data['kd_rekening']; ?> class="hvr-icon-fade col-7">Hapus</a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                 <ul class="bt-list">
                                              <li><a href=rekening_edit.php?kd_rekening=<?php echo $data['kd_rekening']; ?> class="hvr-icon-fade col-7">Edit</a></li>
                                                </ul>
                                            </td>
                                            
                                            </tr>
                                            

                                    <?php 
                                         }
                                        }
                                    ?>
                                    
                        </tbody>

                      </table>
                      <a href="cetak.php" target="_blank">CETAK</a>
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
