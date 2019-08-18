
<?php
error_reporting(0);
session_start();
if (isset($_SESSION['jabatan']))
{
 
   if ($_SESSION['jabatan'] == "direktur")
   {
     include_once 'kirim.php'; 
     include_once 'penjualan_i.php'; 
   }
     exit;
          } else {

 
}