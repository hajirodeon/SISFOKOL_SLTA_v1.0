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

//koneksi
require_once('../Connections/sisfokol.php'); 

//fungsi-fungsi
include("../include/function.php"); 


//ambil nilai
$studikod = $_REQUEST['studikod'];
$kelkod = $_REQUEST['kelkod'];


//pegawai
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_pegawai = "SELECT * FROM m_pegawai ORDER BY nama ASC";
$rs_pegawai = mysql_query($query_rs_pegawai, $sisfokol) or die(mysql_error());
$row_rs_pegawai = mysql_fetch_assoc($rs_pegawai);
$totalRows_rs_pegawai = mysql_num_rows($rs_pegawai);

//pelajaran
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_pelajaran = "SELECT * FROM m_pelajaran ".
						"WHERE kd_progstudi = '$studikod' ".
						"AND kd_kelas = '$kelkod' ".
						"ORDER BY pelajaran ASC";
$rs_pelajaran = mysql_query($query_rs_pelajaran, $sisfokol) or die(mysql_error());
$row_rs_pelajaran = mysql_fetch_assoc($rs_pelajaran);
$totalRows_rs_pelajaran = mysql_num_rows($rs_pelajaran);
?>
<html>
<head>
<title>Tambah Guru</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmguru.pegawai.value=="") {
alert("Jangan lupa memilih pegawai yang akan menjadi gurunya!")
return false
}

if (document.frmguru.pelajaran.value=="") {
alert("Pelajaran yang akan diampu apa?")
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
      <td> <p><a href="akad_guru.php">Data Guru</a> &gt; Tambah Guru</p>
        <p><img src="images/adm_m_akad_guru_tambah.gif" width="182" height="40"></p>
        <form action="akad_guru_add1.php" method="post" name="frmguru" id="frmguru" onSubmit="return cek()">
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
            <option value="akad_guru_add.php?studikod=<? echo $row_rs_progstudi['kd']?>&progstudi=<? echo urlencode($row_rs_progstudi['progstudi']);?>"><? echo $row_rs_progstudi['progstudi'];?></option>
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
            <option value="akad_guru_add.php?studikod=<? echo $_REQUEST['studikod']; ?>&progstudi=<? echo urlencode($_REQUEST['progstudi']); ?>&kelkod=<? echo $row_rs_kelas['kd'] ?>&kelas=<? echo $row_rs_kelas['kelas'] ?>"><? echo $row_rs_kelas['kelas']?></option>
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
          <p>Pegawai : 
            <br><select name="pegawai" id="pegawai">
              <option>--Pilih Pegawai--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_pegawai['kd']?>"><?php echo $row_rs_pegawai['nama']?></option>
              <?php
} while ($row_rs_pegawai = mysql_fetch_assoc($rs_pegawai));
  $rows = mysql_num_rows($rs_pegawai);
  if($rows > 0) {
      mysql_data_seek($rs_pegawai, 0);
	  $row_rs_pegawai = mysql_fetch_assoc($rs_pegawai);
  }
?>
            </select>
          </p>
          <p>Pelajaran : 
            <br><select name="pelajaran" id="pelajaran">
              <option>--Pilih Pelajaran--</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_pelajaran['kd']?>"><?php echo $row_rs_pelajaran['pelajaran']?></option>
              <?php
} while ($row_rs_pelajaran = mysql_fetch_assoc($rs_pelajaran));
  $rows = mysql_num_rows($rs_pelajaran);
  if($rows > 0) {
      mysql_data_seek($rs_pelajaran, 0);
	  $row_rs_pelajaran = mysql_fetch_assoc($rs_pelajaran);
  }
?>
            </select>
          </p>
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