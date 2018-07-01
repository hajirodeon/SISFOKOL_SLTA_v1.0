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

//fungsi-fungsi
include("../include/function.php"); 

//konek db
require_once('../Connections/sisfokol.php'); 

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
?>
<html>
<head>
<title>Tambah Pegawai</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){
var digits="0123456789"
var temp

if (document.frmpeg.nip.value=="") {
alert("NIP harus diisi!")
return false
}

for (var i=0;i<document.frmpeg.nip.value.length;i++){
temp=document.frmpeg.nip.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("NIP harus bernilai angka!")
return false
      }
   }
   
if (frmpeg.nip.value.length<4){ 
alert("NIP Minimal 4 digit!")
return false		
}

if (document.frmpeg.nama.value=="") {
alert("Silahkan diisi namanya!")
return false
}

if (document.frmpeg.tmplahir.value=="") {
alert("Tempat kelahirannya dimana?")
return false
}

if (document.frmpeg.tanggal1.value=="") {
alert("Tanggal kelahiran belum dipilih!")
return false
}

if (document.frmpeg.bulan1.value=="") {
alert("Bulan kelahiran belum dipilih!")
return false
}

if (document.frmpeg.tahun1.value=="") {
alert("Tahun kelahiran belum dipilih!")
return false
}

if (document.frmpeg.alamat.value=="") {
alert("Jangan lupa menuliskan alamatnya!")
return false
}

if (document.frmpeg.pend_sd.value=="") {
alert("SD-nya dimana?")
return false
}

if (document.frmpeg.tahun_sd.value=="") {
alert("Lulus tahun berapa?")
return false
}

if (document.frmpeg.pend_sltp.value=="") {
alert("Nama SLTP belum diisi!")
return false
}

if (document.frmpeg.tahun_sltp.value=="") {
alert("Lulus tahun berapa?")
return false
}

if (document.frmpeg.pend_slta.value=="") {
alert("SLTA-nya dimana?")
return false
}

if (document.frmpeg.tahun_slta.value=="") {
alert("Lulus tahun berapa?")
return false
}

if (document.frmpeg.pend_kuliah.value=="") {
alert("Kuliah dimana?")
return false
}

if (document.frmpeg.tahun_kuliah.value=="") {
alert("Lulus tahun berapa?")
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
      <td> <p><a href="kepg_pegawai.php">Data Pegawai</a> &gt; Tambah Pegawai</p>
        <p><img src="images/adm_kepg_tambah.gif" width="201" height="40"></p>
        <form action="kepg_pegawai_add1.php" method="post" name="frmpeg" id="frmpeg" onSubmit="return cek()">
          <p>Nama :<br>
            <input name="nama" type="text" id="nama" value="-" size="30" maxlength="30">
          </p>
          <p>NIP : <br>
            <input name="nip" type="text" id="nip" value="-" size="10" maxlength="10">
          </p>
          <p>Jenis Kelamin : <br>
            <select name="jekel" id="jekel">
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
          <p>Tempat, Tanggal Lahir : <br>
            <input name="tmplahir" type="text" id="tmplahir" value="-" size="20">
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
for ($i=1925; $i<=2020;$i++) 
			{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>"
              <?
			echo "<br>";
			}
?>
            </select>
          </p>
          <p>Kawin / Tidak : 
             
            <input type="radio" name="RadioGroup1" value="1">
            Kawin 
            
            <input type="radio" name="RadioGroup1" value="0">
            Tidak Kawin
          </p>
          <p>Bangsa : 
            <input name="bangsa" type="text" id="bangsa" value="-" size="30">
          </p>
          <p>Agama : 
            <select name="agm" id="agm">
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
            </select>
          </p>
          <p>Pangkat : 
            <input name="pangkat" type="text" id="pangkat" value="-" size="30">
          </p>
          <p>Jabatan : 
            <input name="jabatan" type="text" id="jabatan" value="-" size="30">
          </p>
          <p>Status Pegawai : 
            
            <input type="radio" name="RadioGroup2" value="1">
            Tetap
            
            <input type="radio" name="RadioGroup2" value="2">
            Tidak Tetap
          </p>
          <p>Alamat : <br>
            <input name="alamat" type="text" id="alamat" value="-" size="50">
          </p>
          <p>&nbsp;</p>
          <p><strong>Riwayat Pendidikan :</strong></p>
          <p>SD : <br>
            <input name="pend_sd" type="text" id="pend_sd" value="-" size="30">
            , Tahun 
            <select name="tahun_sd" id="tahun_sd">
              <option selected>-Tahun-</option>
			  <option value="-">-</option>"
              <?
for ($i=1925; $i<=2020;$i++) 
			{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>"
              <?
			echo "<br>";
			}
?>
            </select>
          </p>
          <p>SLTP : <br>
            <input name="pend_sltp" type="text" id="pend_sltp" value="-" size="30">
, Tahun 
            <select name="tahun_sltp" id="tahun_sltp">
              <option selected>-Tahun-</option>
			  <option value="-">-</option>
              <?
for ($i=1925; $i<=2020;$i++) 
			{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>"
              <?
			echo "<br>";
			}
?>
            </select>
          </p>
          <p>SLTA : <br>
            <input name="pend_slta" type="text" id="pend_slta" value="-" size="30">
, Tahun 
            <select name="tahun_slta" id="tahun_slta">
              <option selected>-Tahun-</option>
			  <option value="-">-</option>
              <?
for ($i=1925; $i<=2020;$i++) 
			{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>"
              <?
			echo "<br>";
			}
?>
            </select>
          </p>
          <p>Kuliah : <br>
            <input name="pend_kuliah" type="text" id="pend_kuliah" value="-" size="30">
, Tahun 
            <select name="tahun_kuliah" id="tahun_kuliah">
              <option selected>-Tahun-</option>
			  <option value="-">-</option>
              <?
for ($i=1925; $i<=2020;$i++) 
			{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>"
              <?
			echo "<br>";
			}
?>
            </select>
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