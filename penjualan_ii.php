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

    $sql="select MAX(id_jual) from Penjualan";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();
    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID
    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1
    $new_ID = "PJ".sprintf("%04s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
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
        var harga=parseInt(document.getElementById("hrg_jual_brg").value); 
        var hasiljual = qty * harga;        
        document.getElementById('hasiljual').value = hasiljual;
 if (isNaN(qty)){ 
        document.getElementById('hasiljual').value = harga;                                 
 }
 if (isNaN(harga)){ 
        document.getElementById('hasiljual').value = qty;                                 
 }
 if ((isNaN(qty))&&(isNaN(harga))){ 
        document.getElementById('hasiljual').value = 0;                                 
 }

        var komisi=parseInt(document.getElementById("komisi").value); 
        var hasiljual=parseInt(document.getElementById("hasiljual").value); 
        var hasil_komisi = komisi * hasiljual / 100;        
        document.getElementById('hasil_komisi').value = hasil_komisi;
 if (isNaN(komisi)){ 
        document.getElementById('hasil_komisi').value = hasiljual;                                 
 }
 if (isNaN(hasiljual)){ 
        document.getElementById('hasil_komisi').value = komisi;                                 
 }
 if ((isNaN(komisi))&&(isNaN(hasiljual))){ 
        document.getElementById('hasil_komisi').value = 0;                                 
 }
      var hasiljual=parseInt(document.getElementById("hasiljual").value); 
        var hasil_komisi=parseInt(document.getElementById("hasil_komisi").value); 
        var kas_diterima = hasiljual - hasil_komisi;        
        document.getElementById('kas_diterima').value = kas_diterima;
 if (isNaN(hasiljual)){ 
        document.getElementById('kas_diterima').value = hasil_komisi;                                 
 }
 if (isNaN(hasil_komisi)){ 
        document.getElementById('kas_diterima').value = hasiljual;                                 
 }
 if ((isNaN(hasil_komisi))&&(isNaN(hasiljual))){ 
        document.getElementById('kas_diterima').value = 0;                                 
 }
}
</script>

<script>
function hpp() {
        var qty=(document.getElementById("qty").value);
        var harga1=parseInt(document.getElementById("hrg_pokok_brg").value); 
        var hasiljual1 = qty * harga1;        
        document.getElementById('total_hpp').value = hasiljual1;
 if (isNaN(qty)){ 
        document.getElementById('total_hpp').value = harga1;                                 
 }
 if (isNaN(harga1)){ 
        document.getElementById('total_hpp').value = qty;                                 
 }
 if ((isNaN(qty))&&(isNaN(harga1))){ 
        document.getElementById('total_hpp').value = 0;                                 
 }
}
</script>

<script>
function kas() {
        var hasiljual=parseInt(document.getElementById("hasiljual").value); 
        var hasil_komisi=parseInt(document.getElementById("hasil_komisi").value); 
        var kas_diterima = hasiljual - hasil_komisi;        
        document.getElementById('kas_diterima').value = kas_diterima;
 if (isNaN(hasiljual)){ 
        document.getElementById('kas_diterima').value = hasil_komisi;                                 
 }
 if (isNaN(hasil_komisi)){ 
        document.getElementById('kas_diterima').value = hasiljual;                                 
 }
 if ((isNaN(hasil_komisi))&&(isNaN(hasiljual))){ 
        document.getElementById('kas_diterima').value = 0;                                 
 }
}
</script>



