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
$labkod = cegah($_POST['labkod']);
$kd_hari = cegah($_POST['kd_hari']);
$kd_jam = cegah($_POST['kd_jam']);
$progstudi = cegah($_POST['progstudi']);
$kelas = cegah($_POST['kelas']);
$ruang = cegah($_POST['ruang']);

//cek, sudah ada belum
$SQLcek = sprintf("SELECT * FROM inv_peng_lab ".
					"WHERE kd_lab = '$labkod' ".
					"AND kd_hari = '$kd_hari' ".
					"AND kd_jam = '$kd_jam'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rscek = mysql_query($SQLcek, $sisfokol) or die(mysql_error());
$row_rscek = mysql_fetch_assoc($Rscek);
$totalRows_rscek = mysql_num_rows($Rscek);

//jika iya, update saja
	if ($totalRows_rscek != 0) 
		{
		$SQL = sprintf("UPDATE inv_peng_lab SET kd_progstudi = '$progstudi', kd_kelas = '$kelas', ".
						"kd_ruang = '$ruang' ".
						"WHERE kd_lab = '$labkod' ".
						"AND kd_hari = '$kd_hari' ".
						"AND kd_jam = '$kd_jam'");

		mysql_select_db($database_sisfokol, $sisfokol);
		$Rs = mysql_query($SQL, $sisfokol) or die(mysql_error());
		}
	
	else
		{		
		//perintah SQL : masukkan data pengguna lab
		$SQL = sprintf("INSERT INTO inv_peng_lab(kd, kd_lab, kd_hari, kd_jam, kd_progstudi, kd_kelas, ".
							"kd_ruang) VALUES ('$x', '$labkod', '$kd_hari', '$kd_jam', '$progstudi', ".
							"'$kelas', '$ruang')");

		mysql_select_db($database_sisfokol, $sisfokol);
		$Rs = mysql_query($SQL, $sisfokol) or die(mysql_error());
		}

//diskonek
mysql_close($sisfokol);

//auto-kembali
header("location:inv_peng_praktikum.php?labkod=$labkod");
?>