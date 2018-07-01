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
$nama = cegah($_POST['nama']);
$jekel = cegah($_POST['jekel']);
$tmplahir = cegah($_POST['tmplahir']);

$tanggal1 == cegah($_POST['tanggal1']);
$bulan1 == cegah($_POST['bulan1']);
$tahun1 == cegah($_POST['tahun1']);
$tgl1 = ("$tahun1:$bulan1:$tanggal1");

$bangsa = cegah($_POST['bangsa']);
$agm = cegah($_POST['agm']);
$anakke = cegah($_POST['anakke']);
$alamat = cegah($_POST['alamat']);
$nm_ortu = cegah($_POST['nm_ortu']);
$pddkn_ortu = cegah($_POST['pddkn_ortu']);
$pek = cegah($_POST['pek']);
$almt_pek_ortu = cegah($_POST['almt_pek_ortu']);
$ket_lain = cegah($_POST['ket_lain']);

//ambil nilai nomer
$SQLno = sprintf("SELECT MAX(nomer) AS nting FROM psb");

mysql_select_db($database_sisfokol, $sisfokol);
$Rsno = mysql_query($SQLno, $sisfokol) or die(mysql_error());
$row_rsno = mysql_fetch_assoc($Rsno);
$totalRows_rsno = mysql_num_rows($Rsno);

//jika MAX < 1 alias masih kosong, jadikan angka 1.
if ($row_rsno['nting'] == "")
	{
	$row_rsno['nting'] = $row_rsno['nting'] + 1;
	$nomer = $row_rsno['nting'];
	}

else
	{
	//sudah ada, tambah 1
	$nomer = $row_rsno['nting'] + 1;
	}

//perintah SQL
$SQL1 = sprintf("INSERT INTO psb(kd, nomer, nama, kd_kelamin, tmp_lahir, tgl_lahir, bangsa, kd_agama, ".
					"anak_ke, alamat, nm_ortu, pendidikan, kd_pekerjaan, almt_pek, ket) ".
					"VALUES ('$x', '$nomer', '$nama', '$jekel', '$tmplahir', '$tgl1', '$bangsa', ".
					"'$agm', '$anakke', '$alamat', '$nm_ortu', '$pddkn_ortu', '$pek', '$almt_pek_ortu', ".
					"'$ket_lain')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);
	
header("location:akt_psb.php");
?>