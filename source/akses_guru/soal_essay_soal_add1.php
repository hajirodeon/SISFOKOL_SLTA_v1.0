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
$kunci = cegah($_POST['kunci']);


//cek, sudah ada belum
$SQL1 = sprintf("SELECT soal_essay.*, soal_essay_detail.* ".
					"FROM soal_essay, soal_essay_detail ".
					"WHERE soal_essay.kd = soal_essay_detail.kd_soal_essay ".
					"AND soal_essay.kd_progstudi = '$mprogkd' ".
					"AND soal_essay.kd_kelas = '$mkelkd' ".
					"AND soal_essay.kd_pelajaran = '$mpelkd' ".
					"AND soal_essay.kd_guru = '$mgkd' ".
					"AND soal_essay_detail.soal = '$soal'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	$pesan = "Soal tersebut sudah ada. Silahkan Diganti";
	$returner = "soal_essay_soal.php?mgkd=$mgkd&mpelkd=$mpelkd&pelajaran=$pelajaran".
				"&mprogkd=$mprogkd&progstudi=$progstudi&mkelkd=$mkelkd&kelas=$kelas&topikkd=$topikkd".
				"&topik=$topik";
	echo "<script>alert('$pesan');location.href=$returner</script>";
	}

else
	{

//perintah SQL
$SQL2 = sprintf("INSERT INTO soal_essay_detail(kd, kd_soal_essay, soal, kunci) ".
					"VALUES ('$x', '$topikkd', '$soal', '$kunci')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

$returner = "soal_essay_soal.php?mgkd=$mgkd&mpelkd=$mpelkd&pelajaran=$pelajaran".
			"&mprogkd=$mprogkd&progstudi=$progstudi&mkelkd=$mkelkd&kelas=$kelas&topikkd=$topikkd".
			"&topik=$topik";
header("location:$returner");
}
?>