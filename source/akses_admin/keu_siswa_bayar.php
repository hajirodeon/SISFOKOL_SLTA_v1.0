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
$katkod = $_REQUEST['katkod'];
$kategori = $_REQUEST['kategori'];
$studikod = $_REQUEST['studikod'];
$kelkod = $_REQUEST['kelkod'];
$rukod = $_REQUEST['rukod'];

mysql_select_db($database_sisfokol, $sisfokol);
$query_rsu = "SELECT m_siswa.*, m_siswa.kd AS msiskd, siswa_progstudi.*, siswa_kelas.*, siswa_ruang.*, ".
					"m_progstudi.*, m_kelas.*, m_ruang.* ".
					"FROM m_siswa, siswa_progstudi, siswa_kelas, siswa_ruang, ".
					"m_progstudi, m_kelas, m_ruang ".
					"WHERE siswa_progstudi.kd_progstudi = m_progstudi.kd ".
					"AND siswa_kelas.kd_kelas = m_kelas.kd ".
					"AND siswa_ruang.kd_ruang = m_ruang.kd ".
					"AND siswa_progstudi.status = 'true' ".
					"AND siswa_kelas.status = 'true' ".
					"AND siswa_ruang.status = 'true' ".
					"AND siswa_progstudi.kd_siswa = m_siswa.kd ".
					"AND siswa_kelas.kd_siswa = m_siswa.kd ".
					"AND siswa_ruang.kd_siswa = m_siswa.kd ".
					"AND siswa_progstudi.kd_progstudi = '$studikod' ".
					"AND siswa_kelas.kd_kelas = '$kelkod' ".
					"AND siswa_ruang.kd_ruang = '$rukod'";
