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
include("include/itapel.php"); 
include("include/ismt.php"); 

//ambil nilai
$kd = $_REQUEST['kd'];
$pelkd = $_REQUEST['pelkd'];
$mpkd = $_REQUEST['mpkd'];
$progstudi = $_REQUEST['progstudi'];
$mkkd = $_REQUEST['mkkd'];
$kelas = $_REQUEST['kelas'];
$mrkd = $_REQUEST['mrkd'];
$ruang = $_REQUEST['ruang'];
$angkakd = $_REQUEST['angkakd'];

//cek, sudah ada belum?
$SQLcek = sprintf("SELECT * FROM siswa_raport ".
					"WHERE kd_tapel = '$row_rstapel[kd]' ".
					"AND kd_semester = '$row_rssmt[kd]' ".
					"AND kd_progstudi = '$mpkd' ".
					"AND kd_kelas = '$mkkd' ".
					"AND kd_ruang = '$mrkd' ".
					"AND kd_pelajaran = '$pelkd' ".
					"AND kd_siswa = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rscek = mysql_query($SQLcek, $sisfokol) or die(mysql_error());
$totalRows_rscek = mysql_num_rows($Rscek);

if ($totalRows_rscek != 0) 
	{
	//update aja
	$SQLupdate = sprintf("UPDATE siswa_raport SET kd_nilai = '$angkakd' ".
							"WHERE kd_tapel = '$row_rstapel[kd]' ".
							"AND kd_semester = '$row_rssmt[kd]' ".
							"AND kd_progstudi = '$mpkd' ".
							"AND kd_kelas = '$mkkd' ".
							"AND kd_ruang = '$mrkd' ".
							"AND kd_pelajaran = '$pelkd' ".
							"AND kd_siswa = '$kd' ");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rsupdate = mysql_query($SQLupdate, $sisfokol) or die(mysql_error());
	
	//diskonek
	mysql_close($sisfokol);
	
	//auto-kembali
	$returner = "raport1.php?mpkd=$mpkd&progstudi=$progstudi&mkkd=$mkkd&kelas=$kelas&mrkd=$mrkd".
					"&ruang=$ruang&kd=$kd";
	header("location:$returner");
	}

else
	{
	$SQL = sprintf("INSERT INTO siswa_raport(kd, kd_siswa, kd_tapel, kd_semester, kd_progstudi, ".
					"kd_kelas, kd_ruang, kd_pelajaran, kd_nilai) ".
					"VALUES ('$x', '$kd', '$row_rstapel[kd]', '$row_rssmt[kd]', ".
					"'$mpkd', '$mkkd', '$mrkd', '$pelkd', '$angkakd')");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rs1 = mysql_query($SQL, $sisfokol) or die(mysql_error());
	
	//diskonek
	mysql_close($sisfokol);
	
	//auto-kembali
	$returner = "raport1.php?mpkd=$mpkd&progstudi=$progstudi&mkkd=$mkkd&kelas=$kelas&mrkd=$mrkd".
					"&ruang=$ruang&kd=$kd";
	header("location:$returner");
	}
?>