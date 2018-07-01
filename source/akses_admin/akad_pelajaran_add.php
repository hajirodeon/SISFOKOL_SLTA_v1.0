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
$query_rs_progstudi = "SELECT * FROM m_progstudi ORDER BY progstudi ASC";
$rs_progstudi = mysql_query($query_rs_progstudi, $sisfokol) or die(mysql_error());
$row_rs_progstudi = mysql_fetch_assoc($rs_progstudi);
$totalRows_rs_progstudi = mysql_num_rows($rs_progstudi);

//kelas
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_kelas = "SELECT * FROM m_kelas ORDER BY kelas ASC";
$rs_kelas = mysql_query($query_rs_kelas, $sisfokol) or die(mysql_error());
$row_rs_kelas = mysql_fetch_assoc($rs_kelas);
$totalRows_rs_kelas = mysql_num_rows($rs_kelas);
?>
<html>
<head>
<title>Tambah Pelajaran</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmpelajaran.progstudi.value=="") {
alert("Silahkan dipilih Program Studinya!")
return false
}

if (document.frmpelajaran.kelas.value=="") {
alert("Silahkan dipilih kelasnya!")
return false
}

if (document.frmpelajaran.pelajaran.value=="") {
alert("Silahkan diisi pelajarannya!")
return false
}

return true
}
// End -->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<div align="center">
  <?php include("include/header.php"); ?>
  <?php include("include/menu.php"); ?>
  <br>
  <table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td> <p><a href="akad_pelajaran.php">Data Pelajaran</a> &gt; Tambah Pelajaran</p>
        <p><img src="images/adm_m_akad_pelajaran_tambah.gif" width="222" height="40"></p>
        <form action="akad_pelajaran_add1.php" method="post" name="frmpelajaran" id="frmpelajaran" onSubmit="return cek()">
          <p>Program Studi : 
            <br><select name="progstudi" id="progstudi">
              <option>--Pilih Program Studi--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_progstudi['kd']?>"><?php echo $row_rs_progstudi['progstudi']?></option>
              <?php
} while ($row_rs_progstudi = mysql_fetch_assoc($rs_progstudi));
  $rows = mysql_num_rows($rs_progstudi);
  if($rows > 0) {
      mysql_data_seek($rs_progstudi, 0);
	  $row_rs_progstudi = mysql_fetch_assoc($rs_progstudi);
  }
?>
            </select>
          </p>
          <p>Kelas : 
            <br><select name="kelas" id="kelas">
              <option>--Pilih Kelas--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_kelas['kd']?>"><?php echo $row_rs_kelas['kelas']?></option>
              <?php
} while ($row_rs_kelas = mysql_fetch_assoc($rs_kelas));
  $rows = mysql_num_rows($rs_kelas);
  if($rows > 0) {
      mysql_data_seek($rs_kelas, 0);
	  $row_rs_kelas = mysql_fetch_assoc($rs_kelas);
  }
?>
            </select>
          </p>
          <p>Nama Pelajaran : 
            <br><input name="pelajaran" type="text" id="pelajaran" size="40">
          </p>
          <p> 
            <input name="Reset" type="reset" id="Reset" value="Batal">
            <input name="Submit" type="submit" id="Submit" value="Simpan">
          </p>
        </form>
        <p><strong></strong></p></td>
    </tr>
  </table>
  <br>
  <?php include("include/footer.php"); ?>
</div>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>