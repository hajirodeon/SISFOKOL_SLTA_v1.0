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

//konek db
require_once('Connections/sisfokol.php'); 

//fungsi - fungsi
include("include/function.php");

//ambil nilai
$username = nosql($_POST["username"]);
$password = md5(nosql($_POST["password"]));

$pesan = "Login Salah, Harap Diulangi ;-)";
$kembali = "index.php";
	
//cek lagi, harus A-Z, a-z, 0-9
if (!ctype_alnum($username) OR !ctype_alnum($password))
	{
	echo "<script>alert('$pesan');location.href='$kembali'</script>";
	}

else
	{

//memilih akses login
switch ($adm) {
   case ad01:   ///login siswa		

		$SQL = sprintf("SELECT * FROM m_siswa WHERE nis = '$username' AND password = '$password'");

  		mysql_select_db($database_sisfokol, $sisfokol);
  		$rs1 = mysql_query($SQL, $sisfokol) or die("Tidak ada data");
		$row_rs1 = mysql_fetch_assoc($rs1);
		$totalRows_rs1 = mysql_num_rows($rs1);

		//cek login	
		if ($totalRows_rs1 != 0) 
			{
			session_start();	
			
			$kd_session = $row_rs1['kd'];
			$nis_session = $row_rs1['nis'];
			$siswa_session = "SISWA";
			$username_session = $username;
			$password_session = $password;
			$hajirobe_session = $hajirobe;
			
			session_register("kd_session");
			session_register("nis_session");
			session_register("siswa_session");
			session_register("username_session");
			session_register("password_session");
			session_register("hajirobe_session");
				
			header("location:akses_siswa/index.php");	
			} 
		
		Else 
		
			{
			echo "<script>alert('$pesan');location.href='$kembali'</script>";
			}
			
		mysql_close($sisfokol);
	   	break;
	   
	   
   case ad02:   ///login orang tua siswa

		$SQL = sprintf("SELECT * FROM m_siswa WHERE nis = '$username' AND passortu = '$password'");

  		mysql_select_db($database_sisfokol, $sisfokol);
  		$rs1 = mysql_query($SQL, $sisfokol) or die("Tidak ada data");
		$row_rs1 = mysql_fetch_assoc($rs1);
		$totalRows_rs1 = mysql_num_rows($rs1);

		//cek login	
		if ($totalRows_rs1 != 0) 
			{
			session_start();	
			
			$kd_session = $row_rs1['kd'];
			$nis_session = $row_rs1['nis'];
			$ortusiswa_session = "ORANG TUA SISWA";
			$username_session = $username;
			$password_session = $password;
			$hajirobe_session = $hajirobe;
			
			session_register("kd_session");
			session_register("nis_session");
			session_register("ortusiswa_session");
			session_register("username_session");
			session_register("password_session");
			session_register("hajirobe_session");
				
			header("location:akses_ortu/index.php");	
			} 
		
		Else 
		
			{
			echo "<script>alert('$pesan');location.href='$kembali'</script>";
			}
			
		mysql_close($sisfokol);
	   	break;
	   
	   	   
   case ad03:  /// login pegawai

		$SQL = sprintf("SELECT * FROM m_pegawai WHERE nip = '$username' AND password = '$password'");

  		mysql_select_db($database_sisfokol, $sisfokol);
  		$rs1 = mysql_query($SQL, $sisfokol) or die("Tidak ada data");
		$row_rs1 = mysql_fetch_assoc($rs1);
		$totalRows_rs1 = mysql_num_rows($rs1);

		//cek login	
		if ($totalRows_rs1 != 0) 
			{
			session_start();	
			
			$kd_session = $row_rs1['kd'];
			$nip_session = $row_rs1['nip'];
			$pegawai_session = "PEGAWAI";
			$username_session = $username;
			$password_session = $password;
			$hajirobe_session = $hajirobe;
			
			session_register("kd_session");
			session_register("nip_session");
			session_register("pegawai_session");
			session_register("username_session");
			session_register("password_session");
			session_register("hajirobe_session");
				
			header("location:akses_pegawai/index.php");	
			} 
		
		Else 
		
			{
			echo "<script>alert('$pesan');location.href='$kembali'</script>";
			}
			
		mysql_close($sisfokol);
	   	break;



   case ad04:  /// GURU
   
		$SQL = sprintf("SELECT m_guru.*, m_pegawai.kd AS mpkd, m_pegawai.* ".
							"FROM m_guru, m_pegawai ".
							"WHERE m_guru.kd_pegawai = m_pegawai.kd ".
							"AND m_pegawai.nip = '$username' ".
							"AND m_pegawai.password = '$password'");

  		mysql_select_db($database_sisfokol, $sisfokol);
  		$rs1 = mysql_query($SQL, $sisfokol) or die("Tidak ada data");
		$row_rs1 = mysql_fetch_assoc($rs1);
		$totalRows_rs1 = mysql_num_rows($rs1);

		//cek login	
		if ($totalRows_rs1 != 0) 
			{
			session_start();	
		
			$kd_session = $row_rs1['mpkd'];
			$nip_session = $row_rs1['nip'];
			$guru_session = "GURU";
			$username_session = $username;
			$password_session = $password;
			$hajirobe_session = $hajirobe;
			
			session_register("kd_session");
			session_register("nip_session");
			session_register("guru_session");
			session_register("username_session");
			session_register("password_session");
			session_register("hajirobe_session");
				
			header("location:akses_guru/index.php");	
			} 
		
		Else 
		
			{
			echo "<script>alert('$pesan');location.href='$kembali'</script>";
			}
			
		mysql_close($sisfokol);
	   	break;


	case ad05:  /// WALI KELAS
   
		$SQL = sprintf("SELECT m_guru.*, m_pegawai.kd AS mpkd, m_pegawai.*, m_ruang_kelas.* ".
							"FROM m_guru, m_pegawai, m_ruang_kelas ".
							"WHERE m_guru.kd_pegawai = m_pegawai.kd ".
							"AND m_pegawai.kd = m_ruang_kelas.kd_guru ".
							"AND m_pegawai.nip = '$username' ".
							"AND m_pegawai.password = '$password'");

  		mysql_select_db($database_sisfokol, $sisfokol);
  		$rs1 = mysql_query($SQL, $sisfokol) or die("Tidak ada data");
		$row_rs1 = mysql_fetch_assoc($rs1);
		$totalRows_rs1 = mysql_num_rows($rs1);

		//cek login	
		if ($totalRows_rs1 != 0) 
			{
			session_start();	
		
			$kd_session = $row_rs1['mpkd'];
			$nip_session = $row_rs1['nip'];
			$walikelas_session = "WALI KELAS";
			$username_session = $username;
			$password_session = $password;
			$hajirobe_session = $hajirobe;
			
			session_register("kd_session");
			session_register("nip_session");
			session_register("walikelas_session");
			session_register("username_session");
			session_register("password_session");
			session_register("hajirobe_session");
				
			header("location:akses_walikelas/index.php");	
			} 
		
		Else 
		
			{
			echo "<script>alert('$pesan');location.href='$kembali'</script>";
			}
			
		mysql_close($sisfokol);
	   	break;


	case ad06:  /// ADMINISTRATOR
   
		$SQL = sprintf("SELECT * FROM admin ".
							"WHERE username = '$username' ".
							"AND password = '$password'");

  		mysql_select_db($database_sisfokol, $sisfokol);
  		$rs1 = mysql_query($SQL, $sisfokol) or die("Tidak ada data");
		$row_rs1 = mysql_fetch_assoc($rs1);
		$totalRows_rs1 = mysql_num_rows($rs1);

		//cek login	
		if ($totalRows_rs1 != 0) 
			{
			session_start();	
		
			$kd_session = $row_rs1['kd'];
			$admin_session = "ADMINISTRATOR";
			$username_session = $username;
			$password_session = $password;
			$hajirobe_session = $hajirobe;
			
			session_register("kd_session");
			session_register("admin_session");
			session_register("username_session");
			session_register("password_session");
			session_register("hajirobe_session");
				
			header("location:akses_admin/index.php");	
			} 
		
		Else 
		
			{
			echo "<script>alert('$pesan');location.href='$kembali'</script>";
			}
			
		mysql_close($sisfokol);
	   	break;
} 
}
?>