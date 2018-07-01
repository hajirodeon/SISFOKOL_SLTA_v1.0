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

$query_rs1 = "SELECT DATE_FORMAT(tgl_lahir, '%d') AS xtgl1, DATE_FORMAT(tgl_lahir, '%m') AS xbln1, ".
				"DATE_FORMAT(tgl_lahir, '%Y') AS xthn1, psb.*, m_kelamin.*, m_agama.* ".
				"FROM psb, m_kelamin, m_agama ".
				"WHERE psb.kd_kelamin = m_kelamin.kd ".
				"AND psb.kd_agama = m_agama.kd ".
				"AND psb.kd = '$kd'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title>Profil : <?php echo balikin($row_rs1['nama']);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="5" marginheight="5">
<div align="center">
  <table width="300" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top"> 
      <td> <p><strong>Nomer Pendaftaran: </strong><br>
          <?php echo $row_rs1['nomer'];?></p>
        <p><strong>Nama : </strong><br>
          <?php echo balikin($row_rs1['nama']);?></p>
        <p><strong>TTL :</strong> <br>
          <?php echo $row_rs1['xtgl1']; ?> 
          <?php 
		  $nilbln = $row_rs1['xbln1'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
          <?php echo $row_rs1['xthn1']; ?> </p>
        <p><strong>Jenis Kelamin : </strong><br>
          <?php echo $row_rs1['kelamin'];?></p>
        <p><strong>Bangsa : </strong><br>
          <?php echo balikin($row_rs1['bangsa']);?></p>
        <p><strong>Agama : </strong><br>
          <?php echo $row_rs1['agama'];?></p>
        <p><strong>Anak Ke : </strong><br>
          <?php echo $row_rs1['anak_ke'];?></p>
        <p><strong>Alamat :</strong><br>
          <?php echo balikin($row_rs1['alamat']);?> </p>
        <p><strong>Nama Orang Tua:</strong><br>
          <?php echo balikin($row_rs1['nm_ortu']);?></p>
        <p><strong>Pendidikan Terakhir:</strong><br>
          <?php echo balikin($row_rs1['pendidikan']);?></p>
        <p><strong>Pekerjaan :</strong><br>
          <?php 
		  	$pek = $row_rs1['kd_pekerjaan'];
				
			mysql_select_db($database_sisfokol, $sisfokol);
						
			$query_rsx = "SELECT * FROM m_pekerjaan WHERE kd = '$pek'";
			$rsx= mysql_query($query_rsx, $sisfokol) or die(mysql_error());
			$row_rsx = mysql_fetch_assoc($rsx);
			$totalRows_rsx = mysql_num_rows($rsx);
		  
		  	echo $row_rsx['pekerjaan'];
		  ?>
        </p>
        <p><strong>Alamat Pekerjaan:</strong><br>
          <?php echo balikin($row_rs1['almt_pek']);?></p>
        <p><strong>Ket :</strong><br>
          <?php echo balikin($row_rs1['ket']);?></p>
        <div align="center"> </div></td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_close($sisfokol);
?>