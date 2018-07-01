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

//ambil nilai session
$kd = cegah($_REQUEST['kd']);
	  	  
mysql_select_db($database_sisfokol, $sisfokol);

$query_rs1 = "SELECT DATE_FORMAT(tgl_lahir, '%d') AS xtgl1, DATE_FORMAT(tgl_lahir, '%m') AS xbln1, ".
				"DATE_FORMAT(tgl_lahir, '%Y') AS xthn1, m_siswa.*, m_kelamin.*, m_agama.*, m_progstudi.*, ".
				"m_kelas.*, DATE_FORMAT(diterima_tgl, '%d') AS xtgl2, ".
				"DATE_FORMAT(diterima_tgl, '%m') AS xbln2, ".
				"DATE_FORMAT(diterima_tgl, '%Y') AS xthn2, ".
				"m_tapel.* ".
				"FROM m_siswa, m_kelamin, m_agama, m_progstudi, m_kelas, m_tapel ".
				"WHERE m_siswa.kd_kelamin = m_kelamin.kd ".
				"AND m_siswa.kd_agama = m_agama.kd ".
				"AND m_siswa.diterima_progstudi = m_progstudi.kd ".
				"AND m_siswa.diterima_kls = m_kelas.kd ".
				"AND m_siswa.kd_tapel = m_tapel.kd ".
				"AND m_siswa.kd = '$kd'";
$rs1= mysql_query($query_rs1, $sisfokol) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);
$totalRows_rs1 = mysql_num_rows($rs1);
?>
<html>
<head>
<title>Profil : <?php echo $row_rs1['nama'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmfoto.filex.value=="") {
alert("Silahkan di-browse dahulu file fotonya!")
return false
}

return true
}
// End -->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="5" topmargin="5" marginwidth="5" marginheight="5">
<div align="center">
  <table width="450" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top"> 
      <td width="245"><p><strong>NIS : </strong><br>
          <?php echo balikin($row_rs1['nis']);?></p>
        <p><strong>Nama : </strong><br>
          <?php echo balikin($row_rs1['nama']);?></p>
        <p><strong>TTL :</strong> <br>
          <?php echo $row_rs1['xtgl1']; ?> 
          <?php 
		  $nilbln = $row_rs1['xbln1'];
		  $arrbln = $ngaray[bln][$nilbln];
		  echo $arrbln;
		  ?>
          <?php echo $row_rs1['xthn1']; ?> </p>
        <p><strong>Jenis Kelamin : </strong><br>
          <?php echo balikin($row_rs1['kelamin']);?></p>
        <p><strong>Agama : </strong><br>
          <?php echo balikin($row_rs1['agama']);?></p>
        <p><strong>Anak Ke : </strong><br>
          <?php echo balikin($row_rs1['anak_ke']);?></p>
        <p><strong>Alamat :</strong><br>
          <?php echo balikin($row_rs1['alamat']);?> </p>
        <p><strong>Telepon :</strong><br>
          <?php echo balikin($row_rs1['telepon']);?> </p>
        <p><strong>Diterima di Program Studi :</strong><br>
          <?php echo balikin($row_rs1['progstudi']);?> </p>
        <p><strong>Diterima di Kelas:</strong><br>
          <?php echo balikin($row_rs1['kelas']);?> </p>
        <p><strong>Diterima pada :</strong><br>
          <?php echo $row_rs1['xtgl2']; ?> 
          <?php 
		  	if ($row_rs1['xbln2'] == 1)
		  		{
				echo "Januari";
				}
			
			else if ($row_rs1['xbln2'] == 2)
		  		{
				echo "Pebruari";
				}
		  
		  	else if ($row_rs1['xbln2'] == 3)
		  		{
				echo "Maret";
				}

		  	else if ($row_rs1['xbln2'] == 4)
		  		{
				echo "April";
				}
			
			else if ($row_rs1['xbln2'] == 5)
		  		{
				echo "Mei";
				}	
				
			else if ($row_rs1['xbln2'] == 6)
		  		{
				echo "Juni";
				}
			
			else if ($row_rs1['xbln2'] == 7)
		  		{
				echo "Juli";
				}
			
			else if ($row_rs1['xbln2'] == 8)
		  		{
				echo "Agustus";
				}
			
			else if ($row_rs1['1bln2'] == 9)
		  		{
				echo "September";
				}
			
			else if ($row_rs1['xbln2'] == 10)
		  		{
				echo "Oktober";
				}
			
			else if ($row_rs1['xbln2'] == 11)
		  		{
				echo "Nopember";
				}
			
			else if ($row_rs1['xbln2'] == 12)
		  		{
				echo "Desember";
				}
		  ?>
          <?php echo $row_rs1['xthn2']; ?> </p>
        <p><strong>Tahun Pelajaran :</strong><br>
          <?php echo balikin($row_rs1['tahun1']);?>/<?php echo balikin($row_rs1['tahun2']);?></p>
        <p><strong>Asal Sekolah :</strong><br>
          <?php echo balikin($row_rs1['asl_sek']);?></p>
        <p><strong>Alamat Asal Sekolah :</strong><br>
          <?php echo balikin($row_rs1['almt_sek']);?></p>
        <p><strong>Nama Ayah :</strong><br>
          <?php echo balikin($row_rs1['nm_ayah']);?></p>
        <p><strong>Nama Ibu :</strong><br>
          <?php echo balikin($row_rs1['nm_ibu']);?></p>
        <p><strong>Pekerjaan Ayah:</strong><br>
          <?php 
		  	$pek_ayah = $row_rs1['pek_ayah'];
				
			mysql_select_db($database_sisfokol, $sisfokol);
						
			$query_rsx = "SELECT * FROM m_pekerjaan WHERE kd = '$pek_ayah'";
			$rsx= mysql_query($query_rsx, $sisfokol) or die(mysql_error());
			$row_rsx = mysql_fetch_assoc($rsx);
			$totalRows_rsx = mysql_num_rows($rsx);
		  
		  	echo $row_rsx['pekerjaan'];
		  ?></p>
        <p><strong>Pekerjaan Ibu :</strong><br>
          <?php 
		  	$pek_ibu = $row_rs1['pek_ibu'];
				
			mysql_select_db($database_sisfokol, $sisfokol);
						
			$query_rsy = "SELECT * FROM m_pekerjaan WHERE kd = '$pek_ibu'";
			$rsy= mysql_query($query_rsy, $sisfokol) or die(mysql_error());
			$row_rsy = mysql_fetch_assoc($rsy);
			$totalRows_rsy = mysql_num_rows($rsy);
		  
		  	echo $row_rsy['pekerjaan'];
		  ?></p></td>
      <td width="205"><div align="center"> 
          <?php
	//jika foto masih kosong
	if ($row_rs1['foto'] == "")
		{
		?>
          <img src="../images/tmp.foto.jpg" width="99" height="127" border="0"> 
          <form action="akad_siswa_detail.foto.php" method="post" enctype="multipart/form-data" name="frmfoto" id="frmfoto" onSubmit="return cek()">
            <input name="filex" type="file" id="filex" size="10">
            <input name="kd" type="hidden" value="<?php echo $kd;?>">
            <input type="submit" name="Submit" value="GANTI FOTO">
          </form>
          <?
		}
	
	else
		{
	?>
          <img src="../filebox/siswa/<?php echo $kd;?>/foto/<?php echo $row_rs1['foto'];?>" width="99" height="127"> 
          <?php
		}
	?>
        </div></td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_close($sisfokol);
?>