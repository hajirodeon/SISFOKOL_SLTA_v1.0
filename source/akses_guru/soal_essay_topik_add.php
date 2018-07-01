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

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT m_pegawai.*, m_guru.kd AS mgkd, m_guru.* ".
				"FROM m_pegawai, m_guru ".
				"WHERE m_pegawai.kd = m_guru.kd_pegawai ".
				"AND m_pegawai.kd = '$kd' ".
				"AND m_pegawai.nip = '$username'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title>Guru : <?php echo balikin($row_rs1['nama']);?> --> Soal Essay</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/guru.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmtopik.topik.value=="") {
alert("Topik untuk Soal Essay masih kosong!.")
return false
}

return true
}
// End -->
</SCRIPT>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="0" marginheight="0">
<?php include("include/header.php"); ?>
<?php include("include/menu.php"); ?>
<br>
<table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="middle"> 
    <td valign="top"> <div align="left">
        <p><a href="soal_essay.php">Soal Essay</a> &gt; Tambah Topik</p>
        <p> 
          <?php include("include/tapel.php"); ?>
        </p>
        <p><?php include("include/smt.php"); ?></p>
        <p><big><strong>TOPIK</strong></big></p>
        <form action="soal_essay_topik_add1.php" method="post" name="frmtopik" id="frmtopik" onSubmit="return cek()">
          <p>Kategori : <br>
            <select name="kategori" id="kategori" onChange="MM_jumpMenu('parent',this,0)">
              <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT m_guru.*, m_progstudi.kd AS mprogkd, m_progstudi.*, ".
				"m_kelas.kd AS mkelkd, m_kelas.*, m_pelajaran.kd AS mpelkd, m_pelajaran.* ".
				"FROM m_guru, m_progstudi, m_kelas, m_pelajaran ".
				"WHERE m_guru.kd_pelajaran = m_pelajaran.kd ".
				"AND m_guru.kd_progstudi = m_progstudi.kd ".
				"AND m_guru.kd_kelas = m_kelas.kd ".
				"AND m_guru.kd_pegawai = '$kd'";
$rsi= mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);			
?>
              <option selected>
			  <?php
			  //jika kosong
			  if ($_REQUEST['mpelkd'] == "")
			  	{
				?>--Kategori--<?php
				}
			else 
				{
				?>
				
				<?php echo $_REQUEST['pelajaran'];?> --> Program Studi : <?php echo $_REQUEST['progstudi'];?>, Kelas :<?php echo $_REQUEST['kelas'];?>
				<?php
				}
				?>
			  </option>
            <?
			do 
				{  
				?>
            <option value="soal_essay_topik_add.php?mgkd=<?php echo $row_rs1['mgkd'];?>&mpelkd=<?php echo $row_rsi['mpelkd'];?>&pelajaran=<?php echo urlencode(balikin($row_rsi['pelajaran']));?>&mprogkd=<?php echo $row_rsi['mprogkd'];?>&progstudi=<?php echo urlencode(balikin($row_rsi['progstudi']));?>&mkelkd=<?php echo $row_rsi['mkelkd'];?>&kelas=<?php echo balikin($row_rsi['kelas']);?>"><?php echo balikin($row_rsi['pelajaran']);?> --> Program Studi : <?php echo balikin($row_rsi['progstudi']);?>, Kelas :<?php echo balikin($row_rsi['kelas']);?></option>
            <?
				} 
		
			while ($row_rsi = mysql_fetch_assoc($rsi));
			
			$rows = mysql_num_rows($rsi);
  				if($rows > 0) 
						{
      					mysql_data_seek($rsi, 0);
						$row_rsi = mysql_fetch_assoc($rsi);
  						}
		?>
          </select>
		  
		  </p>
          <p>Topik : <br>
		  
            <input name="topik" type="text" id="topik" size="50">
          </p>
          <p> 
            <input name="tapelkd" type="hidden" value="<?php echo $row_rstapel['kd'];?>">
            <input name="smtkd" type="hidden" value="<?php echo $row_rssmt['kd'];?>">
            <input name="mgkd" type="hidden" value="<?php echo $_REQUEST['mgkd'];?>">
            <input name="mpelkd" type="hidden" value="<?php echo $_REQUEST['mpelkd'];?>">
            <input name="mprogkd" type="hidden" value="<?php echo $_REQUEST['mprogkd'];?>">
            <input name="mkelkd" type="hidden" value="<?php echo $_REQUEST['mkelkd'];?>">
			<input name="pelajaran" type="hidden" value="<?php echo $_REQUEST['pelajaran'];?>">
			<input name="progstudi" type="hidden" value="<?php echo $_REQUEST['progstudi'];?>">
			<input name="kelas" type="hidden" value="<?php echo $_REQUEST['kelas'];?>">
            <input type="reset" name="Reset" value="Batal">
            <input name="Submit" type="submit" id="Submit" value="Simpan">
          </p>
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