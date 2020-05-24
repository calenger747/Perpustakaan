-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 11:42 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_anggota`
--

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
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_anggota`
--

INSERT INTO `table_anggota` (`no_anggota`, `no_identitas`, `tanda_pengenal`, `nama_anggota`, `fakultas`, `prodi`, `kelas`, `no_hp`, `alamat`, `date_created`) VALUES
('ANG0001-052020', '41518310023', 'KTM', 'Amelia Sari', 'Fasilkom', 'Teknik Informatika', 'Reguler 2', '', 'Kranggan', '2020-05-18 16:43:29'),
('ANG0002-052020', '41518310026', 'KTM', 'Ari Ariyanto', 'Fasilkom', 'Teknik Informatika', 'Reguler 2', '', 'Depok', '2020-05-18 16:50:04'),
('ANG0003-052020', '21371', 'SIM', 'Andika', '', '', '-', '082629182211', 'bekasi', '2020-05-22 09:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `table_buku`
--

CREATE TABLE `table_buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(32) NOT NULL,
  `nama_buku` varchar(128) NOT NULL,
  `kategori` int(11) NOT NULL,
  `pengarang` text NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL,
  `stok` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_buku`
--

INSERT INTO `table_buku` (`id_buku`, `kode_buku`, `nama_buku`, `kategori`, `pengarang`, `tahun_terbit`, `deskripsi`, `gambar`, `stok`, `id_supplier`) VALUES
(5, '88181111', 'Mengupas Rahasia Tersembunyi Ms Office', 6, 'Jubilee Enterprise', 2020, '<pre>\r\nBuku ini mengupas rahasia-rahasia yang terselip di dalam MS Office, seperti kombinasi tombol-tombol keyboard dan mouse, perintah-perintah penting tetapi jarang dipahami, deretan fitur menarik yang kurang disadari, dan sebagainya. Di dalam buku ini, Anda akan menemukan rahasia di balik MS Word, MS Powerpoint, dan MS Excel. Pada pembahasan tentang Powerpoint, Anda akan diajak membuat kreasi-kreasi animasi menarik yang jarang dipikirkan oleh pengguna. Di dalam MS Word, Anda akan mempelajari aneka tombol dan cara mempresentasikan tulisan secara mudah. Terakhir, Anda akan menemukan pembahasan tentang MS Excel terkait menu dan perintah yang menarik untuk didalami. Jika Anda ingin fokus pada pembahasan yang mengupas fitur-fitur penting di dalam MS Office, buku ini memang patut Anda baca!</pre>\r\n', 'buku1.jpg', 30, 1),
(6, '990188199', 'Antipanik! Buku Panduan Virus Corona', 5, 'dr. Jaka Pradipta, Sp.P dan dr. Ahmad Muslim Nazaruddin, Sp.P', 2020, '<pre>\r\nTepat 11 Maret 2020, WHO secara resmi menyatakan COVID-19 sebagai pandemi. Pandemi adalah wabah atau penyakit yang berjangkit secara bersamaan dengan penyebaran secara global di seluruh dunia. Semua warga dunia dihimbau agar lebih meningkatkan kewaspadaan dalam mencegah maupun menangani COVID-19. Anda tidak perlu panik! Sejatinya penyakit ini dapat sembuh dengan imunitas tubuh yang baik. Langkah perlindungan yang menjadi tanggung jawab kita adalah lindungi diri sendiri, lindungi keluarga kita, dan lindungi rumah kita dengan berbagai cara yang dapat Anda baca selengkapnya dalam buku ini.</pre>\r\n', 'buku2.jpg', 23, 1),
(7, '188299121', 'Menatap Langit Senja Di Tower Bridge', 7, 'DEWI PANGALILA', 2020, '<pre>\r\nMenatap Langit Senja di Tower Bridge Pesona Alam, Tragedi Toilet, dan Petualangan Seru Lainnya di Britania Raya Kisah perjalanan pertama ke luar negeri selalu menarik untuk disimak. Banyak suka dan duka, pastinya. Bagaimana ceritanya jika seorang guru yang mengalaminya? Keseruan dan kejutan macam apa yang dirasakan selama mendampingi murid-murid SMP-nya ikut program homestay selama 13 hari di Britania Raya? Belum pernah Penulis bayangkan sebelumnya, ia berkesempatan pergi ke luar negeri. Inggris menjadi negara tujuan Immersion and Homestay Program untuk murid SMP di sekolah tempat ia mengajar. Kota pertama yang didatangi adalah West Yorkshire. Disambut musim semi yang terasa dingin menusuk bagi orang negara tropis, cerita seru pun bermula. Tinggal bersama host family di pinggir kota Bradford dan menemani para murid bersekolah di Hipperholme Grammar School telah membuka cakrawala baru. Acara jalan-jalan ke Old Trafford Stadium?stadion bola yang megah di Manchester, berkunjung ke Oxford University, juga mendatangi Harry Potter Studio, Buckingham Palace, Indonesian Embassy, dan Natural History Museum sungguh jadi pengalaman mata dan budaya yang mengesankan. Tak ketinggalan, merasakan sensasi memasuki tempat megah bernama Harrods dan mengagumi pemandangan di sekitar Tower Bridge. Lalu, ada apa dengan toilet? Kejadian apa yang membuat panik dan khawatir tingkat dewa? Pencinta traveling, para guru, murid, dan siapa pun yang senang menjelajah banyak negara, akan terhibur membaca buku ini.</pre>\r\n', 'buku3.jpg', 63, 1),
(8, '277188172', 'Pesan Cinta Sang Pencipta', 1, 'DR. NURUL HUDA MAARIF', 2020, '<pre>\r\nDalam Al-Quran, Allah memanggil orang-orang beriman dengan ya ayyuhalladzina amanu. Jumlahnya sebanyak 89 kali. Hanya satu kali saja Allah memanggil mereka dengan sebutan ayyuhal muminun tanpa ada ya nida. Sebutan ini di samping mempunyai arti tanbih atau peringatan kepada mereka yang diajak bicara dan merasa sudah beriman, juga berarti tanda kasih sayang Allah kepada orang-orang beriman.\r\nBuku yang memuat uraian ayat-ayat ya ayyuhalladzina amanu ini ditulis dengan sangat bagus oleh ananda Nurul Huda. Topik yang diambilnya tepat. Uraiannya terhadap setiap judul menggunakan metode tafsir tahlili cukup mengena. Gaya bahasanya pun bisa dipahami oleh semua kalangan. Buku ini layak dijadikan pegangan bagi para aktivis muslim yang ingin mengetahui bagaimana karakter ajaran-Islam yang sebenarnya: menggugah kesadaran manusia agar selalu menjaga hubungan harmonis dengan Allah dengan selalu berbakti kepada-Nya dan juga menjaga hubungan harmonis dengan sesama manusia dengan berlaku baik dan adil.\r\nDr. KH. Ahsin Sakho Muhammad\r\nPakar Ilmu Al-Quran dari Institut Ilmu Al-Quran (IIQ) Jakarta\r\nApresiasi layak diberikan kepada penulis buku ini yang secara tekun meneliti ayat-ayat ya ayyuhalladzina amanu. Tema yang diangkat buku ini sangat bermanfaat. Tujuan penelitian yang dilakukan juga sangat relevan dengan situasi masa kini yang banyak berhadapan dengan hal-hal yang tidak diharapkan. Semoga karya ini bermanfaat bagi siapa saja yang membacanya. Aamiin.</pre>\r\n', 'buku4.jpg', 12, 1),
(9, '2618817211', 'Menikah tanpa Cinta', 1, 'Ary Mita C', 2020, '<pre>\r\nTerkadang ada di antara kita yang karena beragam alasan, akhirnya menikah dengan orang yang belum kita cintai. Mungkin ada dari kita yang karena berbagai sebab, akhirnya memutuskan untuk menikah dengan seseorang yang belum kita sayangi. Penyebab pernikahan tanpa cinta antara lain: 1. Karena kecewa dengan orang yang dicintai 2. Karena ditinggalkan oleh seseorang yang disayangi 3. Karena tidak mendapatkan restu dari orangtua 4. Karena tidak kunjung bertemu orang yang dicinta sementara usia terus bertambah 5. Karena sudah bertemu orang yang baik, meski belum dicintai 6. Karena ingin segera menikah, dan bertekad belajar mencintai setelah akad nikah 7. Dan lain-lain Lalu bagaimana mengatasi semua persoalan ini? Semoga buku ini menjadi media untuk meraih kebahagiaan dalam rumah tangga yang sudah terbangun.</pre>\r\n', 'buku6.jpg', 19, 1),
(10, '55216618', 'Hidup (To Live)', 10, 'Yu Hua', 2020, '<pre>\r\nBuku peraih penghargaan yang awalnya dilarang terbit lalu menjadi buku paling berpengaruh di China dekade terakhir ini. Dari seorang anak tuan tanah kaya yang menghabiskan waktu di meja judi dan ranjang pelacur, Fugui kehilangan harta dan orang-orang yang dicintainya. Dia berusaha bertahan hidup di tengah kekejaman perang saudara, absurditas Revolusi Kebudayaan, hingga bencana kelaparan yang melanda China akibat kekeliruan kebijakan Mao. Kisah tragis kehidupan seorang Fugui merangkum kengerian perjalanan sejarah negeri China di tengah ingar-bingar revolusi komunis. To Live adalah karya kontroversial salah satu novelis terbaik China yang sempat dilarang beredar di China, telah meraih berbagai penghargaan sastra internasional, difilmkan, dan telah diterjemahkan ke lebih dari 20 bahasa. Dengan kata-katanya yang sederhana namun bergemuruh dan menggugah, Yu Hua bercerita tentang sebuah China. Yang begitu nyata, tanpa basa-basi.</pre>\r\n', 'buku5.jpg', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `table_cart`
--

CREATE TABLE `table_cart` (
  `id_cart` int(11) NOT NULL,
  `no_anggota` varchar(32) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_kategori`
--

CREATE TABLE `table_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_kategori`
--

INSERT INTO `table_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Agama'),
(2, 'Komik'),
(3, 'Novel'),
(4, 'Fiksi'),
(5, 'Gaya Hidup'),
(6, 'Komputer & Teknologi'),
(7, 'Sains'),
(8, 'Kamus'),
(9, 'Sejarah'),
(10, 'Sastra');

-- --------------------------------------------------------

--
-- Table structure for table `table_pengembalian`
--

CREATE TABLE `table_pengembalian` (
  `no_pengembalian` varchar(32) NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `no_pinjam` varchar(32) NOT NULL,
  `jumlah_kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_pinjaman`
--

CREATE TABLE `table_pinjaman` (
  `no_pinjaman` varchar(64) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `no_anggota` varchar(64) NOT NULL,
  `total_pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_pinjaman_detail`
--

CREATE TABLE `table_pinjaman_detail` (
  `id_detail` int(11) NOT NULL,
  `no_pinjaman` varchar(32) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `expired_date` date DEFAULT NULL,
  `denda` int(11) NOT NULL,
  `status` enum('Pinjam','Kembali','Perpanjang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_stok`
--

CREATE TABLE `table_stok` (
  `id_stok` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_dipinjam` int(11) NOT NULL,
  `total_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_supplier`
--

CREATE TABLE `table_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(128) NOT NULL,
  `no_telp` varchar(24) NOT NULL,
  `fax` varchar(24) NOT NULL,
  `email` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_supplier`
--

INSERT INTO `table_supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `fax`, `email`, `alamat`, `date_created`) VALUES
(1, 'PT A', '(021) 631-7716', '277318827', 'abcd@gmail.com', 'depok', '2020-05-19 11:03:56'),
(2, 'PT B', '(021) 741-7827', '66217712', 'bbb@gmail.com', 'jakarta', '2020-05-19 11:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `no_anggota` varchar(32) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`id_user`, `username`, `password`, `nama`, `email`, `level`, `no_anggota`, `last_login`, `date_created`) VALUES
(1, 'admin', 'knC3R9wpKVimdBQuGcUt+52HdFEajzaiYnzsJ1WhOC+yULsNNDEMfhdXBskRrvreCKhlFUMA2/eOchigz3iMIg==', 'Ari Ariyanto', 'ariariyanto0404@gmail.com', '1', NULL, '2020-05-22 16:59:47', '2020-05-19 16:27:00'),
(3, 'andika', 'TDgAw9Uu1dnC8OUFV9PmKE0sRmP5kRUJnFO5zSwTVrb17T/+I4y+qmFUePoG/1JUVmHM8MdONzRtqRrz48yDKw==', 'Andika', 'andika@gmail.com', '2', 'ANG0003-052020', '2020-05-22 14:36:24', '2020-05-22 09:40:45'),
(5, 'kepala', 'XUWN/18fMnkuoohJRrms7dtFVdHjz7V9SJmF+LEyNNoEyZX4mxCQWzd6cOEsa7Mxvxqpp1JFPw1NroAT3iYWAw==', 'Kepala Perpus', 'kepalaperpus@gmail.com', '3', NULL, NULL, '2020-05-22 14:54:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_anggota`
--
ALTER TABLE `table_anggota`
  ADD PRIMARY KEY (`no_anggota`);

--
-- Indexes for table `table_buku`
--
ALTER TABLE `table_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `table_cart`
--
ALTER TABLE `table_cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `table_kategori`
--
ALTER TABLE `table_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `table_pengembalian`
--
ALTER TABLE `table_pengembalian`
  ADD PRIMARY KEY (`no_pengembalian`);

--
-- Indexes for table `table_pinjaman`
--
ALTER TABLE `table_pinjaman`
  ADD PRIMARY KEY (`no_pinjaman`);

--
-- Indexes for table `table_pinjaman_detail`
--
ALTER TABLE `table_pinjaman_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `table_stok`
--
ALTER TABLE `table_stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `table_supplier`
--
ALTER TABLE `table_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_buku`
--
ALTER TABLE `table_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `table_cart`
--
ALTER TABLE `table_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_kategori`
--
ALTER TABLE `table_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `table_pinjaman_detail`
--
ALTER TABLE `table_pinjaman_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_stok`
--
ALTER TABLE `table_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_supplier`
--
ALTER TABLE `table_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
