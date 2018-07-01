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

mysql_select_db($database_sisfokol, $sisfokol);

//semester yang di-set
$query_rstapel = "SELECT * FROM m_tapel WHERE status = 'true'";
$rstapel= mysql_query($query_rstapel, $sisfokol) or die(mysql_error());
$row_rstapel = mysql_fetch_assoc($rstapel);
$totalRows_rstapel = mysql_num_rows($rstapel);

$inc_tapel = $row_rstapel['kd'];
?>

<strong>Tahun Pelajaran :</strong> <?php echo $row_rstapel['tahun1']?>/<?php echo $row_rstapel['tahun2']?>