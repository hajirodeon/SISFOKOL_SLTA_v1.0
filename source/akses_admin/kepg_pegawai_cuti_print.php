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

//ambil nilai session
$kd = cegah($_REQUEST['kd']);
	  	  
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT m_pegawai.*, pegawai_cuti.*, m_satuan.* ".
				"FROM m_pegawai, pegawai_cuti, m_satuan ".
				"WHERE m_pegawai.kd = pegawai_cuti.kd_pegawai ".
				"AND m_satuan.kd = pegawai_cuti.kd_satuan ".
				"AND pegawai_cuti.kd = '$kd'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title><?php echo $row_rs1['nama'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" onLoad="window.print()" text="#000000" leftmargin="5" topmargin="5" marginwidth="5" marginheight="5">
<div align="left">
  <table width="450" border="0" cellpadding="2" cellspacing="0" bgcolor="#66CCCC">
    <tr> 
      <td width="444"><strong><font color="#FFFFFF">Cuti</font><font color="#FFFFFF"> 
        : <?php echo balikin($row_rs1['nama']);?></font></strong></td>
    </tr>
  </table>
  <br>
  <table width="450" border="0" align="left" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td> <p><strong>NIP : </strong><br>
          <?php echo balikin($row_rs1['nip']);?></p>
        <p><strong>Nama : </strong><br>
          <?php echo balikin($row_rs1['nama']);?></p>
        <p><strong>Jumlah : <br>
          </strong><?php echo balikin($row_rs1['jml']);?>
          <?php 
			echo balikin($row_rs1['satuan']); 
			?>
        </p>
        <p><strong>Waktu :<br>
          </strong><?php echo balikin($row_rs1['waktu']);?></p>
        <p><strong>Keterangan : <br>
          </strong><?php echo balikin($row_rs1['ket']);?></p>
        <p>&nbsp; </p>
		</td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_close($sisfokol);
?>