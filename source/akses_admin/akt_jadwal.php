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
 
//koneksi
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 

//hari
mysql_select_db($database_sisfokol, $sisfokol);
$query_rshari = "SELECT * FROM m_hari";
$rshari = mysql_query($query_rshari, $sisfokol) or die(mysql_error());
$row_rshari = mysql_fetch_assoc($rshari);
$totalRows_rshari = mysql_num_rows($rshari);

//jam
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsjam = "SELECT * FROM m_jam_pel";
$rsjam = mysql_query($query_rsjam, $sisfokol) or die(mysql_error());
$row_rsjam = mysql_fetch_assoc($rsjam);
$totalRows_rsjam = mysql_num_rows($rsjam);
?>
<html>
<head>
<title>Jadwal Pelajaran</title>
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
            <td width="41%"><img src="images/adm_akt_jadwal.gif" width="303" height="40"></td>
            <td width="59%"><div align="right">
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
        <p>
          <select name="progstudi" id="progstudi" onChange="MM_jumpMenu('parent',this,0)">
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
            <option value="akt_jadwal.php?studikod=<? echo $row_rs_progstudi['kd']?>&progstudi=<? echo urlencode($row_rs_progstudi['progstudi']);?>"><? echo $row_rs_progstudi['progstudi'];?></option>
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
          </select>
          - 
          <select name="kelas" id="kelas" onChange="MM_jumpMenu('parent',this,0)">
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
            <option value="akt_jadwal.php?studikod=<? echo $_REQUEST['studikod']; ?>&progstudi=<? echo urlencode($_REQUEST['progstudi']); ?>&kelkod=<? echo $row_rs_kelas['kd'] ?>&kelas=<? echo $row_rs_kelas['kelas'] ?>"><? echo $row_rs_kelas['kelas']?></option>
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
          </select>
          - 
          <select name="ruang" id="ruang" onChange="MM_jumpMenu('parent',this,0)">
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
            <option value="akt_jadwal.php?studikod=<? echo $_REQUEST['studikod']; ?>&progstudi=<? echo urlencode($_REQUEST['progstudi']); ?>&kelkod=<? echo $_REQUEST['kelkod']; ?>&kelas=<? echo urlencode($_REQUEST['kelas']); ?>&rukod=<? echo $row_rs_ruang['kd'] ?>&ruang=<? echo $row_rs_ruang['ruang'] ?>"><? echo $row_rs_ruang['ruang']?></option>
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
          </select>
          <br>
          <br>
          <?php
		  //jika program studi kosong
		  	if ($_REQUEST['studikod'] == "")
		  		{
				?>
          <strong><font color="#FF0000">Program Studi harus dipilih dahulu</font></strong> 
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </p>
		  
        <?
				}
		
		  	else if ($_REQUEST['kelkod'] == "")
				{
				?>
        <strong><font color="#FF0000">Kelas belum dipilih!</font></strong> <br>
        <br> <br><br> <br><br>
        <?
				}
			
			else if ($_REQUEST['rukod'] == "")
				{
				?>
        <strong><font color="#FF0000">Ruang belum dipilih!</font></strong> <br>
        <br> <br><br> <br><br>
        <?
				}
			
			else
				{
		  ?>
        <p><a href="akt_jadwal_del.php?studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>">Kosongkan 
          Semua</a> | <a href="javascript:MM_openBrWindow('akt_jadwal_print.php?studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>','','width=330,height=130,toolbar=no,menubar=no,location=no,scrollbars=yes,resize=no')">Print</a></p>
        <table width="990" border="0" cellspacing="0" cellpadding="0">
          <tr valign="top"> 
            <td width="40">
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#99FFCC">
                <tr>
                  <td><div align="center"><strong>Jam</strong></div></td>
                </tr>
              </table></td>
            <td><table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
                <tr> 
                  <?php
	   do { 
	   ?>
                  <td width="158"><font color="#FFFFFF"><strong><?php echo $row_rshari['hari'];?></strong></font></td>
                  <?php } while ($row_rshari = mysql_fetch_assoc($rshari)); ?>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="990" border="0" cellpadding="0" cellspacing="0">
          <tr valign="top"> 
            <td width="40" height="121">
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#99FFCC">
                <?php
	   do { 

	   ?>  <tr>  
                  <td height="50">
<div align="center"><strong><?php echo $row_rsjam['jam'];?></strong></div></td>
                </tr><?php } while ($row_rsjam = mysql_fetch_assoc($rsjam)); ?>
              </table></td>
            <td><table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
                <?php
//jami
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsjami = "SELECT * FROM m_jam_pel";
$rsjami = mysql_query($query_rsjami, $sisfokol) or die(mysql_error());
$row_rsjami = mysql_fetch_assoc($rsjami);
$totalRows_rsjami = mysql_num_rows($rsjami);
			
	   do { 
	   
	   ?>  <tr>                  
                  <?php
				  //harii
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsharii = "SELECT * FROM m_hari";
$rsharii = mysql_query($query_rsharii, $sisfokol) or die(mysql_error());
$row_rsharii = mysql_fetch_assoc($rsharii);
$totalRows_rsharii = mysql_num_rows($rsharii);

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
                  <td width="158" height="50" bgcolor="<? echo $warna; ?>"> 
                    <?php
				  //ambil nilai
				  $studikod = $_REQUEST['studikod'];
				  $kelkod = $_REQUEST['kelkod'];
				  $rukod = $_REQUEST['rukod'];
				  $nhari = $row_rsharii['kd'];
				  $njampel = $row_rsjami['kd'];
				  
				  //jadwal
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsi = "SELECT jadwal.*, jadwal.kd AS jakd, m_guru.*, m_pelajaran.*, m_pegawai.*, ".
				"m_pegawai.nama AS mpnam ".
				"FROM jadwal, m_guru, m_pelajaran, m_pegawai ".
				"WHERE jadwal.kd_guru = m_guru.kd ".
				"AND m_guru.kd_pelajaran = m_pelajaran.kd ".
				"AND m_guru.kd_pegawai = m_pegawai.kd ".
				"AND jadwal.kd_progstudi = '$studikod' ".
				"AND jadwal.kd_kelas = '$kelkod' ".
				"AND jadwal.kd_ruang = '$rukod' ".
				"AND jadwal.kd_hari = '$nhari' ".
				"AND jadwal.kd_jam_pel = '$njampel'";
$rsi = mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);

//jika kosong
if ($row_rsi['kd_guru'] == "")
	{
	?>
                    <a href="akt_jadwal_post.php?tapelkod=<?php echo $row_rstapel['kd'];?>&smtkod=<?php echo $row_rssmt['kd'];?>&studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>&harikod=<?php echo $row_rsharii['kd'];?>&jamkod=<?php echo $row_rsjami['kd'];?>">Isi</a> 
                    <?
	}
	
else
	{
?>
                    <a href="javascript:MM_openBrWindow('akt_jadwal_detail.php?kd=<?php echo $row_rsi['jakd']; ?>','','width=330,height=130,toolbar=no,menubar=no,location=no,scrollbars=yes,resize=no')"><?php echo substr("<strong>$row_rsi[pelajaran]</strong> -> [$row_rsi[mpnam]]", 0, 50);?>...</a> 
                    <br>
                    [<a href="akt_jadwal_post.php?studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>&harikod=<?php echo $row_rsharii['kd'];?>&jamkod=<?php echo $row_rsjami['kd'];?>">GANTI</a> 
                    | <a href="akt_jadwal_del.php?tapelkod=<?php echo $row_rstapel['kd'];?>&smtkod=<?php echo $row_rssmt['kd'];?>&studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>&kd=<?php echo $row_rsi['jakd']; ?>">HAPUS</a>] 
                    <?php
}
?>
                  </td>
				  
				  
				  
				  
                  <?php } while ($row_rsharii = mysql_fetch_assoc($rsharii)); ?>
				  
				  
                </tr><?php } while ($row_rsjami = mysql_fetch_assoc($rsjami)); ?> 
              </table></td>
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