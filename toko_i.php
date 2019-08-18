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

    $sql="select MAX(id_toko) from toko";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "T".sprintf("%06s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string
?>


<head>
  	
				<!-- input-forms -->
				<div class="grids">
					<div class="progressbar-heading grids-heading">
						<h2>Input Data Toko</h2>
					</div>
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Data Toko:</h4>
								</div>
								<div class="form-body">
									<form action="toko_i_res.php" method="post"> 
										<div class="form-group"> 
											<label for="exampleInputEmail1">Id Toko</label> 
											<input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_toko" readonly>
										</div> 
										

										<div class="form-group"> 
											<label for="exampleInputEmail1">Nama Toko </label> 
											 <input type="text" class="form-control"  name="nm_toko" required>
										</div> 

										<div class="form-group"> 
											<label for="exampleInputEmail1">Alamat </label> 
											 <input type="text" class="form-control"  name="alamat" required>
										</div> 

										<div class="form-group"> 
											<label for="exampleInputEmail1">No Telp </label> 
											<input type="text" class="form-control"  name="no_telp" required>
										</div> 
										
										<div class="form-group"> 
											<label for="exampleInputEmail1">Komisi </label> 
											<input type="number" class="form-control"  name="komisi" required>
										</div> 
										
										<button type="submit" name="tambahdata" value="Tambah Data" class="btn btn-default w3ls-button">Simpan</button> 
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
	  
</body>
</html>
