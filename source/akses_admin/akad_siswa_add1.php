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
$nis = cegah($_POST['nis']);
$nama = cegah($_POST['nama']);
$tmplahir = cegah($_POST['tmplahir']);

$tanggal1 == cegah($_POST['tanggal1']);
$bulan1 == cegah($_POST['bulan1']);
$tahun1 == cegah($_POST['tahun1']);
$tgl1 = ("$tahun1:$bulan1:$tanggal1");

$jekel = cegah($_POST['jekel']);
$agm = cegah($_POST['agm']);
$anakke = cegah($_POST['anakke']);
$status_kel = cegah($_POST['status_kel']);
$alamat = cegah($_POST['alamat']);
$telp = cegah($_POST['telp']);
$progstudi = cegah($_POST['progstudi']);
$kelas = cegah($_POST['kelas']);

$tanggal2 == cegah($_POST['tanggal2']);
$bulan2 == cegah($_POST['bulan2']);
$tahun2 == cegah($_POST['tahun2']);
$tgl2 = ("$tahun2:$bulan2:$tanggal2");

$tapel = cegah($_POST['tapel']);
$asl_sek = cegah($_POST['asl_sek']);
$almt_sek = cegah($_POST['almt_sek']);
$nm_ayah = cegah($_POST['nm_ayah']);
$nm_ibu = cegah($_POST['nm_ibu']);
$pek2 = cegah($_POST['pek1']);

$password = md5($nis);

//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM m_siswa WHERE nis = '$nis'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	$pesan = "Siswa dengan NIS tersebut sudah ada, Silahkan diulangi!";
	$kembali = "akad_siswa_add.php";
	
	echo "<script>alert('$pesan');location.href='$kembali'</script>";
	}

else
	{

//membuat folder pegawai
$path1 = "../filebox/siswa/$x";
mkdir("$path1", 0755);

//membuat folder foto siswa
$path2 = "../filebox/siswa/$x/foto";
mkdir("$path2", 0755);

//perintah SQL
$SQL2 = sprintf("INSERT INTO m_siswa(kd, nis, password, passortu, nama, kd_kelamin, kd_agama, ".
					"tmp_lahir, tgl_lahir, anak_ke, status_kel, alamat, telepon, diterima_progstudi, ".
					"diterima_kls, diterima_tgl, kd_tapel, asl_sek, almt_sek, nm_ayah, nm_ibu, ".
					"pek_ayah, pek_ibu) VALUES ('$x', '$nis', '$password', '$password', '$nama', ".
					"'$jekel', '$agm', '$tmplahir', '$tgl1', '$anakke', '$status_kel', '$alamat', ".
					"'$telp', '$progstudi', '$kelas', '$tgl2', '$tapel', '$asl_sek', '$almt_sek', ".
					"'$nm_ayah', '$nm_ibu', '$pek1', '$pek2')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());


//masukan ke data siswa progstudi
$SQL3 = sprintf("INSERT INTO siswa_progstudi(kd_tapel, kd_progstudi, kd_siswa, status) ".
					"VALUES ('$tapel', '$progstudi', '$x', 'true')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs3 = mysql_query($SQL3, $sisfokol) or die(mysql_error());


//masukan ke data siswa kelas
$SQL4 = sprintf("INSERT INTO siswa_kelas(kd_tapel, kd_kelas, kd_siswa, status) ".
					"VALUES ('$tapel', '$kelas', '$x', 'true')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs4 = mysql_query($SQL4, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);
	
header("location:akad_siswa.php");
}
?>