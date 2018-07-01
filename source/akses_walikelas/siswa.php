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
$mpkd = $_REQUEST['mpkd'];
$mkkd = $_REQUEST['mkkd'];
$mrkd = $_REQUEST['mrkd'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT * FROM m_pegawai ".
				"WHERE kd = '$kd' ".
				"AND nip = '$username'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);


//daftar siswa
$pageNum_rsx  = cegah($_REQUEST["pageNum_rsx"]);
$totalRows_rsx  = cegah($_REQUEST["totalRows_rsx"]);

$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_rsx = 20;
$pageNum_rsx = 0;
if (isset($HTTP_GET_VARS['pageNum_rsx'])) {
  $pageNum_rsx = $HTTP_GET_VARS['pageNum_rsx'];
}
$startRow_rsx = $pageNum_rsx * $maxRows_rsx;

mysql_select_db($database_sisfokol, $sisfokol);

$query_rsx = "SELECT m_siswa.*, siswa_progstudi.*, siswa_kelas.*, siswa_ruang.* ".
				"FROM m_siswa, siswa_progstudi, siswa_kelas, siswa_ruang ".
				"WHERE m_siswa.kd = siswa_progstudi.kd_siswa ".
				"AND m_siswa.kd = siswa_kelas.kd_siswa ".
				"AND m_siswa.kd = siswa_ruang.kd_siswa ".
				"AND siswa_progstudi.kd_progstudi = '$mpkd' ".
				"AND siswa_kelas.kd_kelas = '$mkkd' ".
				"AND siswa_ruang.kd_ruang = '$mrkd' ".
				"ORDER BY m_siswa.nis ASC";
					
$query_limit_rsx = sprintf("%s LIMIT %d, %d", $query_rsx, $startRow_rsx, $maxRows_rsx);
$rsx = mysql_query($query_limit_rsx, $sisfokol) or die(mysql_error());
$row_rsx = mysql_fetch_assoc($rsx);

if (isset($HTTP_GET_VARS['totalRows_rsx'])) {
  $totalRows_rsx = $HTTP_GET_VARS['totalRows_rsx'];
} else {
  $all_rsx = mysql_query($query_rsx);
  $totalRows_rsx = mysql_num_rows($all_rsx);
}
$totalPages_rsx = ceil($totalRows_rsx/$maxRows_rsx)-1;

$queryString_rsx = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsx") == false && 
        stristr($param, "totalRows_rsx") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsx = "&" . implode("&", $newParams);
  }
}
$queryString_rsx = sprintf("&totalRows_rsx=%d%s", $totalRows_rsx, $queryString_rsx);
?>
<html>
<head>
<title>Wali Kelas : <?php echo balikin($row_rs1['nama']);?> --> Daftar Siswa</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/walikelas.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="middle"> 
    <td valign="top"> <div align="left">
        <p><big><img src="images/daftar_siswa.gif" width="262" height="40"></big></p>
        <p>
<select name="kategori" id="kategori" onChange="MM_jumpMenu('parent',this,0)">
            <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT m_pegawai.*, m_ruang_kelas.*, m_progstudi.kd AS mpkd, m_progstudi.*, ".
				"m_kelas.kd AS mkkd, m_kelas.*, m_ruang.kd AS mrkd, m_ruang.* ".
				"FROM m_pegawai, m_ruang_kelas, m_progstudi, m_kelas, m_ruang ".
				"WHERE m_ruang_kelas.kd_guru = m_pegawai.kd ".
				"AND m_ruang_kelas.kd_progstudi = m_progstudi.kd ".
				"AND m_ruang_kelas.kd_kelas = m_kelas.kd ".
				"AND m_ruang_kelas.kd_ruang = m_ruang.kd ".
				"AND m_pegawai.kd = '$kd'";
