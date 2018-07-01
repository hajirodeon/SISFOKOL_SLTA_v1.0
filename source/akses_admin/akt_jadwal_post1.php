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
$tapelkod = cegah($_POST['tapelkod']);
$smtkod = cegah($_POST['smtkod']);
$studikod = cegah($_POST['studikod']);
$kelkod = cegah($_POST['kelkod']);
$rukod = cegah($_POST['rukod']);
$harikod == cegah($_POST['harikod']);
$jamkod == cegah($_POST['jamkod']);
$guru == cegah($_POST['guru']);

//ngajar gak?
$SQLngajar = sprintf("SELECT jadwal.*, jadwal.kd AS jakod FROM jadwal ".
					"WHERE kd_hari = '$harikod' ".
					"AND kd_jam_pel = '$jamkod' ".
					"AND kd_guru = '$guru'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rsngajar = mysql_query($SQLngajar, $sisfokol) or die(mysql_error());
$row_rsngajar = mysql_fetch_assoc($Rsngajar);
$totalRows_rsngajar = mysql_num_rows($Rsngajar);

//jika iya, gak oleh dobel
if ($totalRows_rsngajar != 0) 
	{
	$jakod = $row_rsngajar['jakod'];
	$SQLiya = sprintf("SELECT jadwal.*, m_progstudi.*, m_kelas.*, m_ruang.* ".
						"FROM jadwal, m_progstudi, m_kelas, m_ruang ".
						"WHERE jadwal.kd_progstudi = m_progstudi.kd ".
						"AND jadwal.kd_kelas = m_kelas.kd ".
						"AND jadwal.kd_ruang = m_ruang.kd ".
						"AND jadwal.kd = '$jakod'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rsiya = mysql_query($SQLiya, $sisfokol) or die(mysql_error());
	$row_rsiya = mysql_fetch_assoc($Rsiya);
	$totalRows_rsiya = mysql_num_rows($Rsiya);
	
	$pesan = "Guru telah mengajar di Program Studi : $row_rsiya[progstudi], Kelas : $row_rsiya[kelas], ".
				"Ruang : $row_rsiya[ruang] . Silahkan Diganti!";
	$returner = "akt_jadwal.php?tapelkod=$tapelkod&smtkod=$smtkod&studikod=$studikod&kelkod=$kelkod".
					"&rukod=$rukod&harikod=$harikod&jamkod=$jamkod";
	echo "<script>alert('$pesan');location.href='$returner'</script>";
	header("location:$returner");
	}

else
	//nek gak ngajar
	{
	//cek sudah ada belum
	$SQLcek = sprintf("SELECT * FROM jadwal ".
						"WHERE kd_tapel = '$tapelkod' ".
						"AND kd_semester = '$smtkod' ".
						"AND kd_progstudi = '$studikod' ".
						"AND kd_kelas = '$kelkod' ".
						"AND kd_ruang = '$rukod' ".
						"AND kd_hari = '$harikod' ".
						"AND kd_jam_pel = '$jamkod'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rscek = mysql_query($SQLcek, $sisfokol) or die(mysql_error());
	$row_rscek = mysql_fetch_assoc($Rscek);
	$totalRows_rscek = mysql_num_rows($Rscek);

	//jika iya, update saja
	if ($totalRows_rscek != 0) 
		{
		$SQL = sprintf("UPDATE jadwal SET kd_guru = '$guru' ".
						"WHERE kd_tapel = '$tapelkod' ".
						"AND kd_semester = '$smtkod' ".
						"AND kd_progstudi = '$studikod' ".
						"AND kd_kelas = '$kelkod' ".
						"AND kd_ruang = '$rukod' ".
						"AND kd_hari = '$harikod' ".
						"AND kd_jam_pel = '$jamkod'");

		mysql_select_db($database_sisfokol, $sisfokol);
		$Rs1 = mysql_query($SQL, $sisfokol) or die(mysql_error());
		}

	else
		{
		$SQL = sprintf("INSERT INTO jadwal(kd, kd_tapel, kd_semester, kd_progstudi, kd_kelas, kd_ruang, ".
						"kd_hari, kd_jam_pel, kd_guru) VALUES ('$x', '$tapelkod', '$smtkod', ".
						"'$studikod', '$kelkod', '$rukod', '$harikod', ".
						"'$jamkod', '$guru')");

		mysql_select_db($database_sisfokol, $sisfokol);
		$Rs1 = mysql_query($SQL, $sisfokol) or die(mysql_error());
		}

	
mysql_close($sisfokol);

//auto-kembali
$returner = "akt_jadwal.php?tapelkod=$tapelkod&smtkod=$smtkod&studikod=$studikod&kelkod=$kelkod&rukod=$rukod&harikod=$harikod&jamkod=$jamkod";
header("location:$returner");
}
?>