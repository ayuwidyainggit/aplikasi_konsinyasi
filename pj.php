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
        $barang=("SELECT r.kd_brg, p.nm_brg FROM kirimdetail r join barang p  
                    on (p.kd_brg=r.kd_brg) where r.kd_det_kirim='$kd_det_kirim'  ;");
        $barang_query = mysqli_query($koneksidb,$barang);
?>
<?php
        $a=("SELECT * from kirimdetail where id_kirim='$id_kirim'  ;");
        $a_query = mysqli_query($koneksidb,$a);
?>

<?php
        $sisa=("SELECT sisakirim from kirimdetail where kd_det_kirim='$kd_det_kirim'  ");
        $sisa_query = mysqli_query($koneksidb,$sisa);
?>

<?php
        $tk=("SELECT r.id_kirim, p.id_toko, q.nm_toko FROM kirimdetail r join kirimselesai p join toko q 
                    on (p.id_kirim=r.id_kirim) AND (p.id_toko=q.id_toko) where r.id_kirim='$id_kirim'  ;
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
                      <label for="exampleInputFile">Id Kirim</label> 
                         <input type="text" class="form-control" name="id_kirim" id="id_kirim" onChange="changeValue(this.value)"  readonly    <?php
                                                       while ($a_tampil=mysqli_fetch_assoc($a_query)){
                                                       echo "<option value='".$a_tampil['id_kirim']."'>".$a_tampil['id_kirim']."</option>";
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
                      
                      
                    <button type="submit" name="tambahdata" value="Tambah Data" class="btn btn-default w3ls-button">Submit</button> 
                  </form> 
                </div>
              </div>
            </div>
          </div>
<head>
			<!-- tables -->
				
				<div class="table-heading">
					<h2>PERHITUNGAN PENJUALAN</h2>
				</div>

				<h5>Klik buat untuk melakukan pencatatan perhitungan penjualan !</h5>
				  <?php  

          $id_kirim = $_GET['id_kirim'];
          include "koneksi.php";

                                        $sql_cek=("SELECT * FROM kirimdetail r join  barang q 
                    on  (q.kd_brg=r.kd_brg) WHERE sisakirim >= 1  AND id_kirim='$id_kirim' order by id_kirim asc");
                                        
										$query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                      echo "<center>Barang sudah habis terjual </center>";
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
            <th>Kode Detail Kirim</th>
            <th>Id Kirim</th>
            <th>Barang</th>
            <th>Jml Kirim</th>
            <th>Perhitungan Penjualan</th>
           
            
                 
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
                                                <td><?php echo $data['kd_det_kirim']; ?></td>
                                                <td><?php echo $data['id_kirim']; ?></td>
                                                <td><?php echo $data['nm_brg']; ?></td>
                                                <td><?php echo $data['jml_kirim']; ?></td>
                                                <td>
                                                <ul class="bt-list">
                                              <li><a href=penjualan_ii.php?kd_det_kirim=<?php echo $data['kd_det_kirim']; ?> class="hvr-icon-forward col-2">Buat</a></li>
                                                </ul>
                                            </td>
												
                                            
                                                	
                                                
                                            </tr>
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
