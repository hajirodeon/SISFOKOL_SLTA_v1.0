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

//program studi
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsprogstudi = "SELECT * FROM m_progstudi ORDER BY progstudi ASC";
$rsprogstudi = mysql_query($query_rsprogstudi, $sisfokol) or die(mysql_error());
$row_rsprogstudi = mysql_fetch_assoc($rsprogstudi);
$totalRows_rsprogstudi = mysql_num_rows($rsprogstudi);

//kelas
mysql_select_db($database_sisfokol, $sisfokol);
$query_rskelas = "SELECT * FROM m_kelas ORDER BY kelas ASC";
$rskelas = mysql_query($query_rskelas, $sisfokol) or die(mysql_error());
$row_rskelas = mysql_fetch_assoc($rskelas);
$totalRows_rskelas = mysql_num_rows($rskelas);

//ruang
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsruang = "SELECT * FROM m_ruang ORDER BY ruang ASC";
$rsruang = mysql_query($query_rsruang, $sisfokol) or die(mysql_error());
$row_rsruang = mysql_fetch_assoc($rsruang);
$totalRows_rsruang = mysql_num_rows($rsruang);
?>
<html>
<head>
<title>Isi Ruang Praktikum</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmlab.progstudi.value=="") {
alert("Program Studi Belum Dipilih!")
return false
}

if (document.frmlab.kelas.value=="") {
alert("Kelas Belum Dipilih!")
return false
}

if (document.frmlab.ruang.value=="") {
alert("Ruang Belum Dipilih!")
return false
}

return true
}
// End -->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td><p><a href="inv_peng_praktikum.php?labkod=<?php echo $_REQUEST['labkod'];?>">INVENTARIS : Penggunaan Ruang Praktikum</a> 
        &gt; Isi</p>
      <p><strong><img src="images/adm_inv_peng_praktikum_peng.gif" width="280" height="40"></strong></p>
      <form action="inv_peng_praktikum_post1.php" method="post" name="frmlab" id="frmlab" onSubmit="return cek()">
        <p><strong>Hari : </strong><br>
          <?php echo $_REQUEST['hari'];?></p>
        <p><strong>Jam : </strong><br>
          <?php echo $_REQUEST['jam'];?></p>
        <p><strong>Program Studi : </strong><br>
          <select name="progstudi" id="progstudi">
            <option>--Program Studi--</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsprogstudi['kd']?>"><?php echo $row_rsprogstudi['progstudi']?></option>
            <?php
} while ($row_rsprogstudi = mysql_fetch_assoc($rsprogstudi));
  $rows = mysql_num_rows($rsprogstudi);
  if($rows > 0) {
      mysql_data_seek($rsprogstudi, 0);
	  $row_rsprogstudi = mysql_fetch_assoc($rsprogstudi);
  }
?>
          </select></p>
        <p><strong>Kelas : </strong><br>
          <select name="kelas" id="kelas">
            <option>--Kelas--</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rskelas['kd']?>"><?php echo $row_rskelas['kelas']?></option>
            <?php
} while ($row_rskelas = mysql_fetch_assoc($rskelas));
  $rows = mysql_num_rows($rskelas);
  if($rows > 0) {
      mysql_data_seek($rskelas, 0);
	  $row_rskelas = mysql_fetch_assoc($rskelas);
  }
?>
          </select>
        </p>
        <p><strong>Ruang : </strong><br>
          <select name="ruang" id="ruang">
            <option>--Ruang--</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsruang['kd']?>"><?php echo $row_rsruang['ruang']?></option>
            <?php
} while ($row_rsruang = mysql_fetch_assoc($rsruang));
  $rows = mysql_num_rows($rsruang);
  if($rows > 0) {
      mysql_data_seek($rsruang, 0);
	  $row_rsruang = mysql_fetch_assoc($rsruang);
  }
?>
          </select></p>
        <p> 
          <input name="labkod" type="hidden" id="labkod" value="<?php echo $_REQUEST['labkod'];?>">
          <input name="kd_hari" type="hidden" value="<?php echo $_REQUEST['kd_hari'];?>">
          <input name="kd_jam" type="hidden" value="<?php echo $_REQUEST['kd_jam'];?>">
          <input type="reset" name="Reset" value="Batal">
          <input name="Submit" type="submit" id="Submit" value="Simpan">
        </p>
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
</table><br>
<?php include("include/footer.php"); ?>
</body>
</html>