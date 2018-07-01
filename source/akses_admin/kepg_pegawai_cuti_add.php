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

//konek db
require_once('../Connections/sisfokol.php');

//fungsi-fungsi
include("../include/function.php"); 

//ambil nilai
$pageNum_rs1  = cegah($_REQUEST["pageNum_rs1"]);
$totalRows_rs1  = cegah($_REQUEST["totalRows_rs1"]);

$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_rs1 = 20;
$pageNum_rs1 = 0;
if (isset($HTTP_GET_VARS['pageNum_rs1'])) {
  $pageNum_rs1 = $HTTP_GET_VARS['pageNum_rs1'];
}
$startRow_rs1 = $pageNum_rs1 * $maxRows_rs1;

mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT m_pegawai.*, pegawai_cuti.*, pegawai_cuti.kd AS mpckd, m_satuan.* ".
				"FROM m_pegawai, pegawai_cuti, m_satuan ".
				"WHERE m_pegawai.kd = pegawai_cuti.kd_pegawai ".
				"AND m_satuan.kd = pegawai_cuti.kd_satuan ".
				"ORDER BY m_pegawai.nip ASC";
					
$query_limit_rs1 = sprintf("%s LIMIT %d, %d", $query_rs1, $startRow_rs1, $maxRows_rs1);
$rs1 = mysql_query($query_limit_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);

if (isset($HTTP_GET_VARS['totalRows_rs1'])) {
  $totalRows_rs1 = $HTTP_GET_VARS['totalRows_rs1'];
} else {
  $all_rs1 = mysql_query($query_rs1);
  $totalRows_rs1 = mysql_num_rows($all_rs1);
}
$totalPages_rs1 = ceil($totalRows_rs1/$maxRows_rs1)-1;

$queryString_rs1 = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs1") == false && 
        stristr($param, "totalRows_rs1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs1 = "&" . implode("&", $newParams);
  }
}
$queryString_rs1 = sprintf("&totalRows_rs1=%d%s", $totalRows_rs1, $queryString_rs1);
?>
<html>
<head>
<title>Tambah Data Cuti Pegawai</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){
var digits="0123456789"
var temp

if (document.frmcuti.pegawai.value=="") {
alert("Silahkan dipilih pegawainya!")
return false
}

if (document.frmcuti.jml.value=="") {
alert("Jumlahnya berapa?")
return false
}

for (var i=0;i<document.frmcuti.jml.value.length;i++){
temp=document.frmcuti.jml.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Jumlah harus bernilai angka!")
return false
      }
   }

if (document.frmcuti.satuan.value=="") {
alert("Satuan belum dipilih!")
return false
}

if (document.frmcuti.waktu.value=="") {
alert("Waktu cuti masih kosong")
return false
}

if (document.frmcuti.ket.value=="") {
alert("Keterangan Cuti apa?")
return false
}

return true
}
// End -->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<div align="center">
  <?php include("include/header.php"); ?>
  <?php include("include/menu.php"); ?>
  <br>
  <table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="top">
              
            <td width="45%"><a href="kepg_pegawai_cuti.php">Data Cuti Pegawai</a> 
              &gt; Data Cuti Baru</td>
            <td width="55%"><div align="right">
                
                  
                </div></td>
          </tr>
        </table>
        <p><img src="images/adm_kepg_cuti_tambah.gif" width="165" height="40"> 
        <form action="kepg_pegawai_cuti_add1.php" method="post" name="frmcuti" id="frmcuti" onSubmit="return cek()">
          <p>Pegawai : 
            <br><select name="pegawai" id="pegawai">
              <option>--Pegawai--</option>
              <?php
			  //daftar semester
$query_rspeg = "SELECT * FROM m_pegawai";
$rspeg= mysql_query($query_rspeg, $sisfokol) or die(mysql_error());
$row_rspeg = mysql_fetch_assoc($rspeg);
$totalRows_rspeg = mysql_num_rows($rspeg);

do {  
?>
              <option value="<?php echo $row_rspeg['kd']?>"><?php echo balikin($row_rspeg['nip']);?>. <?php echo balikin($row_rspeg['nama']);?></option>
              <?php
} while ($row_rspeg = mysql_fetch_assoc($rspeg));
  $rows = mysql_num_rows($rspeg);
  if($rows > 0) {
      mysql_data_seek($rspeg, 0);
	  $row_rspeg = mysql_fetch_assoc($rspeg);
  }
?>
            </select></p>
          <p>Jumlah : 
            <br>
            <input name="jml" type="text" id="jml" value="-" size="3" maxlength="3">
            <select name="satuan" id="satuan">
              <option>--Satuan--</option>
              <?php
			  //daftar semester
$query_rssatu = "SELECT * FROM m_satuan";
$rssatu= mysql_query($query_rssatu, $sisfokol) or die(mysql_error());
$row_rssatu = mysql_fetch_assoc($rssatu);
$totalRows_rssatu = mysql_num_rows($rssatu);

do {  
?>
              <option value="<?php echo $row_rssatu['kd']?>"><?php echo balikin($row_rssatu['satuan']);?></option>
              <?php
} while ($row_rssatu = mysql_fetch_assoc($rssatu));
  $rows = mysql_num_rows($rssatu);
  if($rows > 0) {
      mysql_data_seek($rssatu, 0);
	  $row_rssatu = mysql_fetch_assoc($rssatu);
  }
?>
            </select>          </p>
          <p>Waktu : <br>
            <input name="waktu" type="text" id="waktu2" value="-" size="30">
          </p>
          <p>Keterangan : <br>
            <input name="ket" type="text" id="ket" value="-" size="40">
          </p>
          <p> 
            <input type="reset" name="Reset" value="Batal">
            <input name="Submit" type="submit" id="Submit" value="Simpan">
          </p>
        </form>
        </td>
    </tr>
  </table>
  <br>
  <?php include("include/footer.php"); ?>
</div>
</body>
</html>
<?php
mysql_close($sisfokol);
?>