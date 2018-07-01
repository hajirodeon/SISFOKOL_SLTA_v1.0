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

//pekerjaan
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_pek = "SELECT * FROM m_pekerjaan ORDER BY pekerjaan ASC";
$rs_pek = mysql_query($query_rs_pek, $sisfokol) or die(mysql_error());
$row_rs_pek = mysql_fetch_assoc($rs_pek);
$totalRows_rs_pek = mysql_num_rows($rs_pek);

//tahun pelajaran
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_tapel = "SELECT * FROM m_tapel ORDER BY tahun1 ASC";
$rs_tapel = mysql_query($query_rs_tapel, $sisfokol) or die(mysql_error());
$row_rs_tapel = mysql_fetch_assoc($rs_tapel);
$totalRows_rs_tapel = mysql_num_rows($rs_tapel);

//menghapus data yang ada di PSB
$kd = $_REQUEST['kd'];

$SQLxt = sprintf("DELETE FROM PSB WHERE kd = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rsxt = mysql_query($SQLxt, $sisfokol) or die(mysql_error());
?>
<html>
<head>
<title>Tambah Siswa</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){
var digits="0123456789"
var temp

if (document.frmsiswa.nis.value=="") {
alert("Silahkan dimasukkan NIS-nya!")
return false
}

for (var i=0;i<document.frmsiswa.nis.value.length;i++){
temp=document.frmsiswa.nis.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("NIS harus bernilai angka!")
return false
      }
   }
   
if (frmsiswa.nis.value.length<4){ 
alert("NIS minimal 4 digit!")
return false		
}

if (document.frmsiswa.nama.value=="") {
alert("Nama siswa belum dimasukkan!")
return false
}

if (document.frmsiswa.tmplahir.value=="") {
alert("Tempat kelahirannya dimana?")
return false
}

if (document.frmsiswa.tanggal1.value=="") {
alert("Tanggal lahir belum lengkap!")
return false
}

if (document.frmsiswa.bulan1.value=="") {
alert("Tanggal lahir belum lengkap!")
return false
}

if (document.frmsiswa.tahun1.value=="") {
alert("Tanggal lahir belum lengkap!")
return false
}

if (document.frmsiswa.jekel.value=="") {
alert("Jenis Kelamin belum dipilih!")
return false
}

if (document.frmsiswa.agm.value=="") {
alert("Agamanya apa?")
return false
}

if (document.frmsiswa.anakke.value=="") {
alert("Anak ke berapa?")
return false
}

if (document.frmsiswa.status_kel.value=="") {
alert("Status dalam keluarganya apa?.")
return false
}

if (document.frmsiswa.alamat.value=="") {
alert("Alamatnya dimana?")
return false
}

if (document.frmsiswa.telp.value=="") {
alert("Telepon?")
return false
}

if (document.frmsiswa.progstudi.value=="") {
alert("Program Studi belum dipilih!")
return false
}

if (document.frmsiswa.kelas.value=="") {
alert("Masuk sekolah ini, kelas berapa?.")
return false
}

if (document.frmsiswa.tanggal2.value=="") {
alert("Tanggal masuknya kapan?")
return false
}

if (document.frmsiswa.bulan2.value=="") {
alert("Tanggal masuknya kapan?")
return false
}

if (document.frmsiswa.tahun2.value=="") {
alert("Tanggal masuknya kapan?")
return false
}

if (document.frmsiswa.tapel.value=="") {
alert("Tahun Pelajaran?")
return false
}

if (document.frmsiswa.asl_sek.value=="") {
alert("Asal sekolah mana?")
return false
}

if (document.frmsiswa.almt_sek.value=="") {
alert("Alama sekolah asal?")
return false
}

if (document.frmsiswa.nm_ayah.value=="") {
alert("Nama ayahnya siapa?")
return false
}

if (document.frmsiswa.nm_ibu.value=="") {
alert("Nama ibunya siapa?")
return false
}

if (document.frmsiswa.pek1.value=="") {
alert("Pekerjaan ayah belum dipilih")
return false
}

