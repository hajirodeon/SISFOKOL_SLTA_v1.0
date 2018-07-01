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

//mengecek, filenya harus .JPG
if ($filex_type != 'image/pjpeg')
	{
	$pesan = "File Yang Anda Masukkan Harus File Gambar yang berformat JPG. Harap Diulangi";
	$kembali = "akad_siswa_detail.php";
	
	echo "<script>alert('$pesan');location.href='$kembali'</script>";
	}

else
	{

//ambil nilai
$kd = cegah($_POST['kd']);

//mengkopi file
copy($filex,"../filebox/siswa/$kd/foto/$filex_name"); 

//perintah SQL
$SQL2 = sprintf("UPDATE m_siswa SET foto = '$filex_name' WHERE kd = '$kd'");

mysql_select_db($database_sisfokol, $sisfokol);
$Rs2 = mysql_query($SQL2, $sisfokol) or die(mysql_error());

//diskonek
mysql_close($sisfokol);

//auto-kembali
$returner = "akad_siswa_detail.php?kd=$kd";
header("location:$returner");
}
?>