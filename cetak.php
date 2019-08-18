<center><h2>PT ABC</h2></center>
<center><h2>JURNAL UMUM</h2></center>
    <center><h3>Periode :  <?php echo $_POST['tgl_awal']; ?> s/ d <?php echo $_POST['tgl_akhir']; ?></h3></center><br>

<?php
mysql_connect('localhost','root','');
mysql_select_db('kons');
  include "koneksi.php";

                            $tgl_awal            = $_POST['tgl_awal'];
                            $tgl_akhir            = $_POST['tgl_akhir'];

$sql = mysql_query("select *,concat('Rp ', format ((total_debet), 0)) as debet,
concat('Rp ', format ((total_kredit), 0)) as kredit,
 b.keterangan as k,(select count(no_ju) from detail_jurnal where no_ju=A.no_ju) as jumlah from detail_jurnal A join jurnalumum B 
join akun C
on(b.no_ju=a.no_ju) AND (c.kd_akun=A.kd_akun) Where (tgl_jurnal BETWEEN '$tgl_awal' AND '$tgl_akhir') order by A.no_ju");

 
$no = 1;
$jum = 1;
echo '<center>';
echo '<table cellpadding="7 " border="1" bordercolor="blue">';
echo '<tr>
    <th>No</th>
    <th>No Bukti</th>
    <th>Tgl_jurnal</th>
    <th>No Ju</th>
    <th>Akun</th>
    <th>Debet</th>
    <th>Kredit</th>
    </tr>';
while($row = mysql_fetch_array($sql)) {       
echo '<tr>';
if($jum <= 1) {
echo '<td align="center" rowspan="'.$row['jumlah'].'">'.$no.'</td>';
echo '<td rowspan="'.$row['jumlah'].'">'.$row['no_ju'].'</td>'; 

echo '<td rowspan="'.$row['jumlah'].'">'.$row['tgl_jurnal'].'</td>';

echo '<td rowspan="'.$row['jumlah'].'">'.$row['k'].'</td>';  
$jum = $row['jumlah'];       
$no++;                     
} else {
$jum = $jum - 1;
}
echo '<td>'.$row['nm_akun'].'</td>'; 
echo '<td>'.$row['total_debet'].'</td>';   
echo '<td>'.$row['total_kredit'].'</td>'; 
echo '</tr>';              
}
echo '</table>';
echo '</center>';


?>
 <script>
    window.print();
  </script>