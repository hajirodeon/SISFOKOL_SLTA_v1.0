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
?>
<table width="1200" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td><TABLE width=1200 border=0 cellPadding=2 cellSpacing=2 bgcolor="#669999">
        <TBODY>
          <TR align=middle> 
            <TD height=20 onmouseout="style.background='#669999'" 
          onmouseover="style.background='#C5F1B6'" width="14%"><div align="center"><B><A href="index.php" onmouseover=showit(0) title="Kembali ke Halaman Utama ADMINISTRATOR">Halaman 
                Depan</A></B></div></TD>
            <TD onmouseout="style.background='#669999'" 
          onmouseover="style.background='#C5F1B6'" width="7%"><div align="center"><B><A onmouseover=showit(1) title="Setting : Digunakan untuk men-set sistem. Seperti penggantian password, tahun pelajaran dan semester saat ini serta sebagainya.">Setting</A></B></div></TD>
            <TD onmouseout="style.background='#669999'" 
          onmouseover="style.background='#C5F1B6'" width="13%"><div align="center"><B><A onmouseover=showit(2) title="Kepegawaiaan : Dipakai untuk mengolah data - data pegawai yang ada di sekolah.">Kepegawaian</A></B></div></TD>
            <TD onmouseout="style.background='#669999'" 
          onmouseover="style.background='#C5F1B6'" width="16%"><div align="center"><B><A onmouseover=showit(3) title="Master Data Akademik : Biasanya hanya dimasukkan sekali dan selanjutnya akan dipakai pada aktivitas akademik.">Master 
                Akademik</A></B></div></TD>
            <TD onmouseout="style.background='#669999'" 
          onmouseover="style.background='#C5F1B6'" width="18%"><div align="center"><B><A onmouseover=showit(4) title="Aktivitas Akademik : Disini diolah berbagai aktivitas seperti penyusunan agenda, pembuatan jadwal pelajaran, pengolahan nilai siswa sampai dengan pembuatan soal ujian.">Aktivitas 
                Akademik</A></B></div></TD>
            <TD onmouseout="style.background='#669999'" 
          onmouseover="style.background='#C5F1B6'" width="11%"><div align="center"><B><A onmouseover=showit(5) title="Keuangan : Keuangan disini adalah yang berkaitan langsung dengan siswa. Seperti SPP, uang ujian, uang gedung dan biaya lain-lainnya.">Keuangan</A></B></div></TD>
            <TD onmouseout="style.background='#669999'" 
          onmouseover="style.background='#C5F1B6'" width="11%"><div align="center"><strong><A onmouseover=showit(6) title="Inventaris : Pengaturan barang - barang milik sekolah.">Inventaris</a></strong></div></TD>
            <TD onmouseout="style.background='#669999'" 
          onmouseover="style.background='#C5F1B6'" width="10%"><div align="center"><B><A onmouseover=showit(7) href="../logout.php" title="Log Out : Keluar dari Sistem">LOG 
                OUT</A></B></div></TD>
          </TR>
        </TBODY>
      </TABLE></td>
  </tr>
  <tr>
    <td height="18" bgcolor="ECFFE6"> 
      <ILAYER name="dep1" left="-10" top="-1" 
      width="800" height="18" bgColor="#f7f7f7"> </ILAYER>
<DIV id=describe onmouseout=resetit(event) onmouseover=clear_delayhide()>
</DIV>
<SCRIPT language=JavaScript1.2>

/*
Tabs Menu (mouseover)- By Dynamic Drive
For full source code and more DHTML scripts, visit http://www.dynamicdrive.com
This credit MUST stay intact for use
*/

var submenu=new Array()

//Set submenu contents. Expand as needed. For each content, make sure everything exists on ONE LINE. Otherwise, there will be JS errors.
 
submenu[0]='<table width=990 cellpadding=0 cellspacing=2><tr><td bgcolor=ECFFE6 align=center><a href="index.php">Klik disini</a> untuk kembali ke halaman utama Administrator</td></tr></table>'

submenu[1]='<table width=990 cellpadding=0 cellspacing=2><tr><td bgcolor=ECFFE6 align=center><a href="set_password.php" title="Mengganti Password ADMINISTRATOR">Password</a> |  <a href="set_tapel.php" title="Untuk mengatur tahun pelajaran saat ini.">Tahun Pelajaran</a>  | <a href="set_semester.php" title="Untuk mengatur semester saat ini.">Semester</a> | <a href="set_akses.php" title="Set Akses dari para user">Set Akses</a></td></tr></table>'

