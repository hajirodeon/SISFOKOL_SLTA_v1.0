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
$studikod = cegah($_REQUEST['studikod']);
$kelkod = cegah($_REQUEST['kelkod']);
$rukod = cegah($_REQUEST['rukod']);
$pageNum_rs1  = cegah($_REQUEST["pageNum_rs1"]);
$totalRows_rs1  = cegah($_REQUEST["totalRows_rs1"]);

$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_rs1 = 20;
$pageNum_rs1 = 0;
if (isset($HTTP_GET_VARS['pageNum_rs1'])) {
  $pageNum_rs1 = $HTTP_GET_VARS['pageNum_rs1'];
}
$startRow_rs1 = $pageNum_rs1 * $maxRows_rs1;

mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT m_siswa.*, siswa_progstudi.*, siswa_kelas.*, siswa_ruang.* ".
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

//daftar uang
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_katx = "SELECT * FROM m_uang ORDER BY kategori ASC";
$rs_katx = mysql_query($query_rs_katx, $sisfokol) or die(mysql_error());
$row_rs_katx = mysql_fetch_assoc($rs_katx);
$totalRows_rs_katx = mysql_num_rows($rs_katx);
?>
<html>
<head>
<title>Keuangan Siswa</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
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
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33%"><img src="images/adm_keu_siswa.gif" width="226" height="40"></td>
          <td width="67%"><div align="right">
              <?php
			include("include/tapel.php"); 
			?>
              , 
              <?php
			include("include/smt.php"); 
			?>
            </div></td>
        </tr>
      </table>
      <p>Kategori : 
        <br><select name="kategori" id="kategori" onChange="MM_jumpMenu('parent',this,0)">
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
					echo "--Pilih Kategori--";
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
          <option value="keu_siswa.php?katkod=<? echo $row_rs_katx['kd'] ?>&kategori=<? echo $row_rs_katx['kategori'] ?>"><? echo $row_rs_katx['kategori']?></option>
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
      <p>Program Studi : <br><select name="progstudi" id="progstudi" onChange="MM_jumpMenu('parent',this,0)">
            <?
		  	//program studi
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_progstudi = "SELECT * FROM m_progstudi ORDER BY progstudi ASC";
			$rs_progstudi = mysql_query($query_rs_progstudi, $sisfokol) or die(mysql_error());
			$row_rs_progstudi = mysql_fetch_assoc($rs_progstudi);
			$totalRows_rs_progstudi = mysql_num_rows($rs_progstudi);			


			if ($_REQUEST['studikod'] == "")
				{
				echo "<option selected>--Pilih Program Studi--</option>";
				}
				
			else
			
				{
				?>
            <option selected> 
            <?
			$studikod = $_REQUEST['studikod'];
			
			//program studi terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_terjur = "SELECT * FROM m_progstudi WHERE kd = '$studikod'";
			$rs_terjur = mysql_query($query_rs_terjur, $sisfokol) or die(mysql_error());
			$row_rs_terjur = mysql_fetch_assoc($rs_terjur);
			$totalRows_rs_terjur = mysql_num_rows($rs_terjur);			

 echo $row_rs_terjur['progstudi']; ?>
            </option>
            <?
				}


			do 
				{  
				?>
            <option value="keu_siswa.php?katkod=<?php echo $_REQUEST['katkod'];?>&kategori=<?php echo $_REQUEST['kategori'];?>&studikod=<? echo $row_rs_progstudi['kd']?>&progstudi=<? echo urlencode($row_rs_progstudi['progstudi']);?>"><? echo $row_rs_progstudi['progstudi'];?></option>
            <?
				} 
		
			while ($row_rs_progstudi = mysql_fetch_assoc($rs_progstudi));
			
			$rows = mysql_num_rows($rs_progstudi);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_progstudi, 0);
						$row_rs_progstudi = mysql_fetch_assoc($rs_progstudi);
  						}
		?>
          </select></p>
      <p>Kelas : <br><select name="kelas" id="kelas" onChange="MM_jumpMenu('parent',this,0)">
            <?
			//kelas
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_kelas = "SELECT * FROM m_kelas";
			$rs_kelas = mysql_query($query_rs_kelas, $sisfokol) or die(mysql_error());
			$row_rs_kelas = mysql_fetch_assoc($rs_kelas);
			$totalRows_rs_kelas = mysql_num_rows($rs_kelas);			
			?>
            <?
			if ($_REQUEST['kelkod'] == "")
				{
				echo "<option selected>--Pilih Kelas--</option>";
				}
				
			else
			
				{
				?>
            <option selected> 
            <?
			$kelkod = $_REQUEST['kelkod'];
			
			//kelas terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_terkel = "SELECT * FROM m_kelas WHERE kd = '$kelkod'";
			$rs_terkel = mysql_query($query_rs_terkel, $sisfokol) or die(mysql_error());
			$row_rs_terkel = mysql_fetch_assoc($rs_terkel);
			$totalRows_rs_terkel = mysql_num_rows($rs_terkel);			
			?>
            <? echo $row_rs_terkel['kelas']; ?></option>
            <?
				}
			?>
            <?
			do 
				{  
				?>
            <option value="keu_siswa.php?katkod=<?php echo $_REQUEST['katkod'];?>&kategori=<?php echo $_REQUEST['kategori'];?>&studikod=<? echo $_REQUEST['studikod']; ?>&progstudi=<? echo urlencode($_REQUEST['progstudi']); ?>&kelkod=<? echo $row_rs_kelas['kd'] ?>&kelas=<? echo $row_rs_kelas['kelas'] ?>"><? echo $row_rs_kelas['kelas']?></option>
            <?
				} 
		
			while ($row_rs_kelas = mysql_fetch_assoc($rs_kelas));
			
			$rows = mysql_num_rows($rs_kelas);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_kelas, 0);
						$row_rs_kelas = mysql_fetch_assoc($rs_kelas);
  						}
		?>
          </select></p>
      <p>Ruang : <br><select name="ruang" id="ruang" onChange="MM_jumpMenu('parent',this,0)">
            <?
			//kelas
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_ruang = "SELECT * FROM m_ruang";
			$rs_ruang = mysql_query($query_rs_ruang, $sisfokol) or die(mysql_error());
			$row_rs_ruang = mysql_fetch_assoc($rs_ruang);
			$totalRows_rs_ruang = mysql_num_rows($rs_ruang);			
			?>
            <?
			if ($_REQUEST['rukod'] == "")
				{
				echo "<option selected>--Pilih Ruang--</option>";
				}
				
			else
			
				{
				?>
            <option selected> 
            <?
			$rukod = $_REQUEST['rukod'];
			
			//kelas terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_terru = "SELECT * FROM m_ruang WHERE kd = '$rukod'";
			$rs_terru = mysql_query($query_rs_terru, $sisfokol) or die(mysql_error());
			$row_rs_terru = mysql_fetch_assoc($rs_terru);
			$totalRows_rs_terru = mysql_num_rows($rs_terru);			
			?>
            <? echo $row_rs_terru['ruang']; ?></option>
            <?
				}
			?>
            <?
			do 
				{  
				?>
            <option value="keu_siswa.php?katkod=<?php echo $_REQUEST['katkod'];?>&kategori=<?php echo $_REQUEST['kategori'];?>&studikod=<? echo $_REQUEST['studikod']; ?>&progstudi=<? echo urlencode($_REQUEST['progstudi']); ?>&kelkod=<? echo $_REQUEST['kelkod']; ?>&kelas=<? echo urlencode($_REQUEST['kelas']); ?>&rukod=<? echo $row_rs_ruang['kd'] ?>&ruang=<? echo $row_rs_ruang['ruang'] ?>"><? echo $row_rs_ruang['ruang']?></option>
            <?
				} 
		
			while ($row_rs_ruang = mysql_fetch_assoc($rs_ruang));
			
			$rows = mysql_num_rows($rs_ruang);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_ruang, 0);
						$row_rs_ruang = mysql_fetch_assoc($rs_ruang);
  						}
		?>
          </select></p>
      <?php
	  //kategori belum dipilih!
	  if ($_REQUEST['katkod'] == "")
	  	{
		?>
      <font color="#FF0000"><strong>Kategori Belum Dipilih!</strong></font> 
      <?php
		}
	
	else if($_REQUEST['studikod'] == "")
		{
		?>
      <font color="#FF0000"><strong>Program Studi Belum Dipilih!</strong></font> 
      <?php
		}
		
	else if ($_REQUEST['kelkod'] == "")
		{
		?>
      <font color="#FF0000"><strong>Kelas Belum Dipilih!</strong></font> 
      <?php
		}
		
	else if ($_REQUEST['rukod'] == "")
		{
		?>
      <font color="#FF0000"><strong>Ruang Belum Dipilih!</strong></font> 
      <?php
		}
	
	 
	///nek isih kosong
	else if ($totalRows_rs1 == 0)
		{?>
      <strong><font color="#FF0000">TIDAK ADA DATA SISWA</font></strong> 
      <?
		}	
	
	else //nek eneng isine...
	  	{ 
	?>
      <table border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
        <tr> 
          <td width="110" rowspan="2" valign="middle"><div align="left"><font color="#FFFFFF"><strong>NIS</strong></font></div></td>
          <td width="150" rowspan="2" valign="middle"><font color="#FFFFFF"><strong>Nama</strong></font></td>
          <?php
		  //jika uang gedung
		  if ($_REQUEST['katkod'] == "4c75242f81285d49b3f18a7a4d210a8f")
		  	{
			?>
          <td width="720"><strong><font color="#FFFFFF">Uang Gedung</font></strong> 
            <?php
				}
			
			//jika uang spp
		  else if ($_REQUEST['katkod'] == "bad81d085df6c259223d9153cd2fd99b")
		  	{
			?>
          <td colspan="6"><div align="center"><strong><font color="#FFFFFF">Uang 
              SPP</font></strong> </div>
			  
			 
			  
          </td>
           
        </tr>
        <tr> 
          <?php
		//ambil nilai
		$kd_semester_set = $row_rssmt['kd'];

		//bulan semesteran
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsbulan = "SELECT * FROM bulan WHERE kd_semester_set = '$kd_semester_set'";
$rsbulan = mysql_query($query_rsbulan, $sisfokol) or die(mysql_error());
$row_rsbulan = mysql_fetch_assoc($rsbulan);
$totalRows_rsbulan = mysql_num_rows($rsbulan);


//cari tahun
		if ($kd_semester_set == "ce8a0066c0e535bf5fedb54413e75b5d")
			{
			$tahun = $row_rstapel['tahun1'];
			}
		
		else if ($kd_semester_set == "a140a30047adb57e98a71985348bed60")
		//else
			{
			$tahun = $row_rstapel['tahun2'];
			}
		?>
          <?php
	   do { 
	   ?>
          <td width="113"><div align="center"><font color="#FFFFFF"><?php echo $row_rsbulan['bulan'];?>
		   <?php 
		   echo $tahun;		
		 
		 ?>
		  </font></div></td>
          <?php } while ($row_rsbulan = mysql_fetch_assoc($rsbulan)); ?>
        </tr><?php
				}
				?>
				<?php
		  //jika uang lain
		  if ($_REQUEST['katkod'] == "31c2d890125b4103b7844e813f52cf1a")
		  	{
			?>
          <td width="720"><strong><font color="#FFFFFF">Uang Lain-Lain</font></strong> 
            <?php
				}
				?>
				
				<?php
		  //jika uang tes
		  if ($_REQUEST['katkod'] == "7a6df9d882fb55dbe4bc9725e64aab57")
		  	{
			?>
          <td width="720"><strong><font color="#FFFFFF">Uang Tes</font></strong> 
            <?php
				}
				?>
      </table>
      <table border="1" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC">
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
          <td width="110"> 
            <?php 
			echo $row_rs1['nis']; 
			?> </td>
          <td width="150"> 
            <?php 
			echo $row_rs1['nama']; 
			?> </td>
          <?php
		  //jika uang gedung
		  if ($_REQUEST['katkod'] == "4c75242f81285d49b3f18a7a4d210a8f")
		  	{
			?>
          <td width="730"> 
            <?php
		  $kd_siswa = $row_rs1['kd']; 
		  
		  //uang gedung siswa
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsugedung = "SELECT DATE_FORMAT(tgl_bayar, '%d') AS xtgl1, DATE_FORMAT(tgl_bayar, '%m') AS xbln1, ".
					"DATE_FORMAT(tgl_bayar, '%Y') AS xthn1, siswa_uang_gedung.* FROM siswa_uang_gedung ".
					"WHERE kd_siswa = '$kd_siswa'";
$rsugedung = mysql_query($query_rsugedung, $sisfokol) or die(mysql_error());
$row_rsugedung = mysql_fetch_assoc($rsugedung);
$totalRows_rsugedung = mysql_num_rows($rsugedung);

//belum bayar
if ($totalRows_rsugedung == 0)
	{
		  ?>
            <a href="keu_siswa_bayar.php?tapelkod=<?php echo $row_rstapel['kd'];?>&katkod=<?php echo $_REQUEST['katkod'];?>&kategori=<?php echo $_REQUEST['kategori'];?>&studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>&kd_siswa=<?php echo $kd_siswa;?>" title="Bayar Sekarang!">Bayar</a> 
            <?php
	}

else
	{
	?>
            <strong>LUNAS</strong> [<?php echo $row_rsugedung['xtgl1']; ?> 
            <?php 
		  	if ($row_rsugedung['xbln1'] == 1)
		  		{
				echo "Januari";
				}
			
			else if ($row_rsugedung['xbln1'] == 2)
		  		{
				echo "Pebruari";
				}
		  
		  	else if ($row_rsugedung['xbln1'] == 3)
		  		{
				echo "Maret";
				}

		  	else if ($row_rsugedung['xbln1'] == 4)
		  		{
				echo "April";
				}
			
			else if ($row_rsugedung['xbln1'] == 5)
		  		{
				echo "Mei";
				}	
				
			else if ($row_rsugedung['xbln1'] == 6)
		  		{
				echo "Juni";
				}
			
			else if ($row_rsugedung['xbln1'] == 7)
		  		{
				echo "Juli";
				}
			
			else if ($row_rsugedung['xbln1'] == 8)
		  		{
				echo "Agustus";
				}
			
			else if ($row_rsugedung['1bln1'] == 9)
		  		{
				echo "September";
				}
			
			else if ($row_rsugedung['xbln1'] == 10)
		  		{
				echo "Oktober";
				}
			
			else if ($row_rsugedung['xbln1'] == 11)
		  		{
				echo "Nopember";
				}
			
			else if ($row_rsugedung['xbln1'] == 12)
		  		{
				echo "Desember";
				}
		  ?>
            <?php echo $row_rsugedung['xthn1']; ?>]
            <?php
	}
	?>
          </td>
          <?php
		  }
		  ?>
		  
		  <?php
		  //jika uang spp
		  if ($_REQUEST['katkod'] == "bad81d085df6c259223d9153cd2fd99b")
		  	{
			?>
			
			<?php
		//ambil nilai
		$kd_tapel = $row_rstapel['kd'];
		$kd_semester_set = $row_rssmt['kd'];
		$kd_siswa = $row_rs1['kd']; 
		
		//bulan semesteran
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsbulan = "SELECT * FROM bulan WHERE kd_semester_set = '$kd_semester_set'";
$rsbulan = mysql_query($query_rsbulan, $sisfokol) or die(mysql_error());
$row_rsbulan = mysql_fetch_assoc($rsbulan);
$totalRows_rsbulan = mysql_num_rows($rsbulan);


		?>
          <?php
	   do { 
	   ?>
          <td width="113"> 
            <?php
		  //ambil nilai bulan
		  $kd_bulan = $row_rsbulan['kd'];
		  
		  
		  		  //uang spp siswa
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsuspp = "SELECT DATE_FORMAT(tgl_bayar, '%d') AS xtgl1, DATE_FORMAT(tgl_bayar, '%m') AS xbln1, ".
					"DATE_FORMAT(tgl_bayar, '%Y') AS xthn1, siswa_uang_spp.* FROM siswa_uang_spp ".
					"WHERE kd_tapel = '$kd_tapel' ".
					"AND kd_bulan = '$kd_bulan'".
					"AND kd_siswa = '$kd_siswa'";
$rsuspp = mysql_query($query_rsuspp, $sisfokol) or die(mysql_error());
$row_rsuspp = mysql_fetch_assoc($rsuspp);
$totalRows_rsuspp = mysql_num_rows($rsuspp);

		  //belum bayar
if ($totalRows_rsuspp == 0)
	{
		  ?>
            <a href="keu_siswa_bayar.php?tapelkod=<?php echo $row_rstapel['kd'];?>&katkod=<?php echo $_REQUEST['katkod'];?>&kategori=<?php echo urlencode($_REQUEST['kategori']);?>&studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>&kd_siswa=<?php echo $kd_siswa;?>&kd_bulan=<?php echo $row_rsbulan['kd'];?>&bulan=<?php echo $row_rsbulan['bulan'];?>&tahun=<?php echo $tahun;?>" title="Bayar Sekarang!">Bayar</a> 
            <?php
	}

else
	{
	?>
            <a href="#" title="Lunas pada tanggal : <?php 
			
			echo $row_rsuspp['xtgl1']; 
			
		  	if ($row_rsuspp['xbln1'] == 1)
		  		{
				echo " Januari ";
				}
			
			else if ($row_rsuspp['xbln1'] == 2)
		  		{
				echo " Pebruari ";
				}
		  
		  	else if ($row_rsuspp['xbln1'] == 3)
		  		{
				echo " Maret ";
				}

		  	else if ($row_rsuspp['xbln1'] == 4)
		  		{
				echo " April ";
				}
			
			else if ($row_rsuspp['xbln1'] == 5)
		  		{
				echo " Mei ";
				}	
				
			else if ($row_rsuspp['xbln1'] == 6)
		  		{
				echo " Juni ";
				}
			
			else if ($row_rsuspp['xbln1'] == 7)
		  		{
				echo " Juli ";
				}
			
			else if ($row_rsuspp['xbln1'] == 8)
		  		{
				echo " Agustus ";
				}
			
			else if ($row_rsuspp['1bln1'] == 9)
		  		{
				echo " September ";
				}
			
			else if ($row_rsuspp['xbln1'] == 10)
		  		{
				echo " Oktober ";
				}
			
			else if ($row_rsuspp['xbln1'] == 11)
		  		{
				echo " Nopember ";
				}
			
			else if ($row_rsuspp['xbln1'] == 12)
		  		{
				echo " Desember ";
				}

echo $row_rsuspp['xthn1']; ?>"><strong>LUNAS</strong></a> 
            <?php
	}
	?>
          </td>
		  
          <?php } while ($row_rsbulan = mysql_fetch_assoc($rsbulan)); ?>
          <?php
		  }
		  ?>
		  
		  <?php
		  //jika uang lain
		  if ($_REQUEST['katkod'] == "31c2d890125b4103b7844e813f52cf1a")
		  	{
			?>
          <td width="730"> 
            <?php
		  $kd_siswa = $row_rs1['kd']; 
		  
		  //uang lain siswa
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsulain = "SELECT DATE_FORMAT(tgl_bayar, '%d') AS xtgl1, DATE_FORMAT(tgl_bayar, '%m') AS xbln1, ".
					"DATE_FORMAT(tgl_bayar, '%Y') AS xthn1, siswa_uang_lain.* FROM siswa_uang_lain ".
					"WHERE kd_siswa = '$kd_siswa'";
$rsulain = mysql_query($query_rsulain, $sisfokol) or die(mysql_error());
$row_rsulain = mysql_fetch_assoc($rsulain);
$totalRows_rsulain = mysql_num_rows($rsulain);

//belum bayar
if ($totalRows_rsulain == 0)
	{
		  ?>
            <a href="keu_siswa_bayar.php?tapelkod=<?php echo $row_rstapel['kd'];?>&katkod=<?php echo $_REQUEST['katkod'];?>&kategori=<?php echo $_REQUEST['kategori'];?>&studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>&kd_siswa=<?php echo $kd_siswa;?>" title="Bayar Sekarang!">Bayar</a>
            <?php
	}

else
	{
	?>
            <strong>LUNAS</strong> [<?php echo $row_rsulain['xtgl1']; ?> 
            <?php 
		  	if ($row_rsulain['xbln1'] == 1)
		  		{
				echo "Januari";
				}
			
			else if ($row_rsulain['xbln1'] == 2)
		  		{
				echo "Pebruari";
				}
		  
		  	else if ($row_rsulain['xbln1'] == 3)
		  		{
				echo "Maret";
				}

		  	else if ($row_rsulain['xbln1'] == 4)
		  		{
				echo "April";
				}
			
			else if ($row_rsulain['xbln1'] == 5)
		  		{
				echo "Mei";
				}	
				
			else if ($row_rsulain['xbln1'] == 6)
		  		{
				echo "Juni";
				}
			
			else if ($row_rsulain['xbln1'] == 7)
		  		{
				echo "Juli";
				}
			
			else if ($row_rsulain['xbln1'] == 8)
		  		{
				echo "Agustus";
				}
			
			else if ($row_rsulain['1bln1'] == 9)
		  		{
				echo "September";
				}
			
			else if ($row_rsulain['xbln1'] == 10)
		  		{
				echo "Oktober";
				}
			
			else if ($row_rsulain['xbln1'] == 11)
		  		{
				echo "Nopember";
				}
			
			else if ($row_rsulain['xbln1'] == 12)
		  		{
				echo "Desember";
				}
		  ?>
            <?php echo $row_rsulain['xthn1']; ?>] 
            <?php
	}
	?>
          </td>
          <?php
		  }
		  ?>
		  
		  <?php
		  //jika uang tes
		  if ($_REQUEST['katkod'] == "7a6df9d882fb55dbe4bc9725e64aab57")
		  	{
			?>
          <td width="730"> 
            <?php
		  $kd_siswa = $row_rs1['kd']; 
		  
		  //uang lain siswa
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsutes = "SELECT DATE_FORMAT(tgl_bayar, '%d') AS xtgl1, DATE_FORMAT(tgl_bayar, '%m') AS xbln1, ".
				"DATE_FORMAT(tgl_bayar, '%Y') AS xthn1, siswa_uang_test.* FROM siswa_uang_test ".
						"WHERE kd_siswa = '$kd_siswa'";
$rsutes = mysql_query($query_rsutes, $sisfokol) or die(mysql_error());
$row_rsutes = mysql_fetch_assoc($rsutes);
$totalRows_rsutes = mysql_num_rows($rsutes);

//belum bayar
if ($totalRows_rsutes == 0)
	{
		  ?>
            <a href="keu_siswa_bayar.php?tapelkod=<?php echo $row_rstapel['kd'];?>&katkod=<?php echo $_REQUEST['katkod'];?>&kategori=<?php echo $_REQUEST['kategori'];?>&studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>&kd_siswa=<?php echo $kd_siswa;?>" title="Bayar Sekarang!">Bayar</a> 
            <?php
	}

else
	{
	?>
            <strong>LUNAS</strong> [<?php echo $row_rsutes['xtgl1']; ?> 
          <?php 
		  	if ($row_rsutes['xbln1'] == 1)
		  		{
				echo "Januari";
				}
			
			else if ($row_rsutes['xbln1'] == 2)
		  		{
				echo "Pebruari";
				}
		  
		  	else if ($row_rsutes['xbln1'] == 3)
		  		{
				echo "Maret";
				}

		  	else if ($row_rsutes['xbln1'] == 4)
		  		{
				echo "April";
				}
			
			else if ($row_rsutes['xbln1'] == 5)
		  		{
				echo "Mei";
				}	
				
			else if ($row_rsutes['xbln1'] == 6)
		  		{
				echo "Juni";
				}
			
			else if ($row_rsutes['xbln1'] == 7)
		  		{
				echo "Juli";
				}
			
			else if ($row_rsutes['xbln1'] == 8)
		  		{
				echo "Agustus";
				}
			
			else if ($row_rsutes['1bln1'] == 9)
		  		{
				echo "September";
				}
			
			else if ($row_rsutes['xbln1'] == 10)
		  		{
				echo "Oktober";
				}
			
			else if ($row_rsutes['xbln1'] == 11)
		  		{
				echo "Nopember";
				}
			
			else if ($row_rsutes['xbln1'] == 12)
		  		{
				echo "Desember";
				}
		  ?>
          <?php echo $row_rsutes['xthn1']; ?>] 
            <?php
	}
	?>
          </td>
          <?php
		  }
		  ?>
        </tr>
        <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
      </table>
	  <?php
	  }
	  ?>
      
    </td>
  </tr>
</table><br>
<?php include("include/footer.php"); ?>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>