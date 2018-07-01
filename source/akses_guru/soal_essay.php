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

//******************************************** AKSES GURU :??? ************************************///
//ambil nilai
$kd = $_SESSION['kd_session'];
$username = $_SESSION['username_session'];
$password = $_SESSION['password_session'];


//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rsx = "SELECT m_pegawai.*, m_guru.kd AS mgkd, m_guru.* ".
				"FROM m_pegawai, m_guru ".
				"WHERE m_pegawai.kd = m_guru.kd_pegawai ".
				"AND m_pegawai.kd = '$kd' ".
				"AND m_pegawai.nip = '$username'";
$rsx= mysql_query($query_rsx, $sisfokol) or die(mysql_error());
$row_rsx = mysql_fetch_assoc($rsx);
$totalRows_rsx = mysql_num_rows($rsx);

//******************************************** TOPIK ************************************************//

//ambil nilai
$pageNum_rs1  = cegah($_REQUEST["pageNum_rs1"]);
$totalRows_rs1  = cegah($_REQUEST["totalRows_rs1"]);
$mprogkd  = cegah($_REQUEST["mprogkd"]);
$mpelkd  = cegah($_REQUEST["mpelkd"]);
$mkelkd = cegah($_REQUEST["mkelkd"]);


$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_rs1 = 20;
$pageNum_rs1 = 0;
if (isset($HTTP_GET_VARS['pageNum_rs1'])) {
  $pageNum_rs1 = $HTTP_GET_VARS['pageNum_rs1'];
}
$startRow_rs1 = $pageNum_rs1 * $maxRows_rs1;

mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT * FROM soal_essay ".
				"WHERE kd_tapel = '$row_rstapel[kd]' ".
				"AND kd_semester = '$row_rssmt[kd]' ".
				"AND kd_progstudi = '$mprogkd' ".
				"AND kd_kelas = '$mkelkd' ".
				"AND kd_pelajaran = '$mpelkd' ".
				"AND kd_guru = '$row_rsx[mgkd]' ".
				"ORDER BY topik ASC";
					
$query_limit_rs1 = sprintf("%s LIMIT %d, %d", $query_rs1, $startRow_rs1, $maxRows_rs1);
$rs1 = mysql_query($query_limit_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);

if (isset($HTTP_GET_VARS['totalRows_rs1'])) {
  $totalRows_rs1 = $HTTP_GET_VARS['totalRows_rs1'];
} else {
  $all_rs1 = mysql_query($query_rs1);
  $totalRows_rs1 = mysql_num_rows($all_rs1);
}
$totalPages_rs1 = ceil($totalRows_rs1/$maxRows_rs1)-1;

$queryString_rs1 = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs1") == false && 
        stristr($param, "totalRows_rs1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs1 = "&" . implode("&", $newParams);
  }
}
$queryString_rs1 = sprintf("&totalRows_rs1=%d%s", $totalRows_rs1, $queryString_rs1);

?>
<html>
<head>
<title>Guru : <?php echo balikin($row_rsx['nama']);?> --> Soal Essay</title>
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
    <td valign="top"> <div align="left">
        <p><img src="images/soal_essay.gif" width="194" height="40"></p>
        <p>(<a href="soal_essay_topik_add.php">Tambah Topik</a>)</p>
        <p>
          <?php include("include/tapel.php"); ?>
        </p>
        <p> 
          <?php include("include/smt.php"); ?>
        </p>
        <p> 
          <select name="kategori" id="kategori" onChange="MM_jumpMenu('parent',this,0)">
            <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT m_guru.kd AS mgkd, m_guru.*, m_progstudi.kd AS mprogkd, m_progstudi.*, ".
				"m_kelas.kd AS mkelkd, m_kelas.*, m_pelajaran.kd AS mpelkd, m_pelajaran.* ".
				"FROM m_guru, m_progstudi, m_kelas, m_pelajaran ".
				"WHERE m_guru.kd_pelajaran = m_pelajaran.kd ".
				"AND m_guru.kd_progstudi = m_progstudi.kd ".
				"AND m_guru.kd_kelas = m_kelas.kd ".
				"AND m_guru.kd_pegawai = '$kd'";
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
            --Kategori--
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
            <option value="soal_essay.php?mgkd=<?php echo $row_rsi['mgkd'];?>&mpelkd=<?php echo $row_rsi['mpelkd'];?>&pelajaran=<?php echo urlencode(balikin($row_rsi['pelajaran']));?>&mprogkd=<?php echo $row_rsi['mprogkd'];?>&progstudi=<?php echo urlencode(balikin($row_rsi['progstudi']));?>&mkelkd=<?php echo $row_rsi['mkelkd'];?>&kelas=<?php echo balikin($row_rsi['kelas']);?>"><?php echo balikin($row_rsi['pelajaran']);?> 
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
          </select>
        <p> 
          <?php
		//belum dipilih
		if ($_REQUEST['mpelkd'] == "")
			{
			?>
          <font color="#FF0000"><strong>Pilih Dahulu Kategorinya!</strong></font> 
          <?php
			}
			
///nek isih kosong
	else if ($totalRows_rs1 == 0)
		{
		?>
          <strong><font color="#FF0000"> TIDAK ADA TOPIK.</font></strong> 
          <?php
		}
		else if ($totalRows_rs1 != 0)//nek eneng isine...
	  	{ 
		?>
        <table width="500" border="0" cellpadding="2" cellspacing="0">
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
		?><tr valign="top" bgcolor="<? echo $warna; ?>"> 
            <td><a href="soal_essay_soal.php?mgkd=<?php echo $_REQUEST['mgkd'];?>&mpelkd=<?php echo $_REQUEST['mpelkd'];?>&pelajaran=<?php echo urlencode(balikin($_REQUEST['pelajaran']));?>&mprogkd=<?php echo $_REQUEST['mprogkd'];?>&progstudi=<?php echo urlencode(balikin($_REQUEST['progstudi']));?>&mkelkd=<?php echo $_REQUEST['mkelkd'];?>&kelas=<?php echo balikin($_REQUEST['kelas']);?>&topikkd=<?php echo $row_rs1['kd'];?>&topik=<?php echo urlencode(balikin($row_rs1['topik']));?>"><?php echo balikin($row_rs1['topik']);?></a> [<a href="soal_essay_topik_del.php?mgkd=<?php echo $row_rsi['mgkd'];?>&mpelkd=<?php echo $row_rsi['mpelkd'];?>&pelajaran=<?php echo urlencode(balikin($row_rsi['pelajaran']));?>&mprogkd=<?php echo $row_rsi['mprogkd'];?>&progstudi=<?php echo urlencode(balikin($row_rsi['progstudi']));?>&mkelkd=<?php echo $row_rsi['mkelkd'];?>&kelas=<?php echo balikin($row_rsi['kelas']);?>&kd=<?php echo $row_rs1['kd'];?>">HAPUS</a>]</td>
  </tr>
  
  <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); 
		
		}
		?>
</table>

		
		
		
		
		
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