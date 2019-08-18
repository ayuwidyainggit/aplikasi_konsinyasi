<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<?php
session_start();
include_once "session.php";



include "menu.php";
include "koneksi.php";

$id_kirim = $_GET['id_kirim']; 

    $sql="select MAX(id_kirim) from kirimselesai";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "KR".sprintf("%03s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string



?>

<?php
 $sql2="select MAX(no_ju) from jurnalumum";
 $hasil2 = $koneksidb->query($sql2);
 $data2 = $hasil2->fetch_array();

 $MaxID2 = $data2[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

 $no_urut2 = (int) substr($MaxID2,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                     //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                     //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
 $no_urut2++;               //lalu variabel no_urut ditambah 1

 $new_ID2 = "JU".sprintf("%03s","$no_urut2");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                       //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                       //%s merupakan format pemanggilan variabel yang bernilai string
?>
<?php
        $toko=("SELECT id_toko, nm_toko from toko");
        $toko_query = mysqli_query($koneksidb,$toko);
?>


<?php
   $sql1="select MAX(id_det_jual) from detailjual";
    $hasil1 = $koneksidb->query($sql1);
    $data1 = $hasil1->fetch_array();
    $MaxID1 = $data1[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID
    $no_urut1 = (int) substr($MaxID1,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut1++;               //lalu variabel no_urut ditambah 1
    $new_ID1 = "DJ".sprintf("%03s","$no_urut1");  

?>
<?php
        $kirim=("SELECT id_kirim from kirimselesai");
        $kirim_query = mysqli_query($koneksidb,$kirim);
?>
<?php
        $barang=("
SELECT r.kd_brg, p.nm_brg FROM kirimdetail r join barang p  
                    on (p.kd_brg=r.kd_brg) where r.kd_det_kirim='$kd_det_kirim'  ;");
        $barang_query = mysqli_query($koneksidb,$barang);
?>

<?php
        $sisa=("SELECT sisakirim from kirimdetail where kd_det_kirim='$kd_det_kirim'  ");
        $sisa_query = mysqli_query($koneksidb,$sisa);
?>

<?php
        $tk=("SELECT p.id_toko, q.nm_toko FROM  kirimselesai p join toko q 
                    on  (p.id_toko=q.id_toko) where p.id_kirim='$id_kirim'  ;
");
        $tk_query = mysqli_query($koneksidb,$tk);
?>



<?php
        $komisi=("SELECT r.id_kirim, p.id_toko, q.nm_toko, q.komisi FROM kirimdetail r join kirimselesai p join toko q 
                    on (p.id_kirim=r.id_kirim) AND (p.id_toko=q.id_toko) where p.id_kirim='$id_kirim' ");
        $komisi_query = mysqli_query($koneksidb,$komisi);
?>

<?php
        $harga=("SELECT hrg_jual_brg from kirimdetail where kd_det_kirim='$kd_det_kirim'");
        $harga_query = mysqli_query($koneksidb,$harga);
?>
<?php
        $hargap=("SELECT hrg_pokok_brg from kirimdetail where kd_det_kirim='$kd_det_kirim'");
        $hargap_query = mysqli_query($koneksidb,$hargap);
?>

<?php
        $kirim=("SELECT jml_kirm from kirimdetail where kd_det_kirim='$kd_det_kirim'");
        $kirim_query = mysqli_query($koneksidb,$kirim);
?>

<?php
        $kode=("SELECT kd_det_kirim from kirimdetail where kd_det_kirim='$kd_det_kirim'");
        $kode_query = mysqli_query($koneksidb,$kode);
?>




<script>
function hitung() {
        var qty=(document.getElementById("jml_kirim").value);
        var harga=parseInt(document.getElementById("hrg_pokok_brg").value); 
        var total = qty * harga;        
        document.getElementById('total').value = total;
 if (isNaN(qty)){ 
        document.getElementById('total').value = harga;                                 
 }
 if (isNaN(harga)){ 
        document.getElementById('total').value = qty;                                 
 }
 if ((isNaN(qty))&&(isNaN(harga))){ 
        document.getElementById('total').value = 0;                                 
 }

   }    
</script>



<head>

        <!-- input-forms -->
        



          <div class="progressbar-heading grids-heading">
            <h2>Transaksi Pengiriman</h2>
          </div>
          <!-- form -->
    
    <div class="panel-body">
                 <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
                  Tambah
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Barang Konsinyasi</h4>
                            </div>
                            <div class="modal-body">
                              
                              <form action="pengiriman_sementara.php" method="POST">

                               
                                <div class="form-group">
                                    <label>Id Pengiriman</label>
                                     <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_kirim" readonly>
                                </div>


                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <?php   
                          $con = mysqli_connect("localhost","root","","kons");  
                      ?> 
                            <select name="kd_brg" id="kd_brg" class="form-control" onchange='changeValue(this.value)' required >  
                              <option>pilih</option>
                          <?php   
                          $query = mysqli_query($con, "select * from barang where jml_brg >= 1 order by kd_brg
                           esc");  
                          $result = mysqli_query($con, "select * from barang where jml_brg >= 1");  
                          $a          = "var hrg_pokok_brg = new Array();\n;";  
                          $b          = "var hrg_jual_brg = new Array();\n;";
                          $b          = "var jml_brg = new Array();\n;";  
                           
                          while ($row = mysqli_fetch_array($result)) {  
                               echo '<option name="nm_brg" value="'.$row['kd_brg'] . '">' . $row['nm_brg'] . '</option>';   
                          $a .= "hrg_pokok_brg['" . $row['kd_brg'] . "'] = {hrg_pokok_brg:'" . addslashes($row['hrg_pokok_brg'])."'};\n";  
                          $b .= "hrg_jual_brg['" . $row['kd_brg'] . "'] = {hrg_jual_brg:'" . addslashes($row['hrg_jual_brg'])."'};\n";  
                          $c .= "jml_brg['" . $row['kd_brg'] . "'] = {jml_brg:'" . addslashes($row['jml_brg'])."'};\n"; 
                          }  

                          ?>  
                     </select>
                                </div>

                                <div class="form-group">
                                    <label>Stok Barang</label>
                                  <input type="number" class="form-control" name="jml_brg" id="jml_brg" readonly=""  > 
                                </div>
                                 <div class="form-group">
                                    <label>Jumlah Kirim</label>
                                  <input type="number" min="1" class="form-control" name="jml_kirim" id="jml_kirim"  placeholder="Masukkan jumlah pengiriman " required onkeyup="hitung()"> 
                                </div>
                                <div class="form-group">
                                    <label>Biaya Kirim</label>
                                   <input type="text" min="1" class="uang"  id="biaya_kirim1"  name="biaya_kirim1"  placeholder="Biaya yang berhubungan dengan pengiriman"/>
                                </div>
        <script src="jquery.min.js"></script>
        <script src="jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});

            })
        </script>
                                <div class="form-group">
                                    <label>Harga Pokok</label>
                                   <input type="text" class="form-control" name="hrg_pokok_brg" id="hrg_pokok_brg" readonly="readonly" onkeyup="hitung()">
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                <input type="text" class="form-control" name="hrg_jual_brg" id="hrg_jual_brg" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Total</label>
                                   <input type="text" class="form-control" name="total" id="total" readonly="readonly">
                                </div>





                             
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <input type="submit" name="tambahdata" value="Tambah Data"class="btn btn-primary">
                            </div>
                           </form>


                            </div>

                    </div>
                </div>
            </div>
            <!-- /form -->

            <div class="forms">
              <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                <!-- <div class="form-title">
                  <h4></h4>
                </div> -->
                <div class="form-body">
                  <form action="pengiriman_res.php" method="post"> 
                  <div class="form-group">
                                    <!-- <label>Kode Jurnal</label> -->
                                     <input type="hidden" class="form-control" value ="<?php echo $new_ID2?>" name="no_ju" readonly>
                                </div>
                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Kode Pengiriman</label> 
                      <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_kirim" readonly>
                    </div> 
                    <div class="form-group"> 
                      <label for="exampleInputPassword1">Toko</label> 
                      <select  class="form-control" name="id_toko" id="id_toko">  
                                                     <?php
                                                       while ($toko_tampil=mysqli_fetch_assoc($toko_query)){
                                                       echo "<option value='".$toko_tampil['id_toko']."'>".$toko_tampil['nm_toko']."</option>";
                                                        }
                                                    ?>
                                                    </select> 
                    </div> 

                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Tgl </label> 
                       <input type="date" max="YY-MM-DD" class="form-control" name="tgl_kirim" id="tgl_kirim" required >
                    </div> 
                    <!-- <a href="batal.php" >Reset</a> -->
                        
                        <div class="table-responsive bs-example widget-shadow">
                   <table class="table table-bordered">
                            <tr class="success" style="text-align: center;">
                              <th>Id Kirim</th>
                              <th>Nama Barang</th>
                              <th>qty</th>
                              <th>Harga Pokok</th>
                              <th>Harga Jual</th>
                               <th>Biaya</th>
                              <th>Total</th>
                             
                              
                               <button type="submit" name="tambahdata1" value="Tambah Data1" class="btn btn-default w3ls-button">Kirim</button> 
                            
                            </tr>

                              <?php foreach ($_SESSION["cart"] as $key => $value){?>
                              <tr>
                                <td><?=$value['id_kirim']?></td>
                                <td><?=$value['nm_brg']?></td>
                                <td><?=$value['jml_kirim']?></td>
                                <td><?=number_format($value['hrg_pokok_brg'])?></td>
                                <td><?=number_format($value['hrg_jual_brg'])?></td>
                                <td><?=number_format($value['biaya_kirim'])?></td>
                                <td><?=number_format($value['total'])?></td>
                               

                              
                                
                              </tr>
                              <?php }?>                           
                          

                            <?php
                        $sum =0;
                        if(isset($_SESSION["cart"]))
                        {
                          foreach ($_SESSION["cart"] as $key => $value){
                            $sum += $value['total'];
                          }
                        }
                        ?>
                        
                       

                        <?php
                        $sum1 =0;
                        if(isset($_SESSION["cart"]))
                        {
                          foreach ($_SESSION["cart"] as $key => $value){
                            $sum1 += $value['biaya_kirim'];
                          }
                        }
                        ?>
                         
                         <?php
                        $sum3 =0;
                        if(isset($_SESSION["cart"]))
                        {
                          foreach ($_SESSION["cart"] as $key => $value){
                            $sum3 += $value['hrg_pokok_brg'];
                          }
                        }
                        ?>

                         <?php
                        $sum4 =0;
                        if(isset($_SESSION["cart"]))
                        {
                          foreach ($_SESSION["cart"] as $key => $value){
                            $sum4 += $value['hrg_jual_brg'];
                          }
                        }
                        ?>
                        <?php
                        $sum5 =0;
                        if(isset($_SESSION["cart"]))
                        {
                          foreach ($_SESSION["cart"] as $key => $value){
                            $sum5 += $value['biaya_kirim'];
                          }
                        }
                        ?>


                         <tr>
                              <td>Total :</td>
                              <td></td>
                              <td></td>
                              <td><?=number_format($sum3)?></td>
                              <td><?=number_format($sum4)?></td>
                              <td><?=number_format($sum5)?></td>
                              <td><?=number_format($sum)?></td>
                            </tr>
                            </table>
                          </div>

                      
                         

<input type="hidden" name="total" value="<?=$sum?>">
<input type="hidden" name="totalbiaya" value="<?=$sum1?>">


                       

                    


                  
                  </div>
                </form>
                    
                </div>
              </div>
            </div>
          </div>  


                 
                          
                              
                        
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
     <script type="text/javascript">   
                          <?php   
                          echo $a;   
                          echo $b; 
                          echo $c; ?>  
                          function changeValue(kd_brg){  
                            document.getElementById('hrg_pokok_brg').value = hrg_pokok_brg[kd_brg].hrg_pokok_brg;  
                            document.getElementById('hrg_jual_brg').value = hrg_jual_brg[kd_brg].hrg_jual_brg;
                            document.getElementById('jml_brg').value = jml_brg[kd_brg].jml_brg;  
                          };  
                          </script>  
</body>
</html>
