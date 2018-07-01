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
$mpkd = $_REQUEST['mpkd'];
$mkkd = $_REQUEST['mkkd'];
$mrkd = $_REQUEST['mrkd'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT * FROM m_pegawai ".
				"WHERE kd = '$kd' ".
				"AND nip = '$username'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);

$bulan = $_REQUEST['bulan'];
$tahun = $_REQUEST['tahun'];
$mpkd = $_REQUEST['mpkd'];
$progstudi = $_REQUEST['progstudi'];
$mkkd = $_REQUEST['mkkd'];
$kelas = $_REQUEST['kelas'];
$mrkd = $_REQUEST['mrkd'];
$ruang = $_REQUEST['ruang'];
$istart = $_REQUEST['istart'];
$kd = $_REQUEST['kd'];

//siswa
mysql_select_db($database_sisfokol, $sisfokol);
$query_rssis = "SELECT * FROM m_siswa ".
				"WHERE kd = '$kd'";
$rssis = mysql_query($query_rssis, $sisfokol) or die(mysql_error());
$row_rssis = mysql_fetch_assoc($rssis);
$totalRows_rssis = mysql_num_rows($rssis);

//ket
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsket = "SELECT * FROM m_ket ORDER BY ket ASC";
$rsket = mysql_query($query_rsket, $sisfokol) or die(mysql_error());
$row_rsket = mysql_fetch_assoc($rsket);
$totalRows_rsket = mysql_num_rows($rsket);
?>
<html>
<head>
<title>Wali Kelas : <?php echo balikin($row_rs1['nama']);?> --> ABSENSI HARIAN SISWA</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/walikelas.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmabsen.ket.value=="") {
alert("Keterangan harus dipilih!")
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
  <tr valign="middle"> 
    <td valign="top"> <div align="left">
        <p><a href="absensi.php?bulan=<?php echo $_REQUEST['bulan'];?>&tahun=<?php echo $_REQUEST['tahun'];?>&mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>&istart=<?php echo $_REQUEST['istart'];?>">Absensi Harian Siswa</a> &gt; Isi Absensi</p>
        <p><big><strong>ISI ABSENSI</strong></big></p>
        <form action="absensi2.php" method="post" name="frmabsen" id="frmabsen" onSubmit="return cek()">
          <p><strong>NIS : </strong><br>
            <?php echo $row_rssis['nis'];?>
          <p><strong>Nama :</strong> <br>
            <?php echo $row_rssis['nama'];?> 
          <p><strong>Tanggal : </strong><br>
            <?php echo $_REQUEST['tgl'];?>                <?php

				if ($bulan == "01")
					{
					echo "Januari";
					}
				
				else if ($bulan == "02")
					{
					echo "Februari";
					}
				
				else if ($bulan == "03")
					{
					echo "Maret";
					}
				
				else if ($bulan == "04")
					{
					echo "April";
					}
				
				else if ($bulan == "05")
					{
					echo "Mei";
					}
				
				else if ($bulan == "06")
					{
					echo "Juni";
					}
				
				else if ($bulan == "07")
					{
					echo "Juli";
					}
				
				else if ($bulan == "08")
					{
					echo "Agustus";
					}
				
				else if ($bulan == "09")
					{
					echo "September";
					}
				
				else if ($bulan == "10")
					{
					echo "Oktober";
					}
				
				else if ($bulan == "11")
					{
					echo "Nopember";
					}
				
				else if ($bulan == "12")
					{
					echo "Desember";
					}
			
			  ?> <?php echo $_REQUEST['tahun'];?> 
          <p><strong>Keterangan :</strong> <br>
            <select name="ket" id="ket">
              <option>--Keterangan--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsket['kd']?>"><?php echo $row_rsket['ket']?></option>
              <?php
} while ($row_rsket = mysql_fetch_assoc($rsket));
  $rows = mysql_num_rows($rsket);
  if($rows > 0) {
      mysql_data_seek($rsket, 0);
	  $row_rsket = mysql_fetch_assoc($rsket);
  }
?>
            </select>
          <p>
            <input name="kd" type="hidden" value="<?php echo $_REQUEST['kd'];?>">
			<input name="tgl" type="hidden" value="<?php echo $_REQUEST['tgl'];?>">
			<input name="bulan" type="hidden" value="<?php echo $_REQUEST['bulan'];?>">
			<input name="tahun" type="hidden" value="<?php echo $_REQUEST['tahun'];?>">
			<input name="mpkd" type="hidden" value="<?php echo $_REQUEST['mpkd'];?>">
			<input name="progstudi" type="hidden" value="<?php echo $_REQUEST['progstudi'];?>">
			<input name="mkkd" type="hidden" value="<?php echo $_REQUEST['mkkd'];?>">
			<input name="kelas" type="hidden" value="<?php echo $_REQUEST['kelas'];?>">
			<input name="mrkd" type="hidden" value="<?php echo $_REQUEST['mrkd'];?>">
			<input name="ruang" type="hidden" value="<?php echo $_REQUEST['ruang'];?>">
			<input type="submit" name="Submit" value="Simpan">
          </p>
        </form></p>
        </div>
      </td>
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