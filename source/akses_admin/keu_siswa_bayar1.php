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
$tapelkod = cegah($_POST['tapelkod']);
$katkod = cegah($_POST['katkod']);
$kategori = cegah($_POST['kategori']);
$studikod = cegah($_POST['studikod']);
$kelkod = cegah($_POST['kelkod']);
$rukod = cegah($_POST['rukod']);
$kd_siswa = cegah($_POST['kd_siswa']);


/////////////////////////////////// jika uang gedung /////////////////////////////////////////////
if ($katkod == "4c75242f81285d49b3f18a7a4d210a8f")
	{

$tanggal1 == cegah($_POST['tanggal1']);
$bulan1 == cegah($_POST['bulan1']);
$tahun1 == cegah($_POST['tahun1']);
$tgl1 = ("$tahun1:$bulan1:$tanggal1");

//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM siswa_uang_gedung WHERE kd_siswa = '$kd_siswa'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	//update
	}

else
	{

//data baru
$SQL2 = sprintf("INSERT INTO siswa_uang_gedung(kd, kd_uang_gedung, kd_siswa, tgl_bayar) ".
					"VALUES ('$x', '$katkod', '$kd_siswa', '$tgl1')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

//auto-kembali
$returner = "keu_siswa.php?tapelkod=$tapelkod&katkod=$katkod&kategori=$kategori&studikod=$studikod&kelkod=$kelkod&rukod=$rukod";
header("location:$returner");
}
}


/////////////////////////////////// jika uang lain /////////////////////////////////////////////
if ($katkod == "31c2d890125b4103b7844e813f52cf1a")
	{

$tanggal1 == cegah($_POST['tanggal1']);
$bulan1 == cegah($_POST['bulan1']);
$tahun1 == cegah($_POST['tahun1']);
$tgl1 = ("$tahun1:$bulan1:$tanggal1");

//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM siswa_uang_lain ".
					"WHERE kd_tapel = '$tapelkod' ".
					"AND kd_siswa = '$kd_siswa'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	//update
	}

else
	{

//data baru
$SQL2 = sprintf("INSERT INTO siswa_uang_lain(kd, kd_tapel, kd_uang_lain, kd_siswa, tgl_bayar) ".
					"VALUES ('$x', '$tapelkod', '$katkod', '$kd_siswa', '$tgl1')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

//auto-kembali
$returner = "keu_siswa.php?tapelkod=$tapelkod&katkod=$katkod&kategori=$kategori&studikod=$studikod&kelkod=$kelkod&rukod=$rukod";
header("location:$returner");
}
}


/////////////////////////////////// jika uang tes /////////////////////////////////////////////
if ($katkod == "7a6df9d882fb55dbe4bc9725e64aab57")
	{

$tanggal1 == cegah($_POST['tanggal1']);
$bulan1 == cegah($_POST['bulan1']);
$tahun1 == cegah($_POST['tahun1']);
$tgl1 = ("$tahun1:$bulan1:$tanggal1");

//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM siswa_uang_test ".
					"WHERE kd_tapel = '$kd_tapel' ".
					"AND kd_siswa = '$kd_siswa'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	//update
	}

else
	{

//data baru
$SQL2 = sprintf("INSERT INTO siswa_uang_test(kd, kd_tapel, kd_uang_tes, kd_siswa, tgl_bayar) ".
					"VALUES ('$x', '$tapelkod', '$katkod', '$kd_siswa', '$tgl1')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

//auto-kembali
$returner = "keu_siswa.php?tapelkod=$tapelkod&katkod=$katkod&kategori=$kategori&studikod=$studikod&kelkod=$kelkod&rukod=$rukod";
header("location:$returner");
}
}


/////////////////////////////////// jika uang spp /////////////////////////////////////////////
if ($katkod == "bad81d085df6c259223d9153cd2fd99b")
	{

//ambil nilai
$kd_bulan = cegah($_POST['kd_bulan']);
$tanggal1 == cegah($_POST['tanggal1']);
$bulan1 == cegah($_POST['bulan1']);
$tahun1 == cegah($_POST['tahun1']);
$tgl1 = ("$tahun1:$bulan1:$tanggal1");

//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM siswa_uang_spp ".
					"WHERE kd_tapel = '$tapelkod' ".
					"AND kd_bulan = '$kd_bulan' ".
					"AND kd_siswa = '$kd_siswa'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	//update
	}

else
	{

//data baru
$SQL2 = sprintf("INSERT INTO siswa_uang_spp(kd, kd_tapel, kd_uang_spp, kd_siswa, kd_bulan, tgl_bayar) ".
					"VALUES ('$x', '$tapelkod', '$katkod', '$kd_siswa', '$kd_bulan', '$tgl1')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

//auto-kembali
$returner = "keu_siswa.php?tapelkod=$tapelkod&katkod=$katkod&kategori=$kategori&studikod=$studikod&kelkod=$kelkod&rukod=$rukod";
header("location:$returner");
}
}
?>