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
include("include/itapel.php"); 

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

switch ($akseskod) {
	case "": //tanpa kode
		$query_rs1 = "SELECT * FROM m_pegawai ORDER BY nip ASC";
		break;
		
	case 11111: //akses pegawai
		$query_rs1 = "SELECT * FROM m_pegawai ORDER BY nip ASC";
		break;
	
	case 22222: //akses walikelas
		$query_rs1 = "SELECT m_pegawai.kd AS mpkd, m_pegawai.*, m_ruang_kelas.*, m_progstudi.*, ".
						"m_kelas.*, m_ruang.* ".
						"FROM m_pegawai, m_ruang_kelas, m_progstudi, m_kelas, m_ruang ".
						"WHERE m_ruang_kelas.kd_guru = m_pegawai.kd ".
						"AND m_ruang_kelas.kd_progstudi = m_progstudi.kd ".
						"AND m_ruang_kelas.kd_kelas = m_kelas.kd ".
						"AND m_ruang_kelas.kd_ruang = m_ruang.kd ";
		break;
	
	case 33333: //akses guru
		$query_rs1 = "SELECT m_pegawai.kd AS mpkd, m_pegawai.*, m_guru.*, m_progstudi.*, ".
						"m_kelas.*, m_pelajaran.* ".
						"FROM m_pegawai, m_guru, m_progstudi, m_kelas, m_pelajaran ".
						"WHERE m_pegawai.kd = m_guru.kd_pegawai ".
						"AND m_guru.kd_pelajaran = m_pelajaran.kd ".
						"AND m_guru.kd_progstudi = m_progstudi.kd ".
						"AND m_guru.kd_kelas = m_kelas.kd";
		break;
	
	case 44444: //akses siswa
		$query_rs1 = "SELECT m_progstudi.*, m_kelas.*, m_ruang.*, m_siswa.kd AS mskd, m_siswa.*, ".
						"siswa_progstudi.*, siswa_kelas.*, siswa_ruang.* ".
						"FROM m_progstudi, m_kelas, m_ruang, m_siswa, ".
						"siswa_progstudi, siswa_kelas, siswa_ruang ".
						"WHERE siswa_progstudi.kd_progstudi = m_progstudi.kd ".
						"AND siswa_kelas.kd_kelas = m_kelas.kd ".
						"AND siswa_ruang.kd_ruang = m_ruang.kd ".
						"AND siswa_progstudi.status = 'true' ".
						"AND siswa_kelas.status = 'true' ".
						"AND siswa_ruang.status = 'true' ".
						"AND siswa_progstudi.kd_siswa = m_siswa.kd ".
						"AND siswa_kelas.kd_siswa = m_siswa.kd ".
						"AND siswa_ruang.kd_siswa = m_siswa.kd ".
						"ORDER BY m_siswa.nis ASC";
		break;
	
	case 55555:  //akses orang tua siswa
		$query_rs1 = "SELECT m_progstudi.*, m_kelas.*, m_ruang.*, m_siswa.kd AS mskd, m_siswa.*, ".
						"siswa_progstudi.*, siswa_kelas.*, siswa_ruang.* ".
						"FROM m_progstudi, m_kelas, m_ruang, m_siswa, ".
						"siswa_progstudi, siswa_kelas, siswa_ruang ".
						"WHERE siswa_progstudi.kd_progstudi = m_progstudi.kd ".
						"AND siswa_kelas.kd_kelas = m_kelas.kd ".
						"AND siswa_ruang.kd_ruang = m_ruang.kd ".
						"AND siswa_progstudi.status = 'true' ".
						"AND siswa_kelas.status = 'true' ".
						"AND siswa_ruang.status = 'true' ".
						"AND siswa_progstudi.kd_siswa = m_siswa.kd ".
						"AND siswa_kelas.kd_siswa = m_siswa.kd ".
						"AND siswa_ruang.kd_siswa = m_siswa.kd ".
						"ORDER BY m_siswa.nis ASC";
		break;
	}
					
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
<title>Set Akses</title>
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
      <td> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td width="46%"><img src="images/adm_set_akses.gif" width="178" height="40"></td>
            <td width="54%"><div align="right"> </div></td>
          </tr>
        </table>
        <p><strong>Set Akses</strong> ini digunakan untuk mengganti password suatu 
          user. Password standar adalah sama dengan NIP atau NIS-nya.
        <p>Pilih Akses : 
          <select name="aksesi" id="aksesi" onChange="MM_jumpMenu('parent',this,0)">
            <?
			if ($_REQUEST['akseskod'] == "")
				{
				echo "<option selected>--Akses--</option>";
				?>
            <option value="set_akses.php?akseskod=11111&akses=Pegawai">Pegawai</option>
            <option value="set_akses.php?akseskod=22222&akses=Wali+Kelas">Wali 
            Kelas</option>
            <option value="set_akses.php?akseskod=33333&akses=Guru">Guru</option>
            <option value="set_akses.php?akseskod=44444&akses=Siswa">Siswa</option>
            <option value="set_akses.php?akseskod=55555&akses=Orang+Tua+Siswa">Orang 
            Tua Siswa</option>
            <?
				}
				
			else
			
				{
				?>
            <option value="<?php echo $_REQUEST['akaseskod'];?>" selected><? echo $_REQUEST['akses'];?></option>
            <option value="set_akses.php?akseskod=11111&akses=Pegawai">Pegawai</option>
            <option value="set_akses.php?akseskod=22222&akses=Wali+Kelas">Wali 
            Kelas</option>
            <option value="set_akses.php?akseskod=33333&akses=Guru">Guru</option>
            <option value="set_akses.php?akseskod=44444&akses=Siswa">Siswa</option>
            <option value="set_akses.php?akseskod=55555&akses=Orang+Tua+Siswa">Orang 
            Tua Siswa</option>
            <?php
}
?>
          </select>
        <p> 
          <?php
		//jika akses belum dipilih
		if ($akseskod == "")
			{
			?>
          <font color="#FF0000"><strong>Pilih Dahulu AKSES-nya!</strong></font> 
          <?
			}
		else
			{
			?>
			
			<?php
			//jika akses pegawai
			if ($_REQUEST['akseskod'] == "11111")
				{
				?>
				
        <table width="500" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="102"><font color="#FFFFFF"><strong>NIP</strong></font></td>
            <td width="234"><font color="#FFFFFF"><strong>Nama</strong></font></td>
            <td width="144">&nbsp;</td>
          </tr>
        </table>

        <table width="500" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
          <?
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
            <td width="22%"><?php echo balikin($row_rs1['nip']);?> <br></td>
            <td width="48%"><?php echo balikin($row_rs1['nama']);?></td>
            <td width="30%">[<a href="javascript:MM_openBrWindow('set_akses1.php?akseskod=<?php echo $_REQUEST['akseskod'];?>&akses=<?php echo $_REQUEST['akses'];?>&kd=<?php echo $row_rs1['kd']; ?>&nama=<?php echo $row_rs1['nama']; ?>','','width=210,height=100,toolbar=no,menubar=no,location=no,scrollbars=no,resize=no')">GANTI</a>]</td>
          </tr>
          <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
        </table>
		<br><br>
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
<?php	} 
		 
			//jika akses walikelas
		else if ($_REQUEST['akseskod'] == "22222")
				{
				?>
				
				
        <table width="600" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="215"><font color="#FFFFFF"><strong>Wali Kelas</strong></font></td>
            <td width="121"><font color="#FFFFFF"><strong>NIP</strong></font></td>
            <td width="182"><font color="#FFFFFF"><strong>Nama</strong></font></td>
            <td width="56">&nbsp;</td>
          </tr>
        </table>

		<table width="600" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">		
				<?
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
            <td width="215"><?php echo balikin($row_rs1['progstudi']);?> &gt; <?php echo balikin($row_rs1['kelas']);?> &gt; <?php echo balikin($row_rs1['ruang']);?><br></td>
            <td width="121"><?php echo balikin($row_rs1['nip']);?></td>        
            <td width="184"><?php echo balikin($row_rs1['nama']);?></td>
            <td width="54">[<a href="javascript:MM_openBrWindow('set_akses1.php?akseskod=<?php echo $_REQUEST['akseskod'];?>&akses=<?php echo $_REQUEST['akses'];?>&kd=<?php echo $row_rs1['mpkd']; ?>&nama=<?php echo $row_rs1['nama']; ?>','','width=210,height=100,toolbar=no,menubar=no,location=no,scrollbars=no,resize=no')">GANTI</a>]</td>
  </tr><?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
</table>
        <br>
        <br> <table width="100%" border="0" cellspacing="0" cellpadding="2">
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
        <?php } 
		 
		 	//jika akses guru
		else if ($_REQUEST['akseskod'] == "33333")
				{
				?>
				
        <table width="600" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="215"><font color="#FFFFFF"><strong>Mata Pelajaran</strong></font></td>
            <td width="132"><font color="#FFFFFF"><strong>NIP</strong></font></td>
            <td width="177"><font color="#FFFFFF"><strong>Nama</strong></font></td>
            <td width="50">&nbsp;</td>
          </tr>
        </table>
        <table width="600" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
          <?
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
            <td width="215"><?php echo balikin($row_rs1['progstudi']);?> &gt; 
              <?php echo balikin($row_rs1['kelas']);?> &gt; <strong><?php echo balikin($row_rs1['pelajaran']);?></strong><br></td>
            <td width="133"><?php echo balikin($row_rs1['nip']);?></td>        
            <td width="177"><?php echo balikin($row_rs1['nama']);?></td>
            <td width="49">[<a href="javascript:MM_openBrWindow('set_akses1.php?akseskod=<?php echo $_REQUEST['akseskod'];?>&akses=<?php echo $_REQUEST['akses'];?>&kd=<?php echo $row_rs1['mpkd']; ?>&nama=<?php echo $row_rs1['nama']; ?>','','width=210,height=100,toolbar=no,menubar=no,location=no,scrollbars=no,resize=no')">GANTI</a>]</td>
  </tr><?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
</table>
        <br> <br> <table width="100%" border="0" cellspacing="0" cellpadding="2">
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
        <? } 
		 
		  	//jika akses siswa
		else if ($_REQUEST['akseskod'] == "44444")
				{
				?>
        <table width="600" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="215"><font color="#FFFFFF"><strong>Program Studi/Kelas/Ruang</strong></font></td>
            <td width="132"><font color="#FFFFFF"><strong>NIS</strong></font></td>
            <td width="177"><font color="#FFFFFF"><strong>Nama</strong></font></td>
            <td width="50">&nbsp;</td>
          </tr>
        </table>
        <table width="600" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
          <?
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
            <td width="215"><?php echo balikin($row_rs1['progstudi']);?> &gt; <?php echo balikin($row_rs1['kelas']);?> 
              &gt; <?php echo balikin($row_rs1['ruang']);?></td>
            <td width="133"><?php echo balikin($row_rs1['nis']);?></td>
            <td width="176"><?php echo balikin($row_rs1['nama']);?></td>
            <td width="50">[<a href="javascript:MM_openBrWindow('set_akses1.php?akseskod=<?php echo $_REQUEST['akseskod'];?>&akses=<?php echo $_REQUEST['akses'];?>&kd=<?php echo $row_rs1['mskd']; ?>&nama=<?php echo $row_rs1['nama']; ?>','','width=210,height=100,toolbar=no,menubar=no,location=no,scrollbars=no,resize=no')">GANTI</a>]</td>
          </tr><?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
        </table>
        
			
          
         
		 
        <br> <br> <table width="100%" border="0" cellspacing="0" cellpadding="2">
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
        <?php
		 } 
		 
		 	//jika akses orang tua siswa
		else if ($_REQUEST['akseskod'] == "55555")
				{
				?>
				
				
				<table width="600" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="215"><font color="#FFFFFF"><strong>Program Studi/Kelas/Ruang</strong></font></td>
            <td width="132"><font color="#FFFFFF"><strong>NIS</strong></font></td>
            <td width="177"><font color="#FFFFFF"><strong>Nama</strong></font></td>
            <td width="50">&nbsp;</td>
          </tr>
        </table>
        <table width="600" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
          <?
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
            <td width="215"><?php echo balikin($row_rs1['progstudi']);?> &gt; <?php echo balikin($row_rs1['kelas']);?> 
              &gt; <?php echo balikin($row_rs1['ruang']);?></td>
            <td width="133"><?php echo balikin($row_rs1['nis']);?></td>
            <td width="176"><?php echo balikin($row_rs1['nama']);?></td>
            <td width="50">[<a href="javascript:MM_openBrWindow('set_akses1.php?akseskod=<?php echo $_REQUEST['akseskod'];?>&akses=<?php echo $_REQUEST['akses'];?>&kd=<?php echo $row_rs1['mskd']; ?>&nama=<?php echo $row_rs1['nama']; ?>','','width=210,height=100,toolbar=no,menubar=no,location=no,scrollbars=no,resize=no')">GANTI</a>]</td>
          </tr><?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
        </table>
        <br> <br> <table width="100%" border="0" cellspacing="0" cellpadding="2">
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
        <br>
         
		 <?php 
		 } 
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
//diskonek
mysql_close($sisfokol);
?>