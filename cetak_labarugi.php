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

?>
<script>
    $(function () {
        $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

        if (!screenfull.enabled) {
            return false;
        }

        $('#toggle').click(function () {
            screenfull.toggle($('#container')[0]);
        }); 
    });
</script>
<!-- tables -->
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<head>
   
                <!-- tables -->
                
                <div class="table-heading">
                <center><h2>PT ABC</h2></center>
                <center>    <h2> LAPORAN LABA RUGI </h2> </center>

    </div>
     <center><h3>Periode :  <?php echo $_POST['tgl_awal']; ?> s/ d <?php echo $_POST['tgl_akhir']; ?></h3></center><br>


                                
  <?php                                  


                            include "koneksi.php";
                            $tgl_awal            = $_POST['tgl_awal'];
                            $tgl_akhir            = $_POST['tgl_akhir'];

                                        $sql_cek=("SELECT sum(kas) as piutang1 from terimapenjualan Where (tgl_terima BETWEEN '$tgl_awal' AND '$tgl_akhir')");
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                        
                                         }

                                         else{
                                            ?> 
                                              <?php                                          
                                        $sql_cek1=("SELECT sum(hpp_total) as saldo1 from terimapenjualan Where (tgl_terima BETWEEN '$tgl_awal' AND '$tgl_akhir')");
                                        $query_cek1 = $koneksidb->query($sql_cek1);
                                        $result_cek1 = $query_cek1->num_rows;
                                        if($result_cek1=='0'){
                                        
                                         }

                                         else{
                                            ?> 
                                               <?php                                          
                                        $sql_cek2=("SELECT  sum(biaya_kirim) as biaya1 from kirimdetail r join kirimselesai p  on (p.id_kirim=r.id_kirim) Where (p.tgl_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir')");
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
                      
 <script>
    window.print();
  </script>
                    </div>
                  
            </div>
        </div>
        
                <!-- //tables -->
            </div>
        </div>
        <!-- footer -->
        
        <!-- //footer -->
    </section>
    <script src="js/bootstrap.js"></script>
    <script src="js/proton.js"></script>
</body>
</html>
