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

$query_rs1 = "SELECT m_pegawai.*, m_guru.kd AS mgkd, m_guru.* ".
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
<title>Guru : <?php echo balikin($row_rs1['nama']);?> --> Jadwal Mengajar</title>
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
    <td valign="top"> <div align="left">
        <p><big><img src="images/jadwal.gif" width="334" height="40"></big></p>
        <p> 
          <?php include("include/tapel.php"); ?> <br>
          <?php include("include/smt.php"); ?>
          <?php
		//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT jadwal.*, m_tapel.*, m_semester_set.*, m_progstudi.*, m_kelas.*, ".
				"m_ruang.*, m_hari.*, m_jam_pel.*, m_guru.*, m_pelajaran.* ".
				"FROM jadwal, m_tapel, m_semester_set, m_progstudi, m_kelas, m_ruang, ".
				"m_hari, m_jam_pel, m_guru, m_pelajaran ".
				"WHERE jadwal.kd_tapel = m_tapel.kd ".
				"AND jadwal.kd_semester = m_semester_set.kd ".
				"AND jadwal.kd_guru = m_guru.kd ".
				"AND m_guru.kd_pelajaran = m_pelajaran.kd ".
				"AND jadwal.kd_progstudi = m_progstudi.kd ".
				"AND jadwal.kd_kelas = m_kelas.kd ".
				"AND jadwal.kd_ruang = m_ruang.kd ".
				"AND jadwal.kd_hari = m_hari.kd ".
				"AND jadwal.kd_jam_pel = m_jam_pel.kd ".
				"AND jadwal.kd_tapel = '$row_rstapel[kd]'".
				"AND jadwal.kd_semester = '$row_rssmt[kd]'".
				"AND jadwal.kd_guru = '$row_rs1[mgkd]' ".
				"ORDER BY m_hari.hari DESC, m_jam_pel.jam ASC";
$rsi= mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);
?>
        </p>
        <p> 
          <? ///nek isih kosong
	if ($totalRows_rsi == 0)
		{
		?>
          BELUM ADA JADWALNYA! 
          <?php
		}
		else if ($totalRows_rsi != 0)//nek eneng isine...
	  	{
		?>
          <?php
		do
			{
			?>
          - Hari : <strong><?php echo $row_rsi['hari'];?></strong>, Jam Pelajaran : <strong><?php echo $row_rsi['jam'];?></strong> --> <strong><?php echo $row_rsi['pelajaran'];?> </strong>[Program Studi : <strong><?php echo $row_rsi['progstudi'];?></strong>, Kelas : <strong><?php echo $row_rsi['kelas'];?></strong>, Ruang : <strong><?php echo $row_rsi['ruang'];?></strong>]<br>
          <?php } while ($row_rsi = mysql_fetch_assoc($rsi)); 
		  
		  }
		  ?>
        </p>
      <p>&nbsp;</p>
        </div>
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