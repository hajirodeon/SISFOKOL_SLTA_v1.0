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
$kat = cegah($_POST['kat']);
$cari = cegah($_POST['cari']);

mysql_select_db($database_sisfokol, $sisfokol);

//kategori pencarian
switch ($kat) {
	case nip:   
		$query_rs1 = "SELECT * FROM m_pegawai WHERE nip LIKE '%$cari%' ORDER BY nip ASC";
		break;
	
	case nama:
		$query_rs1 = "SELECT * FROM m_pegawai WHERE nama LIKE '%$cari%' ORDER BY nip ASC";
		break;

	case jabatan:
		$query_rs1 = "SELECT * FROM m_pegawai WHERE jabatan LIKE '%$cari%' ORDER BY nip ASC";
		break;

	case pangkat:
		$query_rs1 = "SELECT * FROM m_pegawai WHERE pangkat LIKE '%$cari%' ORDER BY nip ASC";
		break;

	case alamat:
		$query_rs1 = "SELECT * FROM m_pegawai WHERE alamat LIKE '%$cari%' ORDER BY nip ASC";
		break;
}
	

$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title>Hasil Pencarian Pegawai</title>
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
          <tr valign="top"> 
            <td> <p><a href="kepg_pegawai.php">Data Pegawai</a> &gt; Hasil Pencarian</p>
              <p><img src="images/hasil_pencarian.gif" width="306" height="40"></p>
              <div align="right"></div></td>
          </tr>
        </table>
        <p> 
          <? ///nek isih kosong
	if ($totalRows_rs1 == 0)
		{
		?>
          <font color="#FF0000"><strong>TIDAK ADA DATA PEGAWAI</strong></font> 
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
            <td width="98"><font color="#FFFFFF"><strong>NIP</strong></font></td>
            <td width="150"><font color="#FFFFFF"><strong>Nama</strong></font></td>
            <td width="200"><font color="#FFFFFF"><strong>Pangkat</strong></font></td>
            <td width="200"><font color="#FFFFFF"><strong>Jabatan</strong></font></td>
            <td width="293">&nbsp;</td>
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
            <td width="98"> 
              <?php 
			echo balikin($row_rs1['nip']); 
			?>
              <strong> </strong> </td>
            <td width="150"> 
              <?php 
			echo balikin($row_rs1['nama']); 
			?>
            </td>
            <td width="200"> 
              <?php 
			echo balikin($row_rs1['pangkat']); 
			?>
            </td>
            <td width="200"> 
              <?php 
			echo balikin($row_rs1['jabatan']); 
			?>
            </td>
            <td width="293">[ 
              <a href="javascript:MM_openBrWindow('kepg_pegawai_detail.php?kd=<?php echo $row_rs1['kd']; ?>','','width=500,height=250,toolbar=no,menubar=no,location=no,scrollbars=yes,resize=no')">DETAIL</a> 
              | <a href="javascript:MM_openBrWindow('kepg_pegawai_print.php?kd=<?php echo $row_rs1['kd']; ?>','','width=500,height=250,toolbar=no,menubar=no,location=no,scrollbars=yes,resize=no')">PRINT</a> 
              | <a href="kepg_pegawai_del.php?kd=<?php echo $row_rs1['kd']; ?>">HAPUS</a> 
              ]</td>
          </tr>
          <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
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