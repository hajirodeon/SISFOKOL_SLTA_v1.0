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

//kosongkan cache
header("cache-control:private");
header("pragma:no-cache");
header("cache-control:no-cache");
flush();  

//ambil nilai konfigurasi tertentu
include("../include/config.php"); 

//koneksi db
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 

//ambil nilai
$kd = $_SESSION['kd_session'];
$username = $_SESSION['username_session'];
$password = $_SESSION['password_session'];
$mgkd = $_REQUEST['mgkd'];
$mpelkd = $_REQUEST['mpelkd'];
$pelajaran = $_REQUEST['pelajaran'];
$mprogkd = $_REQUEST['mprogkd'];
$progstudi = $_REQUEST['progstudi'];
$mkelkd = $_REQUEST['mkelkd'];
$kelas = $_REQUEST['kelas'];
$topikkd = $_REQUEST['topikkd'];
$topik = $_REQUEST['topik'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT m_pegawai.*, m_guru.* ".
				"FROM m_pegawai, m_guru ".
				"WHERE m_pegawai.kd = m_guru.kd_pegawai ".
				"AND m_pegawai.kd = '$kd' ".
				"AND m_pegawai.nip = '$username'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);

//ambil nilai
$pageNum_rsx  = cegah($_REQUEST["pageNum_rsx"]);
$totalRows_rsx  = cegah($_REQUEST["totalRows_rsx"]);

$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_rsx = 20;
$pageNum_rsx = 0;
if (isset($HTTP_GET_VARS['pageNum_rsx'])) {
  $pageNum_rsx = $HTTP_GET_VARS['pageNum_rsx'];
}
$startRow_rsx = $pageNum_rsx * $maxRows_rsx;

mysql_select_db($database_sisfokol, $sisfokol);

$query_rsx = "SELECT * FROM soal_essay_detail ".
				"WHERE kd_soal_essay = '$topikkd'";
					
$query_limit_rsx = sprintf("%s LIMIT %d, %d", $query_rsx, $startRow_rsx, $maxRows_rsx);
$rsx = mysql_query($query_limit_rsx, $sisfokol) or die(mysql_error());
$row_rsx = mysql_fetch_assoc($rsx);

if (isset($HTTP_GET_VARS['totalRows_rsx'])) {
  $totalRows_rsx = $HTTP_GET_VARS['totalRows_rsx'];
} else {
  $all_rsx = mysql_query($query_rsx);
  $totalRows_rsx = mysql_num_rows($all_rsx);
}
$totalPages_rsx = ceil($totalRows_rsx/$maxRows_rsx)-1;

$queryString_rsx = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsx") == false && 
        stristr($param, "totalRows_rsx") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsx = "&" . implode("&", $newParams);
  }
}
$queryString_rsx = sprintf("&totalRows_rsx=%d%s", $totalRows_rsx, $queryString_rsx);
?>
<html>
<head>
<title>Guru : <?php echo balikin($row_rs1['nama']);?> --> Kumpulan Soal : <?php echo $topik;?> --> Membuat Soal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/guru.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmsoal.soal.value=="") {
alert("Soal belum ditulis!")
return false
}

if (document.frmsoal.kunci.value=="") {
alert("Kunci Jawabannya apa?")
return false
}

return true
}
// End -->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="middle"> 
    <td valign="top"> <div align="left"> 
        <p><a href="soal_essay.php?mgkd=<?php echo $_REQUEST['mgkd'];?>&mpelkd=<?php echo $_REQUEST['mpelkd'];?>&pelajaran=<?php echo balikin(urlencode($_REQUEST['pelajaran']));?>&mprogkd=<?php echo $_REQUEST['mprogkd'];?>&progstudi=<?php echo balikin(urlencode($_REQUEST['progstudi']));?>&mkelkd=<?php echo $_REQUEST['mkelkd'];?>&kelas=<?php echo balikin($_REQUEST['kelas']);?>">Soal 
          Essay</a> &gt; <a href="soal_essay_soal.php?mgkd=<?php echo $_REQUEST['mgkd'];?>&mpelkd=<?php echo $_REQUEST['mpelkd'];?>&pelajaran=<?php echo urlencode(balikin($_REQUEST['pelajaran']));?>&mprogkd=<?php echo $_REQUEST['mprogkd'];?>&progstudi=<?php echo urlencode(balikin($_REQUEST['progstudi']));?>&mkelkd=<?php echo $_REQUEST['mkelkd'];?>&kelas=<?php echo balikin($_REQUEST['kelas']);?>&topikkd=<?php echo $_REQUEST['topikkd'];?>&topik=<?php echo urlencode(balikin($_REQUEST['topik']));?>">Kumpulan 
          Soal <?php echo $_REQUEST['pelajaran'];?> : <?php echo $topik;?></a> 
          &gt; Membuat Soal</p>
        <p><big><strong>MEMBUAT SOAL</strong></big></p>
        <form action="soal_essay_soal_add1.php" method="post" name="frmsoal" id="frmsoal" onSubmit="return cek()">
          <p> Soal :<br>
            <textarea name="soal" cols="75" rows="10" wrap="VIRTUAL" id="soal"></textarea>
          </p>
          <p>Jawaban : <br>
            <textarea name="kunci" cols="75" rows="10" wrap="VIRTUAL" id="kunci"></textarea>
          </p>
          <p> 
            <input name="mgkd" type="hidden" value="<?php echo $_REQUEST['mgkd'];?>">
			<input name="mpelkd" type="hidden" value="<?php echo $_REQUEST['mpelkd'];?>">
			<input name="pelajaran" type="hidden" value="<?php echo $_REQUEST['pelajaran'];?>">
			<input name="mprogkd" type="hidden" value="<?php echo $_REQUEST['mprogkd'];?>">
			<input name="progstudi" type="hidden" value="<?php echo $_REQUEST['progstudi'];?>">
			<input name="mkelkd" type="hidden" value="<?php echo $_REQUEST['mkelkd'];?>">
			<input name="kelas" type="hidden" value="<?php echo $_REQUEST['kelas'];?>">
			<input name="topikkd" type="hidden" value="<?php echo $_REQUEST['topikkd'];?>">
			<input name="topik" type="hidden" value="<?php echo $_REQUEST['topik'];?>">
			
			<input type="reset" name="Reset" value="Batal">
            <input name="Submit" type="submit" id="Submit" value="Simpan">
          </p>
          <p>&nbsp; </p>
        </form>
        <p>&nbsp;</p>
		
		</div>
      </td>
  </tr>
</table>
<br>
<?php include("include/footer.php"); ?>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>