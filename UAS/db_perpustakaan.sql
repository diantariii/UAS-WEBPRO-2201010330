/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.4.22-MariaDB : Database - db_perpustakaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_perpustakaan`;

/*Table structure for table `tb_anggota` */

DROP TABLE IF EXISTS `tb_anggota`;

CREATE TABLE `tb_anggota` (
  `nim` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `prodi` varchar(100) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_anggota` */

insert  into `tb_anggota`(`nim`,`nama`,`tempat_lahir`,`tanggal_lahir`,`jk`,`prodi`) values 
(20112022,'Ayu','Denpasar','2004-01-10','L','Teknik Informatika'),
(20112023,'Bimo','Denpasar','2003-01-04','P','Akuntansi'),
(20112114,'Kim Mingyu','Seoul, Korea','2003-05-06','L','Sistem Komputer');

/*Table structure for table `tb_buku` */

DROP TABLE IF EXISTS `tb_buku`;

CREATE TABLE `tb_buku` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(150) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `isbn` varchar(25) NOT NULL,
  `jumlah_buku` int(3) NOT NULL,
  `lokasi` enum('rak1','rak2','rak3') NOT NULL,
  `tgl_input` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_buku` */

insert  into `tb_buku`(`id`,`judul`,`pengarang`,`penerbit`,`tahun_terbit`,`isbn`,`jumlah_buku`,`lokasi`,`tgl_input`) values 
(1,'Dasar Pemrograman Web: HTML, CSS dan JavaScript','Ach. Khozaimi','Media Nusa Creative (MNC Publishing)','2020','9786024625597, 6024625596',3,'rak1','2022-10-08'),
(2,'Cosmos','Carl Sagan','Random House Publishing Group','2011','9780307800985, 0307800989',2,'rak2','2022-10-12'),
(3,'Photoshop\'s Illusion + Dvd','Mohammad Jeprie','Elex Media Komputindo','2009','9789792742954, 9792742956',3,'rak1','2022-10-11'),
(5,'Si Anak Kuat','Tere Liye','Republika Penerbit','2018','978-602-5734-42-7',0,'rak3','2022-11-11');

/*Table structure for table `tb_transaksi` */

DROP TABLE IF EXISTS `tb_transaksi`;

CREATE TABLE `tb_transaksi` (
  `id_trx` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) DEFAULT NULL,
  `nim` int(11) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `tgl_pinjam` varchar(30) DEFAULT NULL,
  `tgl_kembali` varchar(30) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_trx`),
  KEY `id` (`id_trx`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_transaksi` */

insert  into `tb_transaksi`(`id_trx`,`judul`,`nim`,`nama`,`tgl_pinjam`,`tgl_kembali`,`status`) values 
(1,'Cosmos',20112022,'Ayu','01-04-2023','08-04-2023','Pinjam'),
(2,'Photoshop\'s Illusion + Dvd',20112023,'Bimo','03-04-2023','20-04-2023','Pinjam'),
(32,'Photoshop',20112022,'Ayu','27-06-2023','04-07-2023','kembali'),
(34,'Dasar Pemrograman Web: HTML, CSS dan JavaScript',20112022,'Ayu','27-06-2023','04-07-2023','kembali'),
(35,'Dasar Pemrograman Web: HTML, CSS dan JavaScript',20112114,'Kim Mingyu','27-06-2023','04-07-2023','kembali'),
(36,'Cosmos',20112114,'Kim Mingyu','27-06-2023','04-07-2023','kembali'),
(37,'Si Anak Kuat',20112022,'Ayu','27-06-2023','04-07-2023','kembali');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
