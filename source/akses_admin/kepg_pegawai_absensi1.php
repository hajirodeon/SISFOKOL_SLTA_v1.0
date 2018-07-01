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

//ambil nilai
$kd = $_REQUEST['kd'];
$bulan = $_REQUEST['bulan'];
$tahun = $_REQUEST['tahun'];

//ket
mysql_select_db($database_sisfokol, $sisfokol);
$query_rspeg = "SELECT * FROM m_pegawai ".
				"WHERE kd = '$kd'";
$rspeg = mysql_query($query_rspeg, $sisfokol) or die(mysql_error());
$row_rspeg = mysql_fetch_assoc($rspeg);
$totalRows_rspeg = mysql_num_rows($rspeg);

//ket
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsket = "SELECT * FROM m_ket ORDER BY ket ASC";
$rsket = mysql_query($query_rsket, $sisfokol) or die(mysql_error());
$row_rsket = mysql_fetch_assoc($rsket);
$totalRows_rsket = mysql_num_rows($rsket);
?>
<html>
<head>
<title>Absensi Pegawai</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
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
<div align="center">
  <?php include("include/header.php"); ?>
  <?php include("include/menu.php"); ?>
  <br>
  <table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td> 
        <p> <a href="kepg_pegawai_absensi.php?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>">Absensi Harian Pegawai</a> &gt; 
          Isi Absensi
        <p><strong>ABSENSI </strong> 
		<form action="kepg_pegawai_absensi2.php" method="post" name="frmabsen" id="frmabsen" onSubmit="return cek()">
          <p><strong>NIP : </strong><br><?php echo $row_rspeg['nip'];?>
          <p><strong>Nama :</strong> <br>
            <?php echo $row_rspeg['nama'];?> 
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
			<input type="submit" name="Submit" value="Simpan">
          </p>
        </form>
        <p>&nbsp;
<p>&nbsp;</td>
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