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

//ambil nilai
$kd_siswa  = cegah($_REQUEST["kd_siswa"]);
$inc_tapel  = cegah($_REQUEST["inc_tapel"]);
$kelkod  = cegah($_REQUEST["kelkod"]);
$rukod  = cegah($_REQUEST["rukod"]);


//////////////////////////// UPDATE PROGRAM STUDI //////////////////////////////////////////////////////////
if ($_REQUEST['studikod'] != "")
	{
	//cek, sudah ada belum
	$SQL1 = sprintf("SELECT * FROM siswa_progstudi WHERE kd_tapel = '$inc_tapel' ".
						"AND kd_progstudi = '$studikod' AND kd_siswa = '$kd_siswa'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
	$row_rs1 = mysql_fetch_assoc($Rs1);
	$totalRows_rs1 = mysql_num_rows($Rs1);


	//jika sudah ada, update aja progstudi e
	if ($totalRows_rs1 != 0) 
		{
		//netralkan dahulu semuanya
		mysql_select_db($database_sisfokol, $sisfokol);
		$query_rsnetral = "UPDATE siswa_progstudi SET status = 'false' WHERE kd_siswa = '$kd_siswa'";
		$rsnetral = mysql_query($query_rsnetral, $sisfokol) or die(mysql_error());		
		
		//update-kan baru
		mysql_select_db($database_sisfokol, $sisfokol);
		$query_rsupdate = "UPDATE siswa_progstudi SET status = 'true' ".
							"WHERE kd_progstudi = '$studikod' AND kd_siswa = '$kd_siswa'";
		$rsupdate = mysql_query($query_rsupdate, $sisfokol) or die(mysql_error());
		
		//auto-kembali
		$jurikod = $_REQUEST['jurikod'];
		$progstudi = $_REQUEST['progstudi'];
		$kelikod = $_REQUEST['kelikod'];
		$kelas = $_REQUEST['kelas'];
		$returner = "akt_penempatan.php?jurikod=$jurikod&progstudi=$progstudi&kelikod=$kelikod&kelas=$kelas";
		header("location:$returner");				
		}
	
	//belum ada
	else
		{
		mysql_select_db($database_sisfokol, $sisfokol);
		$query_rs_tapel1 = "INSERT INTO siswa_progstudi(kd_tapel, kd_progstudi, kd_siswa, status)".
							"VALUES ('$inc_tapel', '$studikod', '$kd_siswa', 1)";
		$rs_tapel1 = mysql_query($query_rs_tapel1, $sisfokol) or die(mysql_error());
	
		//auto-kembali
		$jurikod = $_REQUEST['jurikod'];
		$progstudi = $_REQUEST['progstudi'];
		$kelikod = $_REQUEST['kelikod'];
		$kelas = $_REQUEST['kelas'];
		$returner = "akt_penempatan.php?jurikod=$jurikod&progstudi=$progstudi&kelikod=$kelikod&kelas=$kelas";
		header("location:$returner");
		}
}


//////////////////////////// UPDATE KELAS //////////////////////////////////////////////////////////
if ($_REQUEST['kelkod'] != "")
	{
	//cek, sudah ada belum
	$SQL1 = sprintf("SELECT * FROM siswa_kelas WHERE kd_tapel = '$inc_tapel' ".
						"AND kd_kelas = '$kelkod' AND kd_siswa = '$kd_siswa'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
	$row_rs1 = mysql_fetch_assoc($Rs1);
	$totalRows_rs1 = mysql_num_rows($Rs1);


	//jika sudah ada, update aja kelas e
	if ($totalRows_rs1 != 0) 
		{
		//netralkan dahulu semuanya
		mysql_select_db($database_sisfokol, $sisfokol);
		$query_rsnetral = "UPDATE siswa_kelas SET status = 'false' WHERE kd_siswa = '$kd_siswa'";
		$rsnetral = mysql_query($query_rsnetral, $sisfokol) or die(mysql_error());		
		
		//update-kan baru
		mysql_select_db($database_sisfokol, $sisfokol);
		$query_rsupdate = "UPDATE siswa_kelas SET status = 'true' ".
							"WHERE kd_kelas = '$kelkod' AND kd_siswa = '$kd_siswa'";
		$rsupdate = mysql_query($query_rsupdate, $sisfokol) or die(mysql_error());
		
		//auto-kembali
		$jurikod = $_REQUEST['jurikod'];
		$progstudi = $_REQUEST['progstudi'];
		$kelikod = $_REQUEST['kelikod'];
		$kelas = $_REQUEST['kelas'];
		$returner = "akt_penempatan.php?jurikod=$jurikod&progstudi=$progstudi&kelikod=$kelikod&kelas=$kelas";
		header("location:$returner");				
		}
	
	//belum ada
	else
		{
		mysql_select_db($database_sisfokol, $sisfokol);
		$query_rs_tapel1 = "INSERT INTO siswa_kelas(kd_tapel, kd_kelas, kd_siswa, status)".
							"VALUES ('$inc_tapel', '$kelkod', '$kd_siswa', 1)";
		$rs_tapel1 = mysql_query($query_rs_tapel1, $sisfokol) or die(mysql_error());
	
		//auto-kembali
		$jurikod = $_REQUEST['jurikod'];
		$progstudi = $_REQUEST['progstudi'];
		$kelikod = $_REQUEST['kelikod'];
		$kelas = $_REQUEST['kelas'];
		$returner = "akt_penempatan.php?jurikod=$jurikod&progstudi=$progstudi&kelikod=$kelikod&kelas=$kelas";
		header("location:$returner");
		}
}


//////////////////////////// UPDATE RUANG //////////////////////////////////////////////////////////
if ($_REQUEST['rukod'] != "")
	{
	//cek, sudah ada belum
	$SQL1 = sprintf("SELECT * FROM siswa_ruang WHERE kd_tapel = '$inc_tapel' ".
						"AND kd_ruang = '$rukod' AND kd_siswa = '$kd_siswa'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
	$row_rs1 = mysql_fetch_assoc($Rs1);
	$totalRows_rs1 = mysql_num_rows($Rs1);


	//jika sudah ada, update aja ruang e
	if ($totalRows_rs1 != 0) 
		{
		//netralkan dahulu semuanya
		mysql_select_db($database_sisfokol, $sisfokol);
		$query_rsnetral = "UPDATE siswa_ruang SET status = 'false' WHERE kd_siswa = '$kd_siswa'";
		$rsnetral = mysql_query($query_rsnetral, $sisfokol) or die(mysql_error());		
		
		//update-kan baru
		mysql_select_db($database_sisfokol, $sisfokol);
		$query_rsupdate = "UPDATE siswa_ruang SET status = 'true' ".
							"WHERE kd_ruang = '$rukod' AND kd_siswa = '$kd_siswa'";
		$rsupdate = mysql_query($query_rsupdate, $sisfokol) or die(mysql_error());
		
		//auto-kembali
		$jurikod = $_REQUEST['jurikod'];
		$progstudi = $_REQUEST['progstudi'];
		$kelikod = $_REQUEST['kelikod'];
		$kelas = $_REQUEST['kelas'];
		$returner = "akt_penempatan.php?jurikod=$jurikod&progstudi=$progstudi&kelikod=$kelikod&kelas=$kelas";
		header("location:$returner");				
		}
	
	//belum ada
	else
		{
		mysql_select_db($database_sisfokol, $sisfokol);
		$query_rs_tapel1 = "INSERT INTO siswa_ruang(kd_tapel, kd_ruang, kd_siswa, status)".
							"VALUES ('$inc_tapel', '$rukod', '$kd_siswa', 1)";
		$rs_tapel1 = mysql_query($query_rs_tapel1, $sisfokol) or die(mysql_error());
	
		//auto-kembali
		$jurikod = $_REQUEST['jurikod'];
		$progstudi = $_REQUEST['progstudi'];
		$kelikod = $_REQUEST['kelikod'];
		$kelas = $_REQUEST['kelas'];
		$returner = "akt_penempatan.php?jurikod=$jurikod&progstudi=$progstudi&kelikod=$kelikod&kelas=$kelas";
		header("location:$returner");
		}
}


//diskonek
mysql_close($sisfokol);
?>