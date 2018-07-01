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
$kd = cegah($_REQUEST['kd']);
	  	  
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT DATE_FORMAT(tgl, '%d') AS xtgl1, DATE_FORMAT(tgl, '%m') AS xbln1, ".
				"DATE_FORMAT(tgl, '%Y') AS xthn1, DATE_FORMAT(tgl_kembali, '%d') AS xtgl2, ".
				"DATE_FORMAT(tgl_kembali, '%m') AS xbln2, DATE_FORMAT(tgl_kembali, '%Y') AS xthn2, ".
				"inv_peng_peraga.*, inv_alat_peraga.*, m_guru.*, m_pegawai.* ".
				"FROM inv_peng_peraga, inv_alat_peraga, m_guru, m_pegawai ".
				"WHERE inv_peng_peraga.kd_alat_peraga = inv_alat_peraga.kd ".
				"AND inv_peng_peraga.kd_guru = m_guru.kd ".
				"AND m_guru.kd_pegawai = m_pegawai.kd ".
				"AND inv_peng_peraga.kd = '$kd'";
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

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="5" marginheight="5">
<div align="left"> 
  <table width="450" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top"> 
      <td width="450"><p><strong>Tanggal Pinjam :</strong><br>
          <?php echo $row_rs1['xtgl1']; ?> 
          <?php 
		  $nilbln = $row_rs1['xbln1'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
          <?php echo $row_rs1['xthn1']; ?> </p>
        <p><strong>Nama Alat Peraga : </strong><br>
          <?php echo balikin($row_rs1['alat_peraga']);?></p>
        <p><strong>Jumlah :</strong> <br>
          <?php echo balikin($row_rs1['jumlah']);?></p>
        <p><strong>Peminjam : </strong><br>
          <?php echo balikin($row_rs1['nama']);?></p>
        <p><strong>Tanggal Kembali :</strong><br>
          <?php echo $row_rs1['xtgl2']; ?> 
          <?php 
		  $nilbln = $row_rs1['xbln2'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
          <?php echo $row_rs1['xthn2']; ?> </p>
        <p><strong>Keterangan : </strong><br>
          <?php echo balikin($row_rs1['ket']);?></p>
        <p>&nbsp;</p>
        </td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_close($sisfokol);
?>