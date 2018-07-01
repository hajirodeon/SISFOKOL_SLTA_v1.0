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

$query_rsx = "SELECT m_siswa.kd AS mskd, m_siswa.*, siswa_progstudi.*, siswa_kelas.*, siswa_ruang.* ".
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
<title>Wali Kelas : <?php echo balikin($row_rs1['nama']);?> --> ABSENSI HARIAN SISWA</title>
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
        <p><big><img src="images/absensi.gif" width="300" height="40"></big></p>
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
            Program Studi : <?php echo balikin($_REQUEST['progstudi']);?>, Kelas 
            : <?php echo balikin($_REQUEST['kelas']);?>, Ruang : <?php echo balikin($_REQUEST['ruang']);?> 
            <?php
				}
				?>
            </option>
            <?
			do 
				{  
				?>
            <option value="absensi.php?mpkd=<?php echo $row_rsi['mpkd'];?>&progstudi=<?php echo $row_rsi['progstudi'];?>&mkkd=<?php echo $row_rsi['mkkd'];?>&kelas=<?php echo $row_rsi['kelas'];?>&mrkd=<?php echo $row_rsi['mrkd'];?>&ruang=<?php echo $row_rsi['ruang'];?>">Program 
            Studi : <?php echo balikin($row_rsi['progstudi']);?>, Kelas : <?php echo balikin($row_rsi['kelas']);?>, 
            Ruang : <?php echo balikin($row_rsi['ruang']);?></option>
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
        <p><select name="bulan" id="bulan" onChange="MM_jumpMenu('parent',this,0)">
            <?php
			 if ($bulan != "")
				{
				if ($bulan == "01")
					{?>
            <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=1" selected><? echo "Januari";
					}
				
				else if ($bulan == "02")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=2" selected><? echo "Februari";
					}
				
				else if ($bulan == "03")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=3" selected><? echo "Maret";
					}
				
				else if ($bulan == "04")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=4" selected><? echo "April";
					}
				
				else if ($bulan == "05")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=5" selected><? echo "Mei";
					}
				
				else if ($bulan == "06")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=6" selected><? echo "Juni";
					}
				
				else if ($bulan == "07")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=7" selected><? echo "Juli";
					}
				
				else if ($bulan == "08")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=8" selected><? echo "Agustus";
					}
				
				else if ($bulan == "09")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=9" selected><? echo "September";
					}
				
				else if ($bulan == "10")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=10" selected><? echo "Oktober";
					}
				
				else if ($bulan == "11")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=11" selected><? echo "Nopember";
					}
				
				else if ($bulan == "12")
					{
					?>
				
				<option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=12" selected><? echo "Desember";
					}
				}
			
			else
				{
				?>
				
				<option selected><? echo "-Bulan-";
				}
			  ?></option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=1">Januari</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=2">Februari</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=3">Maret</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=4">April</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=5">Mei</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=6">Juni</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=7">Juli</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=8">Agustus</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=9">September</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=10">Oktober</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=11">November</option>
              <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=12">Desember</option>
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
            <option value="absensi.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&bulan=<?php echo $_REQUEST['bulan'];?>&tahun=<?php echo $i;?>"><? echo $i;?></option>
            <?
				} 
		?>
          </select> &nbsp;</p>
        <p> 
          <?php
		//jika belum dipilih
		if ($_REQUEST['mpkd'] == "")
			{
			?>
          <font color="#FF0000"><strong>Kategori Belum Dipilih!</strong></font> 
          <?php
			}
		
		else if ($_REQUEST['bulan'] == "")
			{
			?>
          <font color="#FF0000"><strong>Bulan Belum Dipilih!</strong></font> 
          <?
			}
		
		else if ($_REQUEST['tahun'] == "")
			{
			?>
          <font color="#FF0000"><strong>Tahun Belum Dipilih!</strong></font> 
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
			$ngurl = "absensi.php?mpkd=$mpkd&progstudi=$progstudi&mkkd=$mkkd&kelas=$kelas&mrkd=$mrkd&ruang=$ruang&bulan=$bulan&tahun=$tahun";
			
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
			$ngurl = "absensi.php?mpkd=$mpkd&progstudi=$progstudi&mkkd=$mkkd&kelas=$kelas&mrkd=$mrkd&ruang=$ruang&bulan=$bulan&tahun=$tahun";
			
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
            <td width="100"><font color="#FFFFFF"><strong>NIS</strong></font></td>
            <td width="150"><font color="#FFFFFF"><strong>Nama</strong></font></td>
			<?

for ($i=$iten; $i<=$teni;$i++) 
			{
			?>
            <td width="40"> 
              <div align="center"><strong><font color="#FFFFFF"><?php echo $i;?></font></strong></div></td>
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
            <td width="100"><?php echo $row_rsx['nis'];?></td>
            <td width="150"><?php echo $row_rsx['nama'];?></td>
			<?

for ($i=$iten; $i<=$teni;$i++) 
			{
			?>
            <td width="40"> 
              <div align="center"><?php
			  //ambil nilai
			  $kd = $row_rsx['mskd'];
			  $tgl = $i;
			  $bulan = $_REQUEST['bulan'];
			  $tahun = $_REQUEST['tahun'];
			  $tglx = ("$tahun:$bulan:$tgl");
			  
			  //jika absen
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsabsen = "SELECT siswa_absensi.*, m_ket.* ".
					"FROM siswa_absensi, m_ket ".
					"WHERE siswa_absensi.kd_ket = m_ket.kd ".
					"AND siswa_absensi.kd_siswa = '$kd' ".
					"AND siswa_absensi.tgl_absensi = '$tglx'";
$rsabsen = mysql_query($query_rsabsen, $sisfokol) or die(mysql_error());
$row_rsabsen = mysql_fetch_assoc($rsabsen);
$totalRows_rsabsen = mysql_num_rows($rsabsen);

if ($totalRows_rsabsen == 0)
	{
?><a href="absensi1.php?kd=<?php echo $row_rsx['mskd'];?>&tgl=<?php echo $i;?>&bulan=<?php echo $_REQUEST['bulan'];?>&tahun=<?php echo $_REQUEST['tahun'];?>&mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&istart=<?php echo $_REQUEST['istart'];?>">-</a><?php
	}

else if ($totalRows_rsabsen != 0)
	{
	?><font color="#FF0000"><strong><?php echo $row_rsabsen['iket'];?></strong></font> 
                <?php 
	}
	?>
              </div></td>
			<?php
			}
			?>
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
        <p> <strong>Keterangan : </strong></p>
        <p><strong><font color="#FF0000">I</font></strong> : Ijin</p>
        <p><strong><font color="#FF0000">S</font></strong> : Sakit</p>
        <p><strong><font color="#FF0000">T</font></strong> : Tanpa Keterangan</p>
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