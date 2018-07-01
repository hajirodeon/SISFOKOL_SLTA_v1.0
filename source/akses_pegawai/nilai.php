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

//konek db
require_once('../Connections/sisfokol.php');

//fungsi-fungsi
include("../include/function.php"); 

//ambil nilai session
$kd_session = $_SESSION['kd_session'];
	  	  
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT m_pegawai.*, pegawai_nilai.* ".
				"FROM m_pegawai, pegawai_nilai ".
				"WHERE m_pegawai.kd = pegawai_nilai.kd_pegawai ".
				"AND m_pegawai.kd = '$kd_session'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title><?php echo balikin($row_rs1['nama']);?> --> Nilai - Nilai</title>
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
    <td valign="top"> <div align="left"> 
        <p><strong><img src="images/nilai.gif" width="195" height="40"></strong></p>
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr> 
            <td width="16%">Kesetiaan</td>
            <td width="1%">:</td>
            <td width="83%"> 
              <?php	
		mysql_select_db($database_sisfokol, $sisfokol);

$query_rssetia = "SELECT pegawai_nilai.*, m_huruf.* ".
				"FROM pegawai_nilai, m_huruf ".
				"WHERE pegawai_nilai.kesetiaan = m_huruf.kd ".
				"AND m_huruf.kd = '$row_rs1[kesetiaan]'";
$rssetia= mysql_query($query_rssetia, $sisfokol) or die(mysql_error());
$row_rssetia = mysql_fetch_assoc($rssetia);
$totalRows_rssetia = mysql_num_rows($rssetia);
		
		?>
              <?php 
			  if ($row_rssetia['huruf'] == "")
			  	{
				echo "-";
				}
			
			else
				{			  
			  	echo balikin($row_rssetia['huruf']);
				}
			  ?>
            </td>
          </tr>
          <tr> 
            <td>Prestasi Kerja</td>
            <td>:</td>
            <td> 
              <?php
		mysql_select_db($database_sisfokol, $sisfokol);

$query_rsprest = "SELECT pegawai_nilai.*, m_huruf.* ".
				"FROM pegawai_nilai, m_huruf ".
				"WHERE pegawai_nilai.prestasi_kerja = m_huruf.kd ".
				"AND m_huruf.kd = '$row_rs1[prestasi_kerja]'";
$rsprest= mysql_query($query_rsprest, $sisfokol) or die(mysql_error());
$row_rsprest = mysql_fetch_assoc($rsprest);
$totalRows_rsprest = mysql_num_rows($rsprest);
		
		?>
              <?php 
			  if ($row_rsprest['huruf'] == "")
			  	{
				echo "-";
				}
			
			else
				{			  
			  	echo balikin($row_rsprest['huruf']);
				}
			  ?>
            </td>
          </tr>
          <tr> 
            <td>Tanggung Jawab</td>
            <td>:</td>
            <td> 
              <?php
		mysql_select_db($database_sisfokol, $sisfokol);

$query_rstang = "SELECT pegawai_nilai.*, m_huruf.* ".
				"FROM pegawai_nilai, m_huruf ".
				"WHERE pegawai_nilai.tanggung_jawab = m_huruf.kd ".
				"AND m_huruf.kd = '$row_rs1[tanggung_jawab]'";
$rstang= mysql_query($query_rstang, $sisfokol) or die(mysql_error());
$row_rstang = mysql_fetch_assoc($rstang);
$totalRows_rstang = mysql_num_rows($rstang);
		
		?>
              <?php 
			  if ($row_rstang['huruf'] == "")
			  	{
				echo "-";
				}
			
			else
				{			  
			  	echo balikin($row_rstang['huruf']);
				}
			  ?>
            </td>
          </tr>
          <tr> 
            <td>Kejujuran</td>
            <td>:</td>
            <td> 
              <?php
		mysql_select_db($database_sisfokol, $sisfokol);

$query_rskeju = "SELECT pegawai_nilai.*, m_huruf.* ".
				"FROM pegawai_nilai, m_huruf ".
				"WHERE pegawai_nilai.kejujuran = m_huruf.kd ".
				"AND m_huruf.kd = '$row_rs1[kejujuran]'";
$rskeju= mysql_query($query_rskeju, $sisfokol) or die(mysql_error());
$row_rskeju = mysql_fetch_assoc($rskeju);
$totalRows_rskeju = mysql_num_rows($rskeju);
		
		?>
              <?php 
			  if ($row_rskeju['huruf'] == "")
			  	{
				echo "-";
				}
			
			else
				{			  
			  	echo balikin($row_rskeju['huruf']);
				}
			  ?>
            </td>
          </tr>
          <tr> 
            <td>Kerja Sama</td>
            <td>:</td>
            <td> 
              <?php
		mysql_select_db($database_sisfokol, $sisfokol);

$query_rsker = "SELECT pegawai_nilai.*, m_huruf.* ".
				"FROM pegawai_nilai, m_huruf ".
				"WHERE pegawai_nilai.kerja_sama = m_huruf.kd ".
				"AND m_huruf.kd = '$row_rs1[kerja_sama]'";
$rsker= mysql_query($query_rsker, $sisfokol) or die(mysql_error());
$row_rsker = mysql_fetch_assoc($rsker);
$totalRows_rskeru = mysql_num_rows($rsker);
		
		?>
              <?php 
			  if ($row_rsker['huruf'] == "")
			  	{
				echo "-";
				}
			
			else
				{			  
			  	echo balikin($row_rsker['huruf']);
				}
			  ?>
            </td>
          </tr>
          <tr> 
            <td>Prakarsa</td>
            <td>:</td>
            <td> 
              <?php
		mysql_select_db($database_sisfokol, $sisfokol);

$query_rspra = "SELECT pegawai_nilai.*, m_huruf.* ".
				"FROM pegawai_nilai, m_huruf ".
				"WHERE pegawai_nilai.prakarsa = m_huruf.kd ".
				"AND m_huruf.kd = '$row_rs1[prakarsa]'";
$rspra= mysql_query($query_rspra, $sisfokol) or die(mysql_error());
$row_rspra = mysql_fetch_assoc($rspra);
$totalRows_rspra = mysql_num_rows($rspra);
		
		?>
              <?php 
			  if ($row_rspra['huruf'] == "")
			  	{
				echo "-";
				}
			
			else
				{			  
			  	echo balikin($row_rspra['huruf']);
				}
			  ?>
            </td>
          </tr>
          <tr> 
            <td>Kepemimpinan</td>
            <td>:</td>
            <td> 
              <?php
		mysql_select_db($database_sisfokol, $sisfokol);

$query_rskepem = "SELECT pegawai_nilai.*, m_huruf.* ".
				"FROM pegawai_nilai, m_huruf ".
				"WHERE pegawai_nilai.kepemimpinan = m_huruf.kd ".
				"AND m_huruf.kd = '$row_rs1[kepemimpinan]'";
$rskepem= mysql_query($query_rskepem, $sisfokol) or die(mysql_error());
$row_rskepem = mysql_fetch_assoc($rskepem);
$totalRows_rskepem = mysql_num_rows($rskepem);
		
		?>
              <?php 
			  if ($row_rskepem['huruf'] == "")
			  	{
				echo "-";
				}
			
			else
				{			  
			  	echo balikin($row_rskepem['huruf']);
				}
			  ?>
            </td>
          </tr>
        </table>
        <p>&nbsp; </p>
        <br>
      </div>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><big></big></p>
      <p>&nbsp;</p></td>
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