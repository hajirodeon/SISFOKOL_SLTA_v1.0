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
?>
<html>
<head>
<title>Absensi Pegawai</title>
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
        <p> <strong>ABSENSI HARIAN PEGAWAI</strong>
        <p> 
          <select name="bulan" id="bulan" onChange="MM_jumpMenu('parent',this,0)">
            <?php
			 if ($bulan != "")
				{
				if ($bulan == "01")
					{?>
            <option value="kepg_pegawai_absensi.php?bulan=1" selected><? echo "Januari";
					}
				
				else if ($bulan == "02")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=2" selected><? echo "Februari";
					}
				
				else if ($bulan == "03")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=3" selected><? echo "Maret";
					}
				
				else if ($bulan == "04")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=4" selected><? echo "April";
					}
				
				else if ($bulan == "05")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=5" selected><? echo "Mei";
					}
				
				else if ($bulan == "06")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=6" selected><? echo "Juni";
					}
				
				else if ($bulan == "07")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=7" selected><? echo "Juli";
					}
				
				else if ($bulan == "08")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=8" selected><? echo "Agustus";
					}
				
				else if ($bulan == "09")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=9" selected><? echo "September";
					}
				
				else if ($bulan == "10")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=10" selected><? echo "Oktober";
					}
				
				else if ($bulan == "11")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=11" selected><? echo "Nopember";
					}
				
				else if ($bulan == "12")
					{
					?>
				
				<option value="kepg_pegawai_absensi.php?bulan=12" selected><? echo "Desember";
					}
				}
			
			else
				{
				?>
				
				<option selected><? echo "-Bulan-";
				}
			  ?></option>
              <option value="kepg_pegawai_absensi.php?bulan=1">Januari</option>
              <option value="kepg_pegawai_absensi.php?bulan=2">Februari</option>
              <option value="kepg_pegawai_absensi.php?bulan=3">Maret</option>
              <option value="kepg_pegawai_absensi.php?bulan=4">April</option>
              <option value="kepg_pegawai_absensi.php?bulan=5">Mei</option>
              <option value="kepg_pegawai_absensi.php?bulan=6">Juni</option>
              <option value="kepg_pegawai_absensi.php?bulan=7">Juli</option>
              <option value="kepg_pegawai_absensi.php?bulan=8">Agustus</option>
              <option value="kepg_pegawai_absensi.php?bulan=9">September</option>
              <option value="kepg_pegawai_absensi.php?bulan=10">Oktober</option>
              <option value="kepg_pegawai_absensi.php?bulan=11">November</option>
              <option value="kepg_pegawai_absensi.php?bulan=12">Desember</option>
            </select>
          <select name="tahun" id="tahun" onChange="MM_jumpMenu('parent',this,0)">
            <?
		  	//tahun

			if ($_REQUEST['tahun'] == "")
				{
				echo "<option selected>-Tahun-</option>";
				}
				
			else
			
				{
				?>
            <option selected> 
            <?
			$tahun = $_REQUEST['tahun'];
			
			//terpilih
 			echo $tahun; ?>
            </option>
            <?
				}


			for ($i=2006; $i<=2020;$i++) 
				{  
				?>
            <option value="kepg_pegawai_absensi.php?bulan=<?php echo $_REQUEST['bulan'];?>&tahun=<?php echo $i;?>"><? echo $i;?></option>
            <?
				} 
		?>
          </select>        
        <p> 
          <?php
		if ($_REQUEST['bulan'] == "")
			{
			?>
          <font color="#FF0000"><strong>Bulan Belum Dipulih!</strong></font> 
          <?php
			}
		
		else if ($_REQUEST['tahun'] == "")
			{
			?>
          <font color="#FF0000"><strong>Tahun Belum Dipilih!</strong></font> 
          <?php
			}
		
		else
			{
			?>
        <p>
          <?php
///nek isih kosong
	if ($totalRows_rs1 == 0)
		{?>
        <table width="100%" height="300" border="0" cellpadding="0" cellspacing="0">
          <tr valign="top">
            <td><font color="#FF0000"><strong>TIDAK ADA DATA PEGAWAI</strong></font></td>
  </tr>
</table>
        <?
		}	
	
	else if ($totalRows_rs1 != 0)//nek eneng isine...
	  	{ 
	
	//mendapatkan jumlah tanggal maksimum dalam suatu bulan
$tgl = 0;
$bulan = $_REQUEST['bulan'];
$bln = $bulan + 1;
$thn = $_REQUEST['tahun'];

$lastday = mktime (0,0,0,$bln,$tgl,$thn);

//total tanggal dalam sebulan
$total = strftime ("%d", $lastday);

//ambil nilai
$istart = $_REQUEST['istart'];

//kondisi - kondisi
if (($istart == 1) OR ($istart == ""))
	{
	//tanggal mulai
	$iten = 1;
	
	//10 hari pertama
	$teni = 10;
	}

else if ($istart == 2)
	{
	//tanggal mulai
	$iten = 11;
	
	//10 hari kedua
	$teni = 20;
	}

else if ($istart == 3)
	{
	//tanggal mulai
	$iten = 21;
	
	//sisa hari
	$teni = $total;
	}

	?>
	
        <table width="750" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><div align="right"> 
                <?php
			//jika istart=1
			if (($_REQUEST['istart'] == 1) OR ($_REQUEST['istart'] == ""))
				{
				?>
                <strong><font color="#CCCCCC"><<<</font></strong> 
                <?
				}
			
			else
				{
				?>
                <a href="<?php 
			$ngurl = "kepg_pegawai_absensi.php?bulan=$bulan&tahun=$tahun";
			
			//jika istart kosong
			if ($istart == 3)
				{
				$start = 2;
				}
			
			else if ($istart == 2)
				{
				$start = 1;
				}
			
			//else if ($istart == 1)
			//	{
			//	$start = 1;
			//	}
				
			echo "$ngurl&istart=$start";
			
			
			?>"><strong><<<</strong></a> 
                <?php
				}
				?>
                | 
                <?php
			//jika istart=3
			if ($_REQUEST['istart'] == 3)
				{
				?>
                <strong><font color="#CCCCCC">>>></font></strong> 
                <?
				}
			
			else
				{
				?>
                <a href="<?php 
			$ngurl = "kepg_pegawai_absensi.php?bulan=$bulan&tahun=$tahun";
			
			//jika istart kosong
			if (($istart == "") OR ($istart == 1))
				{
				$istart = 2;
				}
			
			else if ($istart == 2)
				{
				$istart = 3;
				}
			
			//else if ($istart == 3)
			//	{
			//	$istart = 3;
			//	}
				
			echo "$ngurl&istart=$istart";
			
			
			?>"><strong>&gt;&gt;&gt;</strong></a> 
                <?php
				}
				?>
              </div></td>
          </tr>
        </table> 
        <table width="750" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="100" valign="middle"><font color="#FFFFFF"><strong>NIP</strong></font></td>
            <td width="150" valign="middle"><font color="#FFFFFF"><strong>Nama</strong></font></td>
			              <?

for ($i=$iten; $i<=$teni;$i++) 
			{
			?>		
            <td width="40" valign="middle"> 
              <div align="center"><font color="#FFFFFF"><?php echo $i;?></font></div></td>
			<?php
			}
			?>
          </tr>
        </table>
        <table width="750" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
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
            <td width="100" valign="middle"> 
              <?php 
			echo balikin($row_rs1['nip']); 
			?>
            </td>
            <td width="150" valign="middle"> 
              <?php 
			echo balikin($row_rs1['nama']); 
			?>
            </td><?
for ($i=$iten; $i<=$teni;$i++) 
			{
			?>
            <td width="40" valign="middle"> 
              <div align="center"><?php
			  //ambil nilai
			  $kd = $row_rs1['kd'];
			  $tgl = $i;
			  $bulan = $_REQUEST['bulan'];
			  $tahun = $_REQUEST['tahun'];
			  $tglx = ("$tahun:$bulan:$tgl");
			  
			  //jika absen
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsabsen = "SELECT pegawai_absensi.*, m_ket.* ".
					"FROM pegawai_absensi, m_ket ".
					"WHERE pegawai_absensi.kd_ket = m_ket.kd ".
					"AND pegawai_absensi.kd_pegawai = '$kd' ".
					"AND pegawai_absensi.tgl_absensi = '$tglx'";
$rsabsen = mysql_query($query_rsabsen, $sisfokol) or die(mysql_error());
$row_rsabsen = mysql_fetch_assoc($rsabsen);
$totalRows_rsabsen = mysql_num_rows($rsabsen);

if ($totalRows_rsabsen == 0)
	{
?><a href="kepg_pegawai_absensi1.php?kd=<?php echo $row_rs1['kd'];?>&tgl=<?php echo $i;?>&bulan=<?php echo $_REQUEST['bulan'];?>&tahun=<?php echo $_REQUEST['tahun'];?>">-</a><?php
	}

else if ($totalRows_rsabsen != 0)
	{
	?><font color="#FF0000"><strong><?php echo $row_rsabsen['iket'];?></strong></font> 
                <?php 
	}
	?>
              </div></td><?php
			}
			?>
          </tr>
          <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
        </table>
        <p></p>
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
		
		
       <p><strong>Keterangan : </strong></p>
        <p><strong><font color="#FF0000">I</font></strong> : Ijin</p>
        <p><strong><font color="#FF0000">S</font></strong> : Sakit</p>
        <p><strong><font color="#FF0000">T</font></strong> : Tanpa Keterangan</p>
        <p> 
          <?php
	   }
	   }
	   ?>
        </p>
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