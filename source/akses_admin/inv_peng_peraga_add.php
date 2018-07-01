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


//alat
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsalat = "SELECT * FROM inv_alat_peraga ORDER BY alat_peraga ASC";
$rsalat = mysql_query($query_rsalat, $sisfokol) or die(mysql_error());
$row_rsalat = mysql_fetch_assoc($rsalat);
$totalRows_rsalat = mysql_num_rows($rsalat);

//guru
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsguru = "SELECT m_pegawai.*, m_guru.* ".
					"FROM m_pegawai, m_guru ".
					"WHERE m_pegawai.kd = m_guru.kd_pegawai ".
					"ORDER BY m_pegawai.nama ASC";
$rsguru = mysql_query($query_rsguru, $sisfokol) or die(mysql_error());
$row_rsguru = mysql_fetch_assoc($rsguru);
$totalRows_rsguru = mysql_num_rows($rsguru);
?>
<html>
<head>
<title>Tambah Pengguna</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){
var digits="0123456789"
var temp

if (document.frmpeng.tanggal1.value=="") {
alert("Tanggal pinjam belum lengkap!")
return false
}

if (document.frmpeng.bulan1.value=="") {
alert("Tanggal pinjam belum lengkap!")
return false
}

if (document.frmpeng.tahun1.value=="") {
alert("Tanggal pinjam belum lengkap!")
return false
}

if (document.frmpeng.alat.value=="") {
alert("Silahkan dipilih alat peraganya!")
return false
}

if (document.frmpeng.jumlah.value=="") {
alert("Jumlahnya berapa?")
return false
}

for (var i=0;i<document.frmpeng.jumlah.value.length;i++){
temp=document.frmpeng.jumlah.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Jumlah harus bernilai angka!")
return false
      }
   }
   
if (document.frmpeng.guru.value=="") {
alert("Silahkan dipilih guru yang pinjam!")
return false
}

if (document.frmpeng.tanggal3.value=="") {
alert("Tanggal kembali belum lengkap!")
return false
}

if (document.frmpeng.bulan3.value=="") {
alert("Tanggal kembali belum lengkap!")
return false
}

if (document.frmpeng.tahun3.value=="") {
alert("Tanggal kembali belum lengkap!")
return false
}

if (document.frmpeng.ket.value=="") {
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
    <td><p><a href="inv_peng_peraga.php">Inventaris : Penggunaan Alat Peraga</a> 
        &gt; Tambah Pengguna</p>
      <p><strong><img src="images/adm_inv_peng_alat_peng.gif" width="257" height="40"></strong></p>
      <form action="inv_peng_peraga_add1.php" method="post" name="frmpeng" id="frmpeng" onSubmit="return cek()">
        <p>Tanggal Pinjam : <br>
          <select name="tanggal1" id="tanggal1">
              
			 			
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
for ($j=2005; $j<=2020;$j++) 
	{
			?>
              <option value="<? echo $j?>"><? echo $j?></option>
			  <?php
			  }
			  ?>
             
            </select></p>
        <p>Nama Alat : <br>
          <select name="alat" id="alat">
            <option>--Alat Peraga--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsalat['kd']?>"><?php echo $row_rsalat['alat_peraga']?></option>
              <?php
} while ($row_rsalat = mysql_fetch_assoc($rsalat));
  $rows = mysql_num_rows($rsalat);
  if($rows > 0) {
      mysql_data_seek($rsalat, 0);
	  $row_rsalat = mysql_fetch_assoc($rsalat);
  }
?>
            </select>
        </p>
        <p>Jumlah : <br>
          <input name="jumlah" type="text" id="jumlah" value="-" size="5" maxlength="5">
        </p>
        <p>Peminjam : <br>
          <select name="guru" id="guru">
            <option>--Guru--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsguru['kd']?>"><?php echo $row_rsguru['nama']?></option>
              <?php
} while ($row_rsguru = mysql_fetch_assoc($rsguru));
  $rows = mysql_num_rows($rsguru);
  if($rows > 0) {
      mysql_data_seek($rsguru, 0);
	  $row_rsguru = mysql_fetch_assoc($rsguru);
  }
?>
            </select></p>
        <p>Tanggal Kembali : <br>
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
for ($j=2006; $j<=2020;$j++) 
	{
			?>
              <option value="<? echo $j?>"><? echo $j?></option>
			  <?php
			  }
			  ?>
             
            </select></p>
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