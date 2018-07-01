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

//ruang
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_ruang = "SELECT * FROM m_ruang ORDER BY ruang ASC";
$rs_ruang = mysql_query($query_rs_ruang, $sisfokol) or die(mysql_error());
$row_rs_ruang = mysql_fetch_assoc($rs_ruang);
$totalRows_rs_ruang = mysql_num_rows($rs_ruang);

//guru
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_guru = "SELECT m_guru.*, m_pegawai.* ".
					"FROM m_guru, m_pegawai ".
					"WHERE m_guru.kd_pegawai = m_pegawai.kd ".
					"AND m_guru.kd_progstudi = '$studikod' ".
					"AND m_guru.kd_kelas = '$kelkod' ".
					"ORDER BY m_pegawai.nama ASC";
$rs_guru = mysql_query($query_rs_guru, $sisfokol) or die(mysql_error());
$row_rs_guru = mysql_fetch_assoc($rs_guru);
$totalRows_rs_guru = mysql_num_rows($rs_guru);
?>
<html>
<head>
<title>Tambah Ruang Kelas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmruangkelas.progstudi.value=="") {
alert("Silahkan dipilih Program Studinya!")
return false
}

if (document.frmruangkelas.kelas.value=="") {
alert("Silahkan dipilih kelasnya!")
return false
}

if (document.frmruangkelas.ruang.value=="") {
alert("Silahkan dipilih ruangannya!")
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
<div align="center">
  <?php include("include/header.php"); ?>
  <?php include("include/menu.php"); ?>
  <br>
  <table width="990" height="400" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top"> 
      <td> <p><a href="akad_ruang_kelas.php">Data Ruang Kelas</a> &gt; Tambah 
          Ruang Kelas</p>
        <p><img src="images/adm_m_akad_ruang_kelas_tambah.gif" width="264" height="40"></p>
        <form action="akad_ruang_kelas_add1.php" method="post" name="frmruangkelas" id="frmruangkelas" onSubmit="return cek()">
          <p>Program Studi : 
            <br><select name="progstudi" id="progstudi" onChange="MM_jumpMenu('parent',this,0)">
            <?
		  	//program studi
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_progstudi = "SELECT * FROM m_progstudi ORDER BY progstudi ASC";
			$rs_progstudi = mysql_query($query_rs_progstudi, $sisfokol) or die(mysql_error());
			$row_rs_progstudi = mysql_fetch_assoc($rs_progstudi);
			$totalRows_rs_progstudi = mysql_num_rows($rs_progstudi);			


			if ($studikod == "")
				{
				echo "<option selected>--Pilih Program Studi--</option>";
				}
				
			else
			
				{
				?>
            <option value="<?php echo $_REQUEST['studikod']; ?>" selected> 
            <?
			//program studi terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_terjur = "SELECT * FROM m_progstudi WHERE kd = '$studikod'";
			$rs_terjur = mysql_query($query_rs_terjur, $sisfokol) or die(mysql_error());
			$row_rs_terjur = mysql_fetch_assoc($rs_terjur);
			$totalRows_rs_terjur = mysql_num_rows($rs_terjur);			

 echo $row_rs_terjur['progstudi']; ?></option>
            <?
				}


			do 
				{  
				?>
            <option value="akad_ruang_kelas_add.php?studikod=<? echo $row_rs_progstudi['kd']?>&progstudi=<? echo urlencode($row_rs_progstudi['progstudi']);?>"><? echo $row_rs_progstudi['progstudi'];?></option>
            <?
				} 
		
			while ($row_rs_progstudi = mysql_fetch_assoc($rs_progstudi));
			
			$rows = mysql_num_rows($rs_progstudi);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_progstudi, 0);
						$row_rs_progstudi = mysql_fetch_assoc($rs_progstudi);
  						}
		?>
          </select>
          </p>
          <p>Kelas : 
            <br><select name="kelas" id="kelas" onChange="MM_jumpMenu('parent',this,0)">
            <?
			//kelas
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_kelas = "SELECT * FROM m_kelas";
			$rs_kelas = mysql_query($query_rs_kelas, $sisfokol) or die(mysql_error());
			$row_rs_kelas = mysql_fetch_assoc($rs_kelas);
			$totalRows_rs_kelas = mysql_num_rows($rs_kelas);			
			?>
            <?
			if ($kelkod == "")
				{
				echo "<option selected>--Pilih Kelas--</option>";
				}
				
			else
			
				{
				?>
            <option value="<? echo $_REQUEST['kelkod']; ?>" selected> 
            <?
			//kelas terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_terkel = "SELECT * FROM m_kelas WHERE kd = '$kelkod'";
			$rs_terkel = mysql_query($query_rs_terkel, $sisfokol) or die(mysql_error());
			$row_rs_terkel = mysql_fetch_assoc($rs_terkel);
			$totalRows_rs_terkel = mysql_num_rows($rs_terkel);			
			?>
            <? echo $row_rs_terkel['kelas']; ?></option>
            <?
				}
			?>
            <?
			do 
				{  
				?>
            <option value="akad_ruang_kelas_add.php?studikod=<? echo $_REQUEST['studikod']; ?>&progstudi=<? echo urlencode($_REQUEST['progstudi']); ?>&kelkod=<? echo $row_rs_kelas['kd'] ?>&kelas=<? echo $row_rs_kelas['kelas'] ?>"><? echo $row_rs_kelas['kelas']?></option>
            <?
				} 
		
			while ($row_rs_kelas = mysql_fetch_assoc($rs_kelas));
			
			$rows = mysql_num_rows($rs_kelas);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_kelas, 0);
						$row_rs_kelas = mysql_fetch_assoc($rs_kelas);
  						}
		?>
          </select>
          </p>
          <p>Ruang : 
            <br><select name="ruang" id="ruang">
              <option>--Pilih Ruang--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_ruang['kd']?>"><?php echo $row_rs_ruang['ruang']?></option>
              <?php
} while ($row_rs_ruang = mysql_fetch_assoc($rs_ruang));
  $rows = mysql_num_rows($rs_ruang);
  if($rows > 0) {
      mysql_data_seek($rs_ruang, 0);
	  $row_rs_ruang = mysql_fetch_assoc($rs_ruang);
  }
?>
            </select>
          </p>
          <p>Guru : 
            <br><select name="guru" id="guru">
              <option>--Pilih Guru--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_guru['kd']?>"><?php echo $row_rs_guru['nama']?></option>
              <?php
} while ($row_rs_guru = mysql_fetch_assoc($rs_guru));
  $rows = mysql_num_rows($rs_guru);
  if($rows > 0) {
      mysql_data_seek($rs_guru, 0);
	  $row_rs_guru = mysql_fetch_assoc($rs_guru);
  }
?>
            </select></p>
          <p> 
            <input name="Reset" type="reset" id="Reset" value="Batal">
            <input name="Submit" type="submit" id="Submit" value="Simpan">
          </p>
        </form>
        <p><strong></strong></p></td>
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