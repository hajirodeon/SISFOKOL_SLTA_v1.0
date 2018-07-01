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

//ambil nilai konfigurasi tertentu
include("../include/config.php"); 

//koneksi db
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 

//ambil nilai
$mgkd = $_REQUEST['mgkd'];
$mpelkd = $_REQUEST['mpelkd'];
$pelajaran = $_REQUEST['pelajaran'];
$mprogkd = $_REQUEST['mprogkd'];
$progstudi = $_REQUEST['progstudi'];
$mkelkd = $_REQUEST['mkelkd'];
$kelas = $_REQUEST['kelas'];
$topikkd = $_REQUEST['topikkd'];
$topik = $_REQUEST['topik'];
$soal = cegah($_POST['soal']);
$pila = cegah($_POST['pila']);
$pilb = cegah($_POST['pilb']);
$pilc = cegah($_POST['pilc']);
$pild = cegah($_POST['pild']);
$pile = cegah($_POST['pile']);


//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM soal_pilihan_soal ".
					"WHERE kd_topik = '$topikkd' ".
					"AND soal = '$soal'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	$pesan = "Soal tersebut sudah ada. Ganti yang lainnya!";
	$returner = "soal_pil_soal.php?mgkd=$mgkd&mpelkd=$mpelkd&pelajaran=$pelajaran".
				"&mprogkd=$mprogkd&progstudi=$progstudi&mkelkd=$mkelkd&kelas=$kelas&topikkd=$topikkd".
				"&topik=$topik";
	?><title><?php echo $pesan;?></title>
<link href="style/guru.css" rel="stylesheet" type="text/css">
<body bgcolor="#FFFFFF" text="#000000">
  <?php include("include/header.php"); ?>
  <?php include("include/menu.php"); ?>
<table width="990" height="300" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td height="63"> 
      <div align="center">
        <table width="200" border="1" cellspacing="0" cellpadding="2">
          <tr>
            <td><div align="center">
                <p><font color="#FF0000"><strong><?php echo $pesan;?></strong></font></p>
                <p><a href="<?php echo $returner;?>">&lt;&lt;&lt; Kembali</a></p>
              </div></td>
          </tr>
        </table>
        <font color="#FF0000"></font></div>
      <div align="center"></div>
      </td>
  </tr>
</table>
<?php include("include/footer.php"); ?>
	
	
	
<?
	}

else
	{

//perintah SQL
$SQL2 = sprintf("INSERT INTO soal_pilihan_soal(kd, kd_topik, soal) ".
					"VALUES ('$x', '$topikkd', '$soal')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

///////////////////////mengambil data pilihan/////////////////////////////
$SQLpil = sprintf("SELECT * FROM m_pil ORDER BY pil ASC");

mysql_select_db($database_sisfokol, $sisfokol);
$rspil = mysql_query($SQLpil, $sisfokol) or die(mysql_error());
$row_rspil = mysql_fetch_assoc($rspil);
$totalrows_rspil = mysql_num_rows($rspil);


/////////////////////////////////////////pilihan ganda///////////////////////////////////////////////
//perintah SQL
do {  
	$data = $row_rspil['kd'];
	$data1 = $_REQUEST[$row_rspil['ngepil']];
	
	//memasukkan data
	$SQLx = sprintf("INSERT INTO soal_pilihan_opsi(kd_soal, kd_pil, opsi) ".
						"VALUES ('$x', '$data', '$data1')");

	mysql_select_db($database_sisfokol, $sisfokol);
	$Rsx = mysql_query($SQLx, $sisfokol) or die(mysql_error());
	
	} while ($row_rspil = mysql_fetch_assoc($rspil));
  $rows = mysql_num_rows($rspil);
  if($rows > 0) {
      mysql_data_seek($rspil, 0);
	  $row_rspil = mysql_fetch_assoc($rspil);
  }



//diskonek
mysql_close($sisfokol);

$returner = "soal_pil_soal.php?mgkd=$mgkd&mpelkd=$mpelkd&pelajaran=$pelajaran".
			"&mprogkd=$mprogkd&progstudi=$progstudi&mkelkd=$mkelkd&kelas=$kelas&topikkd=$topikkd".
			"&topik=$topik";
header("location:$returner");
}
?>