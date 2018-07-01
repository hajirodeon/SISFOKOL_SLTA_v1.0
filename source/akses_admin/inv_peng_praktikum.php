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
<title>Inventaris : Penggunaan Ruang Praktikum / Laboratorium</title>
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
    <td><p><strong><img src="images/adm_inv_peng_praktikum.gif" width="280" height="40"></strong></p>
      <p>Ruang Praktikum / Lab : 
        <br><select name="lab" id="lab" onChange="MM_jumpMenu('parent',this,0)">
          <?
		  	//program studi
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rslab = "SELECT * FROM inv_lab ORDER BY lab ASC";
			$rslab = mysql_query($query_rslab, $sisfokol) or die(mysql_error());
			$row_rslab = mysql_fetch_assoc($rslab);
			$totalRows_rslab = mysql_num_rows($rslab);			


			if ($_REQUEST['labkod'] == "")
				{
				echo "<option selected>--Lab--</option>";
				}
				
			else
			
				{
				?>
          <option selected> 
            <?
			$labkod = $_REQUEST['labkod'];
			
			//terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rsterlab = "SELECT * FROM inv_lab WHERE kd = '$labkod'";
			$rsterlab = mysql_query($query_rsterlab, $sisfokol) or die(mysql_error());
			$row_rsterlab = mysql_fetch_assoc($rsterlab);
			$totalRows_rsterlab = mysql_num_rows($rsterlab);			

 echo $row_rsterlab['lab']; ?>
            </option>
            <?
				}


			do 
				{  
				?>
            <option value="inv_peng_praktikum.php?labkod=<? echo $row_rslab['kd']?>&lab=<? echo urlencode($row_rslab['lab']);?>"><? echo $row_rslab['lab'];?></option>
            <?
				} 
		
			while ($row_rslab = mysql_fetch_assoc($rslab));
			
			$rows = mysql_num_rows($rslab);
  				if($rows > 0) 
						{
      					mysql_data_seek($rslab, 0);
						$row_rslab = mysql_fetch_assoc($rslab);
  						}
		?>
          </select>
		  
		  
		  
		  
		  </p>
		  
		  
      <?php
		  //jika ruang praktikum belum dipilih
		  if ($_REQUEST['labkod'] == "")
		  	{		  
		  ?>
      <font color="#FF0000"><strong>Silahkan Pilih Ruang Praktikum / Lab-nya! 
      </strong></font> 
      <?php
		  }
	else
		{
		?>
      <table width="990" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
        <tr> 
          <td width="40">
		  <table width="40" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#99FFCC">
              <tr>
                <td width="34"><div align="center"><strong><font color="#000000">JAM</font></strong></div></td>
              </tr>
            </table></td>
          <td width="950"><table width="950" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
              <tr> 
                <?php
	   do { 
	   ?>
                  <td width="158"><div align="center"><font color="#FFFFFF"><strong><?php echo $row_rshari['hari'];?></strong></font></div></td>
                  <?php } while ($row_rshari = mysql_fetch_assoc($rshari)); ?>
              </tr>
            </table></td>
        </tr>
      </table>
      <table width="990" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top"> 
          <td width="40"><table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#99FFCC">
              <?php
	   do { 

	   ?>  <tr>  
                  
                <td height="100"> 
                  <div align="center"><strong><?php echo $row_rsjam['jam'];?></strong></div></td>
                </tr><?php } while ($row_rsjam = mysql_fetch_assoc($rsjam)); ?>
            </table></td>
          <td width="950"><table width="950" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
              <?php
//jami
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsjami = "SELECT * FROM m_jam_pel";
$rsjami = mysql_query($query_rsjami, $sisfokol) or die(mysql_error());
$row_rsjami = mysql_fetch_assoc($rsjami);
$totalRows_rsjami = mysql_num_rows($rsjami);
			
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
	   ?>   <tr bgcolor="<? echo $warna; ?>"> 
	   <?php
				  //harii
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsharii = "SELECT * FROM m_hari";
$rsharii = mysql_query($query_rsharii, $sisfokol) or die(mysql_error());
$row_rsharii = mysql_fetch_assoc($rsharii);
$totalRows_rsharii = mysql_num_rows($rsharii);

	   do { 
	   ?>
                <td width="158" height="100">
				<?php
				//ambil nilai
				$kd_hari = $row_rsharii['kd'];
				$kd_jam = $row_rsjami['kd'];
				
				//jadwal penggunaan lab
mysql_select_db($database_sisfokol, $sisfokol);
$query_rspenglab = "SELECT m_progstudi.*, m_kelas.*, m_ruang.*, inv_peng_lab.kd AS iplkd, inv_peng_lab.* ".
					"FROM m_progstudi, m_kelas, m_ruang, inv_peng_lab ".
					"WHERE m_progstudi.kd = inv_peng_lab.kd_progstudi ".
					"AND m_kelas.kd = inv_peng_lab.kd_kelas ".
					"AND m_ruang.kd = inv_peng_lab.kd_ruang ".
					"AND inv_peng_lab.kd_hari = '$kd_hari' ".
					"AND inv_peng_lab.kd_jam = '$kd_jam' ".
					"AND kd_lab = '$labkod'";
$rspenglab = mysql_query($query_rspenglab, $sisfokol) or die(mysql_error());
$row_rspenglab = mysql_fetch_assoc($rspenglab);
$totalRows_rspenglab = mysql_num_rows($rspenglab);

				///nek isih kosong
	if ($totalRows_rspenglab == 0)
		{
				?>
					<a href="inv_peng_praktikum_post.php?labkod=<?php echo $_REQUEST['labkod'];?>&kd_hari=<?php echo $kd_hari;?>&hari=<?php echo $row_rsharii['hari'];?>&kd_jam=<?php echo $kd_jam;?>&jam=<?php echo $row_rsjami['jam'];?>">ISI</a>
					
		<?php
		}
	else
		{
		?>			
					<strong><?php echo $row_rspenglab['progstudi'];?></strong> - <strong><?php echo $row_rspenglab['kelas'];?><?php echo $row_rspenglab['ruang'];?></strong> <br>
                  [<a href="inv_peng_praktikum_post.php?labkod=<?php echo $_REQUEST['labkod'];?>&kd_hari=<?php echo $kd_hari;?>&hari=<?php echo $row_rsharii['hari'];?>&kd_jam=<?php echo $kd_jam;?>&jam=<?php echo $row_rsjami['jam'];?>">GANTI</a> 
                  | <a href="inv_peng_praktikum_del.php?kd=<?php echo $row_rspenglab['iplkd'];?>&labkod=<?php echo $_REQUEST['labkod'];?>&lab=<?php echo $_REQUEST['lab'];?>&kd_hari=<?php echo $kd_hari;?>&hari=<?php echo $row_rsharii['hari'];?>&kd_jam=<?php echo $kd_jam;?>&jam=<?php echo $row_rsjami['jam'];?>">HAPUS</a>] 
                  <?php
					}
					?>
                </td>
              
				<?php } while ($row_rsharii = mysql_fetch_assoc($rsharii)); ?>
              </tr>
			  <?php } while ($row_rsjami = mysql_fetch_assoc($rsjami)); ?>
            </table></td>
        </tr>
      </table>
      <?php
	  }
	  ?></td>
  </tr>
</table><br>
<?php include("include/footer.php"); ?>
</body>
</html>
<?php
mysql_close($sisfokol);
?>