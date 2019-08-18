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
include "menu.php";
include "koneksi.php";

    $sql="select MAX(id_terima) from terimapenjualan";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "KM".sprintf("%06s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
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
$hrg=mysqli_query($koneksidb, "select * from penjualan");
$jsArray = "var piutang = new Array();\n";
?>



<head>

				<!-- input-forms -->
				<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class=" form-grids form-grids-right">
								<div class="widget-shadow " data-example-id="basic-forms"> 
									<div class="form-title">
										<h4>Input Data Penerimaan Penjualan :</h4>
									</div>

									<div class="form-body">
										<form class="form-horizontal" action="terima_i_res.php" method="post">
										<div class="form-group">
                                    <!-- <label>Kode Jurnal</label> -->
                                     <input type="hidden" class="form-control" value ="<?php echo $new_ID2?>" name="no_ju" readonly>
                                </div> 
											<div class="form-group"> 
												<label for="inputEmail3" class="col-sm-2 control-label">Id Penerimaan </label> 
												<div class="col-sm-9"> 
													  <input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_terima" readonly>
												</div> 
											</div>

											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Tanggal Terima</label>
												<div class="col-sm-9"> 
													<input type="date" class="form-control"  name="tgl_terima" required>
												</div> 
											</div> 

											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Id Penjualan</label> 
												<div class="col-sm-9"> 
													 <?php   
                          $con = mysqli_connect("localhost","root","","kons");  
                      ?> 
                            <select name="id_jual" id="id_jual" class="form-control" onchange='changeValue(this.value)' required >  
                              <option>pilih</option>
                          <?php   
                          $query = mysqli_query($con, "select * from penjualan j join toko k on(k.id_toko=j.id_toko) where piutang > 0 ");  
                          $result = mysqli_query($con, "select * from penjualan j join toko k on(k.id_toko=j.id_toko) where piutang > 0");  
                          $a          = "var piutang = new Array();\n;";  
						  $b          = "var hpp_total = new Array();\n;";
						  $c          = "var nm_toko = new Array();\n;";
                        
                           
                          while ($row = mysqli_fetch_array($result)) {  
                               echo '<option name="id_jual" value="'.$row['id_jual'] . '">' . $row['id_jual'] . '</option>';   
                          $a .= "piutang['" . $row['id_jual'] . "'] = {piutang:'" . addslashes($row['piutang'])."'};\n";  
						  $b .= "hpp_total['" . $row['id_jual'] . "'] = {hpp_total:'" . addslashes($row['hpp_total'])."'};\n"; 
						  $c .= "nm_toko['" . $row['id_jual'] . "'] = {nm_toko:'" . addslashes($row['nm_toko'])."'};\n";  
                         
                          }  

                          ?>  
                               </select>
												</div> 
											</div> 

											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Kas Diterima</label>
												<div class="col-sm-9"> 
													 <input type="number" class="form-control" name="piutang" id="piutang" readonly="" >
												</div> 
											</div> 

											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Hpp</label>
												<div class="col-sm-9"> 
													 <input type="number" class="form-control" name="hpp_total" id="hpp_total" readonly="" >
												</div>
												 
											</div> 
											<div class="form-group"> 
												<label for="inputPassword3" class="col-sm-2 control-label">Toko</label>
												<div class="col-sm-9"> 
													 <input type="text" class="form-control" name="nm_toko" id="nm_toko" readonly="" >
												</div>
												 
											</div> 
											<div class="col-sm-offset-0"> 
												<button type="submit"  name="tambahdata" value="Tambah Data" class="btn btn-default w3ls-button">Simpan</button> 
											</div> 
											
											
												</form> 
												
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
						  echo $c; 
                          ?>  
                          function changeValue(id_jual){  
                            document.getElementById('piutang').value = piutang[id_jual].piutang;  
                            document.getElementById('hpp_total').value = hpp_total[id_jual].hpp_total;
							document.getElementById('nm_toko').value = nm_toko[id_jual].nm_toko;
                             
                          };  
                          </script>  
</body>
</html>
