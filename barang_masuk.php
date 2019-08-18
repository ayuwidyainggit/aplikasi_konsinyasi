<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<html lang="en">
<?php
session_start();
include_once "session.php";

include "koneksi.php";
include "menu.php";

$barang=("SELECT kd_brg, nm_brg from barang");
$barang_query = mysqli_query($koneksidb,$barang);

?>


<head>

                <!-- input-forms -->
                <div class="grids">
                    <div class="progressbar-heading grids-heading">
                        <h2>Input Data Barang Masuk</h2>
                    </div>
                    <div class="panel panel-widget forms-panel">
                        <div class="forms">
                            <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                                <div class="form-title">
                                    <h4>Data Barang:</h4>
                                </div>
                                <div class="form-body">
                                    <form action="barang_masuk_res.php" method="post"> 
                                        
                                         <div class="form-group"> 
                                            <label for="exampleInputEmail1">Taggal Barang Masuk  </label> 
                                             <input type="date" class="form-control"  name="tgl_masuk"  required>
                                        </div> 

                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1">Nama Barang </label> 
                                            <select  class="form-control" name="kd_brg" id="kd_brg">  
                                                     <?php
                                                       while ($barang_tampil=mysqli_fetch_assoc($barang_query)){
                                                       echo "<option value='".$barang_tampil['kd_brg']."'>".$barang_tampil['nm_brg']."</option>";
                                                        }
                                                    ?>
                                                    </select> 
                                        </div> 

                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1">Jumlah Barang Masuk  </label> 
                                             <input type="number" class="form-control"  name="jml_brg" placeholder="Qty" min="1" required>
                                        </div> 
                                         
                                        
                                        
                                        <button type="submit" name="tambahdata" value="Tambah Data" class="btn btn-default w3ls-button">Submit</button> 
                                    </form>  
                                        
                                </div>
                            </div>
                        </div>
                    </div>      


                    





                                    
                <!-- //input-forms -->
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
