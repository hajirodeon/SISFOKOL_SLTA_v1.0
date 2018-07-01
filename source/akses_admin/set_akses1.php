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

//kosongkan cache
header("cache-control:private");
header("pragma:no-cache");
header("cache-control:no-cache");
flush();  

//ambil nilai konfigurasi tertentu
include("../include/config.php");
 
//koneksi
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 

//ambil nilai
$akseskod = $_REQUEST['akseskod'];
$akses = $_REQUEST['akses'];
$nama = $_REQUEST['nama'];
$kd = $_REQUEST['kd'];
?>
<html>
<head>
<title>GANTI PASSWORD --> <?php echo $akses;?> : <?php echo $nama;?></title>
<link href="style/admin.css" rel="stylesheet" type="text/css"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5">
<table width="200" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td bgcolor="#000000"><strong><font color="#FFFFFF">PASSWORD BARU</font></strong></td>
  </tr>
  <tr>
    <td>
	<?php
	$passwd_br = rand(1,10000000);
	echo $passwd_br;
	
	$passwd_bri = md5($passwd_br);
	
	//pilih update akses
	switch ($akseskod) {
		case 11111: //pegawai
			$SQLupdate = sprintf("UPDATE m_pegawai SET password = '$passwd_bri' ".
								"WHERE kd = '$kd'");
			mysql_select_db($database_sisfokol, $sisfokol);
			$Rsupdate = mysql_query($SQLupdate, $sisfokol) or die(mysql_error());
			break;
		
		
		case 22222: //wali kelas
			$SQLupdate = sprintf("UPDATE m_pegawai SET password = '$passwd_bri' ".
								"WHERE kd = '$kd'");
			mysql_select_db($database_sisfokol, $sisfokol);
			$Rsupdate = mysql_query($SQLupdate, $sisfokol) or die(mysql_error());
			break;
		
		
		case 33333: //guru
			$SQLupdate = sprintf("UPDATE m_pegawai SET password = '$passwd_bri' ".
								"WHERE kd = '$kd'");
			mysql_select_db($database_sisfokol, $sisfokol);
			$Rsupdate = mysql_query($SQLupdate, $sisfokol) or die(mysql_error());
			break;
		
		
		case 44444: //siswa
			$SQLupdate = sprintf("UPDATE m_siswa SET password = '$passwd_bri' ".
								"WHERE kd = '$kd'");
			mysql_select_db($database_sisfokol, $sisfokol);
			$Rsupdate = mysql_query($SQLupdate, $sisfokol) or die(mysql_error());
			break;
		
		
		case 55555: //orang tua siswa
			$SQLupdate = sprintf("UPDATE m_siswa SET passortu = '$passwd_bri' ".
								"WHERE kd = '$kd'");
			mysql_select_db($database_sisfokol, $sisfokol);
			$Rsupdate = mysql_query($SQLupdate, $sisfokol) or die(mysql_error());
			break;
		}
		
	
	?></td>
  </tr>
</table>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>