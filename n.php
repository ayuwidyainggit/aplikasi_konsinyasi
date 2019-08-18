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
$kd_det_kirim = $_GET['kd_det_kirim']; 
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
        $tk=("SELECT r.id_kirim, p.id_toko, q.nm_toko FROM kirimdetail r join kirimselesai p join toko q 
                    on (p.id_kirim=r.id_kirim) AND (p.id_toko=q.id_toko) where r.kd_det_kirim='$kd_det_kirim'  ;
");
        $tk_query = mysqli_query($koneksidb,$tk);
?>


<?php
        $komisi=("SELECT r.id_kirim, p.id_toko, q.nm_toko, q.komisi FROM kirimdetail r join kirimselesai p join toko q 
                    on (p.id_kirim=r.id_kirim) AND (p.id_toko=q.id_toko) where r.kd_det_kirim='$kd_det_kirim' ");
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

				<!-- input-forms -->
				<div class="grids">
					<div class="progressbar-heading grids-heading">
						<h2>Input Data Penerimaan Perhitungan Penjualan Konsinyasi</h2>
					</div>
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Perhitungan Penjualan Konsinyasi</h4>
								</div>
								<div class="form-body">
									<form action="penjualan_i_res.php" method="post"> 
										<div class="form-group"> 
											<label for="exampleInputFile">Id Penjualan</label> 
											 <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_jual" readonly>      
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
											<label for="exampleInputFile">Tanggal Penerimaan Perhitungan</label> 
											<input type="date" class="form-control"  name="tgl_jual" required>
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
											<label for="exampleInputFile">Qty</label> 
											    <input type="number" class="form-control" min="1" name="qty" id="qty"  required onkeyup="hitung() , hpp()"   placeholder="Masukkan jumlah penerimaan perhitungan">
                        				</div>
                        				<div class="form-group"> 
											<label for="exampleInputFile">Harga Penjualan</label> 
											    <input type="number" class="form-control"  name="hrg_jual_brg" id="hrg_jual_brg"  readonly  onkeyup="hitung()"  <?php
                                                       while ($harga_tampil=mysqli_fetch_assoc($harga_query)){
                                                       echo "<option value='".$harga_tampil['hrg_jual_brg']."'>"."</option>";
                                                        }
                                                    ?>  
                        				</div>
                        				<div class="form-group"> 
											<label for="exampleInputFile">Harga Pokok Barang</label> 
											    <input type="number" class="form-control"  name="hrg_pokok_brg" id="hrg_pokok_brg"  readonly  onkeyup="hpp()"   <?php
                                                       while ($hargap_tampil=mysqli_fetch_assoc($hargap_query)){
                                                       echo "<option value='".$hargap_tampil['hrg_pokok_brg']."'>"."</option>";
                                                        }
                                                    ?>
                        				</div>
                        				<div class="form-group"> 
											<label for="exampleInputFile">Total HPP</label> 
											    <input type="number" class="form-control" name="total_hpp"  id="total_hpp" readonly="readonly"  placeholder="Harga pokok barang x qty" >
                        				</div>
                        				<div class="form-group"> 
											<label for="exampleInputFile">Hasil Penjualan</label> 
											    <input type="number" class="form-control" name="hasiljual"  id="hasiljual" readonly="readonly"  placeholder="Harga penjualan x qty"onkeyup="hitung()"  >
                        				</div>
                        				<div class="form-group"> 
											<label for="exampleInputFile">Komisi Penjualan</label> 
											   <input type="text" class="form-control"  name="komisi" id="komisi"  readonly   onkeyup="hitung()" <?php
                                                       while ($komisi_tampil=mysqli_fetch_assoc($komisi_query)){
                                                       echo "<option value='".$komisi_tampil['komisi']."'>"."</option>";
                                                        }
                                                    ?> 
                        				</div>
                        				<div class="form-group"> 
											<label for="exampleInputFile">Hasil Komisi Penjualan</label> 
											   <input type="number" class="form-control" name="hasil_komisi"  id="hasil_komisi" placeholder="Hasil Penjualan x komisi" readonly="readonly" onblur="kas()" >
                        				</div>
                        				<div class="form-group"> 
											<label for="exampleInputFile">Kas yang seharusnya diterima</label> 
											    <input type="number" class="form-control" name="kas_diterima"  id="kas_diterima"  placeholder="Hasil Penjualan x Hasil Komisi Penjualan" readonly="readonly"  >
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
                           ?>  
                          function changeValue(id_toko){  
                            document.getElementById('komisi').value = komisi[id_toko].komisi;  
                             
                          };  
                          </script> 
</body>
</html>