$rsi= mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);			
?>
            <option selected> 
            <?php
			  //jika kosong
			  if ($_REQUEST['mpkd'] == "")
			  	{
				?>
            --Kategori--
            <?php
				}
			else 
				{
				?>
            Program Studi : <?php echo balikin($_REQUEST['progstudi']);?>, Kelas : <?php echo balikin($_REQUEST['kelas']);?>, Ruang : <?php echo balikin($_REQUEST['ruang']);?>
            <?php
				}
				?>
            </option>
            <?
			do 
				{  
				?>
            <option value="siswa.php?mpkd=<?php echo $row_rsi['mpkd'];?>&progstudi=<?php echo $row_rsi['progstudi'];?>&mkkd=<?php echo $row_rsi['mkkd'];?>&kelas=<?php echo $row_rsi['kelas'];?>&mrkd=<?php echo $row_rsi['mrkd'];?>&ruang=<?php echo $row_rsi['ruang'];?>">Program Studi : <?php echo balikin($row_rsi['progstudi']);?>, Kelas : <?php echo balikin($row_rsi['kelas']);?>, Ruang : <?php echo balikin($row_rsi['ruang']);?></option>
            <?
				} 
		
			while ($row_rsi = mysql_fetch_assoc($rsi));
			
			$rows = mysql_num_rows($rsi);
  				if($rows > 0) 
						{
      					mysql_data_seek($rsi, 0);
						$row_rsi = mysql_fetch_assoc($rsi);
  						}
		?>
          </select></p>
        <p> 
          <?php
		//jika belum dipilih
		if ($_REQUEST['mpkd'] == "")
			{
			?>
          <font color="#FF0000"><strong>Kategori Belum Dipilih!</strong></font> 
          <?php
			}
		
		///nek isih kosong
	
	else if ($totalRows_rsx == 0)
		{?>
          <font color="#FF0000"><strong>TIDAK ADA SISWA</strong></font> 
          <?php
		}
		
	else if ($totalRows_rsx != 0)//nek eneng isine...
	  	{ 
		?>
        <table width="500" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="30%"><font color="#FFFFFF"><strong>NIS</strong></font></td>
            <td width="45%"><font color="#FFFFFF"><strong>Nama</strong></font></td>
            <td width="25%">&nbsp;</td>
          </tr>
        </table>

		<table width="500" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
          <?php 	
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
          <tr valign="top" bgcolor="<? echo $warna; ?>">
            <td width="30%"><?php echo $row_rsx['nis'];?></td>
            <td width="45%"><?php echo $row_rsx['nama'];?></td>
            <td width="25%">[<a href="javascript:MM_openBrWindow('siswa_detail.php?kd=<?php echo $row_rsx['kd']; ?>','','width=500,height=250,toolbar=no,menubar=no,location=no,scrollbars=yes,resize=no')">DETAIL</a>]</td>
          </tr>
          <?php } while ($row_rsx = mysql_fetch_assoc($rsx)); ?>
        </table>

		
		
		<p>&nbsp;</p>
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr> 
            <td> 
              <?php if ($pageNum_rsx > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_rsx=%d%s", $currentPage, 0, $queryString_rsx); ?>">Awal</a> 
              <?php 
		  		}
		  else
		  		{
				?>
              <font color="#CCCCCC">Awal</font> 
              <?
		  } // Show if not first page ?>
              <?php if ($pageNum_rsx > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_rsx=%d%s", $currentPage, max(0, $pageNum_rsx - 1), $queryString_rsx); ?>">Sebelumnya</a> 
              <?php 
		  		}
		  else
		  		{
				?>
              <font color="#CCCCCC">Sebelumnya</font> 
              <?
		  } // Show if not first page ?>
              <?php if ($pageNum_rsx < $totalPages_rsx) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsx=%d%s", $currentPage, min($totalPages_rsx, $pageNum_rsx + 1), $queryString_rsx); ?>">Selanjutnya</a> 
              <?php 
		  		}
		  else
		  		{?>
              <font color="#CCCCCC">Selanjutnya</font> 
              <?
		  } // Show if not last page ?>
              <?php if ($pageNum_rsx < $totalPages_rsx) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsx=%d%s", $currentPage, $totalPages_rsx, $queryString_rsx); ?>">Terakhir</a> 
              <?php 
		  		}
		  else
		  		{?>
              <font color="#CCCCCC">Terakhir</font> 
              <?
		  } // Show if not last page ?>
            </td>
          </tr>
        </table>
        <p>
          <?php
		}
		?>
        </p>
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