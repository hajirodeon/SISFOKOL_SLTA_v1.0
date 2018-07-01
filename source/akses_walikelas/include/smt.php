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
$query_rssmt = "SELECT * FROM m_semester_set WHERE status = 'true'";
$rssmt= mysql_query($query_rssmt, $sisfokol) or die(mysql_error());
$row_rssmt = mysql_fetch_assoc($rssmt);
$totalRows_rssmt = mysql_num_rows($rssmt);

$inc_smt = $row_rssmt['jenis'];
?>
<strong>Semester :</strong> <?php echo $row_rssmt['jenis'];?>
