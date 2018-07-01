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
?>
<html>
<head>
<title>Setting Semester</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmsmt.smt.value=="") {
alert("Pilih jenis semester yang akan di-set!")
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
      <td> <p><img src="images/adm_set_semester.gif" width="237" height="40"></p>
        <p> 
          <?php 	
mysql_select_db($database_sisfokol, $sisfokol);

//semester yang di-set
$query_rs1 = "SELECT * FROM m_semester_set WHERE status = 'true'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);

//daftar semester
$query_rs2 = "SELECT * FROM m_semester_set";
$rs2= mysql_query($query_rs2, $sisfokol) or die(mysql_error());
$row_rs2 = mysql_fetch_assoc($rs2);
$totalRows_rs2 = mysql_num_rows($rs2);
?>
          Semester Sekarang : <?php echo $row_rs1['jenis']?></p>
        <form action="set_semester1.php" method="post" name="frmsmt" id="frmsmt" onSubmit="return cek()">
          <p>Set Semester sekarang : 
            <select name="smt" id="smt">
              <option>--Semester--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs2['kd']?>"><?php echo $row_rs2['jenis']?></option>
              <?php
} while ($row_rs2 = mysql_fetch_assoc($rs2));
  $rows = mysql_num_rows($rs2);
  if($rows > 0) {
      mysql_data_seek($rs2, 0);
	  $row_rs2 = mysql_fetch_assoc($rs2);
  }
?>
            </select>
            <input type="submit" name="Submit" value="Simpan">
          </p>
        </form>
        <p>&nbsp;</p></td>
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