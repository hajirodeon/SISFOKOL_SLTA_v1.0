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

//koneksi db
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 

//mengambil nilai
$kd = cegah($_REQUEST['kd']);

if (!ctype_alnum($kd))
	{
	$pesan = "ERROR";
	$kembali = "../logout.php";
	
	echo "<script>alert('$pesan');location.href='$kembali'</script>";
	}

else
	{

//menghapus folder foto
$path = "../filebox/siswa/$kd";
delete ($path);

//koneksi
require_once('../Connections/sisfokol.php'); 

//perintah SQL
$SQL = sprintf("DELETE FROM m_siswa WHERE kd = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs = mysql_query($SQL, $sisfokol) or die(mysql_error());

//del siswa_progstudi
$SQL1 = sprintf("DELETE FROM siswa_progstudi WHERE kd_siswa = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());


//del siswa_kelas
$SQL2 = sprintf("DELETE FROM siswa_kelas WHERE kd_siswa = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());


//del siswa_ruang
$SQL3 = sprintf("DELETE FROM siswa_ruang WHERE kd_siswa = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs3 = mysql_query($SQL3, $sisfokol) or die(mysql_error());

//del siswa_ekstra
$SQL4 = sprintf("DELETE FROM siswa_ekstra WHERE kd_siswa = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs4 = mysql_query($SQL4, $sisfokol) or die(mysql_error());


//del siswa_uang_gedung
$SQL5 = sprintf("DELETE FROM siswa_uang_gedung WHERE kd_siswa = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs5 = mysql_query($SQL5, $sisfokol) or die(mysql_error());

//del siswa_uang_lain
$SQL6 = sprintf("DELETE FROM siswa_uang_lain WHERE kd_siswa = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs6 = mysql_query($SQL6, $sisfokol) or die(mysql_error());

//del siswa_uang_spp
$SQL7 = sprintf("DELETE FROM siswa_uang_test WHERE kd_siswa = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs7 = mysql_query($SQL7, $sisfokol) or die(mysql_error());

//del siswa_uang_test
$SQL8 = sprintf("DELETE FROM siswa_uang_test WHERE kd_siswa = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs8 = mysql_query($SQL8, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

$returner = "akad_siswa.php";

header("location:$returner");
}

?>