if (document.frmsiswa.pek2.value=="") {
alert("Pekerjaan ibu belum dipilih")
return false
}

return true
}
// End -->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5">
<div align="center">
  <?php include("include/header.php"); ?>
  <?php include("include/menu.php"); ?>
  <br>
  <table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td> <p><a href="akad_siswa.php">Data Siswa</a> &gt; Tambah Siswa</p>
        <p><img src="images/adm_m_akad_siswa_tambah.gif" width="183" height="40"></p>
        <form action="akad_siswa_add1.php" method="post" name="frmsiswa" id="frmsiswa" onSubmit="return cek()">
          <p>NIS : <br>
            <input name="nis" type="text" id="nis" value="-" size="10" maxlength="10">
          </p>
          <p>Nama : <br>
            <input name="nama" type="text" id="nama" value="<?php
			if ($nama != "")
				{
				echo $nama;
				}
			
			else
				{
				echo "-";
				}
			?>" size="30" maxlength="30">
          </p>
          <p>Tempat, Tanggal Lahir : <br>
            <input name="tmplahir" type="text" id="tmplahir" value="<?php
			if ($tmp_lahir != "")
				{
				echo $tmp_lahir;
				}
			
			else
				{
				echo "-";
				}
			?>" size="20">
            <select name="tanggal1" id="tanggal1">
              
			  <?php
			 if ($tgl != "")
				{
				
				?>
				
				<option value="<? echo $tgl;?>" selected><? echo $tgl;
				
				}
			
			else
				{?>
				
				<option selected><? 
				echo "-Tanggal-";
				}
			  ?></option>
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
               <?php
			 if ($bln != "")
				{
				if ($bln == "01")
					{?>
				
				<option value="<? echo $bln;?>" selected><? echo "Januari";
					}
				
				else if ($bln == "02")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "Februari";
					}
				
				else if ($bln == "03")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "Maret";
					}
				
				else if ($bln == "04")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "April";
					}
				
				else if ($bln == "05")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "Mei";
					}
				
				else if ($bln == "06")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "Juni";
					}
				
				else if ($bln == "07")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "Juli";
					}
				
				else if ($bln == "08")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "Agustus";
					}
				
				else if ($bln == "09")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "September";
					}
				
				else if ($bln == "10")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "Oktober";
					}
				
				else if ($bln == "11")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "Nopember";
					}
				
				else if ($bln == "12")
					{
					?>
				
				<option value="<? echo $bln;?>" selected><? echo "Desember";
					}
				}
			
			else
				{
				?>
				
				<option selected><? echo "-Bulan-";
				}
			  ?></option>
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
              <?php
			 if ($thn != "")
				{
				?>
				
				<option value="<? echo $thn;?>" selected><? echo $thn;
				}
			
			else
				{
				?>
				
				<option selected><? echo "-Tahun-";
				}
			  ?></option>
              <?
for ($i=1985; $i<=2020;$i++) 
			{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>"
              <?
			echo "<br>";
			}