<head>

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
                                <h4 class="modal-title" id="myModalLabel">Barang yang berhasil terjual :</h4>
                            </div>
                            <div class="modal-body">
                              
                              <form action="penjualan_sementara.php" method="POST">

                                <div class="form-group">
                                    <label>Id Pengiriman</label>
                                     <input type="text" class="form-control"  value ="<?php echo $id_kirim?>" name="id_kirim"  name="id_kirim" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Id Penjualan</label>
                                     <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_jual" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nama Barang</label>
                                   <?php   
                          $con = mysqli_connect("localhost","root","","kons");  
                      ?> 
                            <select name="kd_brg" id="kd_brg" class="form-control" onchange='changeValue(this.value)' required >  
                              <option>pilih</option>
                          <?php   
                          $id_kirim = $_GET['id_kirim']; 

                          $query = mysqli_query($con, "select * from kirimdetail r join barang b on (b.kd_brg=r.kd_brg) where id_kirim='$id_kirim'  and sisakirim >= 1 ");  
                          $result = mysqli_query($con, "select * from kirimdetail r join barang b on (b.kd_brg=r.kd_brg) where id_kirim='$id_kirim'  and sisakirim >= 1 ");  
                          $a          = "var hrg_pokok_brg = new Array();\n;";  
                          $b          = "var hrg_jual_brg = new Array();\n;";
                          $c          = "var sisakirim = new Array();\n;";  
                           
                          while ($row = mysqli_fetch_array($result)) {  
                               echo '<option name="nm_brg" value="'.$row['kd_brg'] . '">' . $row['nm_brg'] . '</option>';   
                          $a .= "hrg_pokok_brg['" . $row['kd_brg'] . "'] = {hrg_pokok_brg:'" . addslashes($row['hrg_pokok_brg'])."'};\n";  
                          $b .= "hrg_jual_brg['" . $row['kd_brg'] . "'] = {hrg_jual_brg:'" . addslashes($row['hrg_jual_brg'])."'};\n";  
                          $c .= "sisakirim['" . $row['kd_brg'] . "'] = {sisakirim:'" . addslashes($row['sisakirim'])."'};\n"; 
                          }  

                          ?>  
                     </select>
                                </div>

                                <div class="form-group">
                                    <label>Sisa Kirim</label>
                                 <input type="text" class="form-control" name="sisakirim" id="sisakirim" readonly="readonly">
                                </div>
                                 
                                <div class="form-group">
                                    <label>Harga Pokok</label>
                                    <input type="text" class="form-control" name="hrg_pokok_brg" id="hrg_pokok_brg" readonly="readonly" onkeyup="hpp()">
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                <input type="text" class="form-control" name="hrg_jual_brg" id="hrg_jual_brg" readonly="readonly" onkeyup="hitung()">
                                </div>
                                <div class="form-group">
                                    <label>Qty</label>
                                  <input type="number" class="form-control"  name="qty" id="qty"  required onkeyup="hitung() , hpp()"   placeholder="Masukkan jumlah penerimaan perhitungan">
                                </div>
                                <div class="form-group">
                                    <label>Total Hpp</label>
                                   <input type="number" class="form-control" name="total_hpp"  id="total_hpp" readonly="readonly"  placeholder="Harga pokok barang x qty" >
                                </div>
                                <div class="form-group">
                                    <label>Hasil Penjualan</label>
                                  <input type="number" class="form-control" name="hasiljual"  id="hasiljual" readonly="readonly"  placeholder="Harga penjualan x qty"onkeyup="hitung()"  >
                                </div>
                                <div class="form-group">
                                    <label>Komisi Penjualan</label>
                                    <input type="text" class="form-control"  name="komisi" id="komisi"  readonly   onkeyup="hitung()" <?php
                                                       while ($komisi_tampil=mysqli_fetch_assoc($komisi_query)){
                                                       echo "<option value='".$komisi_tampil['komisi']."'>"."</option>";
                                                        }
                                                    ?> 
                                </div>
                                <div class="form-group">
                                    <label>Hasil Komisi</label>
                                  <input type="number" class="form-control" name="hasil_komisi"  id="hasil_komisi" placeholder="Hasil Penjualan x komisi" readonly="readonly" onblur="kas()" >
                                </div>
                                <div class="form-group">
                                    <label>Kas yang harus diterima</label>
                                 <input type="number" class="form-control" name="kas_diterima"  id="kas_diterima"  placeholder="Hasil Penjualan x Hasil Komisi Penjualan" readonly="readonly"  >
                                </div>
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









                      <div class="grids">
          <div class="progressbar-heading grids-heading">
            <h2>Penerimaan Perhitungan Penjualan</h2>
          </div>
          

            <div class="forms">
              <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                <div class="form-title">
                  <h4></h4>
                </div>
                <div class="form-body">
                  <form action="detail_jual_res.php" method="post"> 
                  <div class="form-group">
                                    <!-- <label>Kode Jurnal</label> -->
                                     <input type="hidden" class="form-control" value ="<?php echo $new_ID2?>" name="no_ju" readonly>
                                </div>
                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Kode Pengiriman</label> 
                      <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_jual" readonly>
                    </div> 
                    <div class="form-group"> 
                      <label for="exampleInputFile">Id Kirim</label> 
                       <input type="text" class="form-control" value ="<?php echo $id_kirim?>" name="id_kirim" readonly>      
                    </div>
                    <div class="form-group"> 
                      <label for="exampleInputFile">Toko</label> 
                        <input type="text" class="form-control"  name="id_toko" id="id_toko"  readonly 
                                       <?php
                                                       while ($tk_tampil=mysqli_fetch_assoc($tk_query)){
                                                       echo "<option value='".$tk_tampil['id_toko']."'>".$tk_tampil['nm_toko']."</option>";
                                                        }
                                                    ?>  
                                                  
                    </div>  
                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Tgl </label> 
                       <input type="date" max="Y-m-d" class="form-control" name="tgl_jual" id="tgl_jual" required >
                    </div> 
                     
                        
                        
                   <table class="table table-bordered">
                            <tr class="success" style="text-align: center;">
                          
                              <th>Id Jual </th>
                              <th>Nama Barang</th>
                              <th>qty</th>
                              <th>Harga Jual</th>
                              <th>Harga Pokok</th>
                              <th>Komisi</th>
                              <th>Hasil Jual</th>
                              <th>Kas Diterima</th>
                              <th>Total Hpp</th>
                               <button type="submit" name="tambahdata1" value="Tambah Data1" class="btn btn-default w3ls-button">Kirim</button> 
                            
                            </tr>
                              <?php foreach ($_SESSION["cart1"] as $key => $value){?>
                              <tr>
                                
                                <td><?=$value['id_jual']?></td>
                                <td><?=$value['nm_brg']?></td>
                                <td><?=$value['qty']?></td>
                                <td><?=number_format($value['hrg_jual_brg'])?></td>
                                <td><?=number_format($value['hrg_pokok_brg'])?></td>
                                <td><?=number_format($value['hasil_komisi'])?></td>
                                <td><?=number_format($value['hasiljual'])?></td>
                                <td><?=number_format($value['kas_diterima'])?></td>
                                <td><?=number_format($value['total_hpp'])?></td>

                              
                                
                              </tr>
                              <?php }?>                           
                         

                           <?php
                        $sum9 =0;
                        if(isset($_SESSION["cart1"]))
                        {
                          foreach ($_SESSION["cart1"] as $key => $value){
                            $sum9 += $value['hrg_jual_brg'];
                          }
                        }
                        ?>          
                         <?php
                        $sum8 =0;
                        if(isset($_SESSION["cart1"]))
                        {
                          foreach ($_SESSION["cart1"] as $key => $value){
                            $sum8 += $value['hrg_pokok_brg'];
                          }
                        }
                        ?>     
                         <?php
                        $sum7 =0;
                        if(isset($_SESSION["cart1"]))
                        {
                          foreach ($_SESSION["cart1"] as $key => $value){
                            $sum7 += $value['hasil_komisi'];
                          }
                        }
                        ?>         
                         <?php
                        $sum6 =0;
                        if(isset($_SESSION["cart1"]))
                        {
                          foreach ($_SESSION["cart1"] as $key => $value){
                            $sum6 += $value['hasiljual'];
                          }
                        }
                        ?>                
                         <?php
                        $sum5 =0;
                        if(isset($_SESSION["cart1"]))
                        {
                          foreach ($_SESSION["cart1"] as $key => $value){
                            $sum5 += $value['kas_diterima'];
                          }
                        }
                        ?>          

                                         

                        <?php
                        $sum1 =0;
                        if(isset($_SESSION["cart1"]))
                        {
                          foreach ($_SESSION["cart1"] as $key => $value){
                            $sum1 += $value['total_hpp'];
                          }
                        }
                        ?>
                        
                       <tr>
                         <td>Total</td>
                         <td></td>
                         <td></td>
                         <td><?=number_format($sum9)?></td>
                         <td><?=number_format($sum8)?></td>
                         <td><?=number_format($sum7)?></td>
                         <td><?=number_format($sum6)?></td>
                         <td><?=number_format($sum5)?></td>
                         <td><?=number_format($sum1)?></td>
                       </tr>
                     </table>
                         

<input type="hidden" name="kas" value="<?=$sum5?>">
<input type="hidden" name="total" value="<?=$sum6?>">
<input type="hidden" name="tot_komisi" value="<?=$sum7?>">
<input type="hidden" name="hpptotal" value="<?=$sum1?>">

                       

                    


                  
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
                            document.getElementById('sisakirim').value = sisakirim[kd_brg].sisakirim;  
                          };  
                          </script>  
</body>
</html>
