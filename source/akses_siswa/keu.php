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

$pageNum_rsy  = cegah($_REQUEST["pageNum_rsy"]);
$totalRows_rsy  = cegah($_REQUEST["totalRows_rsy"]);

$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_rsy = 20;
$pageNum_rsy = 0;
if (isset($HTTP_GET_VARS['pageNum_rsy'])) {
  $pageNum_rsy = $HTTP_GET_VARS['pageNum_rsy'];
}
$startRow_rsy = $pageNum_rsy * $maxRows_rsy;

mysql_select_db($database_sisfokol, $sisfokol);

$query_rsy = "SELECT m_siswa.*, siswa_progstudi.*, siswa_kelas.*, siswa_ruang.* ".
				"FROM m_siswa, siswa_progstudi, siswa_kelas, siswa_ruang ".
				"WHERE m_siswa.kd = siswa_progstudi.kd_siswa ".
				"AND m_siswa.kd = siswa_kelas.kd_siswa ".
				"AND m_siswa.kd = siswa_ruang.kd_siswa ".
				"AND siswa_progstudi.kd_progstudi = '$studikod' ".
				"AND siswa_kelas.kd_kelas = '$kelkod' ".
				"AND siswa_ruang.kd_ruang = '$rukod' ".
				"AND siswa_progstudi.status = 'true' ".
				"AND siswa_kelas.status = 'true' ".
				"AND siswa_ruang.status = 'true' ".
				"ORDER BY m_siswa.nis ASC";
					
$query_limit_rsy = sprintf("%s LIMIT %d, %d", $query_rsy, $startRow_rsy, $maxRows_rsy);
$rsy = mysql_query($query_limit_rsy, $sisfokol) or die(mysql_error());
$row_rsy = mysql_fetch_assoc($rsy);

if (isset($HTTP_GET_VARS['totalRows_rsy'])) {
  $totalRows_rsy = $HTTP_GET_VARS['totalRows_rsy'];
} else {
  $all_rsy = mysql_query($query_rsy);
  $totalRows_rsy = mysql_num_rows($all_rsy);
}
$totalPages_rsy = ceil($totalRows_rsy/$maxRows_rsy)-1;

$queryString_rsy = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsy") == false && 
        stristr($param, "totalRows_rsy") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsy = "&" . implode("&", $newParams);
  }
}
$queryString_rsy = sprintf("&totalRows_rsy=%d%s", $totalRows_rsy, $queryString_rsy);

