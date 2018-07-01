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
<title>Orang Tua : <?php echo balikin($row_rs1['nama']);?> --> RAPORT</title>
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
    <td valign="top"><p><big><img src="images/raport.gif" width="146" height="40"></big></p>
      <?php
	  mysql_select_db($database_sisfokol, $sisfokol);

$query_rspel = "SELECT m_pelajaran.*, m_pelajaran.kd AS mpkd, siswa_progstudi.*, siswa_kelas.* ".
				"FROM m_pelajaran, siswa_progstudi, siswa_kelas ".
				"WHERE m_pelajaran.kd_progstudi = siswa_progstudi.kd_progstudi ".
				"AND m_pelajaran.kd_kelas = siswa_kelas.kd_kelas ".
				"AND siswa_progstudi.status = 'true' ".
				"AND siswa_kelas.status = 'true' ".
				"AND siswa_progstudi.kd_siswa = '$kd' ".
				"AND siswa_kelas.kd_siswa = '$kd'";
$rspel = mysql_query($query_rspel, $sisfokol) or die(mysql_error());
$row_rspel = mysql_fetch_assoc($rspel);
$totalRows_rspel = mysql_num_rows($rspel);?>
      <strong>Pelajaran : </strong> 
      <table width="450" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
        <?php 
		do
			{
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
        <tr valign="top" bgcolor="<? echo $warna; ?>">
          <td width="400">- <?php echo $row_rspel['pelajaran'];?></td>
          <td width="50"> 
            <?php
	  mysql_select_db($database_sisfokol, $sisfokol);

$query_rsnil = "SELECT siswa_raport.*, m_nilai_angka.* ".
				"FROM siswa_raport, m_nilai_angka ".
				"WHERE siswa_raport.kd_nilai = m_nilai_angka.kd ".
				"AND siswa_raport.kd_siswa = '$kd' ".
				"AND siswa_raport.kd_pelajaran = '$row_rspel[mpkd]' ".
				"AND siswa_raport.kd_semester = '$row_rssmt[kd]'";
$rsnil = mysql_query($query_rsnil, $sisfokol) or die(mysql_error());
$row_rsnil = mysql_fetch_assoc($rsnil);
$totalRows_rsnil = mysql_num_rows($rsnil);?>
            <div align="center"></div>
            <div align="center"><strong><?php echo $row_rsnil['angka'];?></strong> </div></td>
  </tr><?php
	}
	while ($row_rspel = mysql_fetch_assoc($rspel));
	?>
</table>

      <p> 
        <?php
	  mysql_select_db($database_sisfokol, $sisfokol);

$query_rsekstra = "SELECT m_ekstra.*, m_ekstra.kd as mekd, siswa_ekstra.* ".
					"FROM m_ekstra, siswa_ekstra ".
					"WHERE m_ekstra.kd = siswa_ekstra.kd_ekstra ".
					"AND siswa_ekstra.kd_siswa = '$kd'";
$rsekstra = mysql_query($query_rsekstra, $sisfokol) or die(mysql_error());
$row_rsekstra = mysql_fetch_assoc($rsekstra);
$totalRows_rsekstra = mysql_num_rows($rsekstra);?>
        <strong>Ekstrakurikuler : </strong> 
      <table width="450" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
        <?php 
		do
			{
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
        <tr valign="top" bgcolor="<? echo $warna; ?>">
          <td width="400">- <?php echo $row_rsekstra['ekstra'];?></td>
          <td width="50"> 
            <?php
	  mysql_select_db($database_sisfokol, $sisfokol);

$query_rsnilx = "SELECT siswa_raport_ekstra.*, m_nilai_angka.* ".
				"FROM siswa_raport_ekstra, m_nilai_angka ".
				"WHERE siswa_raport_ekstra.kd_nilai = m_nilai_angka.kd ".
				"AND siswa_raport_ekstra.kd_siswa = '$kd' ".
				"AND siswa_raport_ekstra.kd_ekstra = '$row_rsekstra[mekd]' ".
				"AND siswa_raport_ekstra.kd_semester = '$row_rssmt[kd]'";
$rsnilx = mysql_query($query_rsnilx, $sisfokol) or die(mysql_error());
$row_rsnilx = mysql_fetch_assoc($rsnilx);
$totalRows_rsnilx = mysql_num_rows($rsnilx);?>
            <div align="center"><strong><?php echo $row_rsnilx['angka'];?></strong> </div></td>
  </tr><?php
	}
	while ($row_rsekstra = mysql_fetch_assoc($rsekstra));
	?>
</table>
      <p> 
        <?php
	  mysql_select_db($database_sisfokol, $sisfokol);

$query_rsabs = "SELECT * ".
					"FROM m_ket";
$rsabs = mysql_query($query_rsabs, $sisfokol) or die(mysql_error());
$row_rsabs = mysql_fetch_assoc($rsabs);
$totalRows_rsabs = mysql_num_rows($rsabs);?>
        <strong>Absensi : </strong> 
      <table width="450" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
        <?php 
		do
			{
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
        <tr valign="top" bgcolor="<? echo $warna; ?>">
          <td width="400">- <?php echo $row_rsabs['ket'];?></td>
          <td width="50"> 
            <?php
	  mysql_select_db($database_sisfokol, $sisfokol);

$query_rsnils = "SELECT * ".
				"FROM siswa_raport_absensi ".
				"WHERE kd_siswa = '$kd' ".
				"AND kd_tapel = '$row_rstapel[kd]' ".
				"AND kd_semester = '$row_rssmt[kd]' ".
				"AND kd_ket = '$row_rsabs[kd]' ";
$rsnils = mysql_query($query_rsnils, $sisfokol) or die(mysql_error());
$row_rsnils = mysql_fetch_assoc($rsnils);
$totalRows_rsnils = mysql_num_rows($rsnils);?>
            <div align="center"><strong><?php echo $row_rsnils['jml'];?></strong> </div></td>
  </tr><?php
	}
	while ($row_rsabs = mysql_fetch_assoc($rsabs));
	?>
</table></p>
      <p><strong>Rangking : </strong>
        <?php
	  mysql_select_db($database_sisfokol, $sisfokol);

$query_rsking = "SELECT * ".
				"FROM siswa_raport_rangking ".
				"WHERE kd_siswa = '$kd' ".
				"AND kd_tapel = '$row_rstapel[kd]' ".
				"AND kd_semester = '$row_rssmt[kd]'";
$rsking = mysql_query($query_rsking, $sisfokol) or die(mysql_error());
$row_rsking = mysql_fetch_assoc($rsking);
$totalRows_rsking = mysql_num_rows($rsking);?>
        <font color="#FF0000"><?php echo $row_rsking['rangking'];?></font></p></td>
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