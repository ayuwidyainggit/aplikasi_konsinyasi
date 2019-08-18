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
    <!-- form -->
    <?php

include "koneksi.php";

 $sql="select MAX(kd_brg) from barang";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "B".sprintf("%03s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string

?>
    <div class="panel-body">
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
                  Tambah
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Tambah Data Barang</h4>
                            </div>
                            <div class="modal-body">
                              
                              <form action="barang_i_res.php" method="POST">

                                <div class="form-group">
                                    <label>Kode Barang</label>
                                     <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="kd_brg" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control"  name="nm_brg" placeholder="Nama Barang" required>
                                </div>

                                 <div class="form-group">
                                    <label>Harga Pokok </label>
                                    <br>
                                        <input type="text" class="uang"  id="hrg_pokok_brg"  name="hrg_pokok_brg"  placeholder="Harga Jual Barang"/>
                                    </div>
                                 
                                <!--  <div class="form-group">
                                    <span>Harga Jual Barang</span>
                                  <input type="text" class="form-control" min="1"  id="hrg_jual_brg"  name="hrg_jual_brg" placeholder="Harga Jual Barang" required>
                                 
                                  </div> -->
                                 
                                    <div class="form-group">
                                    <label>Harga Jual </label>
                                    <br>
                                        <input type="text"  class="uang"  id="hrg_jual_brg"  name="hrg_jual_brg"  placeholder="Harga Jual Barang"/>
                                    </div>
       <script src="jquery.min.js"></script>
        <script src="jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});

            })
        </script>
    
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
                <h2> PT ABC</h2>
                    <h2> DAFTAR BARANG </h2>
    </div>

                                <?php  
                                        $sql_cek="select * from barang ORDER BY kd_brg ASC";
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
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang </th>
            <th>Harga Pokok Barang</th>
            <th>Harga Jual Barang</th>
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
                                                <td><?php echo $data['kd_brg']; ?></td>
                                                <td><?php echo $data['nm_brg']; ?></td>
                                                <td><?php echo $data['jml_brg']; ?></td>
                                                <td>Rp <?php echo number_format($data['hrg_pokok_brg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>Rp <?php echo number_format($data['hrg_jual_brg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                                <td>
                                                 <ul class="bt-list">
                                              <li><a href=baranghapus.php?kd_brg=<?php echo $data['kd_brg']; ?> class="hvr-icon-fade col-7">Hapus</a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                 <ul class="bt-list">
                                              <li><a href=barang_edit.php?kd_brg=<?php echo $data['kd_brg']; ?> class="hvr-icon-fade col-7">Edit</a></li>
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