//daftar uang
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_katx = "SELECT * FROM m_uang ORDER BY kategori ASC";
$rs_katx = mysql_query($query_rs_katx, $sisfokol) or die(mysql_error());
$row_rs_katx = mysql_fetch_assoc($rs_katx);
$totalRows_rs_katx = mysql_num_rows($rs_katx);

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
<title><?php echo balikin($row_rs1['nama']);?> --> KEUANGAN</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/siswa.css" rel="stylesheet" type="text/css">
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
  <tr valign="top"> 
    <td valign="top"><p><big><img src="images/keuangan.gif" width="177" height="40"></big></p>
      <p>
        <?php include("../include/tapel.php"); ?>
        <br>
        <?php include("../include/smt.php"); ?>
      <p> 
        <select name="kategori" id="kategori" onChange="MM_jumpMenu('parent',this,0)">
          <?
			if ($_REQUEST['katkod'] == "")
				{			
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_kati = "SELECT * FROM m_uang ORDER BY kategori ASC";
				$rs_kati = mysql_query($query_rs_kati, $sisfokol) or die(mysql_error());
				$row_rs_kati = mysql_fetch_assoc($rs_kati);
				$totalRows_rs_kati = mysql_num_rows($rs_kati);
				?>
          <option selected> 
          <?php 
				//jika kosong
					echo "--Kategori--";
				?>
          </option>
          <?
				}
				
			else
			
				{
				?>
          <option selected> 
          <?
				//ambil nilai
				$katkod = $_REQUEST['katkod'];
				
			//kategori terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_kata = "SELECT * FROM m_uang WHERE kd = '$katkod'";
			$rs_kata = mysql_query($query_rs_kata, $sisfokol) or die(mysql_error());
			$row_rs_kata = mysql_fetch_assoc($rs_kata);
			$totalRows_rs_kata = mysql_num_rows($rs_kata);			
			?>
          <? 
					echo $row_rs_kata['kategori']; 
				?>
          </option>
          <?
				}
			?>
          <?
			do 
				{  
				?>
          <option value="keu.php?katkod=<? echo $row_rs_katx['kd'] ?>&kategori=<? echo $row_rs_katx['kategori'] ?>"><? echo $row_rs_katx['kategori']?></option>
          <?
				} 
		
			while ($row_rs_katx = mysql_fetch_assoc($rs_katx));
			
			$rows = mysql_num_rows($rs_katx);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_katx, 0);
						$row_rs_katx = mysql_fetch_assoc($rs_katx);
  						}
		?>
        </select>
      </p>
      <p> 
        <?php
	  //jika kategori belum dipilih
	  if ($_REQUEST['katkod'] == "")
	  	{
		?>
        <font color="#FF0000"><strong>Kategori Belum Dipilih!</strong></font> 
        <?php
		}
	//jika uang gedung
	else if ($_REQUEST['katkod'] == "4c75242f81285d49b3f18a7a4d210a8f")
		{
		?>
        <strong>Uang Gedung</strong> --> 
        <?php
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rsuged = "SELECT DATE_FORMAT(tgl_bayar, '%d') AS xtgl1, ".
								"DATE_FORMAT(tgl_bayar, '%m') AS xbln1, ".
								"DATE_FORMAT(tgl_bayar, '%Y') AS xthn1, ".
								"siswa_uang_gedung.* FROM siswa_uang_gedung ".
								"WHERE kd_siswa = '$row_rs1[kd]' ".
								"AND kd_uang_gedung = '$katkod'";
			$rsuged = mysql_query($query_rsuged, $sisfokol) or die(mysql_error());
			$row_rsuged = mysql_fetch_assoc($rsuged);
			$totalRows_rsuged = mysql_num_rows($rsuged);
			
			//jika sudah bayar
			if ($totalRows_rsuged != 0) 
			{
			?>
        Sudah Bayar, pada tanggal <strong><?php echo balikin($row_rsuged['xtgl1']); ?> 
        <?php 
		  $nilbln = $row_rsuged['xbln1'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
        <?php echo balikin($row_rsuged['xthn1']); ?></strong>. 
        <?php
			}
		else
			{
			?>
        Belum Bayar. 
        <?php
			}
			?>
        <?
		}
	//jika uang spp
	else if ($_REQUEST['katkod'] == "bad81d085df6c259223d9153cd2fd99b")
		{
		mysql_select_db($database_sisfokol, $sisfokol);
			$query_rsuspp = "SELECT DATE_FORMAT(tgl_bayar, '%d') AS xtgl2, ".
								"DATE_FORMAT(tgl_bayar, '%m') AS xbln2, ".
								"DATE_FORMAT(tgl_bayar, '%Y') AS xthn2, ".
								"siswa_uang_spp.*, bulan.* ".
								"FROM siswa_uang_spp, bulan ".
								"WHERE siswa_uang_spp.kd_bulan = bulan.kd ".
								"AND siswa_uang_spp.kd_siswa = '$row_rs1[kd]' ".
								"AND siswa_uang_spp.kd_uang_spp = '$katkod' ".
								"AND siswa_uang_spp.kd_tapel = '$row_rstapel[kd]'";
			$rsuspp = mysql_query($query_rsuspp, $sisfokol) or die(mysql_error());
			$row_rsuspp = mysql_fetch_assoc($rsuspp);
			$totalRows_rsuspp = mysql_num_rows($rsuspp);
		?>
        <strong>Uang SPP</strong><br>
		 
        <?php
		do
			{
			?>
        - Bulan : <strong><?php echo $row_rsuspp['bulan'];?></strong> --> Tanggal Bayar : 
		<strong><?php echo balikin($row_rsuspp['xtgl2']); ?> 
        <?php 
		  $nilbln = $row_rsuspp['xbln2'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
        <?php echo balikin($row_rsuspp['xthn2']); ?></strong>. <br>
        <?php
			}
			while ($row_rsuspp = mysql_fetch_assoc($rsuspp));
		}
	//jika uang tes
	else if ($_REQUEST['katkod'] == "7a6df9d882fb55dbe4bc9725e64aab57")
		{
		 ?>
        <strong>Uang Tes --&gt; </strong> <?php
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rsutes = "SELECT DATE_FORMAT(tgl_bayar, '%d') AS xtgl3, ".
								"DATE_FORMAT(tgl_bayar, '%m') AS xbln3, ".
								"DATE_FORMAT(tgl_bayar, '%Y') AS xthn3, ".
								"siswa_uang_test.* FROM siswa_uang_test ".
								"WHERE kd_siswa = '$row_rs1[kd]' ".
								"AND kd_uang_tes = '$katkod' ".
								"AND kd_tapel = '$row_rstapel[kd]'";
			$rsutes = mysql_query($query_rsutes, $sisfokol) or die(mysql_error());
			$row_rsutes = mysql_fetch_assoc($rsutes);
			$totalRows_rsutes = mysql_num_rows($rsutes);
			
			//jika sudah bayar
			if ($totalRows_rsutes != 0) 
			{
			?>
        Sudah Bayar, pada tanggal <strong><?php echo balikin($row_rsutes['xtgl3']); ?> 
        <?php 
		  $nilbln = $row_rsutes['xbln3'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
        <?php echo balikin($row_rsutes['xthn3']); ?></strong>. 
        <?php
			}
		else
			{
			?>
        Belum Bayar. 
        <?php
			}
			?>
        <?php
		 }
	
	//jika uang lain
	else if ($_REQUEST['katkod'] == "31c2d890125b4103b7844e813f52cf1a")
		{
		 ?>
        <strong>Uang Lain</strong> --> <?php
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rsulain = "SELECT DATE_FORMAT(tgl_bayar, '%d') AS xtgl4, ".
								"DATE_FORMAT(tgl_bayar, '%m') AS xbln4, ".
								"DATE_FORMAT(tgl_bayar, '%Y') AS xthn4, ".
								"siswa_uang_lain.* FROM siswa_uang_lain ".
								"WHERE kd_siswa = '$row_rs1[kd]' ".
								"AND kd_uang_lain = '$katkod' ".
								"AND kd_tapel = '$row_rstapel[kd]'";
			$rsulain = mysql_query($query_rsulain, $sisfokol) or die(mysql_error());
			$row_rsulain = mysql_fetch_assoc($rsulain);
			$totalRows_rsulain = mysql_num_rows($rsulain);
			
			//jika sudah bayar
			if ($totalRows_rsulain != 0) 
			{
			?>
        Sudah Bayar, pada tanggal <strong><?php echo balikin($row_rsulain['xtgl4']); ?> 
        <?php 
		  $nilbln = $row_rsulain['xbln4'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
        <?php echo balikin($row_rsulain['xthn4']); ?></strong>. 
        <?php
			}
		else
			{
			?>
        Belum Bayar. 
        <?php
			}
			?>
        <?php
		 }
		 ?>
      </p>
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