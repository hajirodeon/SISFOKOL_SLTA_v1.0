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
<title>Tambah Barang</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){
var digits="0123456789"
var temp

if (document.frmbrg.tanggal1.value=="") {
alert("Tanggal terima belum lengkap!")
return false
}

if (document.frmbrg.bulan1.value=="") {
alert("Tanggal terima belum lengkap!")
return false
}

if (document.frmbrg.tahun1.value=="") {
alert("Tanggal terima belum lengkap!")
return false
}

if (document.frmbrg.tanggal2.value=="") {
alert("Tanggal beli belum lengkap!")
return false
}

if (document.frmbrg.bulan2.value=="") {
alert("Tanggal beli belum lengkap!")
return false
}

if (document.frmbrg.tahun2.value=="") {
alert("Tanggal beli belum lengkap!")
return false
}

if (document.frmbrg.dari.value=="") {
alert("Dari mana barangnya?")
return false
}

if (document.frmbrg.nm_brg.value=="") {
alert("Nama Barang belum ditulis!")
return false
}

if (document.frmbrg.jumlah.value=="") {
alert("Banyaknya berapa?")
return false
}

for (var i=0;i<document.frmbrg.jumlah.value.length;i++){
temp=document.frmbrg.jumlah.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Jumlah barang harus bernilai angka!")
return false
      }
   }
   
if (document.frmbrg.harga.value=="") {
alert("Harganya berapa?")
return false
}

for (var i=0;i<document.frmbrg.harga.value.length;i++){
temp=document.frmbrg.harga.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Harga barang harus bernilai angka!")
return false
      }
   }

if (document.frmbrg.tanggal3.value=="") {
alert("Tanggal pakai belum lengkap!")
return false
}

if (document.frmbrg.bulan3.value=="") {
alert("Tanggal pakai belum lengkap!")
return false
}

if (document.frmbrg.tahun3.value=="") {
alert("Tanggal pakai belum lengkap!")
return false
}

if (document.frmbrg.untuk.value=="") {
alert("Untuk apa barang tersebut?")
return false
}

if (document.frmbrg.ket.value=="") {
alert("Keterangan masih kosong!")
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
    <td><p><a href="inv_pengadaan.php">Inventaris : Pengadaan</a> &gt; Tambah 
        Barang</p>
      <p><img src="images/adm_inv_pengadaan_tambah.gif" width="205" height="40"></p>
      <p><strong><big>TAMBAH BARANG</big></strong></p>
      <form action="inv_pengadaan_add1.php" method="post" name="frmbrg" id="frmbrg" onSubmit="return cek()">
        <p>Tanggal Terima : <br><select name="tanggal1" id="tanggal1">
              
			 			
				<option selected>-Tanggal-</option>
              <?
for ($i=1; $i<=31;$i++) 
	{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>
			  <?php
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
for ($j=1970; $j<=2020;$j++) 
	{
			?>
              <option value="<? echo $j?>"><? echo $j?></option>
			  <?php
			  }
			  ?>
             
            </select></p>
        <p>Tanggal Beli :<br>
          <select name="tanggal2" id="tanggal2">
            <option selected>-Tanggal-</option>
              <?
for ($i=1; $i<=31;$i++) 
	{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>
			  <?php
			  }
			  ?>
            </select>
            
          <select name="bulan2" id="bulan2">
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
            
          <select name="tahun2" id="tahun2">
            <option selected>-Tahun-</option>
              <?
for ($j=1970; $j<=2020;$j++) 
	{
			?>
              <option value="<? echo $j?>"><? echo $j?></option>
			  <?php
			  }
			  ?>
             
            </select></p>
        <p>Dari : <br>
          <input name="dari" type="text" id="dari" value="-" size="50">
        </p>
        <p>Nama Barang : <br>
          <input name="nm_brg" type="text" id="nm_brg" value="-" size="50">
        </p>
        <p>Jumlah : <br>
          <input name="jumlah" type="text" id="jumlah" value="-" size="5" maxlength="5">
        </p>
        <p>Harga : <br>
          Rp. 
          <input name="harga" type="text" id="harga" value="-" size="15">
          ,00 </p>
        <p>Tanggal Pakai : <br>
          <select name="tanggal3" id="tanggal3">
            <option selected>-Tanggal-</option>
              <?
for ($i=1; $i<=31;$i++) 
	{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>
			  <?php
			  }
			  ?>
            </select>
            
          <select name="bulan3" id="bulan3">
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
            
          <select name="tahun3" id="tahun3">
            <option selected>-Tahun-</option>
              <?
for ($j=1970; $j<=2020;$j++) 
	{
			?>
              <option value="<? echo $j?>"><? echo $j?></option>
			  <?php
			  }
			  ?>
             
            </select></p>
        <p>Untuk : <br>
          <input name="untuk" type="text" id="untuk" value="-" size="50">
        </p>
        <p>Keterangan : <br>
          <input name="ket" type="text" id="ket" value="-" size="50">
        </p>
        <p> 
          <input type="reset" name="Reset" value="Batal">
          <input name="Submit" type="submit" id="Submit" value="Simpan">
        </p>
      </form>
      <p>&nbsp;</p>
      <p>&nbsp; </td>
  </tr>
</table><br>
<?php include("include/footer.php"); ?>
</body>
</html>