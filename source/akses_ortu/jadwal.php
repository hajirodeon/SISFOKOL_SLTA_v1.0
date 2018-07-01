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
<title>Orang Tua : <?php echo balikin($row_rs1['nama']);?> --> JADWAL PELAJARAN</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/siswa.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td valign="top"><p><big><img src="images/jadwal.gif" width="303" height="40"></big></p>
      <table width="990" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="50"><table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#99FFCC">
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          <td width="940">
		  <?php
		  //hari
mysql_select_db($database_sisfokol, $sisfokol);
$query_rshari = "SELECT * FROM m_hari";
$rshari = mysql_query($query_rshari, $sisfokol) or die(mysql_error());
$row_rshari = mysql_fetch_assoc($rshari);
$totalRows_rshari = mysql_num_rows($rshari);
?>
		  <table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
              <tr>
               <?php
	   do { 
	   ?>
                  
                <td width="158"><strong><font color="#FFFFFF"><?php echo $row_rshari['hari'];?></font></strong></td>
                  <?php } while ($row_rshari = mysql_fetch_assoc($rshari)); ?>
              </tr>
            </table></td>
        </tr>
      </table>
	  <?php
	  //jam
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsjam = "SELECT * FROM m_jam_pel";
$rsjam = mysql_query($query_rsjam, $sisfokol) or die(mysql_error());
$row_rsjam = mysql_fetch_assoc($rsjam);
$totalRows_rsjam = mysql_num_rows($rsjam);
?>
      <table width="990" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50"><table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#99FFCC">
                       <?php
	   do { 

	   ?>  <tr>  
                  <td height="50">
<div align="center"><strong><?php echo $row_rsjam['jam'];?></strong></div></td>
                </tr><?php } while ($row_rsjam = mysql_fetch_assoc($rsjam)); ?>
            </table></td>
          <td width="940"><table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
                <?php
//jami
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsjami = "SELECT * FROM m_jam_pel";
$rsjami = mysql_query($query_rsjami, $sisfokol) or die(mysql_error());
$row_rsjami = mysql_fetch_assoc($rsjami);
$totalRows_rsjami = mysql_num_rows($rsjami);
			
	   do { 
	   
	   ?>  <tr>                  
                  <?php
				  //harii
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsharii = "SELECT * FROM m_hari";
$rsharii = mysql_query($query_rsharii, $sisfokol) or die(mysql_error());
$row_rsharii = mysql_fetch_assoc($rsharii);
$totalRows_rsharii = mysql_num_rows($rsharii);

	   do { 
	   
	   	   
	   		if ($warna_set ==0)
			{
			$warna = '#F8F8F8';
			$warna_set = 1;
			}
		
		else
			
			{
			$warna = '#F0F4F8';
			$warna_set = 0;
			}
	   ?>
                  <td width="158" height="50" bgcolor="<? echo $warna; ?>"> 
                    <?php
			  //jadwal
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsi = "SELECT jadwal.*, m_pelajaran.*, m_guru.*, siswa_progstudi.*, siswa_kelas.*, siswa_ruang.* ".
				"FROM jadwal, m_pelajaran, m_guru, siswa_progstudi, siswa_kelas, ".
				"siswa_ruang ".
				"WHERE jadwal.kd_progstudi = siswa_progstudi.kd_progstudi ".
				"AND jadwal.kd_kelas = siswa_kelas.kd_kelas ".
				"AND jadwal.kd_ruang = siswa_ruang.kd_ruang ".
				"AND m_guru.kd_pelajaran = m_pelajaran.kd ".
				"AND jadwal.kd_guru = m_guru.kd ".
				"AND siswa_progstudi.status = 'true' ".
				"AND siswa_kelas.status = 'true' ".
				"AND siswa_ruang.status = 'true' ".
				"AND siswa_progstudi.kd_siswa = '$kd' ".
				"AND siswa_kelas.kd_siswa = '$kd' ".
				"AND siswa_ruang.kd_siswa = '$kd' ".
				"AND jadwal.kd_tapel = '$row_rstapel[kd]' ".
				"AND jadwal.kd_semester = '$row_rssmt[kd]' ".
				"AND jadwal.kd_hari = '$row_rsharii[kd]' ".
				"AND jadwal.kd_jam_pel = '$row_rsjami[kd]'";
$rsi = mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);
?>

<?php 
//jika tidak kosong
if ($totalRows_rsi != 0) 
	{
	?>
<?php echo $row_rsi['pelajaran'];?> 
<?php
	}
else
	{
	?>
	-
	<?php
	}
	?>              </td>
				  
				  
				  
				  
                  <?php } while ($row_rsharii = mysql_fetch_assoc($rsharii)); ?>
				  
				  
                </tr><?php } while ($row_rsjami = mysql_fetch_assoc($rsjami)); ?> 
              </table></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp; </td>
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