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

//daftar uang
mysql_select_db($database_sisfokol, $sisfokol);
$query_rs_katx = "SELECT * FROM m_uang ORDER BY kategori ASC";
$rs_katx = mysql_query($query_rs_katx, $sisfokol) or die(mysql_error());
$row_rs_katx = mysql_fetch_assoc($rs_katx);
$totalRows_rs_katx = mysql_num_rows($rs_katx);
?>
<html>
<head>
<title>Set Keuangan</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $lama_akses;?>;URL=../logout.php">
<link href="style/admin.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){
var digits="0123456789"
var temp

if (document.frmuang.nilai.value=="") {
alert("Silahkan masukkan nilai nominalnya.")
return false
}

for (var i=0;i<document.frmuang.nilai.value.length;i++){
temp=document.frmuang.nilai.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Nilai nominal uang harus angka")
return false
      }
   }
   
return true
}
// End -->
</SCRIPT>

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
<table width="800" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td><p><img src="images/adm_keu_set.gif" width="243" height="40"></p>
      <form action="keu_set1.php" method="post" name="frmuang" id="frmuang" onSubmit="return cek()">
        <p> 
          <select name="kategori" id="kategori" onChange="MM_jumpMenu('parent',this,0)">
            <?
			if ($_REQUEST['katkod'] == "")
				{			
				mysql_select_db($database_sisfokol, $sisfokol);
				$query_rs_kati = "SELECT * FROM m_uang ORDER BY kategori ASC";
				$rs_kati = mysql_query($query_rs_kati, $sisfokol) or die(mysql_error());
				$row_rs_kati = mysql_fetch_assoc($rs_kati);
				$totalRows_rs_kati = mysql_num_rows($rs_kati);
				?>
            <option selected> 
            <?php 
				//jika kosong
					echo "--Kategori--";
				?>
            </option>
            <?
				}
				
			else
			
				{
				?>
            <option selected> 
            <?
				//ambil nilai
				$katkod = $_REQUEST['katkod'];
				
			//kategori terpilih
			mysql_select_db($database_sisfokol, $sisfokol);
			$query_rs_kata = "SELECT * FROM m_uang WHERE kd = '$katkod'";
			$rs_kata = mysql_query($query_rs_kata, $sisfokol) or die(mysql_error());
			$row_rs_kata = mysql_fetch_assoc($rs_kata);
			$totalRows_rs_kata = mysql_num_rows($rs_kata);			
			?>
            <? 
					echo $row_rs_kata['kategori']; 
				?>
            </option>
            <?
				}
			?>
            <?
			do 
				{  
				?>
            <option value="keu_set.php?katkod=<? echo $row_rs_katx['kd'] ?>&kategori=<? echo $row_rs_katx['kategori'] ?>"><? echo $row_rs_katx['kategori']?></option>
            <?
				} 
		
			while ($row_rs_katx = mysql_fetch_assoc($rs_katx));
			
			$rows = mysql_num_rows($rs_katx);
  				if($rows > 0) 
						{
      					mysql_data_seek($rs_katx, 0);
						$row_rs_katx = mysql_fetch_assoc($rs_katx);
  						}
		?>
          </select>
          <?php
			  //jika kategori belum dipilih
			  if (cegah($_REQUEST['katkod']) == "")
			  	{
				echo "Pilih Dahulu Kategorinya!";
				}
			
			else
				{
			  	
			  
			  ?>
          Rp. 
          <input name="nilai" type="text" id="nilai" value="<?php echo $row_rs_kata['uang'];?>" size="10" maxlength="10">
          ,00 
          <input name="katkod" type="hidden" value="<?php echo $row_rs_kata['kd'];?>">
          <input type="submit" name="Submit" value="Ganti">
        </p>
        <p>NB. Tanpa tanda titik.</p>
      </form>
      <?php
	  }
	  ?>
	  </td>
  </tr>
</table><br>
<?php include("include/footer.php"); ?>
</body>
</html>
<?php
//diskonek
mysql_close($sisfokol);
?>