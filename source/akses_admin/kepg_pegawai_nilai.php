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

//ambil nilai
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

$query_rs1 = "SELECT * FROM m_pegawai ORDER BY nip ASC";
					
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


//huruf
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_huruf = "SELECT * FROM m_huruf ORDER BY huruf ASC";
$rs_huruf = mysql_query($query_rs_huruf, $sisfokol) or die(mysql_error());
$row_rs_huruf = mysql_fetch_assoc($rs_huruf);
$totalRows_rs_huruf = mysql_num_rows($rs_huruf);
?>
<html>
<head>
<title>Nilai Pegawai</title>
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
<div align="center">
  <?php include("include/header.php"); ?>
  <?php include("include/menu.php"); ?>
  <br>
  <table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td> <p><img src="images/adm_kepg_nilai.gif" width="243" height="40"> 
        <p> 
          <? ///nek isih kosong
	if ($totalRows_rs1 == 0)
		{
		?>
          <font color="#FF0000"><strong>TIDAK ADA DATA NILAI PEGAWAI</strong></font> 
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <?
		}	
	
	else if ($totalRows_rs1 != 0)//nek eneng isine...
	  	{ 
	?></p>
          <p><font color="#000000">Total :<font color="#FF0000"> </font><font color="#FF0000"><? echo "$totalRows_rs1";?> 
          </font>Pegawai</font><font color="#00FF00"><br>
          </font> </p>
        <table width="990" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="93"><font color="#FFFFFF"><strong>NIP</strong></font></td>
            <td width="195"><font color="#FFFFFF"><strong>Nama</strong></font></td>
            <td width="74"><font color="#FFFFFF"><strong>Kesetiaan</strong></font></td>
            <td width="104"><font color="#FFFFFF"><strong>Prestasi Kerja</strong></font></td>
            <td width="122"><font color="#FFFFFF"><strong>Tanggung Jawab</strong></font></td>
            <td width="70"><font color="#FFFFFF"><strong>Kejujuran</strong></font></td>
            <td width="88"><font color="#FFFFFF"><strong>Kerja Sama</strong></font></td>
            <td width="70"><font color="#FFFFFF"><strong>Prakarsa</strong></font></td>
            <td width="118"><font color="#FFFFFF"><strong>Kepemimpinan</strong></font></td>
          </tr>
        </table>
        <table width="990" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
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
            <td width="93"> 
              <?php 
			echo balikin($row_rs1['nip']); 
			?>
              <strong> </strong> </td>
            <td width="195"> 
              <a href="javascript:MM_openBrWindow('kepg_pegawai_n_print.php?kd=<?php echo $row_rs1['kd']; ?>','','width=500,height=250,toolbar=no,menubar=no,location=no,scrollbars=yes,resize=no')"> 
              <?php 
			echo balikin($row_rs1['nama']); 
			?>
              </a> </td>
            <td width="74"><select name="kesetiaan" id="kesetiaan" onChange="MM_jumpMenu('parent',this,0)">
                <?
			if ($_REQUEST['setiakod'] == "")
				{
				$kd_pegawai = $row_rs1['kd'];
				
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_setiai = "SELECT m_huruf.*, pegawai_nilai.* ".
									"FROM m_huruf, pegawai_nilai ".
									"WHERE m_huruf.kd = pegawai_nilai.kesetiaan ".
									"AND pegawai_nilai.kd_pegawai = '$kd_pegawai'";
				$rs_setiai = mysql_query($query_rs_setiai, $sisfokol) or die(mysql_error());
				$row_rs_setiai = mysql_fetch_assoc($rs_setiai);
				$totalRows_rs_setiai = mysql_num_rows($rs_setiai);
				?>
                <option selected>
                <?php 
				//jika kosong
				if ($row_rs_setiai['kesetiaan'] == "")
					{
					echo "-Nilai-";
					}
				
				else
					{				
					echo $row_rs_setiai['huruf']; 
					}
				?>
                </option>
                <?
				}
				
			else
			
				{
				?>
                <option selected> 
                <?
			//terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_seti = "SELECT * FROM m_huruf WHERE kd = '$setiakod'";
			$rs_seti = mysql_query($query_rs_seti, $sisfokol) or die(mysql_error());
			$row_rs_seti = mysql_fetch_assoc($rs_seti);
			$totalRows_rs_seti = mysql_num_rows($rs_seti);			
			?>
                <? echo $row_rs_seti['huruf']; ?></option>
                <?
				}
			?>
                <?
			do 
				{  
				?>
                <option value="kepg_pegawai_nilai1.php?kd_pegawai=<?php echo $kd_pegawai;?>&setiakod=<? echo $row_rs_huruf['kd']?>"><? echo $row_rs_huruf['huruf']?></option>
                <?
				} 
		
			while ($row_rs_huruf = mysql_fetch_assoc($rs_huruf));
			
			$rows = mysql_num_rows($rs_huruf);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_huruf, 0);
						$row_rs_huruf = mysql_fetch_assoc($rs_huruf);
  						}
		?>
              </select>&nbsp; </td>
            <td width="104"><select name="prestasi" id="prestasi" onChange="MM_jumpMenu('parent',this,0)">
                <?
			if ($_REQUEST['prestkod'] == "")
				{
				$kd_pegawai = $row_rs1['kd'];
				
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_presti = "SELECT m_huruf.*, pegawai_nilai.* ".
									"FROM m_huruf, pegawai_nilai ".
									"WHERE m_huruf.kd = pegawai_nilai.prestasi_kerja ".
									"AND pegawai_nilai.kd_pegawai = '$kd_pegawai'";
				$rs_presti = mysql_query($query_rs_presti, $sisfokol) or die(mysql_error());
				$row_rs_presti = mysql_fetch_assoc($rs_presti);
				$totalRows_rs_presti = mysql_num_rows($rs_presti);
				?>
                <option selected>
                <?php 
				//jika kosong
				if ($row_rs_presti['prestasi_kerja'] == "")
					{
					echo "-Nilai-";
					}
				
				else
					{				
					echo $row_rs_presti['huruf']; 
					}
				?>
                </option>
                <?
				}
				
			else
			
				{
				?>
                <option selected> 
                <?
			//terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_spresti = "SELECT * FROM m_huruf WHERE kd = '$setiakod'";
			$rs_spresti = mysql_query($query_rs_spresti, $sisfokol) or die(mysql_error());
			$row_rs_spresti = mysql_fetch_assoc($rs_spresti);
			$totalRows_rs_spresti = mysql_num_rows($rs_spresti);			
			?>
                <? echo $row_rs_spresti['huruf']; ?></option>
                <?
				}
			?>
                <?
			do 
				{  
				?>
                <option value="kepg_pegawai_nilai1.php?kd_pegawai=<?php echo $kd_pegawai;?>&prestkod=<? echo $row_rs_huruf['kd']?>"><? echo $row_rs_huruf['huruf']?></option>
                <?
				} 
		
			while ($row_rs_huruf = mysql_fetch_assoc($rs_huruf));
			
			$rows = mysql_num_rows($rs_huruf);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_huruf, 0);
						$row_rs_huruf = mysql_fetch_assoc($rs_huruf);
  						}
		?>
              </select>&nbsp;</td>
            <td width="122"><select name="tanggung_jawab" id="tanggung_jawab" onChange="MM_jumpMenu('parent',this,0)">
                <?
			if ($_REQUEST['tangkod'] == "")
				{
				$kd_pegawai = $row_rs1['kd'];
				
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_tangi = "SELECT m_huruf.*, pegawai_nilai.* ".
									"FROM m_huruf, pegawai_nilai ".
									"WHERE m_huruf.kd = pegawai_nilai.tanggung_jawab ".
									"AND pegawai_nilai.kd_pegawai = '$kd_pegawai'";
				$rs_tangi = mysql_query($query_rs_tangi, $sisfokol) or die(mysql_error());
				$row_rs_tangi = mysql_fetch_assoc($rs_tangi);
				$totalRows_rs_tangi = mysql_num_rows($rs_tangi);
				?>
                <option selected>
                <?php 
				//jika kosong
				if ($row_rs_tangi['tanggung_jawab'] == "")
					{
					echo "-Nilai-";
					}
				
				else
					{				
					echo $row_rs_tangi['huruf']; 
					}
				?>
                </option>
                <?
				}
				
			else
			
				{
				?>
                <option selected> 
                <?
			//terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_stangi = "SELECT * FROM m_huruf WHERE kd = '$setiakod'";
			$rs_stangi = mysql_query($query_rs_stangi, $sisfokol) or die(mysql_error());
			$row_rs_stangi = mysql_fetch_assoc($rs_stangi);
			$totalRows_rs_stangi = mysql_num_rows($rs_stangi);			
			?>
                <? echo $row_rs_stangi['huruf']; ?></option>
                <?
				}
			?>
                <?
			do 
				{  
				?>
                <option value="kepg_pegawai_nilai1.php?kd_pegawai=<?php echo $kd_pegawai;?>&tangkod=<? echo $row_rs_huruf['kd']?>"><? echo $row_rs_huruf['huruf']?></option>
                <?
				} 
		
			while ($row_rs_huruf = mysql_fetch_assoc($rs_huruf));
			
			$rows = mysql_num_rows($rs_huruf);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_huruf, 0);
						$row_rs_huruf = mysql_fetch_assoc($rs_huruf);
  						}
		?>
              </select>&nbsp;</td>
            <td width="70"><select name="kejujuran" id="kejujuran" onChange="MM_jumpMenu('parent',this,0)">
                <?
			if ($_REQUEST['kejukod'] == "")
				{
				$kd_pegawai = $row_rs1['kd'];
				
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_kejui = "SELECT m_huruf.*, pegawai_nilai.* ".
									"FROM m_huruf, pegawai_nilai ".
									"WHERE m_huruf.kd = pegawai_nilai.kejujuran ".
									"AND pegawai_nilai.kd_pegawai = '$kd_pegawai'";
				$rs_kejui = mysql_query($query_rs_kejui, $sisfokol) or die(mysql_error());
				$row_rs_kejui = mysql_fetch_assoc($rs_kejui);
				$totalRows_rs_kejui = mysql_num_rows($rs_kejui);
				?>
                <option selected>
                <?php 
				//jika kosong
				if ($row_rs_kejui['kejujuran'] == "")
					{
					echo "-Nilai-";
					}
				
				else
					{				
					echo $row_rs_kejui['huruf']; 
					}
				?>
                </option>
                <?
				}
				
			else
			
				{
				?>
                <option selected> 
                <?
			//terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_skejui = "SELECT * FROM m_huruf WHERE kd = '$setiakod'";
			$rs_skejui = mysql_query($query_rs_skejui, $sisfokol) or die(mysql_error());
			$row_rs_skejui = mysql_fetch_assoc($rs_skejui);
			$totalRows_rs_skejui = mysql_num_rows($rs_skejui);			
			?>
                <? echo $row_rs_skejui['huruf']; ?></option>
                <?
				}
			?>
                <?
			do 
				{  
				?>
                <option value="kepg_pegawai_nilai1.php?kd_pegawai=<?php echo $kd_pegawai;?>&kejukod=<? echo $row_rs_huruf['kd']?>"><? echo $row_rs_huruf['huruf']?></option>
                <?
				} 
		
			while ($row_rs_huruf = mysql_fetch_assoc($rs_huruf));
			
			$rows = mysql_num_rows($rs_huruf);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_huruf, 0);
						$row_rs_huruf = mysql_fetch_assoc($rs_huruf);
  						}
		?>
              </select>&nbsp;</td>
            <td width="88"><select name="kerja_sama" id="kerja_sama" onChange="MM_jumpMenu('parent',this,0)">
                <?
			if ($_REQUEST['kerjkod'] == "")
				{
				$kd_pegawai = $row_rs1['kd'];
				
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_kerji = "SELECT m_huruf.*, pegawai_nilai.* ".
									"FROM m_huruf, pegawai_nilai ".
									"WHERE m_huruf.kd = pegawai_nilai.kerja_sama ".
									"AND pegawai_nilai.kd_pegawai = '$kd_pegawai'";
				$rs_kerji = mysql_query($query_rs_kerji, $sisfokol) or die(mysql_error());
				$row_rs_kerji = mysql_fetch_assoc($rs_kerji);
				$totalRows_rs_kerji = mysql_num_rows($rs_kerji);
				?>
                <option selected>
                <?php 
				//jika kosong
				if ($row_rs_kerji['kerja_sama'] == "")
					{
					echo "-Nilai-";
					}
				
				else
					{				
					echo $row_rs_kerji['huruf']; 
					}
				?>
                </option>
                <?
				}
				
			else
			
				{
				?>
                <option selected> 
                <?
			//terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_skerji = "SELECT * FROM m_huruf WHERE kd = '$setiakod'";
			$rs_skerji = mysql_query($query_rs_skerji, $sisfokol) or die(mysql_error());
			$row_rs_skerji = mysql_fetch_assoc($rs_skerji);
			$totalRows_rs_skerji = mysql_num_rows($rs_skerji);			
			?>
                <? echo $row_rs_skerji['huruf']; ?></option>
                <?
				}
			?>
                <?
			do 
				{  
				?>
                <option value="kepg_pegawai_nilai1.php?kd_pegawai=<?php echo $kd_pegawai;?>&kerjkod=<? echo $row_rs_huruf['kd']?>"><? echo $row_rs_huruf['huruf']?></option>
                <?
				} 
		
			while ($row_rs_huruf = mysql_fetch_assoc($rs_huruf));
			
			$rows = mysql_num_rows($rs_huruf);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_huruf, 0);
						$row_rs_huruf = mysql_fetch_assoc($rs_huruf);
  						}
		?>
              </select>&nbsp;</td>
            <td width="70"><select name="prakarsa" id="prakarsa" onChange="MM_jumpMenu('parent',this,0)">
                <?
			if ($_REQUEST['prakarkod'] == "")
				{
				$kd_pegawai = $row_rs1['kd'];
				
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_prakari = "SELECT m_huruf.*, pegawai_nilai.* ".
									"FROM m_huruf, pegawai_nilai ".
									"WHERE m_huruf.kd = pegawai_nilai.prakarsa ".
									"AND pegawai_nilai.kd_pegawai = '$kd_pegawai'";
				$rs_prakari = mysql_query($query_rs_prakari, $sisfokol) or die(mysql_error());
				$row_rs_prakari = mysql_fetch_assoc($rs_prakari);
				$totalRows_rs_prakari = mysql_num_rows($rs_prakari);
				?>
                <option selected>
                <?php 
				//jika kosong
				if ($row_rs_prakari['prakarsa'] == "")
					{
					echo "-Nilai-";
					}
				
				else
					{				
					echo $row_rs_prakari['huruf']; 
					}
				?>
                </option>
                <?
				}
				
			else
			
				{
				?>
                <option selected> 
                <?
			//terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_sprakari = "SELECT * FROM m_huruf WHERE kd = '$setiakod'";
			$rs_sprakari = mysql_query($query_rs_sprakari, $sisfokol) or die(mysql_error());
			$row_rs_sprakari = mysql_fetch_assoc($rs_sprakari);
			$totalRows_rs_sprakari = mysql_num_rows($rs_sprakari);			
			?>
                <? echo $row_rs_sprakari['huruf']; ?></option>
                <?
				}
			?>
                <?
			do 
				{  
				?>
                <option value="kepg_pegawai_nilai1.php?kd_pegawai=<?php echo $kd_pegawai;?>&prakarkod=<? echo $row_rs_huruf['kd']?>"><? echo $row_rs_huruf['huruf']?></option>
                <?
				} 
		
			while ($row_rs_huruf = mysql_fetch_assoc($rs_huruf));
			
			$rows = mysql_num_rows($rs_huruf);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_huruf, 0);
						$row_rs_huruf = mysql_fetch_assoc($rs_huruf);
  						}
		?>
              </select>&nbsp;</td>
            <td width="118"><select name="kepemimpinan" id="kepemimpinan" onChange="MM_jumpMenu('parent',this,0)">
                <?
			if ($_REQUEST['kepemkod'] == "")
				{
				$kd_pegawai = $row_rs1['kd'];
				
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_kepemi = "SELECT m_huruf.*, pegawai_nilai.* ".
									"FROM m_huruf, pegawai_nilai ".
									"WHERE m_huruf.kd = pegawai_nilai.kepemimpinan ".
									"AND pegawai_nilai.kd_pegawai = '$kd_pegawai'";
				$rs_kepemi = mysql_query($query_rs_kepemi, $sisfokol) or die(mysql_error());
				$row_rs_kepemi = mysql_fetch_assoc($rs_kepemi);
				$totalRows_rs_kepemi = mysql_num_rows($rs_kepemi);
				?>
                <option selected>
                <?php 
				//jika kosong
				if ($row_rs_kepemi['kepemimpinan'] == "")
					{
					echo "-Nilai-";
					}
				
				else
					{				
					echo $row_rs_kepemi['huruf']; 
					}
				?>
                </option>
                <?
				}
				
			else
			
				{
				?>
                <option selected> 
                <?
			//terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_skepemi = "SELECT * FROM m_huruf WHERE kd = '$setiakod'";
			$rs_skepemi = mysql_query($query_rs_skepemi, $sisfokol) or die(mysql_error());
			$row_rs_skepemi = mysql_fetch_assoc($rs_skepemi);
			$totalRows_rs_skepemi = mysql_num_rows($rs_skepemi);			
			?>
                <? echo $row_rs_skepemi['huruf']; ?></option>
                <?
				}
			?>
                <?
			do 
				{  
				?>
                <option value="kepg_pegawai_nilai1.php?kd_pegawai=<?php echo $kd_pegawai;?>&kepemkod=<? echo $row_rs_huruf['kd']?>"><? echo $row_rs_huruf['huruf']?></option>
                <?
				} 
		
			while ($row_rs_huruf = mysql_fetch_assoc($rs_huruf));
			
			$rows = mysql_num_rows($rs_huruf);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_huruf, 0);
						$row_rs_huruf = mysql_fetch_assoc($rs_huruf);
  						}
		?>
              </select>&nbsp;</td>
          </tr>
          <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
        </table>
		
		<br><br>
        <br>
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
    <td><?php if ($pageNum_rs1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, 0, $queryString_rs1); ?>">Awal</a> 
        <?php 
		  		}
		  else
		  		{
				?>
        <font color="#CCCCCC">Awal</font> 
        <?
		  } // Show if not first page ?> <?php if ($pageNum_rs1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, max(0, $pageNum_rs1 - 1), $queryString_rs1); ?>">Sebelumnya</a> 
        <?php 
		  		}
		  else
		  		{
				?>
        <font color="#CCCCCC">Sebelumnya</font> 
        <?
		  } // Show if not first page ?> <?php if ($pageNum_rs1 < $totalPages_rs1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, min($totalPages_rs1, $pageNum_rs1 + 1), $queryString_rs1); ?>">Selanjutnya</a> 
        <?php 
		  		}
		  else
		  		{?>
        <font color="#CCCCCC">Selanjutnya</font> 
        <?
		  } // Show if not last page ?> <?php if ($pageNum_rs1 < $totalPages_rs1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, $totalPages_rs1, $queryString_rs1); ?>">Terakhir</a> 
        <?php 
		  		}
		  else
		  		{?>
        <font color="#CCCCCC">Terakhir</font> 
        <?
		  } // Show if not last page ?></td>
  </tr>
</table>

		
		<?php
		}
		?>
		
		</td>
    </tr>
  </table>
  <br>
  <?php include("include/footer.php"); ?>
</div>
</body>
</html>
<?php
mysql_close($sisfokol);
?>