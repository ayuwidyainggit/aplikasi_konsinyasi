<?php

require "koneksi.php";


$sql1 = "INSERT INTO akun (kd_akun, kd_rekening, nm_akun, debet, kredit, keterangan) VALUES
('10000001', 100, 'Kas', 0, 0, 'default account'),
('10000002', 900, 'Barang-barang Konsinyasi', 0, 0, 'default account'),
('10000003', 100, 'Persediaan Produk Jadi', 0, 0, 'default account'),
('10000004', 500, 'Penjualan Konsinyasi', 0, 0, 'default account'),
('10000010', 700, 'Komisi Penjualan', 0, 0, 'default account'),
('10000005', 300, 'Piutang Dagang', 0, 0, 'default account'),
('10000006', 700, 'Barang-barang Konsinyasi-Ongki', 0, 0, 'default account'),
('10000007', 700, 'Barang-barang Konsinyasi-penge', 0, 0, 'default account'),
('10000008', 800, 'Harga Pokok Penjualan', 0, 0, 'default account'),
('10000009', 600, 'Penjualan', 0, 0, 'default account')";			   
$hasil1 = $koneksidb->query($sql1);
if (!$hasil1) {
    echo " silakan diulangi! <br /> ".mysqli_error($koneksidb);
    echo "<input type='button' value='Kembali'
    onClick='self.history.back()'>";
    exit;
} else {


    header("location:neracasaldo.php");
} 

?>