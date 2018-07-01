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

//ambil nilai session
$kd = cegah($_REQUEST['kd']);
$nama = cegah($_REQUEST['nama']);
	  	  
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT m_ekstra.kd AS mekd, m_ekstra.*, siswa_ekstra.* ".
				"FROM m_ekstra, siswa_ekstra ".
				"WHERE m_ekstra.kd = siswa_ekstra.kd_ekstra ".
				"AND siswa_ekstra.kd_siswa = '$kd' ".
				"ORDER BY m_ekstra.ekstra ASC";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);

//data ekstra
mysql_select_db($database_sisfokol, $sisfokol);

$query_rsekstra = "SELECT * FROM m_ekstra ORDER BY ekstra ASC";
$rsekstra = mysql_query($query_rsekstra, $sisfokol) or die(mysql_error());
$row_rsekstra = mysql_fetch_assoc($rsekstra);
$totalRows_rsekstra = mysql_num_rows($rsekstra);
?>
<html>
<head>
<title>Ekstrakurikuler --> <?php echo balikin($nama);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmekstra.ekstra.value=="") {
alert("Ekstrakurikuler Belum Dipilih!")
return false
}

return true
}
// End -->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="5" marginheight="5">
<div align="center">
  <table width="430" border="0" align="left" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td width="199"> <p><strong><?php echo balikin($nama);?></strong></p>
        <p>
          <?php
		//nek kosong
		if ($row_rs1['ekstra'] == "")
			{
			echo "-";
			}
		else
			{
		do
			{
			?>
          <?php echo $row_rs1['ekstra']; ?> [<a href="akt_siswa_ekstra_del.php?ekstrakd=<?php echo $row_rs1['mekd'];?>&kd=<?php echo $kd;?>&nama=<?php echo $nama;?>">HAPUS</a>]<br>
          <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); 
			}
			?>
        </p></td>
      <td width="231"><form action="akt_siswa_ekstra1.php" method="post" name="frmekstra" id="frmekstra" onSubmit="return cek()">
          
            <select name="ekstra" id="ekstra">
              <option>-Ekstrakurikuler-</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsekstra['kd']?>"><?php echo balikin($row_rsekstra['ekstra']);?></option>
              <?php
} while ($row_rsekstra = mysql_fetch_assoc($rsekstra));
  $rows = mysql_num_rows($rsekstra);
  if($rows > 0) {
      mysql_data_seek($rsekstra, 0);
	  $row_rsekstra = mysql_fetch_assoc($rsekstra);
  }
?>
            </select>
          <br>
            <input name="mskd" type="hidden" value="<?php echo $kd;?>">
			<input name="nama" type="hidden" value="<?php echo $nama;?>">
			<input type="submit" name="Submit" value="Tambah">
         
        </form></td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>