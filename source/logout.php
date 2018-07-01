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


//LOG OUT aka KELUAR
//habisi session
session_start();

session_unset($hajirobe_session);
session_unset($kd_session);
session_unset($nis_session);
session_unset($nip_session);
session_unset($admin_session);
session_unset($siswa_session);
session_unset($ortusiswa_session);
session_unset($pegawai_session);
session_unset($guru_session);
session_unset($walikelas_session);
session_unset($username_session);
session_unset($password_session);

session_unregister('$hajirobe_session');
session_unregister('$kd_session');
session_unregister('$nis_session');
session_unregister('$nip_session');
session_unregister('$admin_session');
session_unregister('$siswa_session');
session_unregister('$ortusiswa_session');
session_unregister('$pegawai_session');
session_unregister('$guru_session');
session_unregister('$walikelas_session');
session_unregister('$username_session');
session_unregister('$password_session');

session_unset();
session_destroy();

$pesan = "Session telah habis. Anda berhasil Keluar. Jangan Lupa Seringlah Login";
$kembali = "index.php";

echo "<script>alert('$pesan');location.href='$kembali'</script>";
?>