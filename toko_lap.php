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

$sql="select MAX(id_toko) from toko";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "T".sprintf("%03s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string
?>

<head>
   <!--  <form> -->

    <div class="panel-body">
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
                  Tambah
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Tambah Data Toko</h4>
                            </div>
                            <div class="modal-body">
                              
                              <form action="toko_i_res.php" method="POST">

                                <div class="form-group">
                                    <label>Id Toko</label>
                                    <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_toko" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nama Toko</label>
                                    <input type="text" class="form-control"  name="nm_toko"  placeholder="Nama Toko" required>
                                </div>

                                <div class="form-group">
                                    <label>Alamat </label>
                                        <input type="text" class="form-control"  name="alamat"  placeholder="Alamat" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Nomor Telepon </label>
                                       <input type="text" class="form-control"  name="no_telp"  placeholder="No Telepon" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Komisi</label>
                                       <input type="number" class="form-control"  name="komisi" placeholder="Presentase komisi " required>
                                    </div>                             
                             

                             
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                <input type="submit" name="tambahdata" value="Tambah Data"class="btn btn-primary">
                            </div>
                           </form>


                            </div>

                    </div>
                </div>
            </div>
            <!-- /form -->

                <!-- tables -->
                
                <div class="table-heading">
                    <h2> PT ABC </h2>
                    <h2> DAFTAR TOKO </h2>
    </div>

                               <?php  
                                        $sql_cek="select * from toko ORDER BY id_toko ASC";
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
            <th>Id Toko</th>
            <th>Nama Toko</th>
            <th>Alamat Toko </th>
            <th>No Telp</th>
            <th>Komisi</th>
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
                                                <td><?php echo $data['id_toko']; ?></td>
                                                <td><?php echo $data['nm_toko']; ?></td>
                                                <td><?php echo $data['alamat']; ?></td>
                                                <td><?php echo $data['no_telp']; ?></td>
                                                <td><?php echo $data['komisi']; ?></td>
                                                <td>
                                                 <ul class="bt-list">
                                              <li><a href=toko_hapus.php?id_toko=<?php echo $data['id_toko']; ?> class="hvr-icon-fade col-7">Hapus</a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                 <ul class="bt-list">
                                              <li><a href=toko_edit.php?id_toko=<?php echo $data['id_toko']; ?> class="hvr-icon-fade col-7">Edit</a></li>
                                                </ul>
                                            </td>
                                            
                                            </tr>
                                    <?php 
                                         }
                                        }
                                    ?>
                                  
                        </tbody>
                      </table>
                      <a href="cetak_toko.php" target="_blank">CETAK</a>
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
