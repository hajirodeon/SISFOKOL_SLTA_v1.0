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
$nip = cegah($_POST['nip']);
$nama = cegah($_POST['nama']);
$jekel = cegah($_POST['jekel']);
$tmplahir = cegah($_POST['tmplahir']);

$tanggal1 == cegah($_POST['tanggal1']);
$bulan1 == cegah($_POST['bulan1']);
$tahun1 == cegah($_POST['tahun1']);
$tgl1 = ("$tahun1:$bulan1:$tanggal1");

$kawin = cegah($_POST['RadioGroup1']);
//jika kawin
if ($kawin == "1")
	{
	$kawin = 'true';
	}

//tidak kawin
else if ($kawin == "0")
	{
	$kawin = 'false';
	}


$bangsa = cegah($_POST['bangsa']);
$agm = cegah($_POST['agm']);
$pangkat = cegah($_POST['pangkat']);
$jabatan = cegah($_POST['jabatan']);

$status = cegah($_POST['RadioGroup2']);
//jika status : tetap
if ($status == "1")
	{
	$status = 'true';
	}

//tidak status : tidak tetap
else if ($status == "0")
	{
	$status = 'false';
	}

$alamat = cegah($_POST['alamat']);

//pendidikan
$pend_sd = cegah($_POST['pend_sd']);
$pend_sltp = cegah($_POST['pend_sltp']);
$pend_slta = cegah($_POST['pend_slta']);
$pend_kuliah = cegah($_POST['pend_kuliah']);

//tahun pendidikan
$tahun_sd = cegah($_POST['tahun_sd']);
$tahun_sltp = cegah($_POST['tahun_sltp']);
$tahun_slta = cegah($_POST['tahun_slta']);
$tahun_kuliah = cegah($_POST['tahun_kuliah']);

//cek, sudah ada belum
$SQL1 = sprintf("SELECT * FROM m_pegawai WHERE nip = '$nip'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs1 = mysql_query($SQL1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($Rs1);
$totalRows_rs1 = mysql_num_rows($Rs1);

//jika iya
if ($totalRows_rs1 != 0) 
	{
	$pesan = "Pegawai dengan NIP tersebut sudah ada, Silahkan diulangi!";
	$kembali = "kepg_pegawai_add.php";
	
	echo "<script>alert('$pesan');location.href='$kembali'</script>";
	}

else
	{


//membuat folder pegawai
$path1 = "../filebox/pegawai/$x";
mkdir("$path1", 0755);

//membuat folder foto pegawai
$path2 = "../filebox/pegawai/$x/foto";
mkdir("$path2", 0755);

//perintah SQL : masukkan data pegawai
$SQL2 = sprintf("INSERT INTO m_pegawai(kd, nip, nama, kd_kelamin, tmp_lahir, tgl_lahir, kawin, ".
					"bangsa, kd_agama, pangkat, jabatan, status, alamat) ".
					"VALUES ('$x', '$nip', '$nama', '$jekel', '$tmplahir', '$tgl1', '$kawin', ".
					"'$bangsa', '$agm', '$pangkat', '$jabatan', '$status', '$alamat')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());


//perintah SQL : masukkan data pendidikan pegawai --> SD, SLTP, SLTA, Kuliah.
$SQL3 = sprintf("INSERT INTO pegawai_pddkn(kd_pegawai, pend_sd, pend_sltp, pend_slta, pend_kuliah, ".
					"tahun_sd, tahun_sltp, tahun_slta, tahun_kuliah) ".
					"VALUES ('$x', '$pend_sd', '$pend_sltp', '$pend_slta', '$pend_kuliah', ".
					"'$tahun_sd', '$tahun_sltp', '$tahun_slta', '$tahun_kuliah')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs3 = mysql_query($SQL3, $sisfokol) or die(mysql_error());


//perintah SQL : masukkan nilai "-"
$SQL4 = sprintf("INSERT INTO pegawai_nilai(kd_pegawai, kesetiaan, prestasi_kerja, tanggung_jawab, ".
					"kejujuran, kerja_sama, prakarsa, kepemimpinan) ".
					"VALUES ('$x', '-', '-', '-', '-', '-', '-', '-')");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs4 = mysql_query($SQL4, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

//auto-kembali
header("location:kepg_pegawai.php");
}
?>