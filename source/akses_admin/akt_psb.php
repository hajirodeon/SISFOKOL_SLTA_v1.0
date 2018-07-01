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

$query_rs1 = "SELECT DATE_FORMAT(tgl_lahir, '%d') AS xtgl1, DATE_FORMAT(tgl_lahir, '%m') AS xbln1, ".
				"DATE_FORMAT(tgl_lahir, '%Y') AS xthn1, m_kelamin.*, psb.* FROM m_kelamin, psb ".
				"WHERE m_kelamin.kd = psb.kd_kelamin ORDER BY psb.nomer ASC";
			
				
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
<title>Penerimaan Siswa Baru</title>
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
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><p><img src="images/adm_akt_penerimaan_siswa.gif" width="321" height="40"></p>
              <p>(<a href="akt_psb_add.php">Tambah</a>)</p></td>
          </tr>
          <tr> 
            <td><div align="right">
                <?php include("include/tapel.php"); ?>
              </div></td>
          </tr>
          <tr>
            <td><div align="right">
                <?php include("include/smt.php"); ?>
              </div></td>
          </tr>
        </table>
		<? ///nek isih kosong
	if ($totalRows_rs1 == 0)
		{
		?>
        <table width="100%" height="250" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr valign="middle">
            <td valign="top"> <strong><font color="#FF0000">TIDAK ADA DATA CALON 
              SISWA</font></strong> </td>
          </tr>
        </table>
		<?
				}	
	
	else 
	  	{ 
	?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
              <td> <div align="right"> </div></td>
            </tr>
          </table>
          
        <table width="990" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="50"><font color="#FFFFFF"><strong>Nomer</strong></font></td>
            <td width="166"><font color="#FFFFFF"><strong>Nama</strong></font></td>
            <td width="116"><font color="#FFFFFF"><strong>Jenis Kelamin</strong></font></td>
            <td width="220"><font color="#FFFFFF"><strong>Tempat, Tanggal Lahir</strong></font></td>
            <td width="418"><font color="#FFFFFF">&nbsp;</font></td>
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
            <td width="50"> 
              <?php echo $row_rs1['nomer']; ?> </td>
            <td width="166"> 
              <?php 
			echo balikin($row_rs1['nama']); 
			?>
            </td>
            <td width="116"> 
              <?php 
			echo $row_rs1['kelamin']; 
			?>
            </td>
            <td width="220"> 
              <?php 
			echo balikin($row_rs1['tmp_lahir']); 
			?>
              , <?php echo $row_rs1['xtgl1']; ?> 
              <?php 
		  	if ($row_rs1['xbln1'] == 1)
		  		{
				echo "Januari";
				}
			
			else if ($row_rs1['xbln1'] == 2)
		  		{
				echo "Pebruari";
				}
		  
		  	else if ($row_rs1['xbln1'] == 3)
		  		{
				echo "Maret";
				}

		  	else if ($row_rs1['xbln1'] == 4)
		  		{
				echo "April";
				}
			
			else if ($row_rs1['xbln1'] == 5)
		  		{
				echo "Mei";
				}	
				
			else if ($row_rs1['xbln1'] == 6)
		  		{
				echo "Juni";
				}
			
			else if ($row_rs1['xbln1'] == 7)
		  		{
				echo "Juli";
				}
			
			else if ($row_rs1['xbln1'] == 8)
		  		{
				echo "Agustus";
				}
			
			else if ($row_rs1['1bln1'] == 9)
		  		{
				echo "September";
				}
			
			else if ($row_rs1['xbln1'] == 10)
		  		{
				echo "Oktober";
				}
			
			else if ($row_rs1['xbln1'] == 11)
		  		{
				echo "Nopember";
				}
			
			else if ($row_rs1['xbln1'] == 12)
		  		{
				echo "Desember";
				}
		  ?>
              <?php echo $row_rs1['xthn1']; ?> </td>
            <td width="418">[<a href="javascript:MM_openBrWindow('akt_psb_detail.php?kd=<?php echo $row_rs1['kd']; ?>','','width=330,height=250,toolbar=no,menubar=no,location=no,scrollbars=yes,resize=no')">Detail</a>] 
              - [<a href="akt_psb_del.php?kd=<?php echo $row_rs1['kd'];?>">HAPUS</a>] 
              - 
              <select name="status" id="status" onChange="MM_jumpMenu('parent',this,0)">
                <?
			if ($_REQUEST['status'] == "")
				{
				//calon
				$kd = $row_rs1['kd'];
				
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_caloni = "SELECT * FROM psb ".
									"WHERE kd = '$kd'";
				$rs_caloni = mysql_query($query_rs_caloni, $sisfokol) or die(mysql_error());
				$row_rs_caloni = mysql_fetch_assoc($rs_caloni);
				$totalRows_rs_caloni = mysql_num_rows($rs_caloni);
				?>
                <option selected> 
                <?php 
				//jika kosong
				if ($row_rs_caloni['diterima'] == "")
					{
					echo "--Status--";
					}
				
				else
					{				
					//diterima
					if ($row_rs_caloni['diterima'] == "1")
						{
						echo "Diterima";
						}
					
					if ($row_rs_caloni['diterima'] == "2")
						{
						echo "Tidak Diterima";
						}
					}
				?>
                </option>
                <?				
				}
			
			?>
                <option value="akt_psb1.php?kd=<?php echo $kd;?>&status=1">Diterima</option>
                <option value="akt_psb1.php?kd=<?php echo $kd;?>&status=2">Tidak 
                Diterima</option>
              </select> 
			  <?php
			  //diterima
					if ($row_rs_caloni['diterima'] == "1")
						{
						?>
					[<a href="akad_siswa_add.php?kd=<?php echo $row_rs1['kd'];?>&nama=<?php echo $row_rs1['nama'];?>&kd_kelamin=<?php echo $row_rs1['kd_kelamin'];?>&kd_agama=<?php echo $row_rs1['kd_agama'];?>&tmp_lahir=<?php echo $row_rs1['tmp_lahir'];?>&tgl=<?php echo $row_rs1['xtgl1'];?>&bln=<?php echo $row_rs1['xbln1'];?>&thn=<?php echo $row_rs1['xthn1'];?>&alamat=<?php echo $row_rs1['alamat'];?>&anakke=<?php echo $row_rs1['anak_ke'];?>&nm_ortu=<?php echo $row_rs1['nm_ortu'];?>&kd_pek=<?php echo $row_rs1['kd_pekerjaan'];?>"><?php echo "Pindahkan ke Data Siswa";?></a>]
						<?php
						}
						?></td>
          </tr>
          <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
        </table><br> <br> <?php if ($pageNum_rs1 > 0) { // Show if not first page ?>
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
		  } // Show if not last page 
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