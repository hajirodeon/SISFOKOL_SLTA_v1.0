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
include("include/itapel.php"); 
include("include/ismt.php"); 

//ambil nilai
$kd = $_SESSION['kd_session'];
$username = $_SESSION['username_session'];
$password = $_SESSION['password_session'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT * FROM m_pegawai ".
				"WHERE kd = '$kd' ".
				"AND nip = '$username'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);


////////////////////////////////////// DAFTAR NILAI SISWA ///////////////////////////////////////////////
//ambil nilai
$pageNum_rsx  = cegah($_REQUEST["pageNum_rsx"]);
$totalRows_rsx  = cegah($_REQUEST["totalRows_rsx"]);
$mprogkd  = cegah($_REQUEST["mprogkd"]);
$mpelkd  = cegah($_REQUEST["mpelkd"]);
$mkelkd = cegah($_REQUEST["mkelkd"]);
$mrkd = cegah($_REQUEST["mrkd"]);


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
				"AND siswa_progstudi.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_kelas.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_ruang.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_progstudi.kd_progstudi = '$mprogkd' ".
				"AND siswa_kelas.kd_kelas = '$mkelkd' ".
				"AND siswa_ruang.kd_ruang = '$mrkd'";
					
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
<title>Guru : <?php echo balikin($row_rs1['nama']);?> --> Daftar Nilai</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/guru.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
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
    <td valign="top"> <p align="left"><big><img src="images/daftar_nilai.gif" width="205" height="40"></big></p>
      <p align="left">Pelajaran : 
        <br>
		<select name="pelajaran" id="pelajaran" onChange="MM_jumpMenu('parent',this,0)">
          <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT m_guru.kd AS mgkd, m_guru.*, m_progstudi.kd AS mprogkd, m_progstudi.*, ".
				"m_kelas.kd AS mkelkd, m_kelas.*, m_pelajaran.kd AS mpelkd, m_pelajaran.* ".
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
          <option selected> 
            <?php
			  //jika kosong
			  if ($_REQUEST['mpelkd'] == "")
			  	{
				?>
            -Pelajaran-
            <?php
				}
			else 
				{
				?>
            <?php echo balikin($_REQUEST['pelajaran']);?> --> Program Studi : <?php echo balikin($_REQUEST['progstudi']);?>, 
            Kelas : <?php echo balikin($_REQUEST['kelas']);?> 
            <?php
				}
				?>
            </option>
            <?
			do 
				{  
				?>
            <option value="nilai.php?mgkd=<?php echo $row_rsi['mgkd'];?>&mpelkd=<?php echo $row_rsi['mpelkd'];?>&pelajaran=<?php echo urlencode(balikin($row_rsi['pelajaran']));?>&mprogkd=<?php echo $row_rsi['mprogkd'];?>&progstudi=<?php echo urlencode(balikin($row_rsi['progstudi']));?>&mkelkd=<?php echo $row_rsi['mkelkd'];?>&kelas=<?php echo balikin($row_rsi['kelas']);?>"><?php echo balikin($row_rsi['pelajaran']);?> 
            --> Program Studi : <?php echo balikin($row_rsi['progstudi']);?>, 
            Kelas : <?php echo balikin($row_rsi['kelas']);?></option>
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
      <p align="left">Ruang : <br>
        <select name="ruang" id="ruang" onChange="MM_jumpMenu('parent',this,0)">
          <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT * FROM m_ruang ORDER BY ruang ASC";
$rsi= mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);			
?>
          <option selected> 
          <?php
			  //jika kosong
			  if ($_REQUEST['mrkd'] == "")
			  	{
				?>
          -Ruang- 
          <?php
				}
			else 
				{
				?>
          <?php echo $_REQUEST['ruang'];?> 
          <?php
				}
				?>
          </option>
          <?
			do 
				{  
				?>
          <option value="nilai.php?mgkd=<?php echo $_REQUEST['mgkd'];?>&mpelkd=<?php echo $_REQUEST['mpelkd'];?>&pelajaran=<?php echo urlencode(balikin($_REQUEST['pelajaran']));?>&mprogkd=<?php echo $_REQUEST['mprogkd'];?>&progstudi=<?php echo urlencode(balikin($_REQUEST['progstudi']));?>&mkelkd=<?php echo $_REQUEST['mkelkd'];?>&kelas=<?php echo balikin($_REQUEST['kelas']);?>&mrkd=<?php echo $row_rsi['kd'];?>&ruang=<?php echo $row_rsi['ruang'];?>"><?php echo balikin($row_rsi['ruang']);?></option>
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
        </select>
      </p>
      <p align="left">Kategori Nilai : <br>
        <select name="nilai" id="nilai" onChange="MM_jumpMenu('parent',this,0)">
          <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT * FROM m_nilai_kat ORDER BY kat ASC";
$rsi= mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);			
?>
          <option selected> 
          <?php
			  //jika kosong
			  if ($_REQUEST['mnkd'] == "")
			  	{
				?>
          -Kategori Nilai- 
          <?php
				}
			else 
				{
				?>
          <?php echo $_REQUEST['kat'];?> 
          <?php
				}
				?>
          </option>
          <?
			do 
				{  
				?>
          <option value="nilai.php?mgkd=<?php echo $_REQUEST['mgkd'];?>&mpelkd=<?php echo $_REQUEST['mpelkd'];?>&pelajaran=<?php echo urlencode(balikin($_REQUEST['pelajaran']));?>&mprogkd=<?php echo $_REQUEST['mprogkd'];?>&progstudi=<?php echo urlencode(balikin($_REQUEST['progstudi']));?>&mkelkd=<?php echo $_REQUEST['mkelkd'];?>&kelas=<?php echo balikin($_REQUEST['kelas']);?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&mnkd=<?php echo $row_rsi['kd'];?>&kat=<?php echo $row_rsi['kat'];?>"><?php echo balikin($row_rsi['kat']);?></option>
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
      <p align="left"> 
        <?php
	  //jika pelajaran belum dipilih
	  if ($_REQUEST['mpelkd'] == "")
	  	{
		?>
        <font color="#FF0000"><strong>Pilih Dahulu Pelajarannya!</strong></font> 
        <?php
		}
	else if ($_REQUEST['mrkd'] == "")
		{
		?>
        <font color="#FF0000"><strong>Ruang apa?</strong></font> 
        <?php
		}
	else if ($_REQUEST['mnkd'] == "")
		{
		?><font color="#FF0000"><strong>Kategori Nilai Belum Dipilih!</strong></font> 
		<?php
		} 
	///nek isih kosong
	else if ($totalRows_rsx == 0)
		{?>
        <strong><font color="#FF0000">TIDAK ADA DATA SISWA</font></strong> 
        <?php
		}
	else
		{
		?>
      </p>
	  <table width="430" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
        <tr> 
          <td width="22%"><font color="#FFFFFF"><strong>NIS</strong></font></td>
          <td width="61%"><font color="#FFFFFF"><strong>Nama</strong></font></td>
          <td width="17%"><strong><font color="#FFFFFF">Nilai</font></strong></td>
        </tr>
      </table>

	  
	  
	  <table width="430" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
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
          <td width="22%"><?php echo $row_rsx['nis'];?></td>
          <td width="61%"><?php echo balikin($row_rsx['nama']);?></td>
          <td width="17%"><select name="nilai" id="nilai" onChange="MM_jumpMenu('parent',this,0)">
          <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT m_nilai_angka.* ".
				"FROM m_nilai_angka";
$rsi= mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);			
?>
          <option selected> 
          <?php
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsis = "SELECT m_nilai_angka.*, siswa_nilai.* ".
				"FROM m_nilai_angka, siswa_nilai ".
				"WHERE m_nilai_angka.kd = siswa_nilai.kd_nilai_angka ".
				"AND siswa_nilai.kd_nilai_kat = '$mnkd' ".
				"AND siswa_nilai.kd_siswa = '$row_rsx[kd]'";
$rsis= mysql_query($query_rsis, $sisfokol) or die(mysql_error());
$row_rsis = mysql_fetch_assoc($rsis);
$totalRows_rsis = mysql_num_rows($rsis);

			  //jika kosong
			  if ($row_rsis['kd_nilai_angka'] == "")
			  	{
				?>
          -Nilai- 
          <?php
				}
			else 
				{
				?>
          <?php echo $row_rsis['angka'];?> 
          <?php
				}
				?>
          </option>
          <?
			do 
				{  
				?>
          <option value="nilai1.php?tapelkd=<?php echo $row_rstapel['kd'];?>&smtkd=<?php echo $row_rssmt['kd'];?>&mgkd=<?php echo $_REQUEST['mgkd'];?>&mpelkd=<?php echo $_REQUEST['mpelkd'];?>&pelajaran=<?php echo urlencode(balikin($_REQUEST['pelajaran']));?>&mprogkd=<?php echo $_REQUEST['mprogkd'];?>&progstudi=<?php echo urlencode(balikin($_REQUEST['progstudi']));?>&mkelkd=<?php echo $_REQUEST['mkelkd'];?>&kelas=<?php echo balikin($_REQUEST['kelas']);?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&mnkd=<?php echo $_REQUEST['mnkd'];?>&kat=<?php echo $_REQUEST['kat'];?>&angkakd=<?php echo $row_rsi['kd'];?>&angka=<?php echo $row_rsi['angka'];?>&siswakd=<?php echo $row_rsx['kd'];?>"><?php echo balikin($row_rsi['angka']);?></option>
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
        </select>&nbsp;</td>
        </tr>
        <?php } while ($row_rsx = mysql_fetch_assoc($rsx)); ?>
      </table>
	  <p>&nbsp;</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td> 
            <?php if ($pageNum_rs1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, 0, $queryString_rs1); ?>">Awal</a> 
            <?php 
		  		}
		  else
		  		{
				?>
            <font color="#CCCCCC">Awal</font> 
            <?
		  } // Show if not first page ?>
            <?php if ($pageNum_rs1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, max(0, $pageNum_rs1 - 1), $queryString_rs1); ?>">Sebelumnya</a> 
            <?php 
		  		}
		  else
		  		{
				?>
            <font color="#CCCCCC">Sebelumnya</font> 
            <?
		  } // Show if not first page ?>
            <?php if ($pageNum_rs1 < $totalPages_rs1) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, min($totalPages_rs1, $pageNum_rs1 + 1), $queryString_rs1); ?>">Selanjutnya</a> 
            <?php 
		  		}
		  else
		  		{?>
            <font color="#CCCCCC">Selanjutnya</font> 
            <?
		  } // Show if not last page ?>
            <?php if ($pageNum_rs1 < $totalPages_rs1) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, $totalPages_rs1, $queryString_rs1); ?>">Terakhir</a> 
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
      <p>&nbsp;</p>
      <p> 
        <?php
	  }
	  ?>
      </p></td>
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