submenu[2]='<table width=990 cellpadding=0 cellspacing=2><tr><td bgcolor=ECFFE6 align=center><a href="kepg_pegawai.php" title="Untuk mengolah data kepegawaian sekolah.">Data Pegawai</a> | <a href="kepg_pegawai_nilai.php" title="Nilai Dari Pegawai">Nilai Pegawai</a> | <a href="kepg_pegawai_cuti.php" title="Data Cuti Pegawai">Data Cuti</a> | <a href="kepg_pegawai_absensi.php" title="Absensi Harian Pegawai">Absensi Harian</a></td></tr></table>'

submenu[3]='<table width=990 cellpadding=0 cellspacing=2><tr><td bgcolor=ECFFE6 align=center><a href="akad_progstudi.php" title="Data Program Studi yang dimiliki sekolah.">Program Studi</a> | <a href="akad_ruang.php" title="Data ruangan untuk kelas nantinya.">Ruang</a> | <a href="akad_ruang_kelas.php" title="Daftar ruang - ruang suatu kelas atau tingkat.">Ruang Kelas</a> | <a href="akad_pelajaran.php" title="Data semua pelajaran.">Pelajaran</a> | <a href="akad_guru.php" title="Data guru yang mengampu suatu pelajaran.">Guru</a> | <a href="akad_siswa.php" title="Data siswa">Siswa</a> | <a href="akad_ekstra.php" title="Daftar Ekstrakurikuler.">Ekstrakurikuler</a></td></tr></table>'

submenu[4]='<table width=990 cellpadding=0 cellspacing=2><tr><td bgcolor=ECFFE6 align=center><a href="akt_agenda.php" title="Agenda kegiatan sekolah.">Agenda</a> | <a href="akt_kal_pddkn.php" title="Kalender pendidikan.">Kalender Pendidikan</a> | <a href="akt_jadwal.php" title="Penyusunan jadwal pelajaran.">Jadwal Pelajaran</a> | <a href="akt_penempatan.php" title="Penempatan Siswa">Penempatan Siswa</a> | <a href="akt_ruang_kelas.php" title="Daftar siswa dalam suatu ruang kelas">Ruang Kelas Siswa</a> | <a href="akt_psb.php" title="Penerimaan Siswa Baru">Penerimaan Siswa Baru</a></td></tr></table>'

submenu[5]='<table width=990 cellpadding=0 cellspacing=2><tr><td bgcolor=ECFFE6 align=center><a href="keu_set.php" title="Set keuangan, seperti besarnya uang gedung, SPP, uang tes sampai dengan biaya lain - lain.">Set</a> | <a href="keu_siswa.php" title="Keadaan keuangan siswa.">Keuangan Siswa</a></td></tr></table>'

submenu[6]='<table width=990 cellpadding=0 cellspacing=2><tr><td bgcolor=ECFFE6 align=center><a href="inv_pengadaan.php" title="Pengadaan atau pembelian perabot">Pengadaan</a> | <a href="inv_alat_peraga.php" title="Daftar Alat Peraga">Daftar Alat Peraga</a> | <a href="inv_peng_peraga.php" title="Penggunaan Alat peraga dan lain - lain">Penggunaan Alat Peraga</a> | <a href="inv_lab.php" title="Daftar Ruang Praktikum / Laboratorium">Daftar Ruang Praktikum</a> | <a href="inv_peng_praktikum.php" title="Penggunaan Ruang Praktikum">Penggunaan Ruang Praktikum</a></td></tr></table>'

submenu[7]='<table width=990 cellpadding=0 cellspacing=2><tr><td bgcolor=ECFFE6 align=center><a href="../logout.php">Klik disini</a> untuk keluar atau LOG OUT dari sistem.</td></tr></table>'

//Set delay before submenu disappears after mouse moves out of it (in milliseconds)
var delay_hide=500

/////No need to edit beyond here

var menuobj=document.getElementById? document.getElementById("describe") : document.all? document.all.describe : document.layers? document.dep1.document.dep2 : ""

function showit(which){
clear_delayhide()
thecontent=(which==-1)? "" : submenu[which]
if (document.getElementById||document.all)
menuobj.innerHTML=thecontent
else if (document.layers){
menuobj.document.write(thecontent)
menuobj.document.close()
}
}

function resetit(e){
if (document.all&&!menuobj.contains(e.toElement))
delayhide=setTimeout("showit(-1)",delay_hide)
else if (document.getElementById&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhide=setTimeout("showit(-1)",delay_hide)
}

function clear_delayhide(){
if (window.delayhide)
clearTimeout(delayhide)
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

</SCRIPT></td>
  </tr>
</table>