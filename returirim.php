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

    $sql="select MAX(kd_retur) from retur";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "R".sprintf("%03s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
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
        $toko=("SELECT k.id_toko, c.nm_toko from kirimselesai k join toko c on (c.id_toko=k.id_toko) where id_kirim = '$id_kirim'");
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
        var qty=(document.getElementById("qty").value);
        var harga=parseInt(document.getElementById("hrg_pokok_brg").value); 
        var jmlretur = qty * harga;        
        document.getElementById('jmlretur').value = jmlretur;
 if (isNaN(qty)){ 
        document.getElementById('jmlretur').value = harga;                                 
 }
 if (isNaN(harga)){ 
        document.getElementById('jmlretur').value = qty;                                 
 }
 if ((isNaN(qty))&&(isNaN(harga))){ 
        document.getElementById('jmlretur').value = 0;                                 
 }

   }    
</script>



<head>

        <!-- input-forms -->
        <div class="panel panel-widget forms-panel">
         
         
 



                      <div class="grids">
          <div class="progressbar-heading grids-heading">
            <h2>Retur</h2>
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
                              
                              <form action="retur_sementara.php" method="POST">

                                <div class="form-group">
                                    <label>Id Pengiriman</label>
                                      <input type="text" class="form-control" value ="<?php echo $id_kirim?>" name="id_kirim" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Barang</label>
                                    <?php   
                          $con = mysqli_connect("localhost","root","","kons"); 
                          $id_kirim = $_GET['id_kirim'];  
                      ?> 
                            <select name="kd_brg" id="kd_brg" class="form-control" onchange='changeValue(this.value)' required >  
                              <option>pilih</option>
                          <?php   

                         

                          $query = mysqli_query($con, "select * from kirimdetail  x join  barang b  on (b.kd_brg= x.kd_brg) where id_kirim='$id_kirim' and sisakirim >= 1 ");  
                          $result = mysqli_query($con, "select * from kirimdetail  x join  barang b  on (b.kd_brg= x.kd_brg) where id_kirim='$id_kirim' and sisakirim >= 1");  
                          $a          = "var hrg_pokok_brg = new Array();\n;";  
                          // $b          = "var hrg_jual_brg = new Array();\n;";
                           $c          = "var sisakirim = new Array();\n;";  
                           
                          while ($row = mysqli_fetch_array($result)) {  
                               echo '<option name="nm_brg" value="'.$row['kd_brg'] . '">' . $row['nm_brg'] . '</option>';   
                          $a .= "hrg_pokok_brg['" . $row['kd_brg'] . "'] = {hrg_pokok_brg:'" . addslashes($row['hrg_pokok_brg'])."'};\n";  
                          // $b .= "hrg_jual_brg['" . $row['kd_brg'] . "'] = {hrg_jual_brg:'" . addslashes($row['hrg_jual_brg'])."'};\n";  
                           $c .= "sisakirim['" . $row['kd_brg'] . "'] = {sisakirim:'" . addslashes($row['sisakirim'])."'};\n"; 
                          }  

                          ?>  
                     </select>
                                </div>

                                <div class="form-group">
                                    <label>Stok Barang</label>
                                  <input type="number" class="form-control" name="sisakirim" id="sisakirim" readonly=""  > 
                                </div>
                                 <div class="form-group">
                                    <label>Jumlah Retur</label>
                                 <input type="number" min="1" class="form-control" name="qty" id="qty"  placeholder="Masukkan jumlah retur  " required onkeyup="hitung()"> 
                                </div>
                                <div class="form-group">
                                    <label>Harga Pokok Barang</label>
                                 <input type="text" class="form-control" name="hrg_pokok_brg" id="hrg_pokok_brg" readonly="readonly" onkeyup="hitung()">
                                </div>
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" class="form-control" name="jmlretur" id="jmlretur" readonly="readonly">
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
                
                <div class="form-body">
                  <form action="retur_res.php" method="post"> 
                  <div class="form-group">
                                    <!-- <label>Kode Jurnal</label> -->
                                     <input type="text" class="form-control" value ="<?php echo $new_ID2?>" name="no_ju" id="no_ju" readonly>
                                </div>
                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Kode Retur</label> 
                      <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="kd_retur" readonly>
                    </div> 
                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Kode Kirim</label> 
                      <input type="text" class="form-control" value ="<?php echo $id_kirim?>" name="id_kirim" readonly>
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
                       <input type="date" max="YY-MM-DD" class="form-control" name="tgl_retur" id="tgl_kirim" required >
                    </div> 
                    
                        
                        
                   <table class="table table-bordered">
                            <tr class="success" style="text-align: center;">
                              <th>Id Kirim</th>
                              <th>Nama Barang</th>
                              <th>qty</th>
                              <th>Harga Pokok</th>
                              <th>Jumlah Retur</th>
                       
                             
                              
                               <button type="submit" name="tambahdata1" value="tambahdata1" class="btn btn-default w3ls-button">Kirim</button> 
                            
                            </tr>
                              <?php foreach ($_SESSION["cart2"] as $key => $value){?>
                              <tr>
                                <td><?=$value['id_kirim']?></td>
                                <td><?=$value['nm_brg']?></td>
                                <td><?=$value['qty']?></td>
                                <td><?=number_format($value['hrg_pokok_brg'])?></td>
                                <td><?=number_format($value['jmlretur'])?></td>
                               

                              
                                
                              </tr>
                              <?php }?>                           
                         

                            <?php
                        $sum =0;
                        if(isset($_SESSION["cart2"]))
                        {
                          foreach ($_SESSION["cart2"] as $key => $value){
                            $sum += $value['jmlretur'];
                          }
                        }
                        ?>
                        <?php
                        $sum1 =0;
                        if(isset($_SESSION["cart2"]))
                        {
                          foreach ($_SESSION["cart2"] as $key => $value){
                            $sum1 += $value['hrg_pokok_brg'];
                          }
                        }
                        ?>
                        
                       


                          <tr>
                         <td>Total</td>
                         <td></td>
                         <td></td>
                         <td><?=number_format($sum1)?></td>
                         <td><?=number_format($sum)?></td>
                         
                       </tr>
                     </table>
                       </table>
                         

<input type="hidden" name="jmlretur" value="<?=$sum?>">



                       

                    


                  
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
                          // echo $b; 
                          echo $c; ?>  
                          function changeValue(kd_brg){  
                            document.getElementById('hrg_pokok_brg').value = hrg_pokok_brg[kd_brg].hrg_pokok_brg;  
                            // document.getElementById('hrg_jual_brg').value = hrg_jual_brg[kd_brg].hrg_jual_brg;
                            document.getElementById('sisakirim').value = sisakirim[kd_brg].sisakirim;  
                          };  
                          </script>  
</body>
</html>
