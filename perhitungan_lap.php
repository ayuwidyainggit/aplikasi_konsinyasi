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
                    <h2> PT ABC</h2>
                       <h2> LAPORAN PENCATATAN PERHITUNGAN PENJUALAN </h2>
                    </div>

                    <div class="panel panel-widget forms-panel">
                        <div class="forms">
                            <div class="form-two widget-shadow">
                                <div class="form-title">
                                    <h4> Masukkan Tanggal Periode</h4>
                                </div>
                                <div class="form-body" data-example-id="simple-form-inline">
                                    <form class="form-inline" action="lap_res.php" method="post"> 
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


                    



                <!-- tables -->
                
                

                                <?php  
                                            $sql_cek="select *  FROM penjualan p join toko b on(b.id_toko=p.id_toko) ";
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
            <th>Id Penjualan</th>
            <th>Tgl Penjualan </th>
            <th>Id Kirim </th>
            <th>Toko</th>
            <th>Total Penjualan</th>
            <th>Total Komisi</th>
            <th>Kas Yang Diterima</th>
            <th>Total HPP</th>
            
            
            <th>Lihat Jurnal</th>
            <th>Bukti Transaksi</th>


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
                                                <td><?php echo $data['id_jual']; ?></td>
                                                <td><?php echo $data['tgl_jual']; ?></td>
                                                <td><?php echo $data['id_kirim']; ?></td>
                                                <td><?php echo $data['nm_toko']; ?></td>
                                                <td>Rp <?php echo number_format($data['total'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['tot_komisi'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['kas'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['hpp_total'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                
                                                
                                               
                                            <td>
                                                 <ul class="bt-list">
                                              <li><a href=perhitungan_jurnal.php?id_jual=<?php echo $data['id_jual']; ?> class="hvr-icon-fade col-7">Lihat</a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                 <ul class="bt-list">
                                              <li><a href=perhitungan_bukti.php?id_jual=<?php echo $data['id_jual']; ?> class="hvr-icon-fade col-7">Lihat</a></li>
                                                </ul>
                                            </td>
                                                
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>

                                     <?php  
                                        $sql_cek1="select sum(total) as tot_pj, sum(tot_komisi) as tot_k, sum(kas) as tot_kas, sum(hpp_total) as tot_h  FROM penjualan p join toko b on(b.id_toko=p.id_toko) ";
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
                                                <td>Rp <?php echo number_format($data1['tot_pj'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data1['tot_k'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data1['tot_kas'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data1['tot_h'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                
                                                
                                               
                                            <td>
                                                 <ul class="bt-list">
                                              <li><a href=perhitungan_jurnal.php?id_jual=<?php echo $data['id_jual']; ?> class="hvr-icon-fade col-7">Lihat</a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                 <ul class="bt-list">
                                              <li><a href=perhitungan_bukti.php?id_jual=<?php echo $data['id_jual']; ?> class="hvr-icon-fade col-7">Lihat</a></li>
                                                </ul>
                                            </td>
                                                
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
