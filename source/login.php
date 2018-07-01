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

//LOG OUT aka KELUAR
//habisi session
session_start();

session_unset($hajirobe_session);
session_unset($kd_session);
session_unset($nis_session);
session_unset($nip_session);
session_unset($admin_session);
session_unset($siswa_session);
session_unset($ortusiswa_session);
session_unset($pegawai_session);
session_unset($guru_session);
session_unset($walikelas_session);
session_unset($username_session);
session_unset($password_session);

session_unregister('$hajirobe_session');
session_unregister('$kd_session');
session_unregister('$nis_session');
session_unregister('$nip_session');
session_unregister('$admin_session');
session_unregister('$siswa_session');
session_unregister('$ortusiswa_session');
session_unregister('$pegawai_session');
session_unregister('$guru_session');
session_unregister('$walikelas_session');
session_unregister('$username_session');
session_unregister('$password_session');

session_unset();
session_destroy();

//konfig
include("include/config.php"); 
?>
<html>
<head>
<title>LOGIN</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="Dikembangkan oleh OPEN SOURCE HAJIROBE (http://www.biasawae.com). Agus Muhajir (hajirodeon@yahoo.com)">
<meta name="description" content="SISTEM INFORMASI SEKOLAH (SISFOKOL) Untuk SLTA v1.0">
<meta name="keywords" content="biasawae, open, source, hajirobe, biasa, wae, situs, sekolah, web">
<link href="style/sisfokol.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function cek(){

if (document.frmlogin.adm.value=="") {
alert("Pilih dahulu status login sebagai siapa!")
return false
}

if (document.frmlogin.username.value=="") {
alert("Anda harus menuliskan username-nya")
return false
}

if (document.frmlogin.password.value=="") {
alert("Jangan lupa mengisikan password!")
return false
}


return true
}
// End -->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<form action="login1.php" method="post" name="frmlogin" id="frmlogin" onSubmit="return cek()">
  <div align="center">
    <TABLE WIDTH=510 BORDER=0 CELLPADDING=0 CELLSPACING=0>
      <TR> 
        <TD COLSPAN=2 ROWSPAN=3> <IMG SRC="images/home_01.gif" WIDTH=113 HEIGHT=130 ALT=""></TD>
        <TD ROWSPAN=3> <IMG SRC="images/home_02.gif" WIDTH=159 HEIGHT=130 ALT=""></TD>
        <TD COLSPAN=7> <IMG SRC="images/home_03.gif" WIDTH=238 HEIGHT=75 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=75 ALT=""></TD>
      </TR>
      <TR> 
        <TD ROWSPAN=2> <IMG SRC="images/home_04.gif" WIDTH=28 HEIGHT=55 ALT=""></TD>
        <TD COLSPAN=2> <IMG SRC="images/home_05.gif" WIDTH=51 HEIGHT=28 ALT=""></TD>
        <TD COLSPAN=2> <IMG SRC="images/home_06.gif" WIDTH=125 HEIGHT=28 ALT=""></TD>
        <TD COLSPAN=2> <IMG SRC="images/home_07.gif" WIDTH=34 HEIGHT=28 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=28 ALT=""></TD>
      </TR>
      <TR> 
        <TD> <IMG SRC="images/home_08.gif" WIDTH=23 HEIGHT=27 ALT=""></TD>
        <TD COLSPAN=4 ROWSPAN=4 background="images/home_09.gif"> <div align="center"> 
            <select name="adm" id="adm">
              <option>-Status Login-</option>
              <option value="ad01">Siswa</option>
              <option value="ad02">Orang Tua Siswa</option>
              <option value="ad03">Pegawai</option>
              <option value="ad04">Guru</option>
              <option value="ad05">Wali Kelas</option>
              <option value="ad06">Administrator</option>
            </select>
            <br>
            <br>
            Username : <br>
            <input name="username" type="text" id="username" size="15">
            <br>
            <br>
            Password : 
            <input name="password" type="password" id="password" size="15">
            <br>
            <br>
            <input type="reset" name="Reset" value="Batal">
            <input name="Submit" type="submit" id="Submit" value="Kirim">
          </div></TD>
        <TD ROWSPAN=4> <IMG SRC="images/home_10.gif" WIDTH=13 HEIGHT=181 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=27 ALT=""></TD>
      </TR>
      <TR> 
        <TD COLSPAN=2> <IMG SRC="images/home_11.gif" WIDTH=113 HEIGHT=41 ALT=""></TD>
        <TD> <IMG SRC="images/home_12.gif" WIDTH=159 HEIGHT=41 ALT=""></TD>
        <TD ROWSPAN=5> <IMG SRC="images/home_13.gif" WIDTH=28 HEIGHT=280 ALT=""></TD>
        <TD ROWSPAN=2> <IMG SRC="images/home_14.gif" WIDTH=23 HEIGHT=120 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=41 ALT=""></TD>
      </TR>
      <TR> 
        <TD ROWSPAN=3> <IMG SRC="images/home_15.gif" WIDTH=18 HEIGHT=146 ALT=""></TD>
        <TD colspan="2" ROWSPAN=3><big><strong><?php echo $sekolah;?></strong></big><br> 
          <?php echo $almt_sekolah;?></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=79 ALT=""></TD>
      </TR>
      <TR> 
        <TD ROWSPAN=2> <IMG SRC="images/home_18.gif" WIDTH=23 HEIGHT=67 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=34 ALT=""></TD>
      </TR>
      <TR> 
        <TD> <IMG SRC="images/home_19.gif" WIDTH=28 HEIGHT=33 ALT=""></TD>
        <TD> <IMG SRC="images/home_20.gif" WIDTH=111 HEIGHT=33 ALT=""></TD>
        <TD COLSPAN=3> <IMG SRC="images/home_21.gif" WIDTH=48 HEIGHT=33 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=33 ALT=""></TD>
      </TR>
      <TR> 
        <TD> <IMG SRC="images/home_22.gif" WIDTH=18 HEIGHT=93 ALT=""></TD>
        <TD> <IMG SRC="images/home_23.gif" WIDTH=95 HEIGHT=93 ALT=""></TD>
        <TD> <IMG SRC="images/home_24.gif" WIDTH=159 HEIGHT=93 ALT=""></TD>
        <TD COLSPAN=6> <IMG SRC="images/home_25.gif" WIDTH=210 HEIGHT=93 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=93 ALT=""></TD>
      </TR>
      <TR> 
        <TD> <IMG SRC="images/spacer.gif" WIDTH=18 HEIGHT=1 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=95 HEIGHT=1 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=159 HEIGHT=1 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=28 HEIGHT=1 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=23 HEIGHT=1 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=28 HEIGHT=1 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=111 HEIGHT=1 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=14 HEIGHT=1 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=21 HEIGHT=1 ALT=""></TD>
        <TD> <IMG SRC="images/spacer.gif" WIDTH=13 HEIGHT=1 ALT=""></TD>
        <TD></TD>
      </TR>
    </TABLE>
  </div>
</form>
</body>
</html>