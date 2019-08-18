create table rekening(
kd_rekening int(11) default null,
nm_rekening char(30) default null,
keterangan char(30) default null,
primary key (kd_rekening))
Engine = innoDB default charset= utf8;

INSERT INTO `rekening` (`kd_rekening`, `nm_rekening`,`keterangan`) VALUES
(100, 'AKTIVA LANCAR','default'),
(200, 'AKTIVA TETAP','default'),
(300, 'PIUTANG DAGANG','default'),
(400, 'HUTANG DAGANG','default'),
(500, 'PENDAPATAN KONSINYASI','default'),
(600, 'PENDAPATAN USAHA','default'),
(700, 'BEBAN USAHA','default'),
(800, 'HPP','default');

create table akun(
kd_akun char(11) default null,
kd_rekening int(11) default null,
nm_akun char(30) default null,
debet int (11) default null,
kredit int (11) default null,
keterangan char(30) default null,
primary key (kd_akun),
foreign key (kd_rekening) references rekening (kd_rekening))
Engine = innoDB default charset= utf8;

INSERT INTO `akun` (`kd_akun`, `kd_rekening`, `nm_akun`, `debet`, `kredit`, `keterangan`) VALUES
('10000001', 100, 'Kas', 0, 0,'default account'),
('10000002', 100, 'Barang-barang Konsinyasi', 0, 0,'default account'),
('10000003', 100, 'Persediaan Produk Jadi', 0, 0,'default account'),
('10000004', 500, 'Penjualan Konsinyasi', 0, 0,'default account'),
('10000005', 300, 'Piutang Dagang', 0, 0,'default account'),
('10000006', 700, 'Barang-barang Konsinyasi-Ongki', 0, 0,'default account'),
('10000007', 700, 'Barang-barang Konsinyasi-penge', 0, 0,'default account'),
('10000008', 800, 'Harga Pokok Penjualan', 0, 0,'default account'),
('10000009', 600, 'Penjualan', 0, 0,'default account'),
('10000010', 700, 'Komisi Penjualan', 0, 0,'default account');



create table barang(
kd_brg char(11) default null,
nm_brg char(30) default null,
jml_brg int (11) default null,
hrg_pokok_brg int (11) default null,
hrg_jual_brg int (11) default null,
primary key (kd_brg))
Engine = innoDB default charset= utf8;


create table toko(
id_toko char(11) default null,
nm_toko char(30) default null,
alamat char (20) default null,
no_telp int (11) default null,
komisi int (11) default null,
primary key (id_toko))
Engine = innoDB default charset= utf8;


create table kirimselesai(
id_kirim char(11) default null ,
id_toko char(11) default null,
tgl_kirim date default null,
totalkirim int(11) default null,
biayakirim int(11) default null,
primary key (id_kirim))
Engine = innoDB default charset= utf8;


create table kirimdetail(
kd_det_kirim int(11) auto_increment default null ,
id_kirim char(11) default null ,
kd_brg char(11) default null,
jml_kirim int (11) default null,
biaya_kirim int (11) default null,
total int (11) default null,
sisakirim  int (11) default null,
penerimaan  int (11) default null,
primary key (kd_det_kirim))
Engine = innoDB default charset= utf8;

create table penjualan(
id_jual char(9) default null, 
tgl_jual date default null,
id_kirim char(11) default null ,
id_toko char(11) default null,
total int(11) default null,
tot_komisi int (11) default null,
kas int(11) default null,
hpp_total int(11) default null,
piutang int(11) default null,
primary key(id_jual),
foreign key (id_kirim) references kirimselesai (id_kirim),
foreign key (id_toko) references toko (id_toko))
Engine=innoDB default charset=utf8;


create table detailjual(
id_det_jual int(9) default null auto_increment, 
id_jual char(9) default null, 
kd_brg char(11) default null,
qty char(11) default null,
hasil_komisi int (11) default null,
total_hpp int(11) default null,
kas_diterima int(11) default null,
hasiljual int(11) default null,
primary key(id_det_jual),
foreign key (kd_brg) references barang (kd_brg))
Engine=innoDB default charset=utf8;


create table terimapenjualan(
id_terima char(8) default null, 
tgl_terima date default null,
id_jual char(8) default null, 
kas int(11) default null,
hpp_total int(11) default null,
primary key(id_terima),
foreign key (id_jual) references penjualan (id_jual))
Engine=innoDB default charset=utf8;


create table retur(
kd_retur char(9) default null,
id_kirim char(11) default null , 
tgl_retur date default null,
id_toko char(11) default null,
totalretur int(11) default null,
primary key(kd_retur),
foreign key (id_kirim) references kirimselesai (id_kirim),
foreign key (id_toko) references toko (id_toko))
Engine=innoDB default charset=utf8;


create table detailretur(
id_det_retur int(11) default null auto_increment, 
kd_retur char(8) default null, 
kd_brg char(8) default null,
qty int(11) default null,
jmlretur int (11) default null,
primary key(id_det_retur),
foreign key (kd_brg) references barang (kd_brg),
foreign key (kd_retur) references retur (kd_retur))
Engine=innoDB default charset=utf8;


create table jurnalumum(
no_ju char(8) not null ,
bukti char(8) default null,
tgl_jurnal date default null,
keterangan text default null,
primary key(no_ju))
Engine = innoDB default charset= utf8;

create table detail_jurnal(
no_det_ju int(11) not null auto_increment,
no_ju char(8)  not null ,
kd_akun char(11) default null,
total_debet int (11) default null,
total_kredit int (11) default null,
primary key(no_det_ju),
foreign key (kd_akun) references akun (kd_akun),
foreign key (no_ju) references jurnalumum (no_ju))
Engine = innoDB default charset= utf8;
