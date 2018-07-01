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

$kd = $_REQUEST['kd'];

//detail
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsdt = "SELECT m_guru.*, m_pegawai.*, m_pelajaran.*, jadwal.* ".
				"FROM m_guru, m_pegawai, m_pelajaran, jadwal ".
				"WHERE m_guru.kd = jadwal.kd_guru ".
				"AND m_guru.kd_pegawai = m_pegawai.kd ".
				"AND m_pelajaran.kd = m_guru.kd_pelajaran ".
				"AND jadwal.kd = '$kd'";
$rsdt = mysql_query($query_rsdt, $sisfokol) or die(mysql_error());
$row_rsdt = mysql_fetch_assoc($rsdt);
$totalRows_rsdt = mysql_num_rows($rsdt);
?>
<html>
<head>
<title>Detail Jadwal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<table width="300" border="0" cellpadding="2" cellspacing="0" bgcolor="#66CCCC">
  <tr>
    <td><strong><font color="#FFFFFF">DETAIL</font></strong></td>
  </tr>
</table>
<table width="300" border="0" cellspacing="0" cellpadding="2">
  <tr valign="top">
    <td width="398">
<p><strong>Pelajaran :</strong> <br>
        <?php echo $row_rsdt['pelajaran'];?> </p>
      <p> <strong>Guru :</strong> <br><?php echo $row_rsdt['nama'];?> </p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_close($sisfokol);
?>