# phpMyAdmin MySQL-Dump
# version 2.2.1
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# Host: localhost
# Generation Time: Jan 14, 2006 at 11:11 AM
# Server version: 4.00.18
# PHP Version: 4.3.11
# Database : `sisfokol_slta_v1`
# --------------------------------------------------------

#
# Table structure for table `admin`
#

CREATE TABLE admin (
  kd varchar(50) NOT NULL default '',
  username varchar(15) NOT NULL default '',
  password varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `admin`
#

INSERT INTO admin (kd, username, password) VALUES ('c7d869e8de7eef93f4e02c53839a446f', 'admin', '21232f297a57a5a743894a0e4a801fc3');
# --------------------------------------------------------

#
# Table structure for table `agenda`
#

CREATE TABLE agenda (
  kd varchar(50) NOT NULL default '',
  judul varchar(255) NOT NULL default '',
  isi longtext NOT NULL,
  waktu varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `agenda`
#

INSERT INTO agenda (kd, judul, isi, waktu) VALUES ('509b7c953a34b706398b22d8c8e8a608', 'Uji coba website', 'Saatnya untuk uji coba website ini.', 'Tengah Malam Nanti.');
# --------------------------------------------------------

#
# Table structure for table `bulan`
#

CREATE TABLE bulan (
  kd varchar(50) NOT NULL default '',
  kd_semester_set varchar(50) NOT NULL default '',
  bulan varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `bulan`
#

INSERT INTO bulan (kd, kd_semester_set, bulan) VALUES ('7bc517f8d5ffd0f8d2c0a229abe5a344', 'a140a30047adb57e98a71985348bed60', 'Januari'),
('5ed0257c0a4db16793c6032813a98b46', 'a140a30047adb57e98a71985348bed60', 'Pebruari'),
('5e403f1fcd883fcb51f2f8bf77367826', 'a140a30047adb57e98a71985348bed60', 'Maret'),
('c613934c229b9b66c725843c30cf7a88', 'a140a30047adb57e98a71985348bed60', 'April'),
('4b996ec795d421fbe5b6cba2a12b6d73', 'a140a30047adb57e98a71985348bed60', 'Mei'),
('ddfc257549af89b67513f46c657fe3e7', 'a140a30047adb57e98a71985348bed60', 'Juni'),
('1dbd819160264c7aaed4ae84f7f8fcf8', 'ce8a0066c0e535bf5fedb54413e75b5d', 'Juli'),
('43401dfa6276184f5e3a307b0949cfd5', 'ce8a0066c0e535bf5fedb54413e75b5d', 'Agustus'),
('81ca403f5cfd0298df91a70d78023c45', 'ce8a0066c0e535bf5fedb54413e75b5d', 'September'),
('7bdbbc6a7ba0b78fd447c08e7c2b64a6', 'ce8a0066c0e535bf5fedb54413e75b5d', 'Oktober'),
('14da393d1f0a89d8900b7ae89a546c41', 'ce8a0066c0e535bf5fedb54413e75b5d', 'Nopember'),
('2b0c791da38ba40f4dc47e5bc4f526b1', 'ce8a0066c0e535bf5fedb54413e75b5d', 'Desember');
# --------------------------------------------------------

#
# Table structure for table `inv_alat_peraga`
#

CREATE TABLE inv_alat_peraga (
  kd varchar(50) NOT NULL default '',
  alat_peraga varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `inv_alat_peraga`
#

INSERT INTO inv_alat_peraga (kd, alat_peraga) VALUES ('3189ee07fcd8d0c46c8b257bce04c99d', 'Gunting'),
('97411393f1b1e9fbde3f950e952a96ad', 'Penggaris'),
('0fcc4a7d5271082edee8ab6adfa1a231', 'Gelas Ukur');
# --------------------------------------------------------

#
# Table structure for table `inv_lab`
#

CREATE TABLE inv_lab (
  kd varchar(50) NOT NULL default '',
  lab varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `inv_lab`
#

INSERT INTO inv_lab (kd, lab) VALUES ('c9d80946867450cc7b91a09061b4bb7b', 'Komputer'),
('658bd3c4f4991b833046c2d34865c38b', 'Kimia'),
('76fe41ffbdc7d350d79933d29b964237', 'Bahasa'),
('00ed678a5f8c877227611637f45d7236', 'Biologi');
# --------------------------------------------------------

#
# Table structure for table `inv_peng_lab`
#

CREATE TABLE inv_peng_lab (
  kd varchar(50) NOT NULL default '',
  kd_lab varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_ruang varchar(50) NOT NULL default '',
  kd_jam varchar(50) NOT NULL default '',
  kd_hari varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `inv_peng_lab`
#

INSERT INTO inv_peng_lab (kd, kd_lab, kd_progstudi, kd_kelas, kd_ruang, kd_jam, kd_hari) VALUES ('edd6fad6328c1e27e632cf0288f97080', 'c9d80946867450cc7b91a09061b4bb7b', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', '1244f645158059dad4f49364d9a057b1', '16368d9d5eabdbf10cd3ea474afb953f', '54929fe6d34462c9adef014c00d15c42');
# --------------------------------------------------------

#
# Table structure for table `inv_peng_peraga`
#

CREATE TABLE inv_peng_peraga (
  kd varchar(50) NOT NULL default '',
  tgl datetime NOT NULL default '0000-00-00 00:00:00',
  kd_alat_peraga varchar(50) NOT NULL default '',
  jumlah varchar(255) NOT NULL default '',
  kd_guru varchar(50) NOT NULL default '',
  tgl_kembali datetime NOT NULL default '0000-00-00 00:00:00',
  ket varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `inv_peng_peraga`
#

# --------------------------------------------------------

#
# Table structure for table `inv_pengadaan`
#

CREATE TABLE inv_pengadaan (
  kd varchar(50) NOT NULL default '',
  tgl_terima datetime NOT NULL default '0000-00-00 00:00:00',
  tgl_beli datetime NOT NULL default '0000-00-00 00:00:00',
  dari varchar(255) NOT NULL default '',
  nm_barang varchar(255) NOT NULL default '',
  jumlah varchar(255) NOT NULL default '',
  harga varchar(10) NOT NULL default '',
  tgl_pakai datetime NOT NULL default '0000-00-00 00:00:00',
  untuk varchar(255) NOT NULL default '',
  ket varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `inv_pengadaan`
#

INSERT INTO inv_pengadaan (kd, tgl_terima, tgl_beli, dari, nm_barang, jumlah, harga, tgl_pakai, untuk, ket) VALUES ('edc2348e524d1c48d1da7e9b31bffdfd', '2003-03-03 00:00:00', '2002-01-03 00:00:00', 'Alumni Tahun 2000', 'Kursi Belajar', '200', '10000000', '2004-06-05 00:00:00', 'Pengganti Kursi Kelas yang lama', 'stri');
# --------------------------------------------------------

#
# Table structure for table `jadwal`
#

CREATE TABLE jadwal (
  kd varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_semester varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_ruang varchar(50) NOT NULL default '',
  kd_hari varchar(50) NOT NULL default '',
  kd_jam_pel varchar(50) NOT NULL default '',
  kd_guru varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `jadwal`
#

INSERT INTO jadwal (kd, kd_tapel, kd_semester, kd_progstudi, kd_kelas, kd_ruang, kd_hari, kd_jam_pel, kd_guru) VALUES ('df5b1da3c526985bc5c8e183eb932488', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'edf192658966eff8ec44dd77ac46155d', 'f4ab65549c1d5048fb21c0636680f8d1', '3918fde042f86c2c01b1d71bfc7cff40'),
('fb82097a2a22ee595011ae669a115a38', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '58ed108948a9ea99fbd3f7c67ae01fe8', '3e5e472b05afefb0caafbc497b5e2ac9', '3918fde042f86c2c01b1d71bfc7cff40'),
('68f0d88460eb9209666895f240736fa0', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'edf192658966eff8ec44dd77ac46155d', '3b499b7aaf2159bc8894ffddfc0219fa', '3918fde042f86c2c01b1d71bfc7cff40'),
('3a64c44ff7ae754531fd245bf62fa33d', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '58ed108948a9ea99fbd3f7c67ae01fe8', 'f4ab65549c1d5048fb21c0636680f8d1', '3918fde042f86c2c01b1d71bfc7cff40'),
('7dc017272521a4427073b5ac195a9f45', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'e2d5f9ac643a0688b8b74cf963a3df23', '3b499b7aaf2159bc8894ffddfc0219fa', '3918fde042f86c2c01b1d71bfc7cff40'),
('07947e27236df2d97be2d9658e01c0d9', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'e2d5f9ac643a0688b8b74cf963a3df23', '16368d9d5eabdbf10cd3ea474afb953f', '3918fde042f86c2c01b1d71bfc7cff40'),
('8ff068cce7cc0f507869af1b52cd6ee4', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'edf192658966eff8ec44dd77ac46155d', '16368d9d5eabdbf10cd3ea474afb953f', '714679e8e48780bd88de2d61e2ffb9be'),
('ca6be2093d0aabddb0fbf01fd842c867', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'edf192658966eff8ec44dd77ac46155d', '869465ec86fa1ce98728a32209af6d8f', '714679e8e48780bd88de2d61e2ffb9be');
# --------------------------------------------------------

#
# Table structure for table `kalender`
#

CREATE TABLE kalender (
  kd varchar(50) NOT NULL default '',
  judul varchar(255) NOT NULL default '',
  isi longtext NOT NULL,
  waktu varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `kalender`
#

INSERT INTO kalender (kd, judul, isi, waktu) VALUES ('141fa5003a34448fb88553c62bad6fde', 'Penerimaan Siswa', 'Penerimaan Siswa Baru', '19 Mei 2006');
# --------------------------------------------------------

#
# Table structure for table `m_agama`
#

CREATE TABLE m_agama (
  kd varchar(50) NOT NULL default '',
  agama varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_agama`
#

INSERT INTO m_agama (kd, agama) VALUES ('aa4a5d0437773a393defe493d993f93f', 'Islam'),
('54389a89e5ce98ef449fc2327ad728d4', 'Kristen Protestan'),
('fc5abdef6f0d04b7bfea584fc82336d9', 'Katholik'),
('76a9e44b2b9d7b47ccbc258e33af7b46', 'Budha'),
('42d4aa0eba013bcdc0f0c394b855af05', 'Hindu'),
('8c7d39aaaa9a0df6b149e031e29a1182', 'Konghucu'),
('21675cbb28b06cdf1c5c8dc92226cb7a', 'Kepercayaan');
# --------------------------------------------------------

#
# Table structure for table `m_ekstra`
#

CREATE TABLE m_ekstra (
  kd varchar(50) NOT NULL default '',
  kd_pegawai varchar(50) NOT NULL default '',
  ekstra varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_ekstra`
#

INSERT INTO m_ekstra (kd, kd_pegawai, ekstra) VALUES ('244e2a3bba4d31e6abadcb3cdc3a6df0', 'b81d75747c2dfe32492eff5619fae609', 'Pramuka'),
('c696df2e570a0a9ede85c1700bc9faa8', '383d8c64b1de91531e290a3e6080beaa', 'PMR'),
('d43fb696e07a6feb1146fde74afbe255', '383d8c64b1de91531e290a3e6080beaa', 'Paskibra'),
('33a34b7faa58b098a144ed7ea3051af7', '8a7220d3f1675f2ccf1ea311ee3813e3', 'Karate'),
('62bc631113ecea991cfc724b15b9f1a3', '1100d8d0eebccc4f22986b907db568c2', 'Musik'),
('feadda6dcee0fb10ef19c669b3334e43', 'b81d75747c2dfe32492eff5619fae609', 'PMR');
# --------------------------------------------------------

#
# Table structure for table `m_guru`
#

CREATE TABLE m_guru (
  kd varchar(50) NOT NULL default '',
  kd_pegawai varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_pelajaran varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_guru`
#

INSERT INTO m_guru (kd, kd_pegawai, kd_progstudi, kd_kelas, kd_pelajaran) VALUES ('c95b5441d466fc556e82ff09bb9adddb', '1100d8d0eebccc4f22986b907db568c2', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'fdae483152509cbb05e34cb3a8bb07fe'),
('714679e8e48780bd88de2d61e2ffb9be', '8a7220d3f1675f2ccf1ea311ee3813e3', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'dd34b893098d7c1c779b395648963a0b'),
('3918fde042f86c2c01b1d71bfc7cff40', 'b81d75747c2dfe32492eff5619fae609', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'd289998d487e8e56496878fcb8e20e93'),
('9ea9620770cfbd6e5a9fef2328e840b5', 'b81d75747c2dfe32492eff5619fae609', '8b437a2c0f331d58724cca21bd92509b', '97a0edcf8ee7f52bae4bc4fc0f14090c', 'ca3d344b0a2acda279761f3e1141de6c'),
('e2e15daa9dcfb572cbb5c58ce21ea1a4', '8a7220d3f1675f2ccf1ea311ee3813e3', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', '09f7c789b69d7e922bc8c178b343d9a1');
# --------------------------------------------------------

#
# Table structure for table `m_hari`
#

CREATE TABLE m_hari (
  kd varchar(50) NOT NULL default '',
  hari varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_hari`
#

INSERT INTO m_hari (kd, hari) VALUES ('edf192658966eff8ec44dd77ac46155d', 'Senin'),
('58ed108948a9ea99fbd3f7c67ae01fe8', 'Selasa'),
('e2d5f9ac643a0688b8b74cf963a3df23', 'Rabu'),
('54929fe6d34462c9adef014c00d15c42', 'Kamis'),
('121b75215e1b290126aaa4b4697a80dc', 'Jum\'at'),
('af63ce604413149c94d4ae38d2d04262', 'Sabtu');
# --------------------------------------------------------

#
# Table structure for table `m_huruf`
#

CREATE TABLE m_huruf (
  kd varchar(50) NOT NULL default '',
  huruf char(1) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_huruf`
#

INSERT INTO m_huruf (kd, huruf) VALUES ('1b07ae0b7f48287c8e213eaf3b53a566', 'A'),
('72cdb2a6156f64d26571d9c17104d2c6', 'B'),
('c114c3ab5dc5e7b9bfec6af8a1f6a15a', 'C'),
('1a0ae81a30c87a9e8585745d35a126a3', 'D'),
('f526a13d26772d14ef9b9abe70f7e593', 'E');
# --------------------------------------------------------

#
# Table structure for table `m_jam_pel`
#

CREATE TABLE m_jam_pel (
  kd varchar(50) NOT NULL default '',
  jam varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_jam_pel`
#

INSERT INTO m_jam_pel (kd, jam) VALUES ('3e5e472b05afefb0caafbc497b5e2ac9', '1'),
('f4ab65549c1d5048fb21c0636680f8d1', '2'),
('3b499b7aaf2159bc8894ffddfc0219fa', '3'),
('16368d9d5eabdbf10cd3ea474afb953f', '4'),
('869465ec86fa1ce98728a32209af6d8f', '5'),
('1cdb63285e521cb005a607c3d82818e9', '6'),
('c14b39362ed700ff177e82e6ed7d6cce', '7'),
('3105ca16ca0adfc91418d82cbb93f0d7', '8'),
('1144e77d7043aff6f1ccf39ed99579c6', '9'),
('208d17a8a8597becea76af62b1af0d9d', '10'),
('ce4f673520fd3319149f8348a92d25ca', '11'),
('70140b4205682215fb9f29648b86efae', '12'),
('4d28dcffba744476774f44cd6cc7c203', '13'),
('335acb219074a522a746e24dff7870ec', '14');
# --------------------------------------------------------

#
# Table structure for table `m_kelakuan`
#

CREATE TABLE m_kelakuan (
  kd varchar(50) NOT NULL default '',
  kelakuan varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_kelakuan`
#

# --------------------------------------------------------

#
# Table structure for table `m_kelamin`
#

CREATE TABLE m_kelamin (
  kd varchar(50) NOT NULL default '',
  kelamin varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_kelamin`
#

INSERT INTO m_kelamin (kd, kelamin) VALUES ('9238fb6efac56da391c4abf8a3eb1d16', 'Laki - Laki'),
('60819669cb66e2b69b5279c725d8c429', 'Perempuan');
# --------------------------------------------------------

#
# Table structure for table `m_kelas`
#

CREATE TABLE m_kelas (
  kd varchar(50) NOT NULL default '',
  kelas char(1) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_kelas`
#

INSERT INTO m_kelas (kd, kelas) VALUES ('1236d8c726c2719824d6328ca94d2628', '1'),
('97a0edcf8ee7f52bae4bc4fc0f14090c', '2'),
('7cb2d990d8589c56642182118dc34c54', '3');
# --------------------------------------------------------

#
# Table structure for table `m_ket`
#

CREATE TABLE m_ket (
  kd varchar(50) NOT NULL default '',
  ket varchar(50) NOT NULL default '',
  iket char(1) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_ket`
#

INSERT INTO m_ket (kd, ket, iket) VALUES ('fe6abc6ea080299b975204d73c1590e3', 'Sakit', 'S'),
('a47cbd787696841bfeee02330e0bda82', 'Ijin', 'I'),
('a5021199e355baa52547a0bdc3ddbdb6', 'Tanpa Keterangan', 'T');
# --------------------------------------------------------

#
# Table structure for table `m_ketidakhadiran`
#

CREATE TABLE m_ketidakhadiran (
  kd varchar(50) NOT NULL default '',
  ketidakhadiran varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_ketidakhadiran`
#

# --------------------------------------------------------

#
# Table structure for table `m_nilai_angka`
#

CREATE TABLE m_nilai_angka (
  kd varchar(50) NOT NULL default '',
  angka char(2) NOT NULL default '',
  ket varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_nilai_angka`
#

INSERT INTO m_nilai_angka (kd, angka, ket) VALUES ('481b703636a20371e6649561b982bc41', '01', 'Buruk Sekali'),
('959c61eaddd09ded9e01c671d486c25e', '02', 'Buruk'),
('3bdf85a16d5c8ece1af566b57f4cf8a6', '03', 'Kurang Sekali'),
('b7a35a86f8460eb11a7a810df783468f', '04', 'Kurang'),
('9229b03b82de112ec1463981d1519960', '05', 'Hampir Cukup'),
('8c85630d609325ed96f8f5168fabbe18', '06', 'Cukup'),
('5eb912d41cc69189cc2a7ab7b11099bd', '07', 'Lebih dari Cukup'),
('701425d00f3b54eee90adcf1cf338a03', '08', 'Baik'),
('2d3fd3c78f2b2886d107cae37dd8ea4d', '09', 'Baik Sekali'),
('9c377d3edf31da5d77cf52bf81cadc3c', '10', 'Istimewa');
# --------------------------------------------------------

#
# Table structure for table `m_nilai_huruf`
#

CREATE TABLE m_nilai_huruf (
  kd varchar(50) NOT NULL default '',
  huruf char(1) NOT NULL default '',
  ket varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_nilai_huruf`
#

INSERT INTO m_nilai_huruf (kd, huruf, ket) VALUES ('9c34d42c449024e497a1e01ba926103f', 'A', 'Baik Sekali'),
('ac768731cf92f063569b368538ff895f', 'B', 'Baik'),
('413c9de28f57388179d8b6b4b065845a', 'C', 'Cukup'),
('d8aba8af3d71ebd8843aa0169762d010', 'D', 'Kurang');
# --------------------------------------------------------

#
# Table structure for table `m_nilai_kat`
#

CREATE TABLE m_nilai_kat (
  kd varchar(50) NOT NULL default '',
  kat varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_nilai_kat`
#

INSERT INTO m_nilai_kat (kd, kat) VALUES ('caf23fd6a2520221d1a794cacbd6a07d', 'Tugas'),
('7aa5f57625e29c070afc669cba4fec02', 'Ulangan Tertulis'),
('31fb87d7ce7cf7344a8bd8f351388d85', 'Ulangan Lisan'),
('d0ddb6fa7c19092d180e264f0a1fe1fa', 'Ulangan Praktikum'),
('ba993f2f4106aef023379ccc0742c9bb', 'Tes Tertulis'),
('506f44e77a463f4acc15ebbfcd16a2fd', 'Tes Lisan'),
('c80425e699a6b154fa56d935bb6146bc', 'Tes Praktikum');
# --------------------------------------------------------

#
# Table structure for table `m_pegawai`
#

CREATE TABLE m_pegawai (
  kd varchar(50) NOT NULL default '',
  nip varchar(10) NOT NULL default '',
  password varchar(255) NOT NULL default '',
  kd_kelamin varchar(50) NOT NULL default '',
  nama varchar(30) NOT NULL default '',
  tmp_lahir varchar(100) NOT NULL default '',
  tgl_lahir datetime NOT NULL default '0000-00-00 00:00:00',
  kawin enum('true','false') NOT NULL default 'false',
  bangsa varchar(50) NOT NULL default '',
  kd_agama varchar(50) NOT NULL default '',
  pangkat varchar(255) NOT NULL default '',
  jabatan varchar(255) NOT NULL default '',
  status enum('true','false') NOT NULL default 'false',
  alamat longtext NOT NULL,
  foto varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_pegawai`
#

INSERT INTO m_pegawai (kd, nip, password, kd_kelamin, nama, tmp_lahir, tgl_lahir, kawin, bangsa, kd_agama, pangkat, jabatan, status, alamat, foto) VALUES ('b81d75747c2dfe32492eff5619fae609', '6784565456', 'f9450b6256d67597fef5c28d00f8735d', '9238fb6efac56da391c4abf8a3eb1d16', 'Agus Muhajir', 'Kendal', '1982-04-27 00:00:00', 'false', 'Indonesia', 'aa4a5d0437773a393defe493d993f93f', 'stri', 'stri', 'false', 'stri', ''),
('1100d8d0eebccc4f22986b907db568c2', '5684568', '10733c3f625ea1d2cb1a5f2fbe4d0d88', '60819669cb66e2b69b5279c725d8c429', 'Andara Early', 'Jakarta', '1962-04-25 00:00:00', 'true', 'Indonesia', 'aa4a5d0437773a393defe493d993f93f', 'stri', 'stri', 'true', 'stri', ''),
('8a7220d3f1675f2ccf1ea311ee3813e3', '4575343', 'e5865b8f0c85bebd36c9244152a3e88d', '9238fb6efac56da391c4abf8a3eb1d16', 'Sulaiman Bakir', 'Kediri', '1967-03-06 00:00:00', 'true', 'Indonesia', '76a9e44b2b9d7b47ccbc258e33af7b46', 'stri', 'stri', 'false', 'stri', 'pria.jpg');
# --------------------------------------------------------

#
# Table structure for table `m_pekerjaan`
#

CREATE TABLE m_pekerjaan (
  kd varchar(50) NOT NULL default '',
  pekerjaan varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_pekerjaan`
#

INSERT INTO m_pekerjaan (kd, pekerjaan) VALUES ('c0695c340fc5f4c18bce19c3f5cdde62', 'Pengusaha'),
('4a0327d89ab527d86fe5c230cfb55b61', 'Karyawan Swasta'),
('f611342993e11783abff11658a5254c2', 'Ibu Rumah Tangga'),
('3c632163e84c4a66701003dc145cc266', 'Guru'),
('44bf25fe438cf68804eda8166bb219a3', 'Pegawai Negeri Sipil'),
('7f0ee89dddfc87d039d459965a705555', 'Lain - lain'),
('33e2c02b5d38b4ba57f98df6733d4c7c', 'Kontraktor'),
('7c5a447905cdb92eefe30f961ddf1db9', 'Petani'),
('c334697b3ff10014577d6e638d3c5fae', 'Peternak'),
('5ac0669b791eef837c3a73aa2bd4518e', 'Pengacara'),
('21a8ea9a487491a10ac40507362d1516', 'Arsitektur'),
('92674300a2e723a87364987776f65653', 'Konsultan'),
('d8f0ad0bd66b92e0f214ad243acb4015', 'Programmer'),
('a270011dafd5c6a823129bfb119b25da', 'Penulis');
# --------------------------------------------------------

#
# Table structure for table `m_pelajaran`
#

CREATE TABLE m_pelajaran (
  kd varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  pelajaran varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_pelajaran`
#

INSERT INTO m_pelajaran (kd, kd_progstudi, kd_kelas, pelajaran) VALUES ('09f7c789b69d7e922bc8c178b343d9a1', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'PPKn'),
('fdae483152509cbb05e34cb3a8bb07fe', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'Bahasa Indonesia'),
('dd34b893098d7c1c779b395648963a0b', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'Geografi'),
('ca3d344b0a2acda279761f3e1141de6c', '8b437a2c0f331d58724cca21bd92509b', '97a0edcf8ee7f52bae4bc4fc0f14090c', 'PPKn'),
('d289998d487e8e56496878fcb8e20e93', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'Bahasa Inggris'),
('9d38255327914c5e46a539681c96eb7a', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'Matematika'),
('eba9742382d5c1731646bd8968d007ae', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'Kesenian'),
('cd05ca540f5b3fff0c14dbae52fa675c', '56a336058efe09235c3b3c498cf054e6', '7cb2d990d8589c56642182118dc34c54', 'Fisika'),
('390e72270fb8be017d5a7b91a4ab006a', '8b437a2c0f331d58724cca21bd92509b', '97a0edcf8ee7f52bae4bc4fc0f14090c', 'Agama'),
('5eac7810051a613dcafb5a446f72f868', '56a336058efe09235c3b3c498cf054e6', '7cb2d990d8589c56642182118dc34c54', 'Biologi'),
('960732ed69f966fa0931e74f40d889dc', '56a336058efe09235c3b3c498cf054e6', '7cb2d990d8589c56642182118dc34c54', 'Kimia');
# --------------------------------------------------------

#
# Table structure for table `m_pil`
#

CREATE TABLE m_pil (
  kd varchar(50) NOT NULL default '',
  ngepil varchar(4) NOT NULL default '',
  pil char(1) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_pil`
#

INSERT INTO m_pil (kd, ngepil, pil) VALUES ('8052b4f1778dbe75abd8d0154bdabac0', 'pila', 'A'),
('50862dce6b73905c187a17dafd84b023', 'pilb', 'B'),
('7954c410f2c3084c7cf18bd7a82ed061', 'pilc', 'C'),
('900c7d958e8a4d5b2353be55135e74d7', 'pild', 'D'),
('fa59126812cb9dbc77b2509f4faff346', 'pile', 'E');
# --------------------------------------------------------

#
# Table structure for table `m_progstudi`
#

CREATE TABLE m_progstudi (
  kd varchar(50) NOT NULL default '',
  progstudi varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_progstudi`
#

INSERT INTO m_progstudi (kd, progstudi) VALUES ('8b437a2c0f331d58724cca21bd92509b', '-'),
('56a336058efe09235c3b3c498cf054e6', 'IPA'),
('2f7c4492011328c89aebe58c5922ce64', 'IPS'),
('bd3ceed11bfe1268f33ffa7a4940f207', 'Bahasa');
# --------------------------------------------------------

#
# Table structure for table `m_ruang`
#

CREATE TABLE m_ruang (
  kd varchar(50) NOT NULL default '',
  ruang varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_ruang`
#

INSERT INTO m_ruang (kd, ruang) VALUES ('b18773d4ecc72a5de95b82afbb243bb0', 'A'),
('1244f645158059dad4f49364d9a057b1', 'B'),
('86137a0d92ac46ed412726a3c6313669', 'C'),
('b50d2a8fc4826fdeed707e6c21ee8216', 'D'),
('62bc631113ecea991cfc724b15b9f1a3', 'E'),
('382dfcd6fa19505da66c6bdf80290b21', 'F'),
('2c1a4db39272e881238da91cbe3c7c4e', 'G');
# --------------------------------------------------------

#
# Table structure for table `m_ruang_kelas`
#

CREATE TABLE m_ruang_kelas (
  kd varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_ruang varchar(50) NOT NULL default '',
  kd_guru varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_ruang_kelas`
#

INSERT INTO m_ruang_kelas (kd, kd_progstudi, kd_kelas, kd_ruang, kd_guru) VALUES ('a780e7bc46139460c363aabe4df70591', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', '1244f645158059dad4f49364d9a057b1', '1100d8d0eebccc4f22986b907db568c2'),
('12d3d226d379c9ab740b2d808ab1e6f7', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '1100d8d0eebccc4f22986b907db568c2'),
('2fbcbc020f8ea1a2c2e0294a085c4238', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', '86137a0d92ac46ed412726a3c6313669', 'b81d75747c2dfe32492eff5619fae609');
# --------------------------------------------------------

#
# Table structure for table `m_satuan`
#

CREATE TABLE m_satuan (
  kd varchar(50) NOT NULL default '',
  satuan varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_satuan`
#

INSERT INTO m_satuan (kd, satuan) VALUES ('9cf287c46326155223485b1883307751', 'Hari'),
('ca1bc40765052cc94b650592d580e025', 'Bulan');
# --------------------------------------------------------

#
# Table structure for table `m_semester`
#

CREATE TABLE m_semester (
  kd varchar(50) NOT NULL default '',
  semester char(1) NOT NULL default '',
  kd_semester_set varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_semester`
#

INSERT INTO m_semester (kd, semester, kd_semester_set) VALUES ('c7842bbdf5218f831eedb09a68e8e58b', '1', 'ce8a0066c0e535bf5fedb54413e75b5d'),
('5e548749479f4bef34a3ff3024cd1d6d', '2', 'a140a30047adb57e98a71985348bed60'),
('fa97046a865fbe48440f4c3627b058b3', '3', 'ce8a0066c0e535bf5fedb54413e75b5d'),
('f3fdee594031a44cceba4b327b8e891c', '4', 'a140a30047adb57e98a71985348bed60'),
('828a1dff0cffcb9e82e5be281bb286ed', '5', 'ce8a0066c0e535bf5fedb54413e75b5d'),
('ab1fb7860fee543995b52464b105d665', '6', 'a140a30047adb57e98a71985348bed60');
# --------------------------------------------------------

#
# Table structure for table `m_semester_set`
#

CREATE TABLE m_semester_set (
  kd varchar(50) NOT NULL default '',
  jenis varchar(50) NOT NULL default '',
  status enum('true','false') NOT NULL default 'true'
) TYPE=MyISAM;

#
# Dumping data for table `m_semester_set`
#

INSERT INTO m_semester_set (kd, jenis, status) VALUES ('ce8a0066c0e535bf5fedb54413e75b5d', 'Ganjil', 'false'),
('a140a30047adb57e98a71985348bed60', 'Genap', 'true');
# --------------------------------------------------------

#
# Table structure for table `m_siswa`
#

CREATE TABLE m_siswa (
  kd varchar(50) NOT NULL default '',
  nis varchar(10) NOT NULL default '',
  password varchar(255) NOT NULL default '',
  passortu varchar(255) NOT NULL default '',
  nama varchar(30) NOT NULL default '',
  kd_kelamin varchar(50) NOT NULL default '',
  tmp_lahir varchar(50) NOT NULL default '',
  tgl_lahir datetime NOT NULL default '0000-00-00 00:00:00',
  kd_agama varchar(50) NOT NULL default '',
  anak_ke char(2) NOT NULL default '',
  status_kel varchar(50) NOT NULL default '',
  alamat longtext NOT NULL,
  telepon varchar(255) NOT NULL default '',
  diterima_progstudi varchar(50) NOT NULL default '',
  diterima_kls varchar(50) NOT NULL default '',
  diterima_tgl datetime NOT NULL default '0000-00-00 00:00:00',
  kd_tapel varchar(50) NOT NULL default '',
  asl_sek varchar(255) NOT NULL default '',
  almt_sek varchar(255) NOT NULL default '',
  nm_ayah varchar(30) NOT NULL default '',
  nm_ibu varchar(30) NOT NULL default '',
  pek_ayah varchar(50) NOT NULL default '',
  pek_ibu varchar(50) NOT NULL default '',
  foto varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_siswa`
#

INSERT INTO m_siswa (kd, nis, password, passortu, nama, kd_kelamin, tmp_lahir, tgl_lahir, kd_agama, anak_ke, status_kel, alamat, telepon, diterima_progstudi, diterima_kls, diterima_tgl, kd_tapel, asl_sek, almt_sek, nm_ayah, nm_ibu, pek_ayah, pek_ibu, foto) VALUES ('c2cf4169509bf4870cee2ddcc80bd0ab', '57458456', 'f7cfbe059d51875dd7bed1dd9c27b321', 'f7cfbe059d51875dd7bed1dd9c27b321', 'Hermanu Rizal', '9238fb6efac56da391c4abf8a3eb1d16', 'palembang', '1989-01-05 00:00:00', '42d4aa0eba013bcdc0f0c394b855af05', '2', '-', '-', '-', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', '2005-06-04 00:00:00', 'e64b1ca4c438a8af17256c5d2cfc39c4', '-', '-', '-', '-', '4a0327d89ab527d86fe5c230cfb55b61', '4a0327d89ab527d86fe5c230cfb55b61', ''),
('1757a88edd8afe8166ad204f0921c55e', '4585634', 'fcd1aa44a7aef13691eb2e9aca59d390', 'fcd1aa44a7aef13691eb2e9aca59d390', 'Arif Widyawati', '60819669cb66e2b69b5279c725d8c429', 'Jakarta', '1988-08-27 00:00:00', 'aa4a5d0437773a393defe493d993f93f', '1', '-', '-', '-', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', '2006-03-04 00:00:00', 'e64b1ca4c438a8af17256c5d2cfc39c4', '-', '-', '-', '-', '3c632163e84c4a66701003dc145cc266', '3c632163e84c4a66701003dc145cc266', 'wanita.jpg'),
('bb0e26d85de7f53921b7bd16f1b4de46', '657456', '41957fa25fa976f5fdf74f810df67bc8', '41957fa25fa976f5fdf74f810df67bc8', 'Indra Birowo', '9238fb6efac56da391c4abf8a3eb1d16', 'Palembang', '1988-03-07 00:00:00', 'aa4a5d0437773a393defe493d993f93f', '2', 'stri', 'stri', 'stri', '56a336058efe09235c3b3c498cf054e6', '7cb2d990d8589c56642182118dc34c54', '2005-06-01 00:00:00', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'stri', 'stri', 'stri', 'stri', '4a0327d89ab527d86fe5c230cfb55b61', '4a0327d89ab527d86fe5c230cfb55b61', ''),
('12f6c9c34ecd2c3aeecade075d91e5b6', '2357567986', '15eb3d37393acb09ed2d93619b64b123', '15eb3d37393acb09ed2d93619b64b123', 'Rahma Sarita', '60819669cb66e2b69b5279c725d8c429', 'Semarang', '1988-04-20 00:00:00', 'fc5abdef6f0d04b7bfea584fc82336d9', '4', 'stri', 'stri', 'stri', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', '2005-05-17 00:00:00', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'stri', 'stri', 'stri', 'stri', '3c632163e84c4a66701003dc145cc266', '3c632163e84c4a66701003dc145cc266', ''),
('5905d7e8fec87503c5dce7843f18f63c', '6745346778', '5ce9101bf7199ab3a071f7d7e5b7f3dd', '5ce9101bf7199ab3a071f7d7e5b7f3dd', 'Adelia Wirasti', '60819669cb66e2b69b5279c725d8c429', 'Bogor', '1989-04-14 00:00:00', 'aa4a5d0437773a393defe493d993f93f', '2', 'stri', 'stri', 'stri', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', '2005-04-04 00:00:00', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'stri', 'stri', 'stri', 'stri', '4a0327d89ab527d86fe5c230cfb55b61', '4a0327d89ab527d86fe5c230cfb55b61', '');
# --------------------------------------------------------

#
# Table structure for table `m_tapel`
#

CREATE TABLE m_tapel (
  kd varchar(50) NOT NULL default '',
  tahun1 varchar(4) NOT NULL default '',
  tahun2 varchar(4) NOT NULL default '',
  status enum('true','false') NOT NULL default 'true'
) TYPE=MyISAM;

#
# Dumping data for table `m_tapel`
#

INSERT INTO m_tapel (kd, tahun1, tahun2, status) VALUES ('85c4e4a89320ecc4fea1a5b9e5cc2e52', '2004', '2005', 'false'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '2005', '2006', 'true'),
('f00349a152757c0381b589be4f67a826', '2006', '2007', 'false'),
('9a7edbc9c4072c46490d7706ca9018e5', '2007', '2008', 'false'),
('43fcdd4b8f1d349ca433b68a788bf72f', '2008', '2009', 'false'),
('6cd37f2915763b8e7c8e4b06e7ac0f88', '2009', '2010', 'false'),
('94024e209fb19be4f18f4918daa911a0', '2010', '2011', 'false'),
('fb2c11a363e6683d29ea5226b6cc5ae5', '2011', '2012', 'false'),
('9b0b9c27190f26f3f057d1126dab318d', '2012', '2013', 'false'),
('a6bd01d78d6fccc4d1ce598d90cacb13', '2013', '2014', 'false'),
('f611342993e11783abff11658a5254c2', '2014', '2015', 'false'),
('2f31fc8b00d81478eda3527f41f1cc39', '2015', '2016', 'false'),
('4982e232f7362045a207dbde5c1cba9d', '2016', '2017', 'false'),
('872e1b2a6d46029fa8a7e01c39ad3ce2', '2017', '2018', 'false'),
('aeff0d81a5a9064c272fc6199a9bedec', '2018', '2019', 'false'),
('1b282ca430e761e37fa33ad15a61bf6a', '2019', '2020', 'false');
# --------------------------------------------------------

#
# Table structure for table `m_uang`
#

CREATE TABLE m_uang (
  kd varchar(50) NOT NULL default '',
  uang varchar(10) NOT NULL default '',
  kategori varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `m_uang`
#

INSERT INTO m_uang (kd, uang, kategori) VALUES ('4c75242f81285d49b3f18a7a4d210a8f', '1000000', 'Uang Gedung'),
('bad81d085df6c259223d9153cd2fd99b', '15000', 'Uang SPP'),
('7a6df9d882fb55dbe4bc9725e64aab57', '22000', 'Uang Tes'),
('31c2d890125b4103b7844e813f52cf1a', '10000', 'Uang Lain');
# --------------------------------------------------------

#
# Table structure for table `pegawai_absensi`
#

CREATE TABLE pegawai_absensi (
  kd varchar(50) NOT NULL default '',
  kd_pegawai varchar(50) NOT NULL default '',
  kd_ket varchar(50) NOT NULL default '',
  tgl_absensi datetime NOT NULL default '0000-00-00 00:00:00'
) TYPE=MyISAM;

#
# Dumping data for table `pegawai_absensi`
#

INSERT INTO pegawai_absensi (kd, kd_pegawai, kd_ket, tgl_absensi) VALUES ('2c7310664fdb3a4fb7bf1154545c28eb', 'b81d75747c2dfe32492eff5619fae609', 'a5021199e355baa52547a0bdc3ddbdb6', '2006-01-02 00:00:00'),
('ebc7a97495e66d834a88747a14b695d6', '8a7220d3f1675f2ccf1ea311ee3813e3', 'fe6abc6ea080299b975204d73c1590e3', '2006-01-06 00:00:00'),
('ba14a7d4b4384f0e81a6e790c4fc4489', '1100d8d0eebccc4f22986b907db568c2', 'a47cbd787696841bfeee02330e0bda82', '2006-01-04 00:00:00'),
('3723bb54870302abb3ce5f5c1a696de4', '8a7220d3f1675f2ccf1ea311ee3813e3', 'fe6abc6ea080299b975204d73c1590e3', '2006-01-07 00:00:00');
# --------------------------------------------------------

#
# Table structure for table `pegawai_cuti`
#

CREATE TABLE pegawai_cuti (
  kd varchar(50) NOT NULL default '',
  kd_pegawai varchar(50) NOT NULL default '',
  jml char(3) NOT NULL default '',
  kd_satuan varchar(50) NOT NULL default '',
  waktu varchar(255) NOT NULL default '',
  ket varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `pegawai_cuti`
#

INSERT INTO pegawai_cuti (kd, kd_pegawai, jml, kd_satuan, waktu, ket) VALUES ('9229b03b82de112ec1463981d1519960', '8a7220d3f1675f2ccf1ea311ee3813e3', '2', '9cf287c46326155223485b1883307751', 'stri', 'stri');
# --------------------------------------------------------

#
# Table structure for table `pegawai_nilai`
#

CREATE TABLE pegawai_nilai (
  kd_pegawai varchar(50) NOT NULL default '',
  kesetiaan varchar(50) NOT NULL default '',
  prestasi_kerja varchar(50) NOT NULL default '',
  tanggung_jawab varchar(50) NOT NULL default '',
  kejujuran varchar(50) NOT NULL default '',
  kerja_sama varchar(50) NOT NULL default '',
  prakarsa varchar(50) NOT NULL default '',
  kepemimpinan varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `pegawai_nilai`
#

INSERT INTO pegawai_nilai (kd_pegawai, kesetiaan, prestasi_kerja, tanggung_jawab, kejujuran, kerja_sama, prakarsa, kepemimpinan) VALUES ('4d43451e91f73908ac928b28f24177f6', '72cdb2a6156f64d26571d9c17104d2c6', 'f526a13d26772d14ef9b9abe70f7e593', '1b07ae0b7f48287c8e213eaf3b53a566', 'f526a13d26772d14ef9b9abe70f7e593', '1b07ae0b7f48287c8e213eaf3b53a566', '1a0ae81a30c87a9e8585745d35a126a3', '72cdb2a6156f64d26571d9c17104d2c6'),
('1100d8d0eebccc4f22986b907db568c2', '1b07ae0b7f48287c8e213eaf3b53a566', 'c114c3ab5dc5e7b9bfec6af8a1f6a15a', 'f526a13d26772d14ef9b9abe70f7e593', '1b07ae0b7f48287c8e213eaf3b53a566', 'f526a13d26772d14ef9b9abe70f7e593', '72cdb2a6156f64d26571d9c17104d2c6', 'f526a13d26772d14ef9b9abe70f7e593'),
('8a7220d3f1675f2ccf1ea311ee3813e3', 'c114c3ab5dc5e7b9bfec6af8a1f6a15a', '-', '1b07ae0b7f48287c8e213eaf3b53a566', '-', '-', '-', '-'),
('b81d75747c2dfe32492eff5619fae609', '1b07ae0b7f48287c8e213eaf3b53a566', '-', '1b07ae0b7f48287c8e213eaf3b53a566', '-', '-', '-', '-'),
('383d8c64b1de91531e290a3e6080beaa', 'c114c3ab5dc5e7b9bfec6af8a1f6a15a', 'f526a13d26772d14ef9b9abe70f7e593', '72cdb2a6156f64d26571d9c17104d2c6', '72cdb2a6156f64d26571d9c17104d2c6', '1a0ae81a30c87a9e8585745d35a126a3', '72cdb2a6156f64d26571d9c17104d2c6', '1a0ae81a30c87a9e8585745d35a126a3'),
('b433938d73d1978ec73d22ccf808ec6c', '-', '-', '-', '-', '-', '-', '-'),
('076885fe78dcf72d2305d4184803ac41', '-', '-', '-', '-', '-', '-', '-'),
('e1e076b154b9e1a3f25b646de7c99d93', '-', '-', '-', '-', '-', '-', '-'),
('c7ce49ed986a4da563c67eec11d49643', '-', '-', '-', '-', '-', '-', '-'),
('4f79709e7a42f9ef72e4648f281948ce', '-', '-', '-', '-', '-', '-', '-'),
('6fe7de98cce1c491fb1c27598e66d3cc', '-', '-', '-', '-', '-', '-', '-'),
('89f10e5f34971e7957547d67c26e4c07', '-', '-', '-', '-', '-', '-', '-'),
('a266c1b0c0f0398c850723d7b0b9d50d', '-', '-', '-', '-', '-', '-', '-'),
('f874d0acac902d193834d8381493f26f', '-', '-', '-', '-', '-', '-', '-'),
('956b7b042439566a57d1fa82accba644', '-', '-', '-', '-', '-', '-', '-'),
('a2c78416d970632f239065b610896244', '-', '-', '-', '-', '-', '-', '-'),
('95a3d1b73ef4964158eb5d4c89fad301', '-', '-', '-', '-', '-', '-', '-'),
('df263ba4c819aaed85502a6fab2d4129', '-', '-', '-', '-', '-', '-', '-'),
('ec770eaae5f49134b94c814d16b9793d', '-', '-', '-', '-', '-', '-', '-'),
('34bc29f2d2589ead743781f34d418e82', '-', '-', '-', '-', '-', '-', '-'),
('dc0dc3a1399b3e5ce6658b10e24d2cef', '-', '-', '-', '-', '-', '-', '-');
# --------------------------------------------------------

#
# Table structure for table `pegawai_pddkn`
#

CREATE TABLE pegawai_pddkn (
  kd_pegawai varchar(50) NOT NULL default '',
  pend_sd varchar(255) NOT NULL default '',
  pend_sltp varchar(255) NOT NULL default '',
  pend_slta varchar(255) NOT NULL default '',
  pend_kuliah varchar(255) NOT NULL default '',
  tahun_sd varchar(4) NOT NULL default '',
  tahun_sltp varchar(4) NOT NULL default '',
  tahun_slta varchar(4) NOT NULL default '',
  tahun_kuliah varchar(4) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `pegawai_pddkn`
#

INSERT INTO pegawai_pddkn (kd_pegawai, pend_sd, pend_sltp, pend_slta, pend_kuliah, tahun_sd, tahun_sltp, tahun_slta, tahun_kuliah) VALUES ('1100d8d0eebccc4f22986b907db568c2', 'stri', 'stri', 'stri', 'stri', '1927', '1927', 'stri', 'stri'),
('8a7220d3f1675f2ccf1ea311ee3813e3', 'stri', 'stri', 'stri', 'stri', 'stri', 'stri', 'stri', 'stri'),
('b81d75747c2dfe32492eff5619fae609', 'stri', 'stri', 'stri', 'stri', 'stri', 'stri', 'stri', 'stri');
# --------------------------------------------------------

#
# Table structure for table `psb`
#

CREATE TABLE psb (
  kd varchar(50) NOT NULL default '',
  nomer varchar(50) NOT NULL default '',
  nama varchar(30) NOT NULL default '',
  kd_kelamin varchar(50) NOT NULL default '',
  tmp_lahir varchar(50) NOT NULL default '',
  tgl_lahir datetime NOT NULL default '0000-00-00 00:00:00',
  bangsa varchar(50) NOT NULL default '',
  kd_agama varchar(50) NOT NULL default '',
  anak_ke char(1) NOT NULL default '',
  alamat longtext NOT NULL,
  nm_ortu varchar(30) NOT NULL default '',
  pendidikan longtext NOT NULL,
  kd_pekerjaan varchar(50) NOT NULL default '',
  almt_pek longtext NOT NULL,
  ket longtext NOT NULL,
  diterima text NOT NULL,
  tgl_sah datetime NOT NULL default '0000-00-00 00:00:00'
) TYPE=MyISAM;

#
# Dumping data for table `psb`
#

# --------------------------------------------------------

#
# Table structure for table `siswa_absensi`
#

CREATE TABLE siswa_absensi (
  kd varchar(50) NOT NULL default '',
  kd_ket varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  tgl_absensi datetime NOT NULL default '0000-00-00 00:00:00'
) TYPE=MyISAM;

#
# Dumping data for table `siswa_absensi`
#

INSERT INTO siswa_absensi (kd, kd_ket, kd_siswa, tgl_absensi) VALUES ('94d94636ce84786316c29cb9023e4707', 'a47cbd787696841bfeee02330e0bda82', '1757a88edd8afe8166ad204f0921c55e', '2006-01-01 00:00:00'),
('1227a1ca4ac7afa605621732068a04b6', 'fe6abc6ea080299b975204d73c1590e3', '1757a88edd8afe8166ad204f0921c55e', '2006-01-02 00:00:00');
# --------------------------------------------------------

#
# Table structure for table `siswa_ekstra`
#

CREATE TABLE siswa_ekstra (
  kd_ekstra varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  kd_nilai varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `siswa_ekstra`
#

INSERT INTO siswa_ekstra (kd_ekstra, kd_siswa, kd_nilai) VALUES ('33a34b7faa58b098a144ed7ea3051af7', '1757a88edd8afe8166ad204f0921c55e', ''),
('c696df2e570a0a9ede85c1700bc9faa8', '1757a88edd8afe8166ad204f0921c55e', '');
# --------------------------------------------------------

#
# Table structure for table `siswa_kelakuan`
#

CREATE TABLE siswa_kelakuan (
  kd varchar(50) NOT NULL default '',
  kd_kelakuan varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  nilai varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `siswa_kelakuan`
#

# --------------------------------------------------------

#
# Table structure for table `siswa_kelas`
#

CREATE TABLE siswa_kelas (
  kd_tapel varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  status enum('true','false') NOT NULL default 'false'
) TYPE=MyISAM;

#
# Dumping data for table `siswa_kelas`
#

INSERT INTO siswa_kelas (kd_tapel, kd_kelas, kd_siswa, status) VALUES ('e64b1ca4c438a8af17256c5d2cfc39c4', '97a0edcf8ee7f52bae4bc4fc0f14090c', '1757a88edd8afe8166ad204f0921c55e', 'false'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '97a0edcf8ee7f52bae4bc4fc0f14090c', 'c2cf4169509bf4870cee2ddcc80bd0ab', 'false'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '1236d8c726c2719824d6328ca94d2628', '1757a88edd8afe8166ad204f0921c55e', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '1236d8c726c2719824d6328ca94d2628', 'c2cf4169509bf4870cee2ddcc80bd0ab', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '7cb2d990d8589c56642182118dc34c54', 'bb0e26d85de7f53921b7bd16f1b4de46', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '1236d8c726c2719824d6328ca94d2628', '12f6c9c34ecd2c3aeecade075d91e5b6', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '1236d8c726c2719824d6328ca94d2628', '5905d7e8fec87503c5dce7843f18f63c', 'true');
# --------------------------------------------------------

#
# Table structure for table `siswa_nilai`
#

CREATE TABLE siswa_nilai (
  kd varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_semester varchar(50) NOT NULL default '',
  kd_pelajaran varchar(50) NOT NULL default '',
  kd_guru varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  kd_nilai_kat varchar(50) NOT NULL default '',
  kd_nilai_angka varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `siswa_nilai`
#

INSERT INTO siswa_nilai (kd, kd_tapel, kd_semester, kd_pelajaran, kd_guru, kd_siswa, kd_nilai_kat, kd_nilai_angka) VALUES ('6435f2d0a704ba8f822eb8f6b432df28', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', 'fdae483152509cbb05e34cb3a8bb07fe', 'c95b5441d466fc556e82ff09bb9adddb', 'c2cf4169509bf4870cee2ddcc80bd0ab', '506f44e77a463f4acc15ebbfcd16a2fd', '8c85630d609325ed96f8f5168fabbe18'),
('b1cae1ff1149470f790c5c65c0ed0b17', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', 'fdae483152509cbb05e34cb3a8bb07fe', 'c95b5441d466fc556e82ff09bb9adddb', '1757a88edd8afe8166ad204f0921c55e', '506f44e77a463f4acc15ebbfcd16a2fd', '5eb912d41cc69189cc2a7ab7b11099bd'),
('8d7f693d90b8d02d7bc5be07662ecfcf', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', 'd289998d487e8e56496878fcb8e20e93', '3918fde042f86c2c01b1d71bfc7cff40', '12f6c9c34ecd2c3aeecade075d91e5b6', '506f44e77a463f4acc15ebbfcd16a2fd', '5eb912d41cc69189cc2a7ab7b11099bd'),
('bf563d854ce896110968de6362f674da', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', 'd289998d487e8e56496878fcb8e20e93', '3918fde042f86c2c01b1d71bfc7cff40', '5905d7e8fec87503c5dce7843f18f63c', '506f44e77a463f4acc15ebbfcd16a2fd', '701425d00f3b54eee90adcf1cf338a03');
# --------------------------------------------------------

#
# Table structure for table `siswa_progstudi`
#

CREATE TABLE siswa_progstudi (
  kd_tapel varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  status enum('true','false') NOT NULL default 'false'
) TYPE=MyISAM;

#
# Dumping data for table `siswa_progstudi`
#

INSERT INTO siswa_progstudi (kd_tapel, kd_progstudi, kd_siswa, status) VALUES ('e64b1ca4c438a8af17256c5d2cfc39c4', '56a336058efe09235c3b3c498cf054e6', '1757a88edd8afe8166ad204f0921c55e', 'false'),
('e64b1ca4c438a8af17256c5d2cfc39c4', 'bd3ceed11bfe1268f33ffa7a4940f207', '1757a88edd8afe8166ad204f0921c55e', 'false'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '8b437a2c0f331d58724cca21bd92509b', '1757a88edd8afe8166ad204f0921c55e', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '8b437a2c0f331d58724cca21bd92509b', 'c2cf4169509bf4870cee2ddcc80bd0ab', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '56a336058efe09235c3b3c498cf054e6', 'bb0e26d85de7f53921b7bd16f1b4de46', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '2f7c4492011328c89aebe58c5922ce64', '1757a88edd8afe8166ad204f0921c55e', 'false'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '8b437a2c0f331d58724cca21bd92509b', '12f6c9c34ecd2c3aeecade075d91e5b6', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '8b437a2c0f331d58724cca21bd92509b', '5905d7e8fec87503c5dce7843f18f63c', 'true');
# --------------------------------------------------------

#
# Table structure for table `siswa_raport`
#

CREATE TABLE siswa_raport (
  kd varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_semester varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_ruang varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  kd_pelajaran varchar(50) NOT NULL default '',
  kd_nilai varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `siswa_raport`
#

INSERT INTO siswa_raport (kd, kd_tapel, kd_semester, kd_progstudi, kd_kelas, kd_ruang, kd_siswa, kd_pelajaran, kd_nilai) VALUES ('588e8a0ca4d7d9af1214517e006ff9f9', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '1757a88edd8afe8166ad204f0921c55e', '09f7c789b69d7e922bc8c178b343d9a1', '701425d00f3b54eee90adcf1cf338a03'),
('0575c0d7112d3074976c3ba02a1f87a6', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '1757a88edd8afe8166ad204f0921c55e', 'fdae483152509cbb05e34cb3a8bb07fe', '5eb912d41cc69189cc2a7ab7b11099bd'),
('bddd8424bf82646abaa27983c7caa8ca', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '1757a88edd8afe8166ad204f0921c55e', 'dd34b893098d7c1c779b395648963a0b', '5eb912d41cc69189cc2a7ab7b11099bd'),
('25c697a639ebdebe1e9a83e9e584beb2', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '1757a88edd8afe8166ad204f0921c55e', 'd289998d487e8e56496878fcb8e20e93', '701425d00f3b54eee90adcf1cf338a03'),
('1b88679989ac2e827239c3ba30c1af2c', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '1757a88edd8afe8166ad204f0921c55e', '9d38255327914c5e46a539681c96eb7a', '2d3fd3c78f2b2886d107cae37dd8ea4d'),
('a264074505d79ff59ab2bda255e024c1', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '1757a88edd8afe8166ad204f0921c55e', 'eba9742382d5c1731646bd8968d007ae', '5eb912d41cc69189cc2a7ab7b11099bd');
# --------------------------------------------------------

#
# Table structure for table `siswa_raport_absensi`
#

CREATE TABLE siswa_raport_absensi (
  kd varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_semester varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_ruang varchar(50) NOT NULL default '',
  kd_ket varchar(50) NOT NULL default '',
  jml varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `siswa_raport_absensi`
#

INSERT INTO siswa_raport_absensi (kd, kd_siswa, kd_tapel, kd_semester, kd_progstudi, kd_kelas, kd_ruang, kd_ket, jml) VALUES ('45d9a037dda179646c5c60798a74a83e', '1757a88edd8afe8166ad204f0921c55e', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'fe6abc6ea080299b975204d73c1590e3', '2'),
('16ddef0febd783c12f3b5e99e8c968b2', '1757a88edd8afe8166ad204f0921c55e', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'a47cbd787696841bfeee02330e0bda82', '2'),
('6577079f64325f48b99310996e9b9609', '1757a88edd8afe8166ad204f0921c55e', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'a5021199e355baa52547a0bdc3ddbdb6', '2');
# --------------------------------------------------------

#
# Table structure for table `siswa_raport_ekstra`
#

CREATE TABLE siswa_raport_ekstra (
  kd varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_semester varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_ruang varchar(50) NOT NULL default '',
  kd_ekstra varchar(50) NOT NULL default '',
  kd_nilai varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `siswa_raport_ekstra`
#

INSERT INTO siswa_raport_ekstra (kd, kd_siswa, kd_tapel, kd_semester, kd_progstudi, kd_kelas, kd_ruang, kd_ekstra, kd_nilai) VALUES ('67816184f77b3fa363753e72d07ff061', '1757a88edd8afe8166ad204f0921c55e', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', 'c696df2e570a0a9ede85c1700bc9faa8', '8c85630d609325ed96f8f5168fabbe18'),
('8b99ac255d79d3b7169d54fa0d5b7db0', '1757a88edd8afe8166ad204f0921c55e', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '33a34b7faa58b098a144ed7ea3051af7', '701425d00f3b54eee90adcf1cf338a03'),
('5ce1b47f8577d132e3c70054e103deca', '1757a88edd8afe8166ad204f0921c55e', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '', '');
# --------------------------------------------------------

#
# Table structure for table `siswa_raport_rangking`
#

CREATE TABLE siswa_raport_rangking (
  kd varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_semester varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_ruang varchar(50) NOT NULL default '',
  rangking char(2) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `siswa_raport_rangking`
#

INSERT INTO siswa_raport_rangking (kd, kd_siswa, kd_tapel, kd_semester, kd_progstudi, kd_kelas, kd_ruang, rangking) VALUES ('4dbb45429a370c4c9c192fc17922e77b', '1757a88edd8afe8166ad204f0921c55e', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'b18773d4ecc72a5de95b82afbb243bb0', '2');
# --------------------------------------------------------

#
# Table structure for table `siswa_ruang`
#

CREATE TABLE siswa_ruang (
  kd_tapel varchar(50) NOT NULL default '',
  kd_ruang varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  status enum('true','false') NOT NULL default 'false'
) TYPE=MyISAM;

#
# Dumping data for table `siswa_ruang`
#

INSERT INTO siswa_ruang (kd_tapel, kd_ruang, kd_siswa, status) VALUES ('e64b1ca4c438a8af17256c5d2cfc39c4', 'b50d2a8fc4826fdeed707e6c21ee8216', '1757a88edd8afe8166ad204f0921c55e', 'false'),
('e64b1ca4c438a8af17256c5d2cfc39c4', '86137a0d92ac46ed412726a3c6313669', 'c2cf4169509bf4870cee2ddcc80bd0ab', 'false'),
('e64b1ca4c438a8af17256c5d2cfc39c4', 'b18773d4ecc72a5de95b82afbb243bb0', '1757a88edd8afe8166ad204f0921c55e', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', 'b50d2a8fc4826fdeed707e6c21ee8216', 'c2cf4169509bf4870cee2ddcc80bd0ab', 'false'),
('e64b1ca4c438a8af17256c5d2cfc39c4', 'b18773d4ecc72a5de95b82afbb243bb0', 'bb0e26d85de7f53921b7bd16f1b4de46', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', 'b18773d4ecc72a5de95b82afbb243bb0', '12f6c9c34ecd2c3aeecade075d91e5b6', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', 'b18773d4ecc72a5de95b82afbb243bb0', '5905d7e8fec87503c5dce7843f18f63c', 'true'),
('e64b1ca4c438a8af17256c5d2cfc39c4', 'b18773d4ecc72a5de95b82afbb243bb0', 'c2cf4169509bf4870cee2ddcc80bd0ab', 'true');
# --------------------------------------------------------

#
# Table structure for table `siswa_uang_gedung`
#

CREATE TABLE siswa_uang_gedung (
  kd varchar(50) NOT NULL default '',
  kd_uang_gedung varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  tgl_bayar datetime NOT NULL default '0000-00-00 00:00:00'
) TYPE=MyISAM;

#
# Dumping data for table `siswa_uang_gedung`
#

INSERT INTO siswa_uang_gedung (kd, kd_uang_gedung, kd_siswa, tgl_bayar) VALUES ('5f6102d8139504643128238504e65a1d', '4c75242f81285d49b3f18a7a4d210a8f', '1757a88edd8afe8166ad204f0921c55e', '2006-02-02 00:00:00'),
('eb27ea4e8934f1e2d52f613a3de2fedc', '4c75242f81285d49b3f18a7a4d210a8f', 'c2cf4169509bf4870cee2ddcc80bd0ab', '2007-02-09 00:00:00');
# --------------------------------------------------------

#
# Table structure for table `siswa_uang_lain`
#

CREATE TABLE siswa_uang_lain (
  kd varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_uang_lain varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  tgl_bayar datetime NOT NULL default '0000-00-00 00:00:00'
) TYPE=MyISAM;

#
# Dumping data for table `siswa_uang_lain`
#

INSERT INTO siswa_uang_lain (kd, kd_tapel, kd_uang_lain, kd_siswa, tgl_bayar) VALUES ('038b3103347482892ea545513b6c3e17', 'e64b1ca4c438a8af17256c5d2cfc39c4', '31c2d890125b4103b7844e813f52cf1a', 'c2cf4169509bf4870cee2ddcc80bd0ab', '2006-02-04 00:00:00'),
('82742f2e93c60ceb3ad0eac43277155a', 'e64b1ca4c438a8af17256c5d2cfc39c4', '31c2d890125b4103b7844e813f52cf1a', '1757a88edd8afe8166ad204f0921c55e', '2005-03-02 00:00:00');
# --------------------------------------------------------

#
# Table structure for table `siswa_uang_spp`
#

CREATE TABLE siswa_uang_spp (
  kd varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_uang_spp varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  kd_bulan varchar(50) NOT NULL default '',
  tgl_bayar datetime NOT NULL default '0000-00-00 00:00:00'
) TYPE=MyISAM;

#
# Dumping data for table `siswa_uang_spp`
#

INSERT INTO siswa_uang_spp (kd, kd_tapel, kd_uang_spp, kd_siswa, kd_bulan, tgl_bayar) VALUES ('674697e28f7c9250bb31f54082cf3360', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'bad81d085df6c259223d9153cd2fd99b', 'c2cf4169509bf4870cee2ddcc80bd0ab', '43401dfa6276184f5e3a307b0949cfd5', '2006-04-04 00:00:00'),
('130ed0049d9dc59ea0a03561da682155', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'bad81d085df6c259223d9153cd2fd99b', 'c2cf4169509bf4870cee2ddcc80bd0ab', '7bdbbc6a7ba0b78fd447c08e7c2b64a6', '2006-02-05 00:00:00'),
('c68a8c7009c8e17b901d93c763dd3e36', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'bad81d085df6c259223d9153cd2fd99b', '1757a88edd8afe8166ad204f0921c55e', '1dbd819160264c7aaed4ae84f7f8fcf8', '2005-02-05 00:00:00'),
('b23fe5a08253838d5604b541fedeb855', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'bad81d085df6c259223d9153cd2fd99b', 'bb0e26d85de7f53921b7bd16f1b4de46', '43401dfa6276184f5e3a307b0949cfd5', '2006-03-04 00:00:00'),
('afbf83024717ea098bff0773af1db046', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'bad81d085df6c259223d9153cd2fd99b', '1757a88edd8afe8166ad204f0921c55e', '43401dfa6276184f5e3a307b0949cfd5', '2005-08-04 00:00:00');
# --------------------------------------------------------

#
# Table structure for table `siswa_uang_test`
#

CREATE TABLE siswa_uang_test (
  kd varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_uang_tes varchar(50) NOT NULL default '',
  kd_siswa varchar(50) NOT NULL default '',
  tgl_bayar datetime NOT NULL default '0000-00-00 00:00:00'
) TYPE=MyISAM;

#
# Dumping data for table `siswa_uang_test`
#

INSERT INTO siswa_uang_test (kd, kd_tapel, kd_uang_tes, kd_siswa, tgl_bayar) VALUES ('d0ab25f9ae07d42d26e0d09efa1eaf51', 'e64b1ca4c438a8af17256c5d2cfc39c4', '7a6df9d882fb55dbe4bc9725e64aab57', 'c2cf4169509bf4870cee2ddcc80bd0ab', '2006-03-02 00:00:00');
# --------------------------------------------------------

#
# Table structure for table `soal_essay`
#

CREATE TABLE soal_essay (
  kd varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_semester varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_pelajaran varchar(50) NOT NULL default '',
  kd_guru varchar(50) NOT NULL default '',
  topik varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `soal_essay`
#

INSERT INTO soal_essay (kd, kd_tapel, kd_semester, kd_progstudi, kd_kelas, kd_pelajaran, kd_guru, topik) VALUES ('b7e0cd70439f345b893f9fc30f574646', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '97a0edcf8ee7f52bae4bc4fc0f14090c', 'ca3d344b0a2acda279761f3e1141de6c', '3918fde042f86c2c01b1d71bfc7cff40', 'Mengenal Pancasila'),
('c446be0f6e9a7ba711a7f036690d258c', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'd289998d487e8e56496878fcb8e20e93', '3918fde042f86c2c01b1d71bfc7cff40', 'Vocabulary'),
('79daf3c1b9321f7e993d1bf369c4854c', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '97a0edcf8ee7f52bae4bc4fc0f14090c', 'ca3d344b0a2acda279761f3e1141de6c', '3918fde042f86c2c01b1d71bfc7cff40', 'Prinsip Ketuhanan');
# --------------------------------------------------------

#
# Table structure for table `soal_essay_detail`
#

CREATE TABLE soal_essay_detail (
  kd varchar(50) NOT NULL default '',
  kd_soal_essay varchar(50) NOT NULL default '',
  nomer varchar(5) NOT NULL default '',
  soal longtext NOT NULL,
  kunci longtext NOT NULL
) TYPE=MyISAM;

#
# Dumping data for table `soal_essay_detail`
#

INSERT INTO soal_essay_detail (kd, kd_soal_essay, nomer, soal, kunci) VALUES ('921825ff56155b3ded7a98a858c8e2c1', 'c446be0f6e9a7ba711a7f036690d258c', '1', 'fgjgfj', 'fgjfgj');
# --------------------------------------------------------

#
# Table structure for table `soal_pilihan`
#

CREATE TABLE soal_pilihan (
  kd varchar(50) NOT NULL default '',
  kd_tapel varchar(50) NOT NULL default '',
  kd_semester varchar(50) NOT NULL default '',
  kd_progstudi varchar(50) NOT NULL default '',
  kd_kelas varchar(50) NOT NULL default '',
  kd_pelajaran varchar(50) NOT NULL default '',
  kd_guru varchar(50) NOT NULL default '',
  topik varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `soal_pilihan`
#

INSERT INTO soal_pilihan (kd, kd_tapel, kd_semester, kd_progstudi, kd_kelas, kd_pelajaran, kd_guru, topik) VALUES ('22db61c6f89d79df3795604ac09a9442', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'd289998d487e8e56496878fcb8e20e93', '3918fde042f86c2c01b1d71bfc7cff40', 'vocabulary'),
('c02dd3df25013a8471163b7beefa1622', 'e64b1ca4c438a8af17256c5d2cfc39c4', 'a140a30047adb57e98a71985348bed60', '8b437a2c0f331d58724cca21bd92509b', '1236d8c726c2719824d6328ca94d2628', 'fdae483152509cbb05e34cb3a8bb07fe', 'c95b5441d466fc556e82ff09bb9adddb', 'fdhdfh');
# --------------------------------------------------------

#
# Table structure for table `soal_pilihan_opsi`
#

CREATE TABLE soal_pilihan_opsi (
  kd_soal varchar(50) NOT NULL default '',
  kd_pil varchar(50) NOT NULL default '',
  opsi longtext NOT NULL,
  status enum('true','false') NOT NULL default 'false'
) TYPE=MyISAM;

#
# Dumping data for table `soal_pilihan_opsi`
#

INSERT INTO soal_pilihan_opsi (kd_soal, kd_pil, opsi, status) VALUES ('1ff06ff3f359d7bf7f0802fe2b29032f', '900c7d958e8a4d5b2353be55135e74d7', 'fgjfgj', 'false'),
('1ff06ff3f359d7bf7f0802fe2b29032f', '7954c410f2c3084c7cf18bd7a82ed061', 'fgjfgj', 'false'),
('1ff06ff3f359d7bf7f0802fe2b29032f', '50862dce6b73905c187a17dafd84b023', 'fgjfgj', 'false'),
('1ff06ff3f359d7bf7f0802fe2b29032f', '8052b4f1778dbe75abd8d0154bdabac0', 'fgjfgj', 'false'),
('1ff06ff3f359d7bf7f0802fe2b29032f', 'fa59126812cb9dbc77b2509f4faff346', 'fgjfgj', 'false'),
('8f6901acf58ac412bc966f8e17aaa43b', '8052b4f1778dbe75abd8d0154bdabac0', 'dfghjfgj', 'false'),
('8f6901acf58ac412bc966f8e17aaa43b', '50862dce6b73905c187a17dafd84b023', 'fgjfgj', 'false'),
('8f6901acf58ac412bc966f8e17aaa43b', '7954c410f2c3084c7cf18bd7a82ed061', 'fgjfgj', 'false'),
('8f6901acf58ac412bc966f8e17aaa43b', '900c7d958e8a4d5b2353be55135e74d7', 'dfhdfdfj', 'false'),
('8f6901acf58ac412bc966f8e17aaa43b', 'fa59126812cb9dbc77b2509f4faff346', 'ddfgjfgj', 'false'),
('7c39173028f77be31d5f61de45098491', 'fa59126812cb9dbc77b2509f4faff346', 'sadwtry', 'true'),
('7c39173028f77be31d5f61de45098491', '900c7d958e8a4d5b2353be55135e74d7', 'vbncvb', 'false'),
('7c39173028f77be31d5f61de45098491', '7954c410f2c3084c7cf18bd7a82ed061', 'qweqwr', 'false'),
('7c39173028f77be31d5f61de45098491', '50862dce6b73905c187a17dafd84b023', 'kghjkghj', 'false'),
('7c39173028f77be31d5f61de45098491', '8052b4f1778dbe75abd8d0154bdabac0', 'sdwr', 'false'),
('3708bd76a9978de8f09b58b7d91dc318', '8052b4f1778dbe75abd8d0154bdabac0', 'hdfhdf', 'false'),
('3708bd76a9978de8f09b58b7d91dc318', '50862dce6b73905c187a17dafd84b023', 'dfhdf', 'false'),
('3708bd76a9978de8f09b58b7d91dc318', '7954c410f2c3084c7cf18bd7a82ed061', 'dfhdfh', 'false'),
('3708bd76a9978de8f09b58b7d91dc318', '900c7d958e8a4d5b2353be55135e74d7', 'dfhdfh', 'false'),
('3708bd76a9978de8f09b58b7d91dc318', 'fa59126812cb9dbc77b2509f4faff346', 'dfhdfh', 'false');
# --------------------------------------------------------

#
# Table structure for table `soal_pilihan_soal`
#

CREATE TABLE soal_pilihan_soal (
  kd varchar(50) NOT NULL default '',
  kd_topik varchar(50) NOT NULL default '',
  nomer varchar(5) NOT NULL default '',
  soal longtext NOT NULL
) TYPE=MyISAM;

#
# Dumping data for table `soal_pilihan_soal`
#

INSERT INTO soal_pilihan_soal (kd, kd_topik, nomer, soal) VALUES ('1ff06ff3f359d7bf7f0802fe2b29032f', '22db61c6f89d79df3795604ac09a9442', '1', 'fgjhfgj'),
('8f6901acf58ac412bc966f8e17aaa43b', '22db61c6f89d79df3795604ac09a9442', '2', 'fgjfgj'),
('7c39173028f77be31d5f61de45098491', 'c02dd3df25013a8471163b7beefa1622', '1', 'fdhjdfj'),
('3708bd76a9978de8f09b58b7d91dc318', '0da64bbfa67a7d25cb9fd3e95f5fe2d0', '1', 'dfhdf');