?>
            </select>
          </p>
          <p>Jenis Kelamin : <br>
            <select name="jekel" id="jekel">
              <?php			
			 if ($kd_kelamin != "")
				{
				$kd_jekelx = $kd_kelamin;
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_jekelx = "SELECT * FROM m_kelamin WHERE kd = '$kd_jekelx'";
				$rs_jekelx = mysql_query($query_rs_jekelx, $sisfokol) or die(mysql_error());
				$row_rs_jekelx = mysql_fetch_assoc($rs_jekelx);
				$totalRows_rs_jekelx = mysql_num_rows($rs_jekelx);
				
				?>
				
				<option value="<? echo $kd_kelamin;?>" selected><? echo $row_rs_jekelx['kelamin'];
				}
			
			else
				{
				?>
				<option selected><? echo "-Jenis Kelamin-";
				}
			  ?></option>
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
          <p>Agama : <br>
            <select name="agm" id="agm">
              <?php
			 if ($kd_agama != "")
				{
				$kd_agmx = $kd_agama;
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_agmx = "SELECT * FROM m_agama WHERE kd = '$kd_agmx'";
				$rs_agmx = mysql_query($query_rs_agmx, $sisfokol) or die(mysql_error());
				$row_rs_agmx = mysql_fetch_assoc($rs_agmx);
				$totalRows_rs_agmx = mysql_num_rows($rs_agmx);
				
				?>
              <option value="<? echo $kd_agama;?>" selected><? echo $row_rs_agmx['agama'];
				}
			
			else
				{?>
              <option selected><? echo "-Agama-";
				}
			  ?></option>
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
          <p>Anak Ke : 
            <input name="anakke" type="text" id="anakke" value="<?php
			if ($anakke != "")
				{
				echo $anakke;
				}
			
			else
				{
				echo "-";
				}
			?>" size="2" maxlength="2">
          </p>
          <p>Status dalam Keluarga : 
            <input name="status_kel" type="text" id="status_kel" value="-" size="30">
          </p>
          <p>Alamat : <br>
            <input name="alamat" type="text" id="alamat" value="<?php
			if ($alamat != "")
				{
				echo $alamat;
				}
			
			else
				{
				echo "-";
				}
			?>" size="40">
          </p>
          <p>Telepon : <br>
            <input name="telp" type="text" id="telp" value="-" size="30">
          </p>
          <p>Diterima pada : <br>
            - Program Studi : 
            <select name="progstudi" id="progstudi">
              <option>--Program Studi--</option>
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
            <br>
            - Kelas : 
            <select name="kelas" id="kelas">
              <option>--Kelas--</option>
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
            <br>
            - Tanggal : 
            <select name="tanggal2" id="tanggal2">
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
for ($i=2004; $i<=2020;$i++) 
			{
			?>
              <option value="<? echo $i?>"><? echo $i?></option>"
              <?
			echo "<br>";
			}
?>
            </select>
            <br>
            - Tahun Pelajaran : 
            <select name="tapel" id="tapel">
              <option>--Tahun Pelajaran--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_tapel['kd']?>"><?php echo $row_rs_tapel['tahun1']?>/<?php echo $row_rs_tapel['tahun2']?></option>
              <?php
} while ($row_rs_tapel = mysql_fetch_assoc($rs_tapel));
  $rows = mysql_num_rows($rs_tapel);
  if($rows > 0) {
      mysql_data_seek($rs_tapel, 0);
	  $row_rs_tapel = mysql_fetch_assoc($rs_tapel);
  }
?>
            </select>
          </p>
          <p>Asal Sekolah : <br>
            <input name="asl_sek" type="text" id="asl_sek" value="-" size="40">
          </p>
          <p>Alamat Asal Sekolah : <br>
            <input name="almt_sek" type="text" id="almt_sek" value="-" size="40">
          </p>
          <p>Nama Ayah : <br>
            <input name="nm_ayah" type="text" id="nm_ayah" value="<?php
			if ($nm_ortu != "")
				{
				echo $nm_ortu;
				}
			
			else
				{
				echo "-";
				}
			?>" size="30" maxlength="30">
          </p>
          <p>Nama Ibu : <br>
            <input name="nm_ibu" type="text" id="nm_ibu" value="-" size="30" maxlength="30">
          </p>
          <p>Pekerjaan Ayah : <br>
		    <select name="pek1" id="pek1">
              <?php
			 if ($kd_pek != "")
				{
				$kd_pekx = $kd_pek;
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_pekx = "SELECT * FROM m_pekerjaan WHERE kd = '$kd_pekx'";
				$rs_pekx = mysql_query($query_rs_pekx, $sisfokol) or die(mysql_error());
				$row_rs_pekx = mysql_fetch_assoc($rs_pekx);
				$totalRows_rs_pekx = mysql_num_rows($rs_pekx);
				
				?>
				
				<option value="<? echo $kd_pek;?>" selected><? echo $row_rs_pekx['pekerjaan'];
				}
			
			else
				{
				?>
				
				<option selected><? echo "-Pekerjaan-";
				}
			  ?></option>
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
          <p>Pekerjaan Ibu : <br>
		    <select name="pek2" id="pek2">
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
//tutup koneksi
mysql_close($sisfokol);
?>