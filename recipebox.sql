-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2013 at 10:34 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `recipebox`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE IF NOT EXISTS `bahan` (
  `id_bahan` int(5) NOT NULL AUTO_INCREMENT,
  `nama_bahan` varchar(80) NOT NULL,
  PRIMARY KEY (`id_bahan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`) VALUES
(1, 'Telur puyuh'),
(2, 'Lomi'),
(3, 'Daging sukiyaki'),
(4, 'Wortel'),
(5, 'Kecap asin'),
(6, 'Merica bubuk'),
(7, 'Gula pasir'),
(8, 'Caisim'),
(9, 'Minyak wijen'),
(10, 'Angciu'),
(11, 'Daun bawang'),
(12, 'Seledri'),
(13, 'Air'),
(14, 'Minyak goreng'),
(15, 'Mi telur'),
(16, 'Ayam'),
(17, 'Kacang polong'),
(18, 'Jamur champignon'),
(19, 'Garam'),
(20, 'Telur'),
(21, 'Bawang putih'),
(22, 'Bawang bombay'),
(23, 'Tepung terigu'),
(24, 'Susu cair'),
(25, 'Keju slice'),
(26, 'Mentega'),
(27, 'Jus nanas'),
(28, 'Jus apel'),
(29, 'Stroberi'),
(30, 'Jeruk nipis'),
(31, 'Soda tawar'),
(32, 'Es batu'),
(33, 'Sirup stroberi'),
(34, 'Cokelat bubuk'),
(35, 'Baking powder'),
(36, 'Dark cooking chocolate'),
(37, 'Es krim bubuk instan'),
(38, 'Susu kental manis'),
(39, 'Air jeruk lemon'),
(40, 'Krim bubuk'),
(41, 'Air es'),
(42, 'Pewarna merah muda'),
(43, 'Wafer vanilla'),
(44, 'Margarin'),
(45, 'Es krim'),
(46, 'Kacang mede'),
(47, 'Permen karamel'),
(48, 'Agar - agar bubuk'),
(49, 'Jeli bubuk'),
(50, 'Selai stroberi'),
(51, 'Pewarna merah cabai'),
(52, 'Makaroni'),
(53, 'Udang'),
(54, 'Jamur kancing'),
(55, 'Daging giling'),
(56, 'Keju cheddar'),
(57, 'Bawang merah'),
(58, 'Saus tiram'),
(59, 'Pala bubuk'),
(60, 'Ketumbar bubuk'),
(61, 'Susu bubuk'),
(62, 'Tepung panir'),
(63, 'Stick es krim'),
(64, 'Mayones'),
(65, 'Saus tomat'),
(66, 'Saus sambal'),
(67, 'Ikan');

-- --------------------------------------------------------

--
-- Table structure for table `bahanresep`
--

CREATE TABLE IF NOT EXISTS `bahanresep` (
  `id_resep` int(5) NOT NULL,
  `id_bahan` int(5) NOT NULL,
  `keterangan` text NOT NULL,
  KEY `id_bahan` (`id_bahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahanresep`
--

INSERT INTO `bahanresep` (`id_resep`, `id_bahan`, `keterangan`) VALUES
(1, 1, '10 butir, rebus.'),
(1, 2, '500 gram, seduh sebentar'),
(1, 3, '200 gram'),
(1, 4, '1 buah, potong korek api'),
(1, 5, '1 sendok teh'),
(1, 6, '1/2 sendok teh'),
(1, 7, '1/4 sendok teh'),
(1, 8, '150 gram'),
(1, 9, '1 sendok teh'),
(1, 10, '2 sendok teh'),
(1, 11, '1 batang, iris halus'),
(1, 12, '1 tangkai, iris halus'),
(1, 13, '150ml'),
(1, 14, '1 sendok'),
(2, 15, '150 gram, seduh'),
(2, 16, '50 gram'),
(2, 17, '50 gram'),
(2, 4, '50 gram, parut'),
(2, 18, '50 gram, iris'),
(2, 19, '3/4 sendok teh'),
(2, 6, '1/4 sendok teh'),
(2, 20, '3 butir'),
(2, 21, '2 siung, cincang halus'),
(2, 22, '1/4 buah, cincang'),
(2, 23, '1 sendok makan'),
(2, 24, '150 ml'),
(2, 19, '1/4 sendok teh'),
(2, 6, '1/4 sendok teh'),
(2, 25, '3 lembar, potong - potong'),
(2, 26, '1 sendok makan'),
(3, 27, '200 ml'),
(3, 28, '200 ml'),
(3, 29, '100 gram, diblender halus'),
(3, 30, '2 buah, diiris bulat'),
(3, 31, '2 kaleng'),
(3, 32, '500 gram'),
(3, 13, '100 ml'),
(3, 7, '50 gram'),
(3, 33, '100 ml'),
(4, 26, '100 gram, suhu ruang'),
(4, 19, '1/4 sendok teh'),
(4, 7, '150 gram'),
(4, 20, '3 butir'),
(4, 23, '80 gram'),
(4, 34, '25 gram'),
(4, 35, '1/4 sendok teh'),
(4, 36, '75 gram, lelehkan'),
(4, 37, '1 bungkus rasa kapucino'),
(4, 13, '150 ml'),
(5, 29, '250gram, dicuci bersih, cincang kasar'),
(5, 38, '150 gram'),
(5, 39, '1 sendok teh'),
(5, 40, '150 gram'),
(5, 41, '300 gram'),
(5, 42, '4 tetes'),
(5, 43, '40 gram, cincang kasar untuk pelengkap'),
(6, 44, '100 gram'),
(6, 36, '200 gram, potong - potong'),
(6, 20, '2 butir'),
(6, 7, '100 gram'),
(6, 23, '30 gram'),
(6, 34, '25 gram'),
(6, 35, '1/4 sendok teh'),
(6, 45, '500 gram, rasa vanilla'),
(6, 46, '100 gram, sangrai, cincang kasar'),
(6, 47, '7 buah, cincang kasar'),
(7, 13, '40 ml'),
(7, 48, '1sendok teh (2 gram)'),
(7, 49, '1 1/2 sendok teh (6 gram)'),
(7, 7, '50 gram'),
(7, 50, '50 gram'),
(7, 51, '3 tetes'),
(7, 29, '50 gram, dibelah 2'),
(7, 45, '4 skup, rasa vanilla'),
(7, 45, '4 skup rasa stroberi'),
(7, 33, '2 sendok makan'),
(8, 52, '200 gram, rebus, tiriskan.'),
(8, 53, '300 gram, kupas, cincang.'),
(8, 54, '100 gram, cincang halus.'),
(8, 55, '250 gram'),
(8, 56, '250 gram'),
(8, 57, '8 butir, haluskan'),
(8, 21, '6 siung, haluskan'),
(8, 22, '1 buah, cincang halus'),
(8, 5, '1 sendok makan'),
(8, 58, '1 sendok makan'),
(8, 7, '1 sendok teh'),
(8, 6, '1/2 sendok teh'),
(8, 59, '1/2 sendok teh'),
(8, 60, '1/2 sendok teh'),
(8, 20, '7 butir'),
(8, 61, '6 sendok makan'),
(8, 23, '3 sendok makan'),
(8, 11, '2 batang, cincang halus'),
(8, 44, '3 sendok makan'),
(8, 14, 'untuk menggoreng'),
(8, 62, '200 gram'),
(8, 63, '25 buah'),
(8, 64, '150 gram'),
(8, 65, '150 gram'),
(8, 66, '150 gram');

-- --------------------------------------------------------

--
-- Table structure for table `caramasak`
--

CREATE TABLE IF NOT EXISTS `caramasak` (
  `id_resep` int(5) NOT NULL,
  `id_cara` int(5) NOT NULL AUTO_INCREMENT,
  `cara` varchar(240) NOT NULL,
  PRIMARY KEY (`id_cara`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `caramasak`
--

INSERT INTO `caramasak` (`id_resep`, `id_cara`, `cara`) VALUES
(1, 1, 'Panaskan minyak. Tumis bumbu cincang sampai harum. Masukkan daging sukiyaki. Aduk sampai berubah warna.'),
(1, 2, 'Tambahkan telur dan wortel. Aduk sampai setengah layu.  Masukkan kecap asin, garam, merica,dan gula pasir. Aduk rata.'),
(1, 3, 'Tambahkan caisim. Masak sampai setengah layu. Tuang air. Masak sampai mendidih.'),
(1, 4, 'Masukkan lomi. Aduk rata. Masukkan minyak wijen dan angciu. Aduk rata. Tambahkan daun bawang dan seledri. Aduk rata. Angkat.'),
(2, 5, 'Campur mi, ayam giling, kacang polong, wortel, jamur, telur, garam, dan merica bubuk. Aduk rata.'),
(2, 6, 'Buat dadar dengan menggunakan ring bulat diatas pan yang telah dioles minyak.'),
(2, 7, 'Masak dengan api kecil sampai bagian bawahnya matang. Balik. Matangkan sisi yang lainnya.'),
(2, 8, 'Saus, panaskan mentega. Tumis bawang bombay dan bawang putih sampai harum. Masukkan tepung terigu. Aduk sampai berbutir.'),
(2, 9, 'Tuang susu cair. Aduk sampai mengental. Masukkan garam, merica bubuk, dan keju slice. Aduk rata. Masak sampai meletup-letup.'),
(2, 10, 'Sajikan mi bersama sausnya.'),
(3, 11, 'Sirup, campur air dan gula pasir. Masak tanpa diaduk dengan api kecil hingga gula larut. Tambahkan sirup stroberi. Aduk rata.'),
(3, 12, 'Campur jus nanas, jus apel, blenderan stroberi, dan sirup. Aduk rata. Tambahkan es batu, soda tawar, dan jeruk nipis.'),
(4, 13, 'Toping: kocok es krim bubuk instan dengan air es sampai mengembang. Bekukan dalam lemari es.'),
(4, 14, 'Cake: aduk mentega, garam, dan gula pasir sampai tercampur rata. Masukkan telur. Aduk rata.'),
(4, 15, 'Tambahkan tepung terigu, cokelat bubuk, dan baking powder sambil diayak dan diaduk rata.'),
(4, 16, 'Masukkan dark cooking chocolate leleh. Aduk rata.'),
(4, 17, 'Tuang penuh ke dalam cetakan muffin pendek lebar yang dialas cup kertas emas.'),
(4, 18, 'Oven 25 menit dengan api bawah suhu 180 derajat Celcius sampai matang. Dinginkan.'),
(4, 19, 'Skupkan es krim di atas brownies. Segera sajikan.'),
(5, 20, 'Kocok krim bubuk dan air es sampai mengembang. Simpan dalam lemari es.'),
(5, 21, 'Aduk rata stroberi, susu kental manis putih, dan air jeruk lemon.'),
(5, 22, 'Tuang ke kocokan krim. Aduk rata. Tambahkan pewarna merah muda. Aduk rata.'),
(5, 23, 'Tuang di loyang 22x22x4 cm yang dialas aluminium foil. Ratakan.'),
(5, 24, 'Tabur atasnya dengan wafer vanila. Bekukan.\r\nUntuk 15 potong'),
(6, 25, 'Panaskan margarin. Matikan api. Tambahkan potongan dark cooking chocolate. Aduk sampai larut. Sisihkan dan biarkan mengental.'),
(6, 26, 'Kocok telur dan gula pasir 2 menit sampai rata.'),
(6, 27, 'Masukkan campuran margarin sedikit-sedikit sambil dikocok rata.'),
(6, 28, 'Tambahkan tepung terigu, cokelat bubuk, dan baking powder sambil diayak dan dikocok perlahan.'),
(6, 29, 'Tuang di loyang 28x28x3 cm yang dioles margarin dan dialas kertas roti.'),
(6, 30, 'Oven dengan api bawah suhu 180 derajat Celsius 10 menit sampai matang. Dinginkan.'),
(6, 31, 'Potong ukuran 24x12 cm. Letakkan dalam loyang 24x12x4 cm yang sudah dialas kertas roti. Sendokkan es krim. Ratakan. Tutup dengan cake lainnya.  Bekukan. Potong-potong.'),
(6, 32, 'Celupkan ke dalam dark cooking chocolate leleh. Tabur dengan kacang dan permen karamel. Bekukan kembali. Sajikan dingin.'),
(7, 33, 'Rebus air, agar-agar, jeli instan, dan gula pasir sambil diaduk sampai mendidih. Masukkan selai stroberi dan pewarna merah cabai. Aduk rata.'),
(7, 34, 'Tuang sebagian di gelas. Tata stroberi. Biarkan setengah beku. Tuang lagi di atasnya. Bekukan.'),
(7, 35, 'Sajikan dengan pelengkap.\r\nUntuk 4 gelas'),
(8, 36, 'Panaskan margarin. Tumis bawang merah, bawang putih, dan bawang bombay hingga harum. Masukkan udang, jamur, dan daging giling. Aduk hingga berubah warna. Angkat. Sisihkan.'),
(8, 37, 'Campur makaroni, tepung terigu, susu bubuk, telur, daun bawang, kecap asin, saus tiram, gula pasir, merica bubuk, pala bubuk, dan ketumbar bubuk. Aduk rata. Tambahkan tumisan daging dan sebagian keju parut. aduk rata.'),
(8, 38, 'Tuang dalam loyang ukuran 30x30x4 cm yang dioles margarin. Taburkan sisa keju parut. Kukus diatas api sedang 30 menit hingga matang. Angkat. Dinginkan. Potong-potong kotak. Celupkan ke dalam telur. Gulingkan ke tepung panir.'),
(8, 39, 'Goreng dalam minyak yang sudah dipanaskan hingga matang dan berwarna kuning kecokelatan. Tiriskan.'),
(8, 40, 'Tusuk masing-masing makaroni dengan stik es krim. Sajikan macaroni keju pop bersama pelengkapnya.');

-- --------------------------------------------------------

--
-- Table structure for table `daftarbelanja`
--

CREATE TABLE IF NOT EXISTS `daftarbelanja` (
  `id_user` int(5) NOT NULL,
  `id_resep` int(5) NOT NULL,
  `id_bahan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hidangan`
--

CREATE TABLE IF NOT EXISTS `hidangan` (
  `id_hidangan` int(5) NOT NULL AUTO_INCREMENT,
  `hidangan` varchar(90) NOT NULL,
  PRIMARY KEY (`id_hidangan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hidangan`
--

INSERT INTO `hidangan` (`id_hidangan`, `hidangan`) VALUES
(1, 'Umum'),
(2, 'Daerah'),
(3, 'Italia'),
(4, 'Jepang'),
(5, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(90) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Pembuka'),
(2, 'Makanan Utama'),
(3, 'Salad'),
(4, 'Sarapan'),
(5, 'Sup & Rebusan'),
(6, 'Penutup'),
(7, 'Minuman'),
(8, 'Cake'),
(9, 'Roti & Pastry');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE IF NOT EXISTS `resep` (
  `id_resep` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL,
  `judul` varchar(120) NOT NULL,
  `tglBuat` date NOT NULL,
  `caption` varchar(240) NOT NULL,
  `image` varchar(140) NOT NULL DEFAULT 'default.jpg',
  `id_hidangan` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `viewed` int(5) NOT NULL DEFAULT '0',
  `prep` int(5) NOT NULL DEFAULT '0',
  `cook` int(5) NOT NULL DEFAULT '0',
  `ready` int(5) NOT NULL DEFAULT '0',
  `kalori` int(5) NOT NULL DEFAULT '0',
  `kolesterol` int(5) NOT NULL DEFAULT '0',
  `lemak` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_resep`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id_resep`, `id_user`, `judul`, `tglBuat`, `caption`, `image`, `id_hidangan`, `id_kategori`, `viewed`, `prep`, `cook`, `ready`, `kalori`, `kolesterol`, `lemak`) VALUES
(1, 1, 'Lomi goreng sukiyaki', '2013-01-28', 'Jika Anda bosan dengan daging, Anda bisa menggantikannya dengan menu yang lain. Seperti yang satu ini, untuk membuatnya tidak susah.', 'suki.jpg', 4, 2, 28, 0, 0, 0, 0, 0, 0),
(2, 1, 'Mi telur keju', '2013-01-28', 'Banyak makanan pengganti nasi jika Anda sedang malas menikmati nasi. Kentang, bihun, atau mi bisa menjadi pilihan penggantinya.  Nah, mi telur keju ini bisa Anda nikmati sebagai pengganti nasi saat bosan.', 'telurkeju.jpg', 1, 2, 23, 0, 0, 0, 0, 0, 0),
(3, 1, 'Punch stroberi nipis', '2013-01-28', 'Kurang lengkap rasanya jika sebuah pesta yang meriah dengan hidangan yang serba nikmat tanpa minuman yang menyegarkan', 'punch.jpg', 1, 7, 3, 0, 0, 0, 0, 0, 0),
(4, 1, 'Brownies cup ice cream', '2013-01-28', 'Sekarang banyak es krim siap pakai dijual di berbagai supermarket. Rasanya beragam dan banyak pilihan. Anda tinggal mengikuti resep kami, terciptalah es krim lezat yang disukai siapa saja.', 'icebow.jpg', 1, 6, 9, 0, 0, 0, 0, 0, 0),
(5, 1, 'Es Krim Potong Stroberi', '2013-01-29', 'Kombinasi buah stroberi, air jeruk lemon dan bahan lainnya menghasilkan sajian yang menggugah selera. Ditambah dengan wafer vanila sebagai pelengkap. Penasaran? Rasanya yang manis dan segar menjadikan anda wajib mencoba resep berikut.', 'eskrimpotong.jpg', 1, 6, 39, 0, 0, 0, 0, 0, 0),
(6, 1, 'Brownies Sandwich Ice Cream', '2013-01-29', 'Brownies sandwich ice cream ini terlihat unik. es krim vanila yang segar dan lembut ini dibalut dengan rasa manis dari cokelat pekat. ', 'coklatsand.jpg', 1, 6, 33, 0, 0, 0, 0, 0, 0),
(7, 1, 'Es Krim Jeli Stroberi', '2013-01-29', 'Kombinasi jeli bubuk, selai stroberi, buah stroberi dan bahan lainnya menghasilkan sajian yang spesial. Ditambah dengan sirup stroberi, es krim vanila dan stroberi. Rasanya yang manis, segar dan dingin pasti akan membuat anda tergoda.', 'jeli.jpg', 1, 6, 145, 0, 0, 0, 0, 0, 0),
(8, 1, 'Makaroni Keju Pop', '2013-01-29', 'Liburan merupakan moment untuk berkumpul dengan keluarga. Tapi liburan kurang meriah jika Anda tidak menyuguhkan hidangan. Contohnya pada menu yang satu ini. Selamat membuat!', 'kejupop.jpg', 1, 1, 22, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resepfavorit`
--

CREATE TABLE IF NOT EXISTS `resepfavorit` (
  `id_user` int(5) NOT NULL,
  `id_resep` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resepfavorit`
--

INSERT INTO `resepfavorit` (`id_user`, `id_resep`) VALUES
(7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id_review` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL,
  `id_resep` int(5) NOT NULL,
  `tglReview` date NOT NULL,
  `judulReview` varchar(60) NOT NULL,
  `review` varchar(360) NOT NULL,
  `rating` int(5) NOT NULL,
  PRIMARY KEY (`id_review`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_review`, `id_user`, `id_resep`, `tglReview`, `judulReview`, `review`, `rating`) VALUES
(1, 3, 8, '2013-01-30', 'nice recipe!', 'resep yang baguss ~', 5),
(2, 2, 7, '2013-01-30', 'terlihat enaaaak', 'hahahaaaaaaaaaaa haha', 3),
(3, 4, 7, '2013-01-31', 'cooooolll', 'nice resep wkwkw', 3),
(4, 6, 5, '2013-01-31', 'good', 'resep yang bagusssss', 5),
(5, 5, 1, '2013-01-31', 'love it ~', 'nyam nyam nyam', 5),
(6, 5, 2, '2013-01-31', 'Tes', 'enak beud', 5),
(7, 6, 2, '2013-01-31', 'MT', 'Man man man tap tap tap', 1),
(8, 6, 1, '2013-01-31', 'mayan', 'mayanlah', 3),
(9, 6, 6, '2013-01-31', 'bagooes', 'haha', 3),
(10, 3, 6, '2013-01-31', 'not bad', 'hahaw', 4),
(11, 6, 8, '2013-02-02', 'i dont like :<', '', 2),
(12, 6, 3, '2013-02-05', 'resep yg bagus', '', 5),
(13, 6, 7, '2013-02-05', 'ga enaks', 'resepnya buruk, iyuuuuuuuuuwh', 1),
(14, 8, 5, '2013-02-05', 'haha', 'asa', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `img` varchar(80) NOT NULL DEFAULT 'default.jpg',
  `imgThumb` varchar(80) NOT NULL DEFAULT 'defaultThumb.jpg',
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `birthDate` date NOT NULL,
  `jkelamin` varchar(10) NOT NULL,
  `adress` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `job` varchar(60) NOT NULL,
  `company` varchar(80) NOT NULL,
  `wAdress` text NOT NULL,
  `tgl_register` date NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `tipe`, `img`, `imgThumb`, `fName`, `lName`, `birthDate`, `jkelamin`, `adress`, `email`, `phone`, `mobile`, `job`, `company`, `wAdress`, `tgl_register`) VALUES
(1, 'kersa', 'kersa', 'admin', 'admin.jpg', 'adminThumb.jpg', 'Kersa', 'Andika', '1994-06-13', 'Pria', 'Indonesia', 'kersaa203@gmail.com', '6661100', '0987654321', 'Pelajar', 'SMKN 1 Cimahi', 'Jl. Mahar Martanegara', '2011-03-20'),
(2, 'nagato', 'ynagato', 'user', 'default.jpg', 'defaultThumb.jpg', 'Nagato', 'Yuki', '1999-11-13', 'Wanita', 'Classified', 'nagato@ymail.com', '09912345', '09876543211', '', '', '', '2013-01-28'),
(3, 'haruhi', 'haruhi', 'user', 'haruhi.jpg', 'haruhiThumb.jpg', 'Miya', 'Haruhi', '1999-11-11', 'Wanita', 'Bandung', 'suzumiya@mail.com', '', '', '', '', '', '2013-01-30'),
(4, 'johnsmith', 'johnsmith', 'user', 'default.jpg', 'defaultThumb.jpg', 'John', 'Smith', '1990-12-11', 'Pria', 'USA', 'jsmith@mail.com', '', '', '', '', '', '2013-01-31'),
(5, 'kitten', 'fish', 'user', 'cat.jpg', 'catThumb.jpg', 'Cat', 'Garfield', '1990-03-09', 'Pria', 'Wonderland', 'cat@mail.com', '', '', '', '', '', '2013-01-31'),
(6, 'ken', 'ken', 'user', 'ken.jpg', 'kenThumb.jpg', 'Ken', 'Kitamura', '1999-12-12', 'Pria', 'Jepang', 'ken@mail.com', '', '', '', '', '', '2013-01-31'),
(7, 'estone', 'estone', 'user', 'estone.jpg', 'estoneThumb.jpg', 'Emma', 'Stone', '1994-12-06', 'Wanita', 'Indonesia', 'estone@mail.com', '', '', '', '', '', '2013-02-05'),
(8, 'indraprasetya', 'indra123', 'user', 'default.jpg', 'defaultThumb.jpg', 'indra', 'prasetya', '2013-02-05', 'Pria', 'Bandung..', 'namasayaindra@gmail.com', '', '', '', '', '', '2013-02-05'),
(9, 'firas_tistus', 'css', 'user', 'default.jpg', 'defaultThumb.jpg', 'firas', 'wertyu', '2013-02-22', 'Pria', 'London, England', 'firastistus234@tistus.com', '022323048', '0892901298', '', '', '', '2013-02-08');

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewbahan`
--
CREATE TABLE IF NOT EXISTS `viewbahan` (
`id_resep` int(5)
,`judul` varchar(120)
,`id_bahan` int(5)
,`nama_bahan` varchar(80)
,`keterangan` text
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `viewlangkah`
--
CREATE TABLE IF NOT EXISTS `viewlangkah` (
`id_resep` int(5)
,`judul` varchar(120)
,`id_cara` int(5)
,`cara` varchar(240)
);
-- --------------------------------------------------------

--
-- Structure for view `viewbahan`
--
DROP TABLE IF EXISTS `viewbahan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewbahan` AS select `bahanresep`.`id_resep` AS `id_resep`,`resep`.`judul` AS `judul`,`bahanresep`.`id_bahan` AS `id_bahan`,`bahan`.`nama_bahan` AS `nama_bahan`,`bahanresep`.`keterangan` AS `keterangan` from ((`bahanresep` join `bahan`) join `resep`) where ((`bahan`.`id_bahan` = `bahanresep`.`id_bahan`) and (`resep`.`id_resep` = `bahanresep`.`id_resep`));

-- --------------------------------------------------------

--
-- Structure for view `viewlangkah`
--
DROP TABLE IF EXISTS `viewlangkah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewlangkah` AS select `resep`.`id_resep` AS `id_resep`,`resep`.`judul` AS `judul`,`caramasak`.`id_cara` AS `id_cara`,`caramasak`.`cara` AS `cara` from (`resep` join `caramasak`) where (`resep`.`id_resep` = `caramasak`.`id_resep`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
