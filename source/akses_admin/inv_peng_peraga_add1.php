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

//koneksi
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 

//ambil nilai
$tanggal1 == cegah($_POST['tanggal1']);
$bulan1 == cegah($_POST['bulan1']);
$tahun1 == cegah($_POST['tahun1']);
$tgl1 = ("$tahun1:$bulan1:$tanggal1");

$alat = cegah($_POST['alat']);
$jumlah = cegah($_POST['jumlah']);
$guru = cegah($_POST['guru']);

$tanggal3 == cegah($_POST['tanggal3']);
$bulan3 == cegah($_POST['bulan3']);
$tahun3 == cegah($_POST['tahun3']);
$tgl3 = ("$tahun3:$bulan3:$tanggal3");

$ket = cegah($_POST['ket']);

//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM inv_peng_peraga ".	
					"WHERE kd_guru = '$guru' ".
					"AND kd_alat_peraga = '$alat'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	$pesan = "Alat Peraga sudah pernah dipinjam oleh guru tersebut. Silahkan diganti!";
	$kembali = "inv_peng_peraga_add.php";
	
	echo "<script>alert('$pesan');location.href='$kembali'</script>";
	}

else
	{
	
//perintah SQL
$SQL2 = sprintf("INSERT INTO inv_peng_peraga(kd, tgl, kd_alat_peraga, jumlah, kd_guru, tgl_kembali, ".
					"ket) VALUES ('$x', '$tgl1', '$alat', '$jumlah', '$guru', '$tgl3', '$ket')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);
	
header("location:inv_peng_peraga.php");
}
?>