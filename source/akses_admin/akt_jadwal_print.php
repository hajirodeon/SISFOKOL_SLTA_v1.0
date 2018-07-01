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
				  
//hider
mysql_select_db($database_sisfokol, $sisfokol);
$query_rshider = "SELECT jadwal.*, m_progstudi.*, m_kelas.*, m_ruang.* ".
					"FROM jadwal, m_progstudi, m_kelas, m_ruang ".
					"WHERE jadwal.kd_progstudi = m_progstudi.kd ".
					"AND jadwal.kd_kelas = m_kelas.kd ".
					"AND jadwal.kd_ruang = m_ruang.kd";
$rshider = mysql_query($query_rshider, $sisfokol) or die(mysql_error());
$row_rshider = mysql_fetch_assoc($rshider);
$totalRows_rshider = mysql_num_rows($rshider);

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
</head>

<body bgcolor="#FFFFFF" onLoad="window.print()" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<div align="center"> <br>
  <table width="820" height="300" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><div align="center">
                <p><big><strong>JADWAL PELAJARAN</strong></big> </p>
                <p><strong>Program Studi :</strong> <?php echo $row_rshider['progstudi'];?>, <strong>Kelas :</strong> <?php echo $row_rshider['kelas'];?>, <strong>Ruang :</strong> <?php echo $row_rshider['ruang'];?></p>
              </div>
              <div align="right"> 
              </div></td>
          </tr>
        </table>
        <?
				{
		  ?>
        <table width="820" border="0" cellspacing="0" cellpadding="0">
          <tr valign="top"> 
            <td width="40">
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#99FFCC">
                <tr>
                  <td><div align="center"><strong>Jam</strong></div></td>
                </tr>
              </table></td>
            <td><table width="780" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#66CCCC">
                <tr> 
                  <?php
	   do { 
	   ?>
                  <td width="130"><font color="#FFFFFF"><strong><?php echo $row_rshari['hari'];?></strong></font></td>
                  <?php } while ($row_rshari = mysql_fetch_assoc($rshari)); ?>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="820" border="0" cellpadding="0" cellspacing="0">
          <tr valign="top"> 
            <td width="40" height="121">
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#99FFCC">
                <?php
	   do { 

	   ?>  <tr>  
                  <td height="30">
<div align="center"><strong><?php echo $row_rsjam['jam'];?></strong></div></td>
                </tr><?php } while ($row_rsjam = mysql_fetch_assoc($rsjam)); ?>
              </table></td>
            <td><table width="780" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
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
                  <td width="130" height="30" bgcolor="<? echo $warna; ?>"> 
                    <?php
				  //ambil nilai
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
                    - 
                    <?
	}
	
else
	{
?>
                    <span class="cilik"><?php echo $row_rsi['pelajaran'];?></span> <br>
                    <?php
}
?>
                  </td>
				  
				  
				  
				  
                  <?php } while ($row_rsharii = mysql_fetch_assoc($rsharii)); ?>
				  
				  
                </tr><?php } while ($row_rsjami = mysql_fetch_assoc($rsjami)); ?> 
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <br>
  <?php
  }
  ?>
</div>
</body>
</html>
<?php
mysql_close($sisfokol);
?>