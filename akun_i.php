<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<html lang="en">
<?php
session_start();
include_once "session.php";

include "koneksi.php";
include "menu.php";

    $sql="select MAX(kd_akun) from akun";
    $hasil = $koneksidb->query($sql);
    $data = $hasil->fetch_array();

    $MaxID = $data[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut = (int) substr($MaxID,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut++;               //lalu variabel no_urut ditambah 1

    $new_ID = "10".sprintf("%06s","$no_urut");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string
?>
<?php

 $rekening 			="SELECT nm_rekening, kd_rekening from rekening";
 $rekening_query	= mysqli_query($koneksidb,$rekening); 
 
?>


<head>
<div class="panel-body">
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
                +rekening
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Tambah Data Rekening</h4>
                            </div>
                            <div class="modal-body">
                              
                              <form action="rekening_res.php" method="POST">

                                <div class="form-group">
                                    <label>Kode Rekening</label>
                                     <input type="number" class="form-control" name="kd_rekening"  placeholder="Kode Rekening" required>
                                </div>

                                <div class="form-group">
                                    <label>Nama Rekening</label>
                                    <input type="text" class="form-control" id="nm_rekening" name="nm_rekening" placeholder="Nama Rekening" required>
                                </div>
                     

                             
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                <input type="submit" name="tambahdata" value="Tambah Data"class="btn btn-primary">
                            </div>
                           </form>


                            </div>

                    </div>
                </div>
            </div>
            <!-- /form -->
   
				<!-- input-forms -->
				<div class="grids">
					<div class="progressbar-heading grids-heading">
						<h2>Input Data Akun</h2>
					</div>
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Data akun :</h4>
								</div>
								<div class="form-body">
									<form action="akun_i_res.php" method="post"> 
										<div class="form-group"> 
											<label for="exampleInputEmail1">Kode Akun</label> 
											<input type="text" class="form-control" value ="<?php echo $new_ID?>" name="kd_akun" readonly>
										</div> 
										<div class="form-group"> 
											<label for="exampleInputPassword1">Kelompok Rekening</label> 
											 <select  class="form-control" name="kd_rekening" id="kd_rekening">  
                                                     <?php
                                                       while ($rekening_tampil=mysqli_fetch_assoc($rekening_query)){
                                                       echo "<option value='".$rekening_tampil['kd_rekening']."'>".$rekening_tampil['nm_rekening']."</option>";
                                                        }
                                                     ?>
                                                    </select> 
										</div> 

										<div class="form-group"> 
											<label for="exampleInputEmail1">Nama Akun </label> 
											<input type="text" class="form-control"  name="nm_akun" placeholder="Nama Akun" required>
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
	  
</body>
</html>
