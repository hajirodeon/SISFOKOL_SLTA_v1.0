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
include("include/itapel.php"); 
include("include/ismt.php"); 

//ambil nilai
$kd = $_SESSION['kd_session'];
$username = $_SESSION['username_session'];
$password = $_SESSION['password_session'];
$mpkd = $_REQUEST['mpkd'];
$mkkd = $_REQUEST['mkkd'];
$mrkd = $_REQUEST['mrkd'];

//sql
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT * FROM m_pegawai ".
				"WHERE kd = '$kd' ".
				"AND nip = '$username'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);

$bulan = $_REQUEST['bulan'];
$tahun = $_REQUEST['tahun'];
$mpkd = $_REQUEST['mpkd'];
$progstudi = $_REQUEST['progstudi'];
$mkkd = $_REQUEST['mkkd'];
$kelas = $_REQUEST['kelas'];
$mrkd = $_REQUEST['mrkd'];
$ruang = $_REQUEST['ruang'];
$kd = $_REQUEST['kd'];

//siswa
mysql_select_db($database_sisfokol, $sisfokol);
$query_rssis = "SELECT * FROM m_siswa ".
				"WHERE kd = '$kd'";
$rssis = mysql_query($query_rssis, $sisfokol) or die(mysql_error());
$row_rssis = mysql_fetch_assoc($rssis);
$totalRows_rssis = mysql_num_rows($rssis);
?>
<html>
<head>
<title>Wali Kelas : <?php echo balikin($row_rs1['nama']);?> --> RAPORT SISWA</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/walikelas.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

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
        <p><a href="raport.php?mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>">Daftar 
          Raport Siswa</a> &gt; Raport</p>
        <p><big><strong>RAPORT</strong></big></p>
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr valign="top">
            <td width="23%" bgcolor="#CCFFCC"><p><strong>NIS : </strong><br>
                <?php echo $row_rssis['nis'];?> </p>
              <p><strong>Nama :</strong> <br>
                <?php echo $row_rssis['nama'];?> </p>
              <p><strong>Program Studi :</strong> <br>
                <?php echo $_REQUEST['progstudi'];?> </p>
              <p><strong>Kelas :</strong> <br>
                <?php echo $_REQUEST['kelas'];?> </p>
              <p><strong>Ruang :</strong> <br>
                <?php echo $_REQUEST['ruang'];?> </p>
              <p> 
                <?php include("include/tapel.php"); ?>
              </p>
              <div align="left"> 
                <p> 
                  <?php include("include/smt.php"); ?>
                </p>
              </div>
        </td>
            <td width="1%">&nbsp;</td>
            <td width="76%"> <strong>Pelajaran 
              <?php
			//ambil nilai
			$mpkd = $_REQUEST['mpkd'];
			$mkkd = $_REQUEST['mkkd'];
			
			//daftar pelajaran
mysql_select_db($database_sisfokol, $sisfokol);
$query_rspel = "SELECT * FROM m_pelajaran ".
				"WHERE kd_progstudi = '$mpkd' ".
				"AND kd_kelas = '$mkkd'";
$rspel = mysql_query($query_rspel, $sisfokol) or die(mysql_error());
$row_rspel = mysql_fetch_assoc($rspel);
$totalRows_rspel = mysql_num_rows($rspel);
?>
              </strong> 
              <table width="500" border="0" cellspacing="0" cellpadding="2">
                <?php
 do
 	{
	if ($warna_set ==0)
			{
			$warna = '#F8F8F8';
			$warna_set = 1;
			}
		
		else
			
			{
			$warna = '#F0F4F8';
			$warna_set = 0;
			}
		?>
                <tr valign="top" bgcolor="<? echo $warna; ?>"> 
                  <td width="86%" valign="middle">- <?php echo $row_rspel['pelajaran'];?></td>
                  <td width="14%"><select name="nilai" id="nilai" onChange="MM_jumpMenu('parent',this,0)">
            <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsi = "SELECT siswa_raport.*, m_nilai_angka.* ".
				"FROM siswa_raport, m_nilai_angka ".
				"WHERE siswa_raport.kd_nilai = m_nilai_angka.kd ".
				"AND siswa_raport.kd_siswa = '$kd' ".
				"AND siswa_raport.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_raport.kd_semester = '$row_rssmt[kd]' ".
				"AND siswa_raport.kd_progstudi = '$mpkd' ".
				"AND siswa_raport.kd_kelas = '$mkkd' ".
				"AND siswa_raport.kd_ruang = '$mrkd' ".
				"AND siswa_raport.kd_pelajaran = '$row_rspel[kd]'";
$rsi= mysql_query($query_rsi, $sisfokol) or die(mysql_error());
$row_rsi = mysql_fetch_assoc($rsi);
$totalRows_rsi = mysql_num_rows($rsi);			
?>
            <option selected> 
            <?php
			  //jika kosong
			  if ($row_rsi['kd_nilai'] == "")
			  	{
				?>
            -Nilai- 
            <?php
				}
			else 
				{
				?><?php echo $row_rsi['angka'];?>
            <?php
				}
				?>
            </option>
            <?
			
				mysql_select_db($database_sisfokol, $sisfokol);

$query_rsangka = "SELECT * FROM m_nilai_angka ".
					"ORDER BY angka ASC";
$rsangka = mysql_query($query_rsangka, $sisfokol) or die(mysql_error());
$row_rsangka = mysql_fetch_assoc($rsangka);
$totalRows_rsangka = mysql_num_rows($rsangka);

do 
				{  
				?>
            <option value="raport2.php?kd=<?php echo $row_rssis['kd'];?>&pelkd=<?php echo $row_rspel['kd'];?>&angkakd=<?php echo $row_rsangka['kd'];?>&mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>"><?php echo $row_rsangka['angka'];?></option>
            <?
				} 
		
			while ($row_rsangka = mysql_fetch_assoc($rsangka));
		?>
          </select></td>
                </tr>
                <?php
			} while ($row_rspel = mysql_fetch_assoc($rspel)); ?>
              </table><br><br>

			  <strong>Ekstrakurikuler</strong>
                <?php
			//daftar ekstra
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsekstra = "SELECT siswa_ekstra.*, m_ekstra.* ".
				"FROM siswa_ekstra, m_ekstra ".
				"WHERE siswa_ekstra.kd_ekstra = m_ekstra.kd";
$rsekstra = mysql_query($query_rsekstra, $sisfokol) or die(mysql_error());
$row_rsekstra = mysql_fetch_assoc($rsekstra);
$totalRows_rsekstra = mysql_num_rows($rsekstra);
?></strong>
               
              <table width="500" border="0" cellspacing="0" cellpadding="2">
                <?php
 do
 	{
	if ($warna_set ==0)
			{
			$warna = '#F8F8F8';
			$warna_set = 1;
			}
		
		else
			
			{
			$warna = '#F0F4F8';
			$warna_set = 0;
			}
		?>
                <tr valign="top" bgcolor="<? echo $warna; ?>"> 
                  <td width="86%" valign="middle">- <?php echo $row_rsekstra['ekstra'];?></td>
                  <td width="14%"><select name="nilaix" id="nilaix" onChange="MM_jumpMenu('parent',this,0)">
            <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsix = "SELECT siswa_raport_ekstra.*, m_nilai_angka.* ".
				"FROM siswa_raport_ekstra, m_nilai_angka ".
				"WHERE siswa_raport_ekstra.kd_nilai = m_nilai_angka.kd ".
				"AND siswa_raport_ekstra.kd_siswa = '$kd' ".
				"AND siswa_raport_ekstra.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_raport_ekstra.kd_semester = '$row_rssmt[kd]' ".
				"AND siswa_raport_ekstra.kd_progstudi = '$mpkd' ".
				"AND siswa_raport_ekstra.kd_kelas = '$mkkd' ".
				"AND siswa_raport_ekstra.kd_ruang = '$mrkd' ".
				"AND siswa_raport_ekstra.kd_ekstra = '$row_rsekstra[kd]'";
$rsix = mysql_query($query_rsix, $sisfokol) or die(mysql_error());
$row_rsix = mysql_fetch_assoc($rsix);
$totalRows_rsix = mysql_num_rows($rsix);			
?>
            <option selected> 
            <?php
			  //jika kosong
			  if ($row_rsix['kd_nilai'] == "")
			  	{
				?>
            -Nilai- 
            <?php
				}
			else 
				{
				?><?php echo $row_rsix['angka'];?>
            <?php
				}
				?>
            </option>
            <?
			
				mysql_select_db($database_sisfokol, $sisfokol);

$query_rsangkax = "SELECT * FROM m_nilai_angka ".
					"ORDER BY angka ASC";
$rsangkax = mysql_query($query_rsangkax, $sisfokol) or die(mysql_error());
$row_rsangkax = mysql_fetch_assoc($rsangkax);
$totalRows_rsangkax = mysql_num_rows($rsangkax);

do 
				{  
				?>
            <option value="raport2x.php?kd=<?php echo $row_rssis['kd'];?>&ekstrakd=<?php echo $row_rsekstra['kd'];?>&angkakd=<?php echo $row_rsangkax['kd'];?>&mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>"><?php echo $row_rsangkax['angka'];?></option>
            <?
				} 
		
			while ($row_rsangkax = mysql_fetch_assoc($rsangkax));
		?>
          </select>&nbsp;</td>
                </tr>
                <?php
			} while ($row_rsekstra = mysql_fetch_assoc($rsekstra)); ?>
              </table><br><br>
              <strong>Absensi  </strong> 
                <?php
			//daftar ket
mysql_select_db($database_sisfokol, $sisfokol);
$query_rsket = "SELECT * ".
				"FROM m_ket";
$rsket = mysql_query($query_rsket, $sisfokol) or die(mysql_error());
$row_rsket = mysql_fetch_assoc($rsket);
$totalRows_rsket = mysql_num_rows($rsket);
?>
               
              <table width="500" border="0" cellspacing="0" cellpadding="2">
                
                <?php
 do
 	{
	if ($warna_set ==0)
			{
			$warna = '#F8F8F8';
			$warna_set = 1;
			}
		
		else
			
			{
			$warna = '#F0F4F8';
			$warna_set = 0;
			}
		?>
                <tr valign="top" bgcolor="<? echo $warna; ?>"> 
                  <td width="78%" valign="middle">- <?php echo $row_rsket['ket'];?></td>
                  <td width="22%"><select name="nilaia" id="nilaia" onChange="MM_jumpMenu('parent',this,0)">
            <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsia = "SELECT siswa_raport_absensi.*, m_ket.* ".
				"FROM siswa_raport_absensi, m_ket ".
				"WHERE siswa_raport_absensi.kd_ket = m_ket.kd ".
				"AND siswa_raport_absensi.kd_siswa = '$kd' ".
				"AND siswa_raport_absensi.kd_tapel = '$row_rstapel[kd]' ".
				"AND siswa_raport_absensi.kd_semester = '$row_rssmt[kd]' ".
				"AND siswa_raport_absensi.kd_progstudi = '$mpkd' ".
				"AND siswa_raport_absensi.kd_kelas = '$mkkd' ".
				"AND siswa_raport_absensi.kd_ruang = '$mrkd' ".
				"AND siswa_raport_absensi.kd_ket = '$row_rsket[kd]'";
$rsia = mysql_query($query_rsia, $sisfokol) or die(mysql_error());
$row_rsia = mysql_fetch_assoc($rsia);
$totalRows_rsia = mysql_num_rows($rsia);			
?>
            <option selected> 
            <?php
			  //jika kosong
			  if ($row_rsia['kd_ket'] == "")
			  	{
				?>
            -Nilai- 
            <?php
				}
			else 
				{
				?><?php echo $row_rsia['jml'];?>
            <?php
				}
				?>
            </option>
            <?
for ($i=1; $i<=31;$i++) 
				{  
				?>
            <option value="raport2a.php?kd=<?php echo $row_rssis['kd'];?>&ketkd=<?php echo $row_rsket['kd'];?>&jml=<?php echo $i;?>&mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>"><?php echo $i;?></option>
            <?
				} 
		?>
          </select>
                    Hari&nbsp;</td>
                </tr>
                <?php
			} while ($row_rsket = mysql_fetch_assoc($rsket)); ?>
              </table>
              
              <br>
              <br>
              <table width="500" border="0" cellpadding="2" cellspacing="0" bgcolor="#F0F4F8">
                               <tr valign="top"> 
                  <td width="81%" valign="middle"><strong>Rangking</strong> </td>
                  <td width="19%"><select name="rangking" id="rangking" onChange="MM_jumpMenu('parent',this,0)">
            <?
		  	mysql_select_db($database_sisfokol, $sisfokol);

$query_rsiking = "SELECT * ".
				"FROM siswa_raport_rangking ".
				"WHERE kd_siswa = '$kd' ".
				"AND kd_tapel = '$row_rstapel[kd]' ".
				"AND kd_semester = '$row_rssmt[kd]' ".
				"AND kd_progstudi = '$mpkd' ".
				"AND kd_kelas = '$mkkd' ".
				"AND kd_ruang = '$mrkd'";
$rsiking = mysql_query($query_rsiking, $sisfokol) or die(mysql_error());
$row_rsiking = mysql_fetch_assoc($rsiking);
$totalRows_rsiking = mysql_num_rows($rsiking);			
?>
            <option selected> 
            <?php
			  //jika kosong
			  if ($row_rsiking['rangking'] == "")
			  	{
				?>
            -Nilai- 
            <?php
				}
			else 
				{
				?><?php echo $row_rsiking['rangking'];?>
            <?php
				}
				?>
            </option>
            <?
				mysql_select_db($database_sisfokol, $sisfokol);

$query_rse = "SELECT m_siswa.kd AS mskd, m_siswa.*, siswa_progstudi.*, siswa_kelas.*, siswa_ruang.* ".
				"FROM m_siswa, siswa_progstudi, siswa_kelas, siswa_ruang ".
				"WHERE m_siswa.kd = siswa_progstudi.kd_siswa ".
				"AND m_siswa.kd = siswa_kelas.kd_siswa ".
				"AND m_siswa.kd = siswa_ruang.kd_siswa ".
				"AND siswa_progstudi.kd_progstudi = '$mpkd' ".
				"AND siswa_kelas.kd_kelas = '$mkkd' ".
				"AND siswa_ruang.kd_ruang = '$mrkd' ";
$rse = mysql_query($query_rse, $sisfokol) or die(mysql_error());
$row_rse = mysql_fetch_assoc($rse);
$totalRows_rse = mysql_num_rows($rse);
			
			
for ($ii=1; $ii<=$totalRows_rse;$ii++) 
				{  
				?>
            <option value="raport2r.php?kd=<?php echo $row_rssis['kd'];?>&rangking=<?php echo $ii;?>&mpkd=<?php echo $_REQUEST['mpkd'];?>&progstudi=<?php echo $_REQUEST['progstudi'];?>&mkkd=<?php echo $_REQUEST['mkkd'];?>&kelas=<?php echo $_REQUEST['kelas'];?>&mrkd=<?php echo $_REQUEST['mrkd'];?>&ruang=<?php echo $_REQUEST['ruang'];?>"><?php echo $ii;?></option>
            <?
				} 
		?>
          </select>&nbsp; </td>
                </tr>
               
              </table></td>
          </tr>
        </table>
        
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