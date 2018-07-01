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

////////////////////////////////////////////// KATEGORI NILAI ///////////////////////////////////////
mysql_select_db($database_sisfokol, $sisfokol);

$query_rskat = "SELECT * FROM m_nilai_kat ORDER BY kat ASC";
$rskat = mysql_query($query_rskat, $sisfokol) or die(mysql_error());
$row_rskat = mysql_fetch_assoc($rskat);
$totalRows_rskat = mysql_num_rows($rskat);

////////////////////////////////////////////// DATA - DATA NILAI ////////////////////////////////////
//ambil nilai
$pageNum_rsx  = cegah($_REQUEST["pageNum_rsx"]);
$totalRows_rsx  = cegah($_REQUEST["totalRows_rsx"]);
$mpelkd  = cegah($_REQUEST["mpelkd"]);
$pelajaran = cegah($_REQUEST["pelajaran"]);


$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_rsx = 20;
$pageNum_rsx = 0;
if (isset($HTTP_GET_VARS['pageNum_rsx'])) {
  $pageNum_rsx = $HTTP_GET_VARS['pageNum_rsx'];
}
$startRow_rsx = $pageNum_rsx * $maxRows_rsx;

mysql_select_db($database_sisfokol, $sisfokol);

$query_rsx = "SELECT * FROM siswa_nilai ".
				"WHERE kd_tapel = '$row_rstapel[kd]' ".
				"AND kd_semester = '$row_rssmt[kd]' ".
				"AND kd_pelajaran = '$mpelkd' ".
				"AND kd_siswa = '$kd'";
					
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
<title><?php echo balikin($row_rs1['nama']);?> --> NILAI</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/siswa.css" rel="stylesheet" type="text/css">
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
  <tr valign="top"> 
    <td valign="top"><p><big><img src="images/nilai.gif" width="198" height="40"></big></p>
      <p> 
        <select name="pelajaran" id="pelajaran" onChange="MM_jumpMenu('parent',this,0)">
          <?
mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT siswa_progstudi.*, siswa_kelas.*, m_pelajaran.kd AS mpelkd, m_pelajaran.* ".
				"FROM siswa_progstudi, siswa_kelas, m_pelajaran ".
				"WHERE siswa_progstudi.kd_progstudi = m_pelajaran.kd_progstudi ".
				"AND siswa_kelas.kd_kelas = m_pelajaran.kd_kelas ".
				"AND siswa_progstudi.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_kelas.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_progstudi.status = 'true' ".
				"AND siswa_kelas.status = 'true' ".
				"AND siswa_progstudi.kd_siswa = '$kd_session' ".
				"AND siswa_kelas.kd_siswa = '$kd_session'";
$rsi = mysql_query($query_rsi, $sisfokol) or die(mysql_error());
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
          <?php echo balikin($_REQUEST['pelajaran']);?> 
          <?php
				}
				?>
          </option>
          <?
			do 
				{  
				?>
          <option value="nilai.php?mpelkd=<?php echo $row_rsi['mpelkd'];?>&pelajaran=<?php echo balikin($row_rsi['pelajaran']);?>"><?php echo balikin($row_rsi['pelajaran']);?></option>
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
      <p> 
        <?php 
	  //pelajaran belum dipilih
	  if ($mpelkd == "")
	  	{
		?>
        <font color="#FF0000"><strong>Pelajaran Belum Dipilih!</strong></font> 
        <?php
		}
	else
		{
		?>
      <table width="250" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
        <tr> 
          <td width="210"><font color="#FFFFFF"><strong>Kategori Nilai</strong></font></td>
          <td width="40"><div align="center"><font color="#FFFFFF"><strong>Nilai</strong></font></div></td>
        </tr>
      </table>
      <table width="250" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
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
          <td width="210"><?php echo balikin($row_rskat['kat']);?></td>
          <td width="42"> 
            <?php
		  mysql_select_db($database_sisfokol, $sisfokol);

$query_rster = "SELECT m_nilai_angka.*, siswa_nilai.* ".
				"FROM m_nilai_angka, siswa_nilai ".
				"WHERE siswa_nilai.kd_nilai_angka = m_nilai_angka.kd ".
				"AND siswa_nilai.kd_nilai_kat = '$row_rskat[kd]' ".
				"AND siswa_nilai.kd_pelajaran = '$mpelkd' ".
				"AND siswa_nilai.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_nilai.kd_semester = '$row_rssmt[kd]'";
$rster = mysql_query($query_rster, $sisfokol) or die(mysql_error());
$row_rster = mysql_fetch_assoc($rster);
$totalRows_rster = mysql_num_rows($rster);
?>
            <div align="center">
              <?php 
//jika kosong
if ($row_rster['angka'] == "")
	{
	echo "-";
	}

else
	{
	echo $row_rster['angka'];
	}
?>
            </div></td>
        </tr>
        <?php
			}
			 while ($row_rskat = mysql_fetch_assoc($rskat));
		
		?>
      </table>

		
		<?php
		}
		?></p></td>
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