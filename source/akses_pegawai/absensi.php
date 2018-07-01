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

//ambil nilai
$kd_session = $_SESSION['kd_session'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT DATE_FORMAT(tgl_absensi, '%d') AS xtgl1, DATE_FORMAT(tgl_absensi, '%m') AS xbln1, ".
				"DATE_FORMAT(tgl_absensi, '%Y') AS xthn1, pegawai_absensi.*, m_pegawai.*, m_ket.* ".
				"FROM pegawai_absensi, m_pegawai, m_ket ".
				"WHERE m_pegawai.kd = pegawai_absensi.kd_pegawai ".
				"AND pegawai_absensi.kd_ket = m_ket.kd ".
				"AND pegawai_absensi.kd_pegawai = '$kd_session' ".
				"ORDER BY pegawai_absensi.tgl_absensi DESC";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title><?php echo balikin($row_rs1['nama']);?> --> Absensi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/pegawai.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="middle"> 
    <td valign="top"> <p align="left"><img src="images/absensi.gif" width="177" height="40"></p>
      <p align="left">
        <? ///nek isih kosong
	if ($totalRows_rs1 == 0)
		{
		?>
      </p>
      <div align="left"><strong>TIDAK PERNAH ABSEN, SELALU HADIR </strong> 
        <?php
		}
		
	else if ($totalRows_rs1 != 0)//nek eneng isine...
	  	{ 
		 	
		do { 
		?>
		
        - <?php echo $row_rs1['xtgl1']; ?> 
          <?php 
		  $nilbln = $row_rs1['xbln1'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
          <?php echo $row_rs1['xthn1']; ?> --> <strong><?php echo $row_rs1['ket'];?> </strong><br>
		
        <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); 
		
		}
		?>
      </div></td>
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