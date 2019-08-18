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


$barang=("SELECT * from barang");
$barang_query = mysqli_query($koneksidb,$barang);
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
                    <div class="panel-body">

                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
                  Tambah
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Input Data Pemasukan Barang</h4>
                            </div>
                            <div class="modal-body">
                              
                              <form action="barang_masuk_res.php" method="POST">

                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                     <input type="date" class="form-control"  name="tgl_masuk"  required>
                                </div>
                                    <?php
                                    $barang=("SELECT kd_brg, nm_brg from barang");
                                    $barang_query = mysqli_query($koneksidb,$barang);
                                    ?>

                                <div class="form-group">
                                    <label>Barang</label>
                                     <select  class="form-control" name="kd_brg" id="kd_brg">  
                                                     <?php
                                                       while ($barang_tampil=mysqli_fetch_assoc($barang_query)){
                                                       echo "<option value='".$barang_tampil['kd_brg']."'>".$barang_tampil['nm_brg']."</option>";
                                                        }
                                                    ?>
                                                    </select> 
                                </div>

                                <div class="form-group">
                                    <label>Jumlah Barang Masuk</label>
                                  <input type="number" class="form-control"  name="jml_brg" placeholder="Qty" required>
                                </div>


                             
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                <input type="submit" name="tambahdata" value="Tambah Data" class="btn btn-primary">
                            </div>
                           </form>


                            </div>

                    </div>
                </div>
            </div>


                    



                <!-- tables -->
                
                

                                <?php  
                                            $sql_cek="select b.kd_barangmasuk, b.tgl_masuk, a.nm_brg, b.jml_brg  FROM barangmasuk b join barang a on (a.kd_brg=b.kd_brg) ";
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
            <th>Kode Barang Masuk</th>
            <th>Tgl Masuk </th>
            <th>Nama Barang </th>
            <th>Jumlah</th>
            

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
                                                <td><?php echo $data['kd_barangmasuk']; ?></td>
                                                <td><?php echo $data['tgl_masuk']; ?></td>
                                                <td><?php echo $data['nm_brg']; ?></td>
                                                <td><?php echo $data['jml_brg']; ?></td>
                                                
                                                
                                           
                                                
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
