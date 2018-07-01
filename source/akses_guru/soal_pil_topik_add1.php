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
$topik = cegah($_POST['topik']);
$mpelkd = cegah($_POST['mpelkd']);
$mkelkd = cegah($_POST['mkelkd']);
$mprogkd = cegah($_POST['mprogkd']);
$mgkd = cegah($_POST['mgkd']);
$tapelkd = cegah($_POST['tapelkd']);
$smtkd = cegah($_POST['smtkd']);

//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM soal_pilihan ".
					"WHERE kd_progstudi = '$mprogkd' ".
					"AND kd_kelas = '$mkelkd' ".
					"AND kd_pelajaran = '$mpelkd' ".
					"AND kd_guru = '$mgkd' ".
					"AND topik = '$topik'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	$pesan = "Topik sudah ada. Silahkan ganti yang lain.";
	$kembali = "soal_pil_topik_add.php";
	
	echo "<script>alert('$pesan');location.href='$kembali'</script>";
	}

else
	{

//perintah SQL
$SQL2 = sprintf("INSERT INTO soal_pilihan(kd, kd_tapel, kd_semester, kd_progstudi, kd_kelas, ".
					"kd_pelajaran, kd_guru, topik) ".
					"VALUES ('$x', '$tapelkd', '$smtkd', '$mprogkd', '$mkelkd', '$mpelkd', ".
					"'$mgkd', '$topik')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

$returner = "soal_pil.php?mgkd=$mgkd&mpelkd=$mpelkd&pelajaran=$pelajaran&mprogkd=$mprogkd".
				"&progstudi=$progstudi&mkelkd=$mkelkd&kelas=$kelas";
header("location:$returner");
}
?>