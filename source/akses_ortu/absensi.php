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

//koneksi db
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 
include("../include/itapel.php"); 
include("../include/ismt.php"); 

//ambil nilai
$kd = $_SESSION['kd_session'];
$username = $_SESSION['username_session'];
$password = $_SESSION['password_session'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT * FROM m_siswa ".
				"WHERE kd = '$kd' ".
				"AND nis = '$username'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title>Orang Tua : <?php echo balikin($row_rs1['nama']);?> --> ABSENSI</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/siswa.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td valign="top"><p><big><img src="images/absensi.gif" width="180" height="40"></big></p>
      <p><?php
	  mysql_select_db($database_sisfokol, $sisfokol);

$query_rsket = "SELECT * FROM m_ket ORDER BY ket ASC";
$rsket = mysql_query($query_rsket, $sisfokol) or die(mysql_error());
$row_rsket = mysql_fetch_assoc($rsket);
$totalRows_rsket = mysql_num_rows($rsket);?>

      <table width="250" border="0" cellspacing="0" cellpadding="2">
        <?php
do
	{
	?>
        <tr> 
          <td width="173"><?php echo $row_rsket['ket'];?></td>
          <td width="69"><?php
		   mysql_select_db($database_sisfokol, $sisfokol);

$query_rsx = "SELECT COUNT(*) AS siscon FROM siswa_absensi ".
				"WHERE kd_siswa = '$kd' ".
				"AND kd_ket = '$row_rsket[kd]'";
$rsx = mysql_query($query_rsx, $sisfokol) or die(mysql_error());
$row_rsx = mysql_fetch_assoc($rsx);
$totalRows_rsx = mysql_num_rows($rsx);?>

<?php
//jika kosong
if ($row_rsx['siscon'] == "")
	{
	echo "-";
	}

else
	{
	echo $row_rsx['siscon'];
	}
?>

</td>
        </tr>
        <?php
	}
	while ($row_rsket = mysql_fetch_assoc($rsket));
	?>
      </table>
</p>
      <p>&nbsp; </p>
      </td>
  </tr>
</table>
<br>
<?php include("include/footer.php"); ?>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>