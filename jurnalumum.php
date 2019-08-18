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
        $akun=("SELECT * from akun");
        $akun_query = mysqli_query($koneksidb,$akun);
?>









<head>

        <!-- input-forms -->
        



          <div class="progressbar-heading grids-heading">
            <h2>JURNAL UMUM</h2>
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
                                <h4 class="modal-title" id="myModalLabel">Jurnal Umum</h4>
                            </div>
                            <div class="modal-body">
                              
                              <form action="jurnal_sementara.php" method="POST">

                        

                                <div class="form-group">
                                    <label>Akun</label>
                                  <select  class="form-control" name="kd_akun" id="kd_akun">  
                                                     <?php
                                                       while ($akun_tampil=mysqli_fetch_assoc($akun_query)){
                                                       echo "<option value='".$akun_tampil['kd_akun']."'>".$akun_tampil['nm_akun']."</option>";
                                                        }
                                                    ?>
                                                    </select> 
                                </div>
                                 <div class="form-group">
                                    <label>Debet</label>
                                  <input type="number"  class="uang" name="debet" id="debet"  required=""> 
                                </div>
                                <div class="form-group">
                                    <label>Kredit</label>
                                  <input type="number" class="uang" name="kredit" id="kredit" required=""> 
                                </div>
                                
                                <script src="jquery.min.js"></script>
        <script src="jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});

            })
        </script>


                             
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

           

                             
                            

            <div class="forms">
              <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                <!-- <div class="form-title">
                  <h4></h4>
                </div> -->
                <div class="form-body">
                  <form action="jurnal_act.php" method="post"> 
                   <!-- <label>Kode Jurnal</label> -->
                   <input type="hidden" class="form-control" value ="<?php echo $new_ID2?>" name="no_ju" readonly>
                                </div>
                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Bukti Jurnal</label> 
                      <input type="text" class="form-control" id="bukti" name="bukti" required="">
                    </div> 
                   <div class="form-group"> 
                      <label for="exampleInputEmail1">Tanggal Jurnal</label> 
                      <input type="date" class="form-control" id="tgl_jurnal" name="tgl_jurnal" required="">
                    </div> 

                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Keterangan </label> 
                       <input type="text"  class="form-control" name="keterangan" id="keterangan" required >
                    </div> 
                    
                        
                        <div class="table-responsive bs-example widget-shadow">
                   <table class="table table-bordered">
                            <tr class="success" style="text-align: center;">
                              <th>Nama Akun</th>
                              <th>Debet</th>
                              <th>Kredit</th>
                              <th>Batal</th>
                               
                              
                               <button type="submit" name="tambahdata1" value="Tambah Data1" class="btn btn-default w3ls-button">Kirim</button> 
                            
                            </tr>

                              <?php foreach ($_SESSION["cart3"] as $key => $value){?>
                              <tr>
                             
                                <td><?=$value['nm_akun']?></td>
                                <td><?=number_format($value['total_debet'])?></td>
                                <td><?=number_format($value['total_kredit'])?></td>
                                <td><a href=jurnalhapus.php?kd_akun=<?php echo $value['kd_akun']; ?> class="btn btn-danger">X</a></td>
                               
                               


                              
                                
                              </tr>
                              <?php }?>                           
                          

                            <?php
                        $sum =0;
                        if(isset($_SESSION["cart3"]))
                        {
                          foreach ($_SESSION["cart3"] as $key => $value){
                            $sum += $value['total_debet'];
                          }
                        }
                        ?>
                        
                       

                        <?php
                        $sum1 =0;
                        if(isset($_SESSION["cart3"]))
                        {
                          foreach ($_SESSION["cart3"] as $key => $value){
                            $sum1 += $value['total_kredit'];
                          }
                        }
                        ?>
                         
                         <tr>
                              <td>Total :</td>
                              
                              <td><?=number_format($sum)?></td>
                              <td><?=number_format($sum1)?></td>
                              
                            </tr>
                            </table>
                          </div>

                      
                         

<input type="hidden" name="total_kredit1" value="<?=$sum1?>">
<input type="hidden" name="total_debet1" value="<?=$sum?>">


                       

                    


                  
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