$rsu = mysql_query($query_rsu, $sisfokol) or die(mysql_error());
$row_rsu = mysql_fetch_assoc($rsu);
$totalRows_rsu = mysql_num_rows($rsu);
?>
<html>
<head>
<title>Bayar</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td><p><a href="keu_siswa.php?katkod=<?php echo $_REQUEST['katkod'];?>&kategori=<?php echo $_REQUEST['kategori'];?>&studikod=<?php echo $_REQUEST['studikod'];?>&kelkod=<?php echo $_REQUEST['kelkod'];?>&rukod=<?php echo $_REQUEST['rukod'];?>&kd_siswa=<?php echo $_REQUEST['kd_siswa'];?>">Keuangan 
        Siswa</a> &gt; Bayar <?php echo $_REQUEST['kategori'];?></p>
      <p><big><strong>BAYAR <?php echo $_REQUEST['kategori'];?></strong></big></p>
      <p><strong>Program Studi :</strong> <br><?php echo $row_rsu['progstudi'];?></p>
      <p><strong>Kelas :</strong> <br><?php echo $row_rsu['kelas'];?></p>
      <p><strong>Ruang :</strong> <br><?php echo $row_rsu['ruang'];?></p>
      <p><strong>NIS :</strong> <br><?php echo $row_rsu['nis'];?></p>
      <p><strong>Nama :</strong> <br><?php echo $row_rsu['nama'];?></p>
	  
	  <?php
	  ///jika bayar uang gedung  ////////////////////////////////////////////////////////////////
	  if ($katkod == "4c75242f81285d49b3f18a7a4d210a8f")
	  	{	  
	  ?>
	  <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmbayar.tanggal1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

if (document.frmbayar.bulan1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

if (document.frmbayar.tahun1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

return true
}
// End -->
</SCRIPT>
	  
      <form action="keu_siswa_bayar1.php" method="post" name="frmbayar" id="frmbayar" onSubmit="return cek()">
        <p><strong>Tanggal Bayar :</strong> <br>
          <select name="tanggal1" id="tanggal1">
            <?php
			 if ($tgl != "")
				{
				
				?>
            <option value="<? echo $tgl;?>" selected><? echo $tgl;
				
				}
			
			else
				{?> 
            <option selected>
            <? 
				echo "-Tanggal-";
				}
			  ?>
            </option>
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
for ($i=2005; $i<=2020;$i++) 
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
          <input name="tapelkod" type="hidden" id="tapelkod" value="<?php echo $_REQUEST['tapelkod'];?>">
          <input name="kd_siswa" type="hidden" value="<?php echo $row_rsu['msiskd'];?>">
          <input name="katkod" type="hidden" value="<?php echo $_REQUEST['katkod'];?>">
          <input name="kategori" type="hidden" value="<?php echo $_REQUEST['kategori'];?>">
          <input name="studikod" type="hidden" value="<?php echo $_REQUEST['studikod'];?>">
          <input name="kelkod" type="hidden" value="<?php echo $_REQUEST['kelkod'];?>">
          <input name="rukod" type="hidden" value="<?php echo $_REQUEST['rukod'];?>">
          <input type="submit" name="Submit" value="Simpan">
        </p>
      </form>
	  <?php
	  }
	  ?>
	  
	  <?php
	  ///jika bayar uang lain ///////////////////////////////////////////////////////////////////////
	  if ($katkod == "31c2d890125b4103b7844e813f52cf1a")
	  	{	  
	  ?>
	  <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmbayar.tanggal1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

if (document.frmbayar.bulan1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

if (document.frmbayar.tahun1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

return true
}
// End -->
</SCRIPT>
	  
      <form action="keu_siswa_bayar1.php" method="post" name="frmbayar" id="frmbayar" onSubmit="return cek()">
        <p><strong>Tanggal Bayar :</strong> <br>
          <select name="tanggal1" id="tanggal1">
            <?php
			 if ($tgl != "")
				{
				
				?>
            <option value="<? echo $tgl;?>" selected><? echo $tgl;
				
				}
			
			else
				{?> 
            <option selected>
            <? 
				echo "-Tanggal-";
				}
			  ?>
            </option>
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
for ($i=2005; $i<=2020;$i++) 
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
          <input name="tapelkod" type="hidden" id="tapelkod" value="<?php echo $_REQUEST['tapelkod'];?>">
          <input name="kd_siswa" type="hidden" value="<?php echo $row_rsu['msiskd'];?>">
          <input name="katkod" type="hidden" value="<?php echo $_REQUEST['katkod'];?>">
          <input name="kategori" type="hidden" value="<?php echo $_REQUEST['kategori'];?>">
          <input name="studikod" type="hidden" value="<?php echo $_REQUEST['studikod'];?>">
          <input name="kelkod" type="hidden" value="<?php echo $_REQUEST['kelkod'];?>">
          <input name="rukod" type="hidden" value="<?php echo $_REQUEST['rukod'];?>">
          <input type="submit" name="Submit" value="Simpan">
        </p>
      </form>
	  <?php
	  }
	  ?>
<?php
	  ///jika bayar uang tes ///////////////////////////////////////////////////////////////////////
	  if ($katkod == "7a6df9d882fb55dbe4bc9725e64aab57")
	  	{	  
	  ?>
	  <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmbayar.tanggal1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

if (document.frmbayar.bulan1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

if (document.frmbayar.tahun1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

return true
}
// End -->
</SCRIPT>
	  
      <form action="keu_siswa_bayar1.php" method="post" name="frmbayar" id="frmbayar" onSubmit="return cek()">
        <p><strong>Tanggal Bayar :</strong> <br>
          <select name="tanggal1" id="tanggal1">
            <?php
			 if ($tgl != "")
				{
				
				?>
            <option value="<? echo $tgl;?>" selected><? echo $tgl;
				
				}
			
			else
				{?> 
            <option selected>
            <? 
				echo "-Tanggal-";
				}
			  ?>
            </option>
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
for ($i=2005; $i<=2020;$i++) 
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
          <input name="tapelkod" type="hidden" id="tapelkod" value="<?php echo $_REQUEST['tapelkod'];?>">
          <input name="kd_siswa" type="hidden" value="<?php echo $row_rsu['msiskd'];?>">
          <input name="katkod" type="hidden" value="<?php echo $_REQUEST['katkod'];?>">
          <input name="kategori" type="hidden" value="<?php echo $_REQUEST['kategori'];?>">
          <input name="studikod" type="hidden" value="<?php echo $_REQUEST['studikod'];?>">
          <input name="kelkod" type="hidden" value="<?php echo $_REQUEST['kelkod'];?>">
          <input name="rukod" type="hidden" value="<?php echo $_REQUEST['rukod'];?>">
          <input type="submit" name="Submit" value="Simpan">
        </p>
      </form>
	  <?php
	  }
	  ?>
<?php
	  ///jika bayar uang spp ///////////////////////////////////////////////////////////////////////
	  if ($katkod == "bad81d085df6c259223d9153cd2fd99b")
	  	{	  
	  ?>
	  <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmbayar.tanggal1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

if (document.frmbayar.bulan1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

if (document.frmbayar.tahun1.value=="") {
alert("Tanggal pembayaran belum lengkap!")
return false
}

return true
}
// End -->
</SCRIPT>
      <strong>Bulan : </strong> <br>
	  <?php echo $_REQUEST['bulan'];?> <?php echo $_REQUEST['tahun'];?>
      <form action="keu_siswa_bayar1.php" method="post" name="frmbayar" id="frmbayar" onSubmit="return cek()">
        <p><strong>Tanggal Bayar :</strong> <br>
          <select name="tanggal1" id="tanggal1">
            <?php
			 if ($tgl != "")
				{
				
				?>
            <option value="<? echo $tgl;?>" selected><? echo $tgl;
				
				}
			
			else
				{?> 
            <option selected>
            <? 
				echo "-Tanggal-";
				}
			  ?>
            </option>
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
for ($i=2005; $i<=2020;$i++) 
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
          <input name="tapelkod" type="hidden" id="tapelkod" value="<?php echo $_REQUEST['tapelkod'];?>">
          <input name="kd_siswa" type="hidden" value="<?php echo $row_rsu['msiskd'];?>">
          <input name="kd_bulan" type="hidden" id="kd_bulan" value="<?php echo $_REQUEST['kd_bulan'];?>">
          <input name="katkod" type="hidden" value="<?php echo $_REQUEST['katkod'];?>">
          <input name="kategori" type="hidden" value="<?php echo $_REQUEST['kategori'];?>">
          <input name="studikod" type="hidden" value="<?php echo $_REQUEST['studikod'];?>">
          <input name="kelkod" type="hidden" value="<?php echo $_REQUEST['kelkod'];?>">
          <input name="rukod" type="hidden" value="<?php echo $_REQUEST['rukod'];?>">
          <input type="submit" name="Submit" value="Simpan">
        </p>
      </form>
	  <?php
	  }
	  ?>      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      </td>
  </tr>
</table><br>
<?php include("include/footer.php"); ?>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>