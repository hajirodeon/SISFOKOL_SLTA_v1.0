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
?>
<html>
<head>
<title>Data Program Studi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<div align="center">
  <?php include("include/header.php"); ?>
  <?php include("include/menu.php"); ?>
  <br>
  <table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td> <p><img src="images/adm_m_akad_progstudi.gif" width="290" height="40"></p>
        <p>(<a href="akad_progstudi_add.php">Tambah Program Studi</a>)</p>
        <p> 
          <?php
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT * FROM m_progstudi ORDER BY progstudi ASC";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
          <? ///nek isih kosong
	if ($totalRows_rs1 == 0)
		{
		?>
          <font color="#FF0000"><strong>TIDAK ADA DATA PROGRAM STUDI</strong></font> 
          <?php
		}	
	
	else if ($totalRows_rs1 != 0)//nek eneng isine...
	  	{ 
	?>
        </p>
        <p><font color="#000000">Total : <strong><? echo "$totalRows_rs1";?></strong> 
          Program Studi</font><br>
        </p>
        <table width="400" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
          <tr> 
            <td width="9%"><strong><font color="#FFFFFF">No.</font></strong></td>
            <td width="91%"><strong><font color="#FFFFFF">Program Studi</font></strong></td>
          </tr>
        </table>

        <table width="400" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
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
            <td width="29"><?php 
			  $nomer = $nomer + 1;
			  echo "$nomer. ";
			  ?>
            </td>
            <td width="357"> 
              <?php
			$progstudi = balikin($row_rs1['progstudi']); 
			echo $progstudi; 
			?>
              <strong> </strong> [<a href="akad_progstudi_del.php?kd=<?php echo $row_rs1['kd']; ?>">HAPUS</a>]</td>
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