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
$siswakd = cegah($_REQUEST['siswakd']);
$angkakd = cegah($_REQUEST['angkakd']);
$mgkd = cegah($_REQUEST['mgkd']);
$mpelkd = cegah($_REQUEST['mpelkd']);
$pelajaran = cegah($_REQUEST['pelajaran']);
$mprogkd = cegah($_REQUEST['mprogkd']);
$progstudi = cegah($_REQUEST['progstudi']);
$mkelkd = cegah($_REQUEST['mkelkd']);
$kelas = cegah($_REQUEST['kelas']);
$mrkd = cegah($_REQUEST['mrkd']);
$ruang = cegah($_REQUEST['ruang']);
$mnkd = cegah($_REQUEST['mnkd']);
$kat = cegah($_REQUEST['kat']);
$tapelkd = cegah($_REQUEST['tapelkd']);
$smtkd = cegah($_REQUEST['smtkd']);

//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM siswa_nilai ".
					"WHERE kd_siswa = '$siswakd' ".
					"AND kd_nilai_kat = '$mnkd' ".
					"AND kd_guru = '$mgkd' ".
					"AND kd_pelajaran = '$mpelkd' ".
					"AND kd_tapel = '$tapelkd' ".
					"AND kd_semester = '$smtkd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);


//jika iya
if ($totalRows_rs1 == 0) 
	{
	//masukkan baru
	$SQLi = sprintf("INSERT INTO siswa_nilai (kd, kd_tapel, kd_semester, kd_guru, kd_pelajaran, ".
						"kd_siswa, kd_nilai_kat, kd_nilai_angka) ".
						"VALUES ('$x', '$tapelkd', '$smtkd', '$mgkd', '$mpelkd', '$siswakd', '$mnkd', ".
						"'$angkakd')");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rsi = mysql_query($SQLi, $sisfokol) or die(mysql_error());
		
	//diskonek
	mysql_close($sisfokol);
	
	//auto-kembali
	$returner = "nilai.php?mgkd=$mgkd&mpelkd=$mpelkd&pelajaran=$pelajaran&mprogkd=$mprogkd&progstudi=$progstudi&".
					"mkelkd=$mkelkd&kelas=$kelas&mrkd=$mrkd&ruang=$ruang&mnkd=$mnkd&kat=$kat";
	header("location:$returner");
	}

else
	{
	//update saja
	$SQLi = sprintf("UPDATE siswa_nilai SET kd_nilai_angka = '$angkakd' ".
						"WHERE kd_siswa = '$siswakd' ".
						"AND kd_nilai_kat = '$mnkd' ".
						"AND kd_guru = '$mgkd' ".
						"AND kd_pelajaran = '$mpelkd' ".
						"AND kd_tapel = '$tapelkd' ".
						"AND kd_semester = '$smtkd'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rsi = mysql_query($SQLi, $sisfokol) or die(mysql_error());
	
	
	//diskonek
	mysql_close($sisfokol);
	
	//auto-kembali
	$returner = "nilai.php?mgkd=$mgkd&mpelkd=$mpelkd&pelajaran=$pelajaran&mprogkd=$mprogkd&progstudi=$progstudi&".
					"mkelkd=$mkelkd&kelas=$kelas&mrkd=$mrkd&ruang=$ruang&mnkd=$mnkd&kat=$kat";
	header("location:$returner");
	}
?>