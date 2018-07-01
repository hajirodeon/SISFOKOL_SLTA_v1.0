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

///cek session
$kd_session = $_SESSION['kd_session'];
$nip_session = $_SESSION['nip_session'];
$username_session = $_SESSION['username_session'];
$password_session = $_SESSION['password_session'];
$guru_session = $_SESSION['guru_session'];
$hajirobe_session = $_SESSION['hajirobe_session'];


if (($kd_session == "") AND ($nip_session == "") AND ($username_session == "") AND ($password_session == "") AND ($guru_session == "") AND ($hajirobe_session == ""))
	{
	$pesan = "Anda Harus Login Terlebih Dahulu";
	$kembali = "../index.php";
	
  	echo "<script>alert('$pesan');location.href='$kembali'";
	}
?>