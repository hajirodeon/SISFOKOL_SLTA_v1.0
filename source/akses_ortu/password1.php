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
$passlama = md5(cegah($_POST['passlama']));
$passbaru = md5(cegah($_POST['passbaru']));

$kd_session = $_SESSION['kd_session'];
$username_session = $_SESSION['username_session'];


//cek password lama
$SQL1 = sprintf("SELECT * FROM m_siswa ".
				"WHERE kd = '$kd_session' ".
				"AND nis = '$username_session' ".
				"AND passortu = '$passlama'");

mysql_select_db($database_sisfokol, $sisfokol);
$rs1 = mysql_query($SQL1, $sisfokol) or die("Tidak ada data");
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);

if ($totalRows_rs1 != 0) 
	{
	//perintah SQL
	$SQL2 = sprintf("UPDATE m_siswa SET passortu = '$passbaru' ".
						"WHERE kd = '$kd_session' ".
						"AND nis = '$username_session'");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());
	
	//diskonek
	mysql_close($sisfokol);
	
	//auto-kembali
	$pesan = "Password berhasil diganti!";
	$kembali = "index.php";
	
	echo "<script>alert('$pesan');location.href='$kembali'</script>";
	}

Else 
		
	{
	$pesan = "Password lama tidak cocok. Silahkan diulangi!";
	$kembali = "password.php";
	
	echo "<script>alert('$pesan');location.href='$kembali'</script>";
	}
?>