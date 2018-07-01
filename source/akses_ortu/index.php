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

//ambil nilai
$kd = $_SESSION['kd_session'];
$username = $_SESSION['username_session'];
$password = $_SESSION['password_session'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT m_siswa.*, siswa_progstudi.*, siswa_kelas.*, siswa_ruang.*, ".
				"m_progstudi.*, m_kelas.*, m_ruang.* ".
				"FROM m_siswa, siswa_progstudi, siswa_kelas, siswa_ruang, ".
				"m_progstudi, m_kelas, m_ruang ".
				"WHERE m_siswa.kd = siswa_progstudi.kd_siswa ".
				"AND m_siswa.kd = siswa_kelas.kd_siswa ".
				"AND m_siswa.kd = siswa_ruang.kd_siswa ".
				"AND siswa_progstudi.status = 'true' ".
				"AND siswa_kelas.status = 'true' ".
				"AND siswa_progstudi.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_kelas.kd_tapel = '$row_rstapel[kd]' ".
				"AND m_siswa.kd = '$kd'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title>Selamat Datang, Orang Tua : <?php echo balikin($row_rs1['nama']);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/siswa.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="middle"> 
    <td width="182" valign="top"> <div align="center"> 
        <table width="100%" border="0" cellpadding="2">
          <tr> 
            <td bgcolor="#000000"><strong><font color="#FFFFFF">AGENDA</font></strong></td>
          </tr>
          <tr> 
            <td> 
              <?php
		//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rsagenda = "SELECT * FROM agenda";
$rsagenda = mysql_query($query_rsagenda, $sisfokol) or die(mysql_error());
$row_rsagenda = mysql_fetch_assoc($rsagenda);
$totalRows_rsagenda = mysql_num_rows($rsagenda);

do
	{
?>
              <font color="#FF0000"><strong><?php echo balikin($row_rsagenda['judul']);?></strong></font><br> 
              <?php echo balikin($row_rsagenda['isi']);?><br> <strong>Waktu --> 
              </strong><?php echo balikin($row_rsagenda['waktu']);?><br>
              <br> 
              <?php } while ($row_rsagenda = mysql_fetch_assoc($rsagenda)); ?>
            </td>
          </tr>
        </table>
        <br>
        <table width="100%" border="0">
          <tr> 
            <td bgcolor="#000000"><strong><font color="#FFFFFF">Kalender Pendidikan</font></strong></td>
          </tr>
          <tr> 
            <td> 
              <?php
		//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rskal = "SELECT * FROM kalender";
$rskal = mysql_query($query_rskal, $sisfokol) or die(mysql_error());
$row_rskal = mysql_fetch_assoc($rskal);
$totalRows_rskal = mysql_num_rows($rskal);

do
	{
?>
              <font color="#FF0000"><strong><?php echo balikin($row_rskal['judul']);?></strong></font><br> 
              <?php echo balikin($row_rskal['isi']);?><br> <strong>Waktu --> </strong><?php echo balikin($row_rskal['waktu']);?><br> 
              <br> 
              <?php } while ($row_rskal = mysql_fetch_assoc($rskal)); ?>
            </td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        </div></td>
    <td width="10" valign="top">&nbsp;</td>
    <td width="800" valign="top"><p><big><strong>Selamat Datang</strong>, <font color="#FF0000">Orang 
        Tua : <?php echo $row_rs1['nama'];?></font></big></p>
      <p><img src="../images/open_source_hajirobe.gif" width="260" height="120"></p>
      <p>&nbsp;</p>
      <p>Putra / Putri Anda Mengambil :</p>
      <p>- Program Studi : <?php echo $row_rs1['progstudi'];?></p>
      <p>- Kelas : <?php echo $row_rs1['kelas'];?></p>
      <p>- Ruang : <?php echo $row_rs1['ruang'];?></p>
      <p>&nbsp;</p>
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