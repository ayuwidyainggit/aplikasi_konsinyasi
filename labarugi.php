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
                    <h2> LAPORAN LABA RUGI </h2>
    </div>
    <div class="panel panel-widget forms-panel">
                        <div class="forms">
                            <div class="form-two widget-shadow">
                                <div class="form-title">
                                    <h4> Masukkan Tanggal Periode</h4>
                                </div>
                                <div class="form-body" data-example-id="simple-form-inline">
                                    <form class="form-inline" action="labarugiperiode.php" method="post"> 
                                        <div class="form-group"> 
                                            <label for="exampleInputName2">Tanggal Awal</label> 
                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" placeholder="Tanggal Awal"> 
                                        </div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail2">Tanggal Akhir</label> 
                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" placeholder="Tanggal Akhir
                                            "> 
                                        </div> 
                                        <button type="submit" class="btn btn-default w3ls-button">Lihat laporan</button> 
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>  

                 


                                
  <?php                                          
                                        $sql_cek=("SELECT sum(kas) as piutang1 from terimapenjualan ");
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                        
                                         }

                                         else{
                                            ?> 
                                              <?php                                          
                                        $sql_cek1=("SELECT sum(hpp_total) as saldo1 from terimapenjualan ");
                                        $query_cek1 = $koneksidb->query($sql_cek1);
                                        $result_cek1 = $query_cek1->num_rows;
                                        if($result_cek1=='0'){
                                        
                                         }

                                         else{
                                            ?> 
                                               <?php                                          
                                        $sql_cek2=("SELECT sum(biaya_kirim) as biaya1 from kirimdetail ");
                                        $query_cek2 = $koneksidb->query($sql_cek2);
                                        $result_cek2 = $query_cek2->num_rows;
                                        if($result_cek2=='0'){
                                        
                                         }

                                         else{
                                            ?> 
                <div class="agile-tables">
                    <div class="w3l-table-info">
                    
                       <div class="table-responsive bs-example widget-shadow">
      <table class="table table-bordered">
                        <thead>
                        

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
                                                <td>Hasil Penjualan</td>
                                                 <td>Rp <?php echo number_format($data['piutang1'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                             
                                            </tr>
                                            <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data1 = $query_cek1->fetch_array()) {
                                            $no ++;
                                    ?>
                                             <tr>
                                                <td>Harga Pokok Penjualan</td>
                                                <td>Rp <?php echo number_format($data1['saldo1'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                               
                                            </tr>
                                             <tr>
                                                <td>Laba Kotor Penjualan</td>
                                                <td>Rp <?php echo number_format($data['piutang1']-$data1['saldo1'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                            </tr>
                                              <?php 
                                        $no=0;
                                        $jumlah_desimal = "0";
                                        $pemisah_desimal = ",";
                                        $pemisah_ribuan = ".";
                                         while ($data2 = $query_cek2->fetch_array()) {
                                            $no ++;
                                    ?>
                                             <tr>
                                                <td>Biaya</td>
                                                 <td></td>

                                            </tr>
                                            <tr>
                                                <td>BiayaPengiriman</td>
                                                <td>Rp <?php echo number_format($data2['biaya1'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                           
                                            </tr>

                                            <tr>
                                                <td>Laba Bersih Usaha</td>
                                               <td>Rp <?php echo number_format((($data['piutang1']-$data1['saldo1'])-$data2['biaya1']), $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                            
                                            </t r>   
                                    <?php
}
}

?>
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
