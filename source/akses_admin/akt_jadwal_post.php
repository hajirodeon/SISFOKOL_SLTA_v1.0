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

//ambil nilai
$studikod = $_REQUEST['studikod'];
$kelkod = $_REQUEST['kelkod'];
$rukod = $_REQUEST['rukod'];
$harikod = $_REQUEST['harikod'];
$jamkod = $_REQUEST['jamkod'];

//program studi
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsjur = "SELECT * FROM m_progstudi WHERE kd = '$studikod'";
$rsjur = mysql_query($query_rsjur, $sisfokol) or die(mysql_error());
$row_rsjur = mysql_fetch_assoc($rsjur);
$totalRows_rsjur = mysql_num_rows($rsjur);

//kelas
mysql_select_db($database_sisfokol, $sisfokol);
$query_rskel = "SELECT * FROM m_kelas WHERE kd = '$kelkod'";
$rskel = mysql_query($query_rskel, $sisfokol) or die(mysql_error());
$row_rskel = mysql_fetch_assoc($rskel);
$totalRows_rskel = mysql_num_rows($rskel);

//ruang
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsru = "SELECT * FROM m_ruang WHERE kd = '$rukod'";
$rsru = mysql_query($query_rsru, $sisfokol) or die(mysql_error());
$row_rsru = mysql_fetch_assoc($rsru);
$totalRows_rsru = mysql_num_rows($rsru);

//hari
mysql_select_db($database_sisfokol, $sisfokol);
$query_rshari = "SELECT * FROM m_hari WHERE kd = '$harikod'";
$rshari = mysql_query($query_rshari, $sisfokol) or die(mysql_error());
$row_rshari = mysql_fetch_assoc($rshari);
$totalRows_rshari = mysql_num_rows($rshari);

//jam
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsjam = "SELECT * FROM m_jam_pel WHERE kd = '$jamkod'";
$rsjam = mysql_query($query_rsjam, $sisfokol) or die(mysql_error());
$row_rsjam = mysql_fetch_assoc($rsjam);
$totalRows_rsjam = mysql_num_rows($rsjam);

//guru
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsguru = "SELECT m_guru.*, m_guru.kd AS mgkd, m_pelajaran.*, m_pegawai.* ".
					"FROM m_guru, m_pegawai, m_pelajaran ".
					"WHERE m_guru.kd_pegawai = m_pegawai.kd ".
					"AND m_guru.kd_pelajaran = m_pelajaran.kd ".
					"AND m_guru.kd_progstudi = '$studikod' ".
					"AND m_guru.kd_kelas = '$kelkod' ".
					"ORDER BY m_pelajaran.pelajaran ASC";
$rsguru = mysql_query($query_rsguru, $sisfokol) or die(mysql_error());
$row_rsguru = mysql_fetch_assoc($rsguru);
$totalRows_rsguru = mysql_num_rows($rsguru);
?>
<html>
<head>
<title>Isi Jadwal</title>
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
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="36%"><a href="akt_jadwal.php?studikod=<?php echo $studikod;?>&kelkod=<?php echo $kelkod;?>&rukod=<?php echo $rukod;?>">Jadwal Pelajaran</a> &gt; Isi Jadwal</td>
            <td width="64%"><div align="right">
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
        <p><img src="images/adm_akt_jadwal_isi.gif" width="302" height="40"></p>
        <form action="akt_jadwal_post1.php" method="post" name="frmisi" id="frmisi">
          <p>Program Studi : <?php echo $row_rsjur['progstudi']?></p>
          <p>Kelas : <?php echo $row_rskel['kelas']?></p>
          <p>Ruang : <?php echo $row_rsru['ruang']?></p>
          <p>Hari : <?php echo $row_rshari['hari']?></p>
          <p>Jam : <?php echo $row_rsjam['jam']?></p>
          <p>Guru : 
            <select name="guru" id="guru">
			<?php
			//jika kosong
	if ($totalRows_rsguru == 0)
		{
		?>
			<option>--Guru--</option>
			<?php
			}	
	
	else if ($totalRows_rsguru != 0)//nek eneng isine...
	  	{ 
			?>
			
              <option>--Guru--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsguru['mgkd']?>"><?php echo $row_rsguru['pelajaran']?> 
              -> [<?php echo $row_rsguru['nama']?>]</option>
              <?php
} while ($row_rsguru = mysql_fetch_assoc($rsguru));
  $rows = mysql_num_rows($rsguru);
  if($rows > 0) {
      mysql_data_seek($rsguru, 0);
	  $row_rsguru = mysql_fetch_assoc($rsguru);
  }
  }
?>
            </select>
          </p>
          <p> 
            <input name="tapelkod" type="hidden" id="tapelkod" value="<?php echo $row_rstapel['kd'];?>">
            <input name="smtkod" type="hidden" id="smtkod" value="<?php echo $row_rssmt['kd'];?>">
            <input name="studikod" type="hidden" id="studikod" value="<?php echo $_REQUEST['studikod'];?>">
            <input name="kelkod" type="hidden" id="kelkod" value="<?php echo $_REQUEST['kelkod'];?>">
            <input name="rukod" type="hidden" id="rukod" value="<?php echo $_REQUEST['rukod'];?>">
            <input name="harikod" type="hidden" value="<?php echo $_REQUEST['harikod'];?>">
            <input name="jamkod" type="hidden" value="<?php echo $_REQUEST['jamkod'];?>">
            <input type="submit" name="Submit" value="Submit">
          </p>
        </form>
        <p>&nbsp;</p>
        </td>
    </tr>
  </table>
  <br>
  <?php include("include/footer.php"); ?>
</div>
</body>
</html>