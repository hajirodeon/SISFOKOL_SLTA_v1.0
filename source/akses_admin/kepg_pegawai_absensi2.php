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

//konek
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 

//ambil nilai
$kd == cegah($_POST['kd']);
$ket == cegah($_POST['ket']);

$tgl == cegah($_POST['tgl']);
$bulan == cegah($_POST['bulan']);
$tahun == cegah($_POST['tahun']);
$tglx = ("$tahun:$bulan:$tgl");


$SQL = sprintf("INSERT INTO pegawai_absensi(kd, kd_pegawai, kd_ket, tgl_absensi) ".
				"VALUES ('$x', '$kd', '$ket', '$tglx')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

//auto-kembali
$returner = "kepg_pegawai_absensi.php?bulan=$bulan&tahun=$tahun";
header("location:$returner");
?>