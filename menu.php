
<?php
error_reporting(0);
session_start();
if (isset($_SESSION['jabatan']))
{
 
   if ($_SESSION['jabatan'] == "admin")
   {
     include 'menuadmin.php'; 
   }
   else if ($_SESSION['jabatan'] == "manager")
   {
     include 'menudirektur.php';
   }

}
?>