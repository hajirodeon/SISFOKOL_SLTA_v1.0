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
				"DATE_FORMAT(tgl_lahir, '%Y') AS xthn1, m_pegawai.*, m_pegawai.kd AS mkdp, ".
				"m_kelamin.*, m_agama.* FROM m_pegawai, m_kelamin, m_agama ".
				"WHERE m_pegawai.kd_kelamin = m_kelamin.kd ".
				"AND m_pegawai.kd_agama = m_agama.kd ".
				"AND m_pegawai.kd = '$kd'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title>Profil : <?php echo $row_rs1['nama'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" onLoad="window.print()" text="#000000" leftmargin="5" topmargin="5" marginwidth="5" marginheight="5">
<div align="left">
  <table width="450" border="0" cellpadding="2" cellspacing="0" bgcolor="#66CCCC">
    <tr> 
      <td width="444"><strong><font color="#FFFFFF"><?php echo balikin($row_rs1['nama']);?></font></strong></td>
    </tr>
  </table>
  <br>
  <table width="450" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top"> 
      <td width="245"><p><strong>NIP : </strong><br>
          <?php echo balikin($row_rs1['nip']);?></p>
        <p><strong>Nama : </strong><br>
          <?php echo balikin($row_rs1['nama']);?></p>
        <p><strong>Jenis Kelamin : </strong><br>
          <?php echo balikin($row_rs1['kelamin']);?></p>
        <p><strong>TTL :</strong> <br>
          <?php echo balikin($row_rs1['tmp_lahir']); ?>, <?php echo balikin($row_rs1['xtgl1']); ?> 
          <?php 
		  $nilbln = $row_rs1['xbln1'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
          <?php echo balikin($row_rs1['xthn1']); ?> </p>
        <p><strong>Kawin / Tidak Kawin :</strong><br>
          <?php 
		  //jika kawin
		  if (balikin($row_rs1['kawin']) == 'true')
		  	{
			echo "Kawin";
			}
		
		else if (balikin($row_rs1['kawin']) == 'false')
			{	
		  	echo "Tidak Kawin";
			}
		  
		  ?>
        </p>
        <p><strong>Bangsa :</strong><br>
          <?php echo balikin($row_rs1['bangsa']);?> </p>
        <p>&nbsp;</p></td>
      <td width="205"><div align="center"> 
          <?php
	//jika foto masih kosong
	if ($row_rs1['foto'] == "")
		{
		?>
          <img src="../images/tmp.foto.jpg" width="99" height="127" border="0"> 
          <?
		}
	
	else
		{
	?>
          <img src="../filebox/pegawai/<?php echo $row_rs1['mkdp'];?>/foto/<?php echo $row_rs1['foto'];?>" width="99" height="127"> 
          <?php
		}
	?>
        </div></td>
    </tr>
    <tr valign="top"> 
      <td colspan="2"><p><strong>Agama :</strong><br>
          <?php echo balikin($row_rs1['agama']);?> </p>
        <p><strong>Pangkat :</strong><br>
          <?php echo balikin($row_rs1['pangkat']);?> </p>
        <p><strong>Jabatan :</strong><br>
          <?php echo balikin($row_rs1['jabatan']);?> </p>
        <p><strong>Status :</strong><br>
          <?php 
		  //jika tetap		  
		  if (balikin($row_rs1['status']) == 'true')
		  	{
			echo "Tetap";
			}
		
		else if (balikin($row_rs1['status']) == 'false')
			{
			echo "Tidak Tetap";
			}?>
        </p>
        <p><strong>Alamat :</strong><br>
          <?php echo balikin($row_rs1['alamat']);?> </p>
        <p>&nbsp;</p>
        <table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#66CCCC">
          <tr> 
            <td><strong><font color="#FFFFFF">PENDIDIKAN</font></strong></td>
          </tr>
        </table>
        <p> 
          <?php
		$kd_pegawai = $row_rs1['mkdp'];
		mysql_select_db($database_sisfokol, $sisfokol);

$query_rspend = "SELECT * FROM pegawai_pddkn WHERE kd_pegawai = '$kd_pegawai'";
$rspend = mysql_query($query_rspend, $sisfokol) or die(mysql_error());
$row_rspend = mysql_fetch_assoc($rspend);
$totalRows_rspend = mysql_num_rows($rspend);
		?>
        </p>
        <p><strong>SD : </strong><br>
          <?php echo balikin($row_rspend['pend_sd']);?> (<?php echo balikin($row_rspend['tahun_sd']);?>)</p>
        <p><strong>SLTP : </strong><br>
          <?php echo balikin($row_rspend['pend_sltp']);?> (<?php echo balikin($row_rspend['tahun_sltp']);?>)</p>
        <p><strong>SLTA : </strong><br>
          <?php echo balikin($row_rspend['pend_slta']);?> (<?php echo balikin($row_rspend['tahun_slta']);?>)</p>
        <p><strong>Kuliah : </strong><br>
          <?php echo balikin($row_rspend['pend_kuliah']);?> (<?php echo balikin($row_rspend['tahun_kuliah']);?>)</p></td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_close($sisfokol);
?>