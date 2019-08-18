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

$id_kirim = $_GET['id_kirim']; 

 $sql="select MAX(kd_retur) from retur";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "RT".sprintf("%03s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string

?>
<?php
        $kirim=("SELECT id_kirim from kirimselesai");
        $kirim_query = mysqli_query($koneksidb,$kirim);
?>
<?php
        $barang=("
SELECT r.kd_brg, p.nm_brg FROM kirimdetail r join barang p  join kirimselesai k
                    on (p.kd_brg=r.kd_brg) AND (r.kd_det_kirim=k.kd_det_kirim) where r.kd_det_kirim='$kd_det_kirim'  ;");
        $barang_query = mysqli_query($koneksidb,$barang);
?>

<?php
        $sisa=("SELECT sisakirim from kirimdetail where kd_det_kirim='$kd_det_kirim'  ");
        $sisa_query = mysqli_query($koneksidb,$sisa);
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

<?php
        $tk=("SELECT r.id_kirim, p.id_toko, q.nm_toko FROM kirimdetail r join kirimselesai p join toko q 
                    on (p.id_kirim=r.id_kirim) AND (p.id_toko=q.id_toko) where r.kd_det_kirim='$kd_det_kirim'  ;
");
        $tk_query = mysqli_query($koneksidb,$tk);
?>
<script>
function hitung() {
        var qty=(document.getElementById("qty").value);
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
                <div class="grids">
                    <div class="progressbar-heading grids-heading">
                        <h2>Input Retur Barang</h2>
                    </div>
                    <div class="panel panel-widget forms-panel">
                        <div class="forms">
                            <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                                <div class="form-title">
                                    <h4>Barang yg tidak laku terjual:</h4>
                                </div>
                                <div class="form-body">
                                    <form action="retur_res.php" method="post"> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1">Kode Retur</label> 
                                            <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="kd_retur" readonly>
                                        </div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputFile">Detail Pengiriman</label> 
                                            <input type="text" class="form-control"  name="kd_det_kirim" id="kd_det_kirim"  readonly    <?php
                                                       while ($kode_tampil=mysqli_fetch_assoc($kode_query)){
                                                       echo "<option value='".$kode_tampil['kd_det_kirim']."'>"."</option>";
                                                        }
                                                    ?>   
                                        </div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1">Tgl Retur Pengiriman </label> 
                                             <input type="date" class="form-control" name="tgl_retur" id="tgl_retur"   required="" >
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
                                            <label for="exampleInputFile">Barang</label> 
                                               <input type="text" class="form-control" name="kd_brg" id="kd_brg" onChange="changeValue(this.value)"  readonly    <?php
                                                       while ($barang_tampil=mysqli_fetch_assoc($barang_query)){
                                                       echo "<option value='".$barang_tampil['kd_brg']."'>".$barang_tampil['nm_brg']."</option>";
                                                        }
                                                    ?>  

                                        </div>  
                                        <div class="form-group"> 
                                            <label for="exampleInputFile">Jumlah yang belum Terjual</label> 
                                                <input type="number" class="form-control"  name="qty1" id="qty1"  readonly  <?php
                                                       while ($sisa_tampil=mysqli_fetch_assoc($sisa_query)){
                                                       echo "<option value='".$sisa_tampil['sisakirim']."'>"."</option>";
                                                        }
                                                    ?>  
                                        </div>
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1">Jumlah Retur </label> 
                                             <input type="text" class="form-control"  name="qty"  id= "qty" onkeyup="hitung()" placeholder="Jumlah barang yg dikembalikan" required>
                                        </div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputFile">Harga Penjualan</label> 
                                                <input type="number" class="form-control"  name="hrg_jual_brg" id="hrg_jual_brg"  readonly    <?php
                                                       while ($harga_tampil=mysqli_fetch_assoc($harga_query)){
                                                       echo "<option value='".$harga_tampil['hrg_jual_brg']."'>"."</option>";
                                                        }
                                                    ?>  
                                        </div>
                                        <div class="form-group"> 
                                            <label for="exampleInputFile">Harga Pokok Barang</label> 
                                                <input type="number" class="form-control"  name="hrg_pokok_brg" id="hrg_pokok_brg"  readonly  onkeyup="hitung()"   <?php
                                                       while ($hargap_tampil=mysqli_fetch_assoc($hargap_query)){
                                                       echo "<option value='".$hargap_tampil['hrg_pokok_brg']."'>"."</option>";
                                                        }
                                                    ?>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1">Total</label> 
                                             <input type="number" class="form-control"  name="total" id="total"
                                             placeholder="Jumlah barang yg dikembalikan" readonly="readonly">
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
    <script type="text/javascript">   
                          <?php   
                          echo $a;   
                          echo $b; 
                           ?>  
                          function changeValue(kd_brg){  
                            document.getElementById('hrg_pokok_brg').value = hrg_pokok_brg[kd_brg].hrg_pokok_brg;  
                            document.getElementById('hrg_jual_brg').value = hrg_jual_brg[kd_brg].hrg_jual_brg;
                              
                          };  
                          </script>  
      
</body>
</html>
