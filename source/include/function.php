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


//enkriptsi wae!
function kript($str) {
    $str = md5(md5($str));
	return $str;
  }
  
//untuk mencegah si jahil
function cegah($str) {
    $str = trim(htmlentities($str));
	$str = ereg_replace("%", "persen", $str);
	$str = ereg_replace("1=1", "1smdgan1", $str);
	$str = ereg_replace("-", "stri", $str);
	$str = ereg_replace("_", "stripbwh", $str);
	$str = ereg_replace("/", "gmring", $str);
	$str = ereg_replace("!", "pentung", $str);
	$str = ereg_replace("'", "psiji", $str);
	$str = ereg_replace("select", "NOSQL", $str);
	$str = ereg_replace("delete", "NOSQL", $str);
	$str = ereg_replace("update", "NOSQL", $str);
	$str = ereg_replace("alter", "NOSQL", $str);
	$str = ereg_replace("insert", "NOSQL", $str);
	$str = ereg_replace("from", "NOSQL", $str);
	return $str;
  }

//untuk anti-sql
function nosql($str) {
    $str = trim(mysql_real_escape_string(htmlentities(addslashes(htmlspecialchars($str)))));
	$str = ereg_replace("%", "persen", $str);
	$str = ereg_replace("1=1", "1smdgan1", $str);
	$str = ereg_replace("-", "stri", $str);
	$str = ereg_replace("_", "stripbwh", $str);
	$str = ereg_replace("/", "gmring", $str);
	$str = ereg_replace("!", "pentung", $str);
	$str = ereg_replace("'", "psiji", $str);
	$str = ereg_replace("select", "NOSQL", $str);
	$str = ereg_replace("delete", "NOSQL", $str);
	$str = ereg_replace("update", "NOSQL", $str);
	$str = ereg_replace("alter", "NOSQL", $str);
	$str = ereg_replace("insert", "NOSQL", $str);
	$str = ereg_replace("grant", "NOSQL", $str);
	return $str;
  }
 
//balikino. . o . . .. o. . .. . balikin
function balikin($str) {
	$str = ereg_replace("persen", "%", $str);
	$str = ereg_replace("1smdgan1", "1=1", $str);
	$str = ereg_replace("stri", "-", $str);
	$str = ereg_replace("stripbwh", "_", $str);
	$str = ereg_replace("gmring", "/", $str);
	$str = ereg_replace("pentung", "!", $str);
	$str = ereg_replace("&amp;", "&", $str);
	$str = ereg_replace("-pbwh", "_", $str);
	$str = ereg_replace("psiji", "'", $str);
	return $str;
  }
 
//penghapus, dayo!
function delete($file) {
 if (file_exists($file)) {
   chmod($file,0777);
   if (is_dir($file)) {
     $handle = opendir($file); 
     while($filename = readdir($handle)) {
       if ($filename != "." && $filename != "..") {
         delete($file."/".$filename);
       }
     }
     closedir($handle);
     rmdir($file);
   } else {
     unlink($file);
   }
 }
}

//pengatur random session
$hajirobe = md5(md5(rand(1,1000000000000)));

//ambil saat ini
$today = date("Ymd H:i:s");

//atur random untuk kode
$x = md5(md5(rand(1,1000000000000)));

//atur random password baru dari lupa
$lpx = rand(1,1000000);

//pengatur array
$ngaray = array(
	//array bulan
   'bln' => array(
       '01' => 'Januari',
       '02' => 'Pebruari',
	   '03' => 'Maret',
	   '04' => 'April',
	   '05' => 'Mei',
	   '06' => 'Juni',
	   '07' => 'Juli',
	   '08' => 'Agustus',
	   '09' => 'September',
	   '10' => 'Oktober',
	   '11' => 'Nopember',
	   '12' => 'Desember'
     )
 );
?>