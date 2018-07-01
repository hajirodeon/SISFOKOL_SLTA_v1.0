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


//jenis kelamin
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_jekel = "SELECT * FROM m_kelamin ORDER BY kelamin ASC";
$rs_jekel = mysql_query($query_rs_jekel, $sisfokol) or die(mysql_error());
$row_rs_jekel = mysql_fetch_assoc($rs_jekel);
$totalRows_rs_jekel = mysql_num_rows($rs_jekel);

//agama
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_agm = "SELECT * FROM m_agama ORDER BY agama ASC";
$rs_agm = mysql_query($query_rs_agm, $sisfokol) or die(mysql_error());
$row_rs_agm = mysql_fetch_assoc($rs_agm);
$totalRows_rs_agm = mysql_num_rows($rs_agm);

//pekerjaan
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_pek = "SELECT * FROM m_pekerjaan ORDER BY pekerjaan ASC";
$rs_pek = mysql_query($query_rs_pek, $sisfokol) or die(mysql_error());
$row_rs_pek = mysql_fetch_assoc($rs_pek);
$totalRows_rs_pek = mysql_num_rows($rs_pek);
?>
<html>
<head>
<title>Masukan Data Calon Siswa</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){
var digits="0123456789"
var temp

if (document.frmpsb.nama.value=="") {
alert("Nama Calon Siswa belum dimasukkan!")
return false
}

if (document.frmpsb.jekel.value=="") {
alert("Jenis Kelamin belum dipilih!")
return false
}

if (document.frmpsb.tmplahir.value=="") {
alert("Lahirnya dimana?")
return false
}

if (document.frmpsb.tanggal1.value=="") {
alert("Tanggal lahir belum lengkap.")
return false
}

if (document.frmpsb.bulan1.value=="") {
alert("Tanggal lahir belum lengkap.")
return false
}

if (document.frmpsb.tahun1.value=="") {
alert("Tanggal lahir belum lengkap.")
return false
}

if (document.frmpsb.bangsa.value=="") {
alert("Asal Bangsa?")
return false
}

if (document.frmpsb.agm.value=="") {
alert("Silahkan dipilih agamanya!")
return false
}

if (document.frmpsb.anakke.value=="") {
alert("Anak ke berapa?")
return false
}

for (var i=0;i<document.frmpsb.anakke.value.length;i++){
temp=document.frmpsb.anakke.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Urutan anak harus angka!")
return false
      }
   }

if (document.frmpsb.alamat.value=="") {
alert("Alamat belum dimasukkan!")
return false
}

if (document.frmpsb.nm_ortu.value=="") {
alert("Nama Orang Tua belum ditulis.")
return false
}

if (document.frmpsb.pddkn_ortu.value=="") {
alert("Pendidikan Terakhir Orang Tuanya apa?.")
return false
}

if (document.frmpsb.pek.value=="") {
alert("Silahkan dipilih pekerjaannya!")
return false
}

if (document.frmpsb.almt_pek_ortu.value=="") {
alert("Jangan lupa menuliskan alamat pekerjaan orang tua.")
return false
}

if (document.frmpsb.ket_lain.value=="") {
alert("Bila ada keterangan lain, silahkan dimasukkan.")
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
<table width="800" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td><p><a href="akt_psb.php">Penerimaan Siswa</a> &gt; Tambah Data</p>
      <p><img src="images/adm_akt_penerimaan_siswa_tambah.gif" width="321" height="40"></p>
      <form action="akt_psb_add1.php" method="post" name="frmpsb" id="frmpsb" onSubmit="return cek()">
        <p>Nama : 
          <br><input name="nama" type="text" id="nama" value="-" size="30" maxlength="30">
        </p>
        <p>Jenis Kelamin : <br><select name="jekel" id="jekel">
              <option>--Jenis Kelamin--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_jekel['kd']?>"><?php echo $row_rs_jekel['kelamin']?></option>
              <?php
} while ($row_rs_jekel = mysql_fetch_assoc($rs_jekel));
  $rows = mysql_num_rows($rs_jekel);
  if($rows > 0) {
      mysql_data_seek($rs_jekel, 0);
	  $row_rs_jekel = mysql_fetch_assoc($rs_jekel);
  }
?>
            </select></p>
        <p>Tempat, Tanggal Lahir : <br><input name="tmplahir" type="text" id="tmplahir" value="-" size="20">
            <select name="tanggal1" id="tanggal1">
              <option selected>-Tanggal-</option>
              <?
for ($i=1; $i<=31;$i++) 
			{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>"
              <?
			echo "<br>";
			}
?>
            </select>
            <select name="bulan1" id="bulan1">
              <option selected>-Bulan-</option>
              <option value="1">Januari</option>
              <option value="2">Februari</option>
              <option value="3">Maret</option>
              <option value="4">April</option>
              <option value="5">Mei</option>
              <option value="6">Juni</option>
              <option value="7">Juli</option>
              <option value="8">Agustus</option>
              <option value="9">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
            <select name="tahun1" id="tahun1">
              <option selected>-Tahun-</option>
              <?
for ($i=1985; $i<=2020;$i++) 
			{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>"
              <?
			echo "<br>";
			}
?>
            </select></p>
        <p>Bangsa : 
          <br><input name="bangsa" type="text" id="bangsa" value="-" size="30">
        </p>
        <p>Agama : <br><select name="agm" id="agm">
              <option>--Agama--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_agm['kd']?>"><?php echo $row_rs_agm['agama']?></option>
              <?php
} while ($row_rs_agm = mysql_fetch_assoc($rs_agm));
  $rows = mysql_num_rows($rs_agm);
  if($rows > 0) {
      mysql_data_seek($rs_agm, 0);
	  $row_rs_agm = mysql_fetch_assoc($rs_agm);
  }
?>
            </select></p>
        <p>Anak Ke : 
          <br><input name="anakke" type="text" id="anakke" value="-" size="2" maxlength="2">
        </p>
        <p>Alamat : 
          <br><input name="alamat" type="text" id="alamat" value="-" size="40">
        </p>
        <p>Nama Orang Tua / Wali : 
          <br><input name="nm_ortu" type="text" id="nm_ortu" value="-" size="30" maxlength="30">
        </p>
        <p>Pendidikan : 
          <br><input name="pddkn_ortu" type="text" id="pddkn_ortu" value="-" size="40">
        </p>
        <p>Pekerjaan : 
          <br><select name="pek" id="pek">
            <option>--Pekerjaan--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_pek['kd']?>"><?php echo $row_rs_pek['pekerjaan']?></option>
              <?php
} while ($row_rs_pek = mysql_fetch_assoc($rs_pek));
  $rows = mysql_num_rows($rs_pek);
  if($rows > 0) {
      mysql_data_seek($rs_pek, 0);
	  $row_rs_pek = mysql_fetch_assoc($rs_pek);
  }
?>
            </select></p>
        <p>Alamat Pekerjaan : 
          <br><input name="almt_pek_ortu" type="text" id="almt_pek_ortu" value="-" size="40">
        </p>
        <p>Keterangan Lain : 
          <br><input name="ket_lain" type="text" id="ket_lain" value="-" size="40">
        </p>
        <p> 
          <input type="reset" name="Reset" value="Batal">
          <input name="Submit" type="submit" id="Submit" value="Simpan">
        </p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </form>
      <p>&nbsp;</p></td>
  </tr>
</table><br>
<?php include("include/footer.php"); ?>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>