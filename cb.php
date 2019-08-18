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

?>

<head>

<!-- input-forms -->
                <div class="grids">
                    <div class="progressbar-heading grids-heading">
                       <h2> LAPORAN BARANG MASUK </h2>
                       <h2> PT ABC </h2>
                    </div>

                    <div class="panel panel-widget forms-panel">
                        <div class="forms">
                            <div class="form-two widget-shadow">
                                <div class="form-title">
                                    <h4> Masukkan Tanggal Periode</h4>
                                </div>
                                <div class="form-body" data-example-id="simple-form-inline">
                                    <form class="form-inline" action="barangmasuk_periode.php" method="post"> 
                                        <div class="form-group"> 
                                            <label for="exampleInputName2">Tanggal Awal</label> 
                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" placeholder="Tanggal Awal"> 
                                        </div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail2">Tanggal Akhir</label> 
                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" placeholder="Tanggal Akhir
                                            "> 
                                        </div> 
                                        <button type="submit" class="btn btn-default w3ls-button">Lihat Laporan</button> 
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>  
   <?php  
          $sql_cek="select *,concat('Rp ', format ((total_debet), 0)) as debet,
concat('Rp ', format ((total_kredit), 0)) as kredit,
 b.keterangan as k,(select count(no_ju) from detail_jurnal where no_ju=A.no_ju) as jumlah from detail_jurnal A join jurnalumum B 
join akun C
on(b.no_ju=a.no_ju) AND (c.kd_akun=A.kd_akun) order by A.no_ju";
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                        echo "<center>Maaf Data Yang anda cari tidak ada <br> Silahkan Masukkan Data Terlebih Dahulu</center>";
                                         }

                                         else{
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
            <th>Bukti</th>
            <th>Tgl</th>
            <th>Keterangan</th>
            <th>Akun</th>
            <th>Debet</th>
            <th>Kredit</th>
            

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
                                                <?php
                                             if($jum <= 1) {

                                             ?>
                                                <td rowspan=<?php echo $data['jumlah']?>><?php echo $no; ?></td>
                                                <td rowspan=<?php echo $data['jumlah']?>><?php echo $data['no_ju']; ?></td>
                                                <td rowspan=<?php echo $data['jumlah']?>><?php echo $data['tgl_jurnal']; ?></td>
                                                <td rowspan=<?php echo $data['jumlah']?>><?php echo $data['k']; ?></td>
                                                 <?php
                                            $jum = $data['jumlah'];       
                                                            
                                        } else {
                                        $jum = $jum - 1;
                                        }
                                             ?>
                                         
                                                <td><?php echo $data['nm_akun']; ?></td>
                                                 <td><?php echo $data['debet']; ?></td>
                                                  <td><?php echo $data['kredit']; ?></td>
                                                
                                                
                                           
                                                
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
