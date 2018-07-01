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

//koneksi db
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 

//ambil nilai
$kd = $_SESSION['kd_session'];
$username = $_SESSION['username_session'];
$password = $_SESSION['password_session'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT * FROM m_pegawai ".
				"WHERE kd = '$kd' ".
				"AND nip = '$username'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title>Wali Kelas : <?php echo balikin($row_rs1['nama']);?> --> Ganti Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmpass.passlama.value=="") {
alert("Password lama harus diisi dahulu!")
return false
}

if (document.frmpass.passbaru.value=="") {
alert("Password baru harus diisi!")
return false
}

return true
}
// End -->
</SCRIPT>
<link href="style/walikelas.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="middle"> 
    <td valign="top"> <p align="left"><big><img src="images/password.gif" width="173" height="40"></big></p>
      <form action="password1.php" method="post" name="frmpass" id="frmpass" onSubmit="return cek()">
        <p align="left">Password Lama : <br>
          <input name="passlama" type="password" id="passlama" size="20" maxlength="20">
        </p>
        <p align="left">Password Baru : <br>
          <input name="passbaru" type="password" id="passbaru" size="20" maxlength="20">
          *) Max. 20 karakter </p>
        <p align="left"> 
          <input name="Reset" type="reset" id="Reset" value="Batal">
          <input type="submit" name="Submit" value="Ganti">
        </p>
      </form>
      <p align="left">&nbsp;</p></td>
  </tr>
</table>
<br>
<?php include("include/footer.php"); ?>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>