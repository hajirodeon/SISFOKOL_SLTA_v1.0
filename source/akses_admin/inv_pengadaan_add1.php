<?php
//Sistem Informasi ini berbasis OPEN SOURCE dengan lisensi GNU/GPL. 
//
//OPEN SOURCE HAJIROBE dengan segala hormat tidak bertanggung jawab dan tidak memiliki pertanggungjawaban
//kepada apapun atau siapa pun akibat terjadinya kehilangan atau kerusakan yang mungkin muncul yang berasal
//dari buah karya ini.
//
//Sistem Informasi ini akan selalu dikembangkan dan jika ditemukan kesalahan logika ataupun kesalahan program,
//hal ini bukanlah disengaja. Melainkan hal tersebut adalah salah satu dari tahapan pengembangan lebih lanjut. 

//Sistem Informasi Sekolah (SISFOKOL) untuk SLTA v1.0, dikembangkan oleh OPEN SOURCE HAJIROBE (Agus Muhajir).
//Dan didistribusikan oleh BIASAWAE PRODUCTION (http://www.biasawae.com)
//
//Bila Anda mempunyai pertanyaan, komentar, saran maupun kritik layangkan saja ke hajirodeon@yahoo.com .
//Semoga program ini berguna bagi Anda.
//
//Ikutilah perkembangan terbaru Sistem Informasi ini di BIASAWAE PRODUCTION.

session_start();

///cek session
require("include/cek.php"); 

//ambil nilai konfigurasi tertentu
include("../include/config.php"); 

//koneksi
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 

//ambil nilai
$dari = cegah($_POST['dari']);
$nm_brg = cegah($_POST['nm_brg']);
$jumlah = cegah($_POST['jumlah']);
$harga = cegah($_POST['harga']);
$untuk = cegah($_POST['untuk']);
$ket = cegah($_POST['ket']);

$tanggal1 == cegah($_POST['tanggal1']);
$bulan1 == cegah($_POST['bulan1']);
$tahun1 == cegah($_POST['tahun1']);
$tgl1 = ("$tahun1:$bulan1:$tanggal1");

$tanggal2 == cegah($_POST['tanggal2']);
$bulan2 == cegah($_POST['bulan2']);
$tahun2 == cegah($_POST['tahun2']);
$tgl2 = ("$tahun2:$bulan2:$tanggal2");

$tanggal3 == cegah($_POST['tanggal3']);
$bulan3 == cegah($_POST['bulan3']);
$tahun3 == cegah($_POST['tahun3']);
$tgl3 = ("$tahun3:$bulan3:$tanggal3");

//perintah SQL : masukkan data pengadaan
$SQL2 = sprintf("INSERT INTO inv_pengadaan(kd, tgl_terima, tgl_beli, dari, nm_barang, jumlah, harga, ".
					"tgl_pakai, untuk, ket) VALUES ('$x', '$tgl1', '$tgl2', '$dari', '$nm_brg', ".
					"'$jumlah', '$harga', '$tgl3', '$untuk', '$ket')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

//auto-kembali
header("location:inv_pengadaan.php");
?>