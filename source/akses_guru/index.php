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
$kd = $_SESSION['kd_session'];
$username = $_SESSION['username_session'];
$password = $_SESSION['password_session'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT m_pegawai.*, m_guru.* ".
				"FROM m_pegawai, m_guru ".
				"WHERE m_pegawai.kd = m_guru.kd_pegawai ".
				"AND m_pegawai.kd = '$kd' ".
				"AND m_pegawai.nip = '$username'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title>Selamat Datang, Guru : <?php echo balikin($row_rs1['nama']);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/guru.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="middle"> 
    <td width="188" valign="top"> <div align="left"> 
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
    <td width="792" valign="top"><p><big><strong>Selamat Datang</strong>, <font color="#FF0000"><?php echo $row_rs1['nama'];?></font></big></p>
      <p><img src="../images/open_source_hajirobe.gif" width="260" height="120"></p>
      <p>&nbsp;</p>
      <p>Anda adalah GURU : 
        <?php
		//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT m_guru.*, m_progstudi.*, m_kelas.*, m_pelajaran.* ".
				"FROM m_guru, m_progstudi, m_kelas, m_pelajaran ".
				"WHERE m_guru.kd_pelajaran = m_pelajaran.kd ".
				"AND m_guru.kd_progstudi = m_progstudi.kd ".
				"AND m_guru.kd_kelas = m_kelas.kd ".
				"AND m_guru.kd_pegawai = '$kd' ".
				"ORDER BY m_pelajaran.pelajaran ASC";
$rsi= mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);
?>
      </p>
      <p> 
        <?php
		do
			{
			?>
        - <strong><?php echo $row_rsi['pelajaran'];?></strong> [<strong><?php echo $row_rsi['progstudi'];?></strong>, 
        Kelas <strong><?php echo $row_rsi['kelas'];?></strong>] <br>
        <?php } while ($row_rsi = mysql_fetch_assoc($rsi)); ?>
      </p>
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