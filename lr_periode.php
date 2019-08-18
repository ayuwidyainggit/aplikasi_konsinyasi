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

$tgl_awal            = $_POST['tgl_awal'];
$tgl_akhir            = $_POST['tgl_akhir'];
if ($tgl_awal >  date($_POST['tgl_akhir'])){
    echo "<SCRIPT language=Javascript>
        alert('Maaf masukkan tanggal dengan benar!') 
        </script>
        <script>window.location='lr.php'</script>";

  exit;
        } else {

}
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
     include "koneksi.php";
     $tgl_awal            = $_POST['tgl_awal'];
     $tgl_akhir            = $_POST['tgl_akhir'];

                                        $sql_cek=("SELECT sum(total) as penjualan,  sum(tot_komisi) as komisi,
                                        sum(t.hpp_total) as hpp
                                        from terimapenjualan t join penjualan p on (p.id_jual=t.id_jual) Where (tgl_terima BETWEEN '$tgl_awal' AND '$tgl_akhir')");
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                        
                                         }

                                         else{
                                            ?> 
                                              
                                               <?php   
                                               include "koneksi.php";
                                               $tgl_awal            = $_POST['tgl_awal'];
                                               $tgl_akhir            = $_POST['tgl_akhir'];                                       
                                        $sql_cek2=("
                                        SELECT sum(biaya_kirim ) as biaya from kirimdetail k join kirimselesai a on (a.id_kirim=k.id_kirim) Where (a.tgl_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir') ");
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
                                                <td>Penjualan</td>
                                                 <td>Rp <?php echo number_format($data['penjualan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                             
                                            </tr>
                                            <tr>
                                                <td>Komisi Penjualan</td>
                                                 <td>Rp <?php echo number_format($data['komisi'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                             
                                            </tr>
                                            <tr>
                                                <td>Penjualan Bersih</td>
                                                 <td>Rp <?php echo number_format($data['penjualan']-$data['komisi'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                             
                                            </tr>
                                         
                                             <tr>
                                                <td>Harga Pokok Penjualan</td>
                                                <td>Rp <?php echo number_format($data['hpp'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                               
                                            </tr>
                                             <tr>
                                                <td>Laba Kotor Penjualan</td>
                                                <td>Rp <?php echo number_format(($data['penjualan']-$data['komisi'])-$data['hpp'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
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
                                                <td>Rp <?php echo number_format($data2['biaya'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                           
                                            </tr>

                                            <tr>
                                                <td>Laba Bersih Usaha</td>
                                               <td>Rp <?php echo number_format((($data['penjualan']-$data['komisi'])-$data['hpp'])-$data2['biaya'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                                            
                                            </t r>   
                                   
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
