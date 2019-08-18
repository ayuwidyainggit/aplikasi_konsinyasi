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


$barang=("SELECT kd_brg, nm_brg from barang");
$barang_query = mysqli_query($koneksidb,$barang);

?>

<?php

    $sql1="select MAX(kd_det_kirim) from kirimdetail";
    $hasil1 = $koneksidb->query($sql1);
    $data1 = $hasil1->fetch_array();

    $MaxID1 = $data1[0];  //data kode perusahaan terakhir disimpan di variabel baru $MaxID

    $no_urut1 = (int) substr($MaxID1,2,6);  //Memisahkan karakter dengan angka menggunakan fungsi substr
                        //string di $MaxID akan dipisahkan menjadi"PM" dan "000001"
                        //angka 0 pertama dimulai dari index ke-2 dengan panjang 6(sampaiangka 1).000001  dimasukkan ke variabel $no_urut
    $no_urut1++;               //lalu variabel no_urut ditambah 1

    $new_ID1 = "DK".sprintf("%03s","$no_urut1");  //angka yang telah ditambah dengan dengan 1 kemudian  digabung kembali dengan "PM"
                          //sprintf digunakan untuk memanggil variabel dalam format yang sudah ditentukan
                          //%s merupakan format pemanggilan variabel yang bernilai string


?>


<?php
        $toko=("SELECT id_toko, nm_toko from toko");
        $toko_query = mysqli_query($koneksidb,$toko);
?>



<?php
$total=("SELECT sum(total) as totalkirim from kirimsementara");
$total_query = mysqli_query($koneksidb,$total); 
?>
<?php
$totalb=("SELECT sum(biaya_kirim) as totalbiaya from kirimsementara");
$totalb_query = mysqli_query($koneksidb,$totalb); 
?>


<head>

				<!-- input-forms -->
				<div class="grids">
					<div class="progressbar-heading grids-heading">
						<h2>Input Data Pengiriman</h2>
					</div>
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Step 1. Pengiriman barang konsinyasi :</h4>
								</div>
								<div class="form-body">
									<form action="trans_i_res.php" method="post"> 
										<div class="form-group"> 
											<label for="exampleInputEmail1">Kode Pengiriman</label> 
											<input type="text" class="form-control" value ="<?php echo $new_ID?>" name="id_kirim" readonly>
										</div> 
										<div class="form-group"> 
											<label for="exampleInputPassword1">Barang</label> 
											<?php   
                          $con = mysqli_connect("localhost","root","","k");  
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
											<label for="exampleInputEmail1">Stok </label> 
											<input type="number" class="form-control" name="jml_brg" id="jml_brg" readonly=""  > 
										</div> 
										<div class="form-group"> 
											<label for="exampleInputEmail1">Jumlah Kirim </label> 
											 <input type="number" min="1" max.id="jml_brg" class="form-control" name="jml_kirim" id="jml_kirim"  placeholder="Masukkan jumlah pengiriman " required onblur="hitung()"> 
										</div> 
										
										<div class="form-group"> 
											<label for="exampleInputEmail1">Biaya Kirim </label> 
											<input type="number" class="form-control" name="biaya_kirim" id="biaya_kirim" required="">
										</div> 
										<div class="form-group"> 
											<label for="exampleInputEmail1">Harga Pokok Barang </label> 
											 <input type="text" class="form-control" name="hrg_pokok_brg" id="hrg_pokok_brg" readonly="readonly">
										</div> 

										<div class="form-group"> 
											<label for="exampleInputEmail1">Harga Jual Barang </label> 
											 <input type="text" class="form-control" name="hrg_jual_brg" id="hrg_jual_brg" readonly="readonly">
										</div> 
										
										<button type="submit" name="tambahdata" value="Tambah Data" class="btn btn-default w3ls-button">Submit</button> 
									</form>  
										
								</div>
							</div>
						</div>
					</div>		

					<div class="grids">
					<div class="progressbar-heading grids-heading">
						<h2>Proses Pengiriman</h2>
					</div>
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Step 2. Proses Pengiriman :</h4>
								</div>
								<div class="form-body">
									<form action="detail_kirim_res.php" method="post"> 
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
										<div class="form-group"> 
											<label for="exampleInputEmail1">Amount </label> 
											 <select  class="form-control" name="totalkirim" id="totalkirim">  
                                                     <?php
                                                       while ($total_tampil=mysqli_fetch_assoc($total_query)){
                                                       echo "<option value='".$total_tampil['totalkirim']."'>".$total_tampil['totalkirim']."</option>";
                                                        }
                                                    ?>
                                                    </select>  
										</div> 
										
										<div class="form-group"> 
											<label for="exampleInputEmail1">Total Biaya </label> 
											<select  class="form-control" name="totalbiaya" id="totalbiaya">  
                                                     <?php
                                                       while ($totalb_tampil=mysqli_fetch_assoc($totalb_query)){
                                                       echo "<option value='".$totalb_tampil['totalbiaya']."'>".$totalb_tampil['totalbiaya']."</option>";
                                                        }
                                                    ?>
                                                    </select> 
										</div> 
										
										<button type="submit" name="tambahdata" value="Tambah Data" class="btn btn-default w3ls-button">Submit</button> 
									</form>  
										
								</div>
							</div>
						</div>
					</div>	


                                <?php  

                                        $sql_cek=("SELECT * FROM kirimsementara r join barang p 
                    on (p.kd_brg=r.kd_brg) ");
                                        $query_cek = $koneksidb->query($sql_cek);
                                        $result_cek = $query_cek->num_rows;
                                        if($result_cek=='0'){
                                        
                                         }

                                         else{
                                         //   $sqltotal=("SELECT sum(total) as totalkirim from kirimsementara");
                                         //   $query= $koneksidb->query($sqltotal);
                                         //   $result= $query->num_rows;

                                ?>

				<div class="agile-tables">
					<div class="w3l-table-info">
					
					   <div class="table-responsive bs-example widget-shadow">
      <table class="table table-bordered">
						<thead>
						 <tr>
            <th data-breakpoints="xs">NO</th>
            <th>Kode Detail Pengiriman</th>
            <th>Barang</th>
            <th>Jumlah Kirim</th>
            <th>Harga Jual </th>
            <th>Total</th>
            <th>Biaya Pengiriman</th>
            <th>Action</th>
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
                                            <tbody>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data['kd_det_kirim']; ?></td>
                                                <td><?php echo $data['nm_brg']; ?></td>
                                                <td><?php echo $data['jml_kirim']; ?></td>
                                                <td><?php echo $data['hrg_pokok_brg']; ?></td>
                                                <td><?php echo $data['total']; ?></td>
                                                <td><?php echo $data['biaya_kirim']; ?></td>
                                                <td class="text-primary">
                                                     <a title="delete" href=delete_brg.php?kd_det_kirim=<?php echo $data['kd_det_kirim']; ?>>delete</a>
                                                </td>
                                            </tr>

     <?php 
                                         }
                                        }
                                    ?>







                                    
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
