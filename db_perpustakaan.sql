/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 100411
Source Host           : localhost:3306
Source Database       : db_perpustakaan

Target Server Type    : MYSQL
Target Server Version : 100411
File Encoding         : 65001

Date: 2020-09-01 02:53:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for table_anggota
-- ----------------------------
DROP TABLE IF EXISTS `table_anggota`;
CREATE TABLE `table_anggota` (
  `no_anggota` varchar(64) NOT NULL,
  `no_identitas` varchar(32) NOT NULL,
  `tanda_pengenal` enum('KTP','SIM','Paspor','KTM') NOT NULL,
  `nama_anggota` varchar(64) NOT NULL,
  `fakultas` varchar(32) NOT NULL,
  `prodi` varchar(32) NOT NULL,
  `kelas` enum('Reguler 1','Reguler 2','Reguler 3','-','Pascasarjana') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`no_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_anggota
-- ----------------------------
INSERT INTO `table_anggota` VALUES ('ANG0001-052020', '72661829197', 'KTP', 'Dwi Alfina', '', '', '-', '', 'Semarang', '2020-05-18 16:43:29');
INSERT INTO `table_anggota` VALUES ('ANG0001-062020', '41518310027', 'KTM', 'Muhammad Umar', '', '', '-', '081928817318', 'depok', '2020-06-14 21:05:48');
INSERT INTO `table_anggota` VALUES ('ANG0002-052020', '41518310026', 'KTM', 'Ari Ariyanto', 'Fasilkom', 'Teknik Informatika', 'Reguler 2', '081389061742', 'Depok', '2020-05-18 16:50:04');
INSERT INTO `table_anggota` VALUES ('ANG0003-052020', '21371', 'SIM', 'Andika', '', '', '-', '082629182211', 'bekasi', '2020-05-22 09:40:45');

-- ----------------------------
-- Table structure for table_buku
-- ----------------------------
DROP TABLE IF EXISTS `table_buku`;
CREATE TABLE `table_buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `kode_buku` varchar(32) NOT NULL,
  `nama_buku` varchar(128) NOT NULL,
  `kategori` int(11) NOT NULL,
  `pengarang` text NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL,
  `stok` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_buku
-- ----------------------------
INSERT INTO `table_buku` VALUES ('5', '88181111', 'Mengupas Rahasia Tersembunyi Ms Office', '6', 'Jubilee Enterprise', '2020', '<p>\r\nBuku ini mengupas rahasia-rahasia yang terselip di dalam MS Office, seperti kombinasi tombol-tombol keyboard dan mouse, perintah-perintah penting tetapi jarang dipahami, deretan fitur menarik yang kurang disadari, dan sebagainya. Di dalam buku ini, Anda akan menemukan rahasia di balik MS Word, MS Powerpoint, dan MS Excel. Pada pembahasan tentang Powerpoint, Anda akan diajak membuat kreasi-kreasi animasi menarik yang jarang dipikirkan oleh pengguna. Di dalam MS Word, Anda akan mempelajari aneka tombol dan cara mempresentasikan tulisan secara mudah. Terakhir, Anda akan menemukan pembahasan tentang MS Excel terkait menu dan perintah yang menarik untuk didalami. Jika Anda ingin fokus pada pembahasan yang mengupas fitur-fitur penting di dalam MS Office, buku ini memang patut Anda baca!</p>\r\n', 'buku1.jpg', '53', '1');
INSERT INTO `table_buku` VALUES ('6', '990188199', 'Antipanik! Buku Panduan Virus Corona', '5', 'dr. Jaka Pradipta, Sp.P dan dr. Ahmad Muslim Nazaruddin, Sp.P', '2020', '<p>\r\nTepat 11 Maret 2020, WHO secara resmi menyatakan COVID-19 sebagai pandemi. Pandemi adalah wabah atau penyakit yang berjangkit secara bersamaan dengan penyebaran secara global di seluruh dunia. Semua warga dunia dihimbau agar lebih meningkatkan kewaspadaan dalam mencegah maupun menangani COVID-19. Anda tidak perlu panik! Sejatinya penyakit ini dapat sembuh dengan imunitas tubuh yang baik. Langkah perlindungan yang menjadi tanggung jawab kita adalah lindungi diri sendiri, lindungi keluarga kita, dan lindungi rumah kita dengan berbagai cara yang dapat Anda baca selengkapnya dalam buku ini.</p>\r\n', 'buku2.jpg', '23', '1');
INSERT INTO `table_buku` VALUES ('7', '188299121', 'Menatap Langit Senja Di Tower Bridge', '7', 'DEWI PANGALILA', '2020', '<p>\r\nMenatap Langit Senja di Tower Bridge Pesona Alam, Tragedi Toilet, dan Petualangan Seru Lainnya di Britania Raya Kisah perjalanan pertama ke luar negeri selalu menarik untuk disimak. Banyak suka dan duka, pastinya. Bagaimana ceritanya jika seorang guru yang mengalaminya? Keseruan dan kejutan macam apa yang dirasakan selama mendampingi murid-murid SMP-nya ikut program homestay selama 13 hari di Britania Raya? Belum pernah Penulis bayangkan sebelumnya, ia berkesempatan pergi ke luar negeri. Inggris menjadi negara tujuan Immersion and Homestay Program untuk murid SMP di sekolah tempat ia mengajar. Kota pertama yang didatangi adalah West Yorkshire. Disambut musim semi yang terasa dingin menusuk bagi orang negara tropis, cerita seru pun bermula. Tinggal bersama host family di pinggir kota Bradford dan menemani para murid bersekolah di Hipperholme Grammar School telah membuka cakrawala baru. Acara jalan-jalan ke Old Trafford Stadium?stadion bola yang megah di Manchester, berkunjung ke Oxford University, juga mendatangi Harry Potter Studio, Buckingham Palace, Indonesian Embassy, dan Natural History Museum sungguh jadi pengalaman mata dan budaya yang mengesankan. Tak ketinggalan, merasakan sensasi memasuki tempat megah bernama Harrods dan mengagumi pemandangan di sekitar Tower Bridge. Lalu, ada apa dengan toilet? Kejadian apa yang membuat panik dan khawatir tingkat dewa? Pencinta traveling, para guru, murid, dan siapa pun yang senang menjelajah banyak negara, akan terhibur membaca buku ini.</p>\r\n', 'buku3.jpg', '71', '1');
INSERT INTO `table_buku` VALUES ('8', '277188172', 'Pesan Cinta Sang Pencipta', '1', 'DR. NURUL HUDA MAARIF', '2020', '<p>\r\nDalam Al-Quran, Allah memanggil orang-orang beriman dengan ya ayyuhalladzina amanu. Jumlahnya sebanyak 89 kali. Hanya satu kali saja Allah memanggil mereka dengan sebutan ayyuhal muminun tanpa ada ya nida. Sebutan ini di samping mempunyai arti tanbih atau peringatan kepada mereka yang diajak bicara dan merasa sudah beriman, juga berarti tanda kasih sayang Allah kepada orang-orang beriman.\r\nBuku yang memuat uraian ayat-ayat ya ayyuhalladzina amanu ini ditulis dengan sangat bagus oleh ananda Nurul Huda. Topik yang diambilnya tepat. Uraiannya terhadap setiap judul menggunakan metode tafsir tahlili cukup mengena. Gaya bahasanya pun bisa dipahami oleh semua kalangan. Buku ini layak dijadikan pegangan bagi para aktivis muslim yang ingin mengetahui bagaimana karakter ajaran-Islam yang sebenarnya: menggugah kesadaran manusia agar selalu menjaga hubungan harmonis dengan Allah dengan selalu berbakti kepada-Nya dan juga menjaga hubungan harmonis dengan sesama manusia dengan berlaku baik dan adil.\r\nDr. KH. Ahsin Sakho Muhammad\r\nPakar Ilmu Al-Quran dari Institut Ilmu Al-Quran (IIQ) Jakarta\r\nApresiasi layak diberikan kepada penulis buku ini yang secara tekun meneliti ayat-ayat ya ayyuhalladzina amanu. Tema yang diangkat buku ini sangat bermanfaat. Tujuan penelitian yang dilakukan juga sangat relevan dengan situasi masa kini yang banyak berhadapan dengan hal-hal yang tidak diharapkan. Semoga karya ini bermanfaat bagi siapa saja yang membacanya. Aamiin.</p>\r\n', 'buku4.jpg', '12', '1');
INSERT INTO `table_buku` VALUES ('9', '2618817211', 'Menikah tanpa Cinta', '1', 'Ary Mita C', '2020', '<p>\r\nTerkadang ada di antara kita yang karena beragam alasan, akhirnya menikah dengan orang yang belum kita cintai. Mungkin ada dari kita yang karena berbagai sebab, akhirnya memutuskan untuk menikah dengan seseorang yang belum kita sayangi. Penyebab pernikahan tanpa cinta antara lain: 1. Karena kecewa dengan orang yang dicintai 2. Karena ditinggalkan oleh seseorang yang disayangi 3. Karena tidak mendapatkan restu dari orangtua 4. Karena tidak kunjung bertemu orang yang dicinta sementara usia terus bertambah 5. Karena sudah bertemu orang yang baik, meski belum dicintai 6. Karena ingin segera menikah, dan bertekad belajar mencintai setelah akad nikah 7. Dan lain-lain Lalu bagaimana mengatasi semua persoalan ini? Semoga buku ini menjadi media untuk meraih kebahagiaan dalam rumah tangga yang sudah terbangun.</p>\r\n', 'buku6.jpg', '33', '1');
INSERT INTO `table_buku` VALUES ('10', '55216618', 'Hidup (To Live)', '10', 'Yu Hua', '2020', '<p>Buku peraih penghargaan yang awalnya dilarang terbit lalu menjadi buku paling berpengaruh di China dekade terakhir ini. Dari seorang anak tuan tanah kaya yang menghabiskan waktu di meja judi dan ranjang pelacur, Fugui kehilangan harta dan orang-orang yang dicintainya. Dia berusaha bertahan hidup di tengah kekejaman perang saudara, absurditas Revolusi Kebudayaan, hingga bencana kelaparan yang melanda China akibat kekeliruan kebijakan Mao. Kisah tragis kehidupan seorang Fugui merangkum kengerian perjalanan sejarah negeri China di tengah ingar-bingar revolusi komunis. To Live adalah karya kontroversial salah satu novelis terbaik China yang sempat dilarang beredar di China, telah meraih berbagai penghargaan sastra internasional, difilmkan, dan telah diterjemahkan ke lebih dari 20 bahasa. Dengan kata-katanya yang sederhana namun bergemuruh dan menggugah, Yu Hua bercerita tentang sebuah China. Yang begitu nyata, tanpa basa-basi.</p>\r\n', 'flip.jpg', '16', '2');
INSERT INTO `table_buku` VALUES ('11', '8829181992', 'Rapid', '6', 'dimas', '2020', '<p>Rapid Book</p>\r\n', 'download.jpg', '21', '4');

-- ----------------------------
-- Table structure for table_cart
-- ----------------------------
DROP TABLE IF EXISTS `table_cart`;
CREATE TABLE `table_cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(32) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id_cart`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_cart
-- ----------------------------
INSERT INTO `table_cart` VALUES ('32', 'ANG0002-052020', '8', '1');
INSERT INTO `table_cart` VALUES ('36', 'ANG0002-052020', '5', '1');

-- ----------------------------
-- Table structure for table_kategori
-- ----------------------------
DROP TABLE IF EXISTS `table_kategori`;
CREATE TABLE `table_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(64) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_kategori
-- ----------------------------
INSERT INTO `table_kategori` VALUES ('1', 'Agama');
INSERT INTO `table_kategori` VALUES ('2', 'Komik');
INSERT INTO `table_kategori` VALUES ('3', 'Novel');
INSERT INTO `table_kategori` VALUES ('4', 'Fiksi');
INSERT INTO `table_kategori` VALUES ('5', 'Gaya Hidup');
INSERT INTO `table_kategori` VALUES ('6', 'Komputer & Teknologi');
INSERT INTO `table_kategori` VALUES ('7', 'Sains');
INSERT INTO `table_kategori` VALUES ('8', 'Kamus');
INSERT INTO `table_kategori` VALUES ('9', 'Sejarah');
INSERT INTO `table_kategori` VALUES ('10', 'Sastra');
INSERT INTO `table_kategori` VALUES ('11', 'Matematika & Statistik');

-- ----------------------------
-- Table structure for table_pengembalian
-- ----------------------------
DROP TABLE IF EXISTS `table_pengembalian`;
CREATE TABLE `table_pengembalian` (
  `no_pengembalian` varchar(32) NOT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `no_pinjam` varchar(32) NOT NULL,
  `no_anggota` varchar(32) NOT NULL,
  `jumlah_kembali` int(11) NOT NULL,
  PRIMARY KEY (`no_pengembalian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_pengembalian
-- ----------------------------
INSERT INTO `table_pengembalian` VALUES ('KMB0001-062020', '2020-06-07 00:06:52', 'PJM0003-062020', 'ANG0001-052020', '3');
INSERT INTO `table_pengembalian` VALUES ('KMB0001-102020', '2020-10-11 00:01:12', 'PJM0001-062020', 'ANG0002-052020', '2');
INSERT INTO `table_pengembalian` VALUES ('KMB0001-122020', '2020-12-01 13:19:12', 'PJM0009-062020', 'ANG0002-052020', '1');
INSERT INTO `table_pengembalian` VALUES ('KMB0002-062020', '2020-06-07 20:20:14', 'PJM0004-062020', 'ANG0002-052020', '1');
INSERT INTO `table_pengembalian` VALUES ('KMB0003-062020', '2020-06-14 21:08:55', 'PJM0007-062020', 'ANG0001-062020', '3');
INSERT INTO `table_pengembalian` VALUES ('KMB0004-062020', '2020-06-21 03:28:42', 'PJM0005-062020', 'ANG0003-052020', '1');
INSERT INTO `table_pengembalian` VALUES ('KMB0005-062020', '2020-06-21 03:38:28', 'PJM0006-062020', 'ANG0003-052020', '1');
INSERT INTO `table_pengembalian` VALUES ('KMB0006-062020', '2020-06-21 03:38:36', 'PJM0002-062020', 'ANG0003-052020', '1');
INSERT INTO `table_pengembalian` VALUES ('KMB0007-062020', '2020-06-21 03:46:00', 'PJM0008-062020', 'ANG0002-052020', '1');

-- ----------------------------
-- Table structure for table_pinjaman
-- ----------------------------
DROP TABLE IF EXISTS `table_pinjaman`;
CREATE TABLE `table_pinjaman` (
  `no_pinjaman` varchar(64) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `no_anggota` varchar(64) NOT NULL,
  `total_pinjam` int(11) NOT NULL,
  `status` enum('Dipinjam','Dikembalikan','Pending','Cancel by Admin','Process','Dibatalkan','Approve by Admin','Approve Kembali by Admin') NOT NULL,
  `notif` enum('0','1') NOT NULL,
  PRIMARY KEY (`no_pinjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_pinjaman
-- ----------------------------
INSERT INTO `table_pinjaman` VALUES ('PJM0001-062020', '2020-10-10 23:59:57', 'ANG0002-052020', '2', 'Dikembalikan', '0');
INSERT INTO `table_pinjaman` VALUES ('PJM0002-062020', '2020-06-06 04:03:25', 'ANG0003-052020', '1', 'Dikembalikan', '0');
INSERT INTO `table_pinjaman` VALUES ('PJM0003-062020', '2020-05-27 02:12:20', 'ANG0001-052020', '3', 'Dikembalikan', '0');
INSERT INTO `table_pinjaman` VALUES ('PJM0004-062020', '2020-06-06 02:14:59', 'ANG0002-052020', '1', 'Dikembalikan', '0');
INSERT INTO `table_pinjaman` VALUES ('PJM0005-062020', '2020-06-07 20:12:19', 'ANG0003-052020', '1', 'Dikembalikan', '0');
INSERT INTO `table_pinjaman` VALUES ('PJM0006-062020', '2020-06-07 20:19:42', 'ANG0003-052020', '1', 'Dikembalikan', '0');
INSERT INTO `table_pinjaman` VALUES ('PJM0007-062020', '2020-06-14 21:08:12', 'ANG0001-062020', '3', 'Dikembalikan', '0');
INSERT INTO `table_pinjaman` VALUES ('PJM0008-062020', '2020-06-21 03:07:52', 'ANG0002-052020', '1', 'Dikembalikan', '0');
INSERT INTO `table_pinjaman` VALUES ('PJM0009-062020', '2020-11-17 12:08:48', 'ANG0002-052020', '1', 'Dikembalikan', '0');
INSERT INTO `table_pinjaman` VALUES ('PJM0010-112020', '2020-11-30 22:30:21', 'ANG0001-052020', '1', 'Approve by Admin', '1');

-- ----------------------------
-- Table structure for table_pinjaman_detail
-- ----------------------------
DROP TABLE IF EXISTS `table_pinjaman_detail`;
CREATE TABLE `table_pinjaman_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `no_pinjaman` varchar(32) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `expired_date` date DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `status_detail` enum('Pinjam','Kembali','Batal','Pending','Proses','Cancel') NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_pinjaman_detail
-- ----------------------------
INSERT INTO `table_pinjaman_detail` VALUES ('1', 'PJM0003-062020', '9', '2', '2020-06-03', '4000', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('2', 'PJM0003-062020', '7', '1', '2020-06-03', '2000', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('3', 'PJM0004-062020', '5', '1', '2020-06-13', '3000', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('7', 'PJM0002-062020', '10', '1', '2020-06-13', '4000', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('9', 'PJM0001-062020', '5', '1', '2020-10-17', '0', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('10', 'PJM0001-062020', '5', '1', '2020-10-17', '0', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('11', 'PJM0005-062020', '9', '1', '2020-06-14', '3500', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('12', 'PJM0006-062020', '8', '1', '2020-06-14', '3500', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('13', 'PJM0007-062020', '8', '1', '2020-06-21', '3500', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('14', 'PJM0007-062020', '5', '2', '2020-06-21', '7000', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('19', 'PJM0008-062020', '5', '1', '2020-06-28', '0', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('24', 'PJM0009-062020', '5', '1', '2020-11-24', '3500', 'Kembali');
INSERT INTO `table_pinjaman_detail` VALUES ('25', 'PJM0010-112020', '11', '1', '2020-12-07', '0', 'Proses');

-- ----------------------------
-- Table structure for table_stok
-- ----------------------------
DROP TABLE IF EXISTS `table_stok`;
CREATE TABLE `table_stok` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_dipinjam` int(11) NOT NULL,
  `total_stok` int(11) NOT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_stok
-- ----------------------------

-- ----------------------------
-- Table structure for table_supplier
-- ----------------------------
DROP TABLE IF EXISTS `table_supplier`;
CREATE TABLE `table_supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(128) NOT NULL,
  `no_telp` varchar(24) NOT NULL,
  `fax` varchar(24) NOT NULL,
  `email` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_supplier
-- ----------------------------
INSERT INTO `table_supplier` VALUES ('1', 'PT A', '(021) 631-7716', '277318827', 'abcd@gmail.com', 'depok', '2020-05-19 11:03:56');
INSERT INTO `table_supplier` VALUES ('2', 'PT B', '(021) 741-7827', '66217712', 'bbb@gmail.com', 'jakarta', '2020-05-19 11:05:40');
INSERT INTO `table_supplier` VALUES ('4', 'PT C', '0218821992', '28832', 'c@mail.com', 'depok', '2020-06-14 21:07:26');

-- ----------------------------
-- Table structure for table_user
-- ----------------------------
DROP TABLE IF EXISTS `table_user`;
CREATE TABLE `table_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `no_anggota` varchar(32) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_user
-- ----------------------------
INSERT INTO `table_user` VALUES ('1', 'ari.ariyanto', 'f12bdb6d7b05fb8843568ec0af49d49c1f9f44ec259fdadf877a08a1ee4d973d1e066111e7590eeddfba83f788593447e7647d47cd84f1306b69fcb2601feefbL+VZBjiMjKKC98FcxySh7X39x+JKaM0IV5YPoWjnEmQ=', 'Ari Ariyanto', 'ariariyanto0404@gmail.com', '1', null, '2020-12-01 10:45:20', '2020-05-19 16:27:00');
INSERT INTO `table_user` VALUES ('3', 'andika', '1bbe0b7eedff2896daf9b299e3503af5bad71f1f5e31800f1327f9a688e44774cc87eda4e27066aacbb11615e13680c8434cd2d59812ba452a998e8e3307ab0d8sCzwSnzEEAe+rnhdu2q5O+GNlHHrbTp5cq2wZqcpzI=', 'Andika', 'andika@gmail.com', '2', 'ANG0003-052020', '2020-10-10 23:50:34', '2020-05-22 09:40:45');
INSERT INTO `table_user` VALUES ('5', 'kepala', '36b8067562039461ff19ba881ffff9b3ca9002a999d5833d0b9af104413d84f4cbda21e8333bb866cd9c369ca0525ba422d45c1385ae60c8e3e6fdefa70ba873AeFuNs90/fxyz71jiMYX/T8HUP7o0bFhBW5y7sOR/LI=', 'Kepala Perpus', 'kepalaperpus@gmail.com', '3', null, '2020-11-30 23:43:25', '2020-05-22 14:54:34');
INSERT INTO `table_user` VALUES ('6', 'ari', '9fb42408553146745b489c55f587140f3543ca2925e509fe65c2d64388a59a17efdc42ddedb8840ff366260a2333dad6476a3fa25362ef247d67f2231203e196532pnUpCwex0gErn48QhTGV1+tzTsQsF+MW6ml/8xKo=', 'Ariyanto', 'calenger747@gmail.com', '2', 'ANG0002-052020', '2020-06-21 20:18:51', '2020-06-06 14:05:00');
INSERT INTO `table_user` VALUES ('7', 'alfina', '03be566707001a16a3705780a842c98bd657bfda5484292f10678350b0d792151d2fe6a62cd9f01ad74731249e3f549fec0c97d5bd85c4a02ecb04271ea16376xZPJq2WpdU/v1G8yvvh3Ddb3W3pj4pCUFFzXy3gDnJU=', 'Dwi Alfina', 'dwialfina28@gmail.com', '2', 'ANG0001-052020', '2020-12-01 13:01:44', '2020-06-06 14:05:00');
SET FOREIGN_KEY_CHECKS=1;
