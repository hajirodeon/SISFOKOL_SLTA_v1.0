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
$kd = cegah($_REQUEST['kd']);
$mpelkd = cegah($_REQUEST['mpelkd']);
$mkelkd = cegah($_REQUEST['mkelkd']);
$mprogkd = cegah($_REQUEST['mprogkd']);
$mgkd = cegah($_REQUEST['mgkd']);
$tapelkd = cegah($_REQUEST['tapelkd']);
$smtkd = cegah($_REQUEST['smtkd']);
$progstudi = cegah($_REQUEST['progstudi']);
$pelajaran = cegah($_REQUEST['pelajaran']);
$kelas = cegah($_REQUEST['kelas']);
$topikkd = cegah($_REQUEST['topikkd']);
$topik = cegah($_REQUEST['topik']);
$soalkd = cegah($_REQUEST['soalkd']);
$pilkd = cegah($_REQUEST['pilkd']);



//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM soal_pilihan_opsi ".
					"WHERE kd_soal = '$soalkd' AND kd_pil = '$pilkd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);


//jika iya
if ($totalRows_rs1 == 0) 
	{
	//update baru
	$SQLi = sprintf("UPDATE soal_pilihan_opsi SET status = 'true' ".
						"WHERE kd_soal = '$soalkd' ".
						"AND kd_pil = '$pilkd'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rsi = mysql_query($SQLi, $sisfokol) or die(mysql_error());
		
	//diskonek
	mysql_close($sisfokol);
	
	//auto-kembali
	$returner = "soal_pil_soal.php?mgkd=$mgkd&mpelkd=$mpelkd&pelajaran=$pelajaran&mprogkd=$mprogkd".
				"&progstudi=$progstudi&mkelkd=$mkelkd&kelas=$kelas&topikkd=$topikkd&topik=$topik";
	header("location:$returner");
	}

else
	{
	//netralkan dahulu
	$SQLi = sprintf("UPDATE soal_pilihan_opsi SET status = 'false' ".
						"WHERE kd_soal = '$soalkd'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rsi = mysql_query($SQLi, $sisfokol) or die(mysql_error());
	
	//update saja
	$SQLii = sprintf("UPDATE soal_pilihan_opsi SET status = 'true' ".
						"WHERE kd_soal = '$soalkd' ".
						"AND kd_pil = '$pilkd'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rsii = mysql_query($SQLii, $sisfokol) or die(mysql_error());
	
	
	//diskonek
	mysql_close($sisfokol);
	
	//auto-kembali
	$returner = "soal_pil_soal.php?mgkd=$mgkd&mpelkd=$mpelkd&pelajaran=$pelajaran&mprogkd=$mprogkd".
				"&progstudi=$progstudi&mkelkd=$mkelkd&kelas=$kelas&topikkd=$topikkd&topik=$topik";
	header("location:$returner");
	}
?>