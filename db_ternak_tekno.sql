/*
SQLyog Enterprise - MySQL GUI v7.14 
MySQL - 5.5.5-10.1.21-MariaDB : Database - db_ternak_tekno
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_ternak_tekno` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_ternak_tekno`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`) values (1,'admin','fbceddc26e0c6bfe5476b413af9d1b74bf96d1442a3715e4b76684dd633e50899ffcf870419a29158ca9a43812fa3be10d5f78af9d923e2d29b7824eb75053c05iTJ6bBlhNlwtzMmNcns0Qv9TankSmM7YByH2VJ9SsA=');

/*Table structure for table `detail_proyek` */

DROP TABLE IF EXISTS `detail_proyek`;

CREATE TABLE `detail_proyek` (
  `idDetailProyek` int(11) NOT NULL AUTO_INCREMENT,
  `idProyek` int(11) DEFAULT NULL,
  `namaProyek` varchar(100) DEFAULT NULL,
  `jml_invest` int(11) DEFAULT NULL,
  `idInvestor` int(11) DEFAULT NULL,
  `namaInvestor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idDetailProyek`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_proyek` */

/*Table structure for table `investor` */

DROP TABLE IF EXISTS `investor`;

CREATE TABLE `investor` (
  `idInvestor` int(11) NOT NULL AUTO_INCREMENT,
  `namaInvestor` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `nik` varchar(40) DEFAULT NULL,
  `npwp` varchar(40) DEFAULT NULL,
  `saldo_wallet` int(11) DEFAULT NULL,
  PRIMARY KEY (`idInvestor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `investor` */

insert  into `investor`(`idInvestor`,`namaInvestor`,`email`,`no_telp`,`password`,`no_rek`,`nik`,`npwp`,`saldo_wallet`) values (1,'Arif','arif@gmail.com','082922828','fdb00434d5dfd367326c1ef2619dac9a9cb0699d32dfb8d9a6de245c69383132347048986f8f97b480fae834a3554e1b68f2fc4a2f7b8b8a8f0623e8762de10cWJRBoEauT+Axx3VKXBXX6eyTVP3bzmjbmrP3rdBUEQo=','29292929','2929292','222992929',9000000),(2,'aku','aku@gmail.com','101','748a568ce616d5eaed6ef698a4f1c0fb8340e2a36ba3f55abbb4494541e578cfb129a16c97917ecb8781e6a93f3290a3b0df117e923846f7706dc9c0fd549c4cadC3XosyEwj8h3sYRYiM9G7x9DR8ufivwfxtsGJNBhU=','220','440','330',900099900),(3,'Raushan Fikri','raushan@gmail.com','085269522303','79d37abc6c090ac182c9d8c10ad616beebb96227b3877b3dfea3f1fd2d4907d1190804f06226aa9d5f727c11d0b8f568f66f523b74b77da7102b58a9a1272b81ftKBg//stSjDtpKKMdjmqUO0zFjwX0usyf+tkflDGXQ=','10984579348','23452346','12352135',99900099),(4,'siapa','siapa@gmail.com','109828','995483a984c8cac11fc0e340b014ae91f428a7bd83a786dbd215210a0638468712ded69cdd037344290b4743cbb3cdd1edb3a3d6e3da1f3f64fca1e693dc42baNP9b/BaioRs6yV8shrnLqNh6jMP2Ao4+lwYMIdy2/ns=','9999228','2929292','28383883',990000009);

/*Table structure for table `peternak` */

DROP TABLE IF EXISTS `peternak`;

CREATE TABLE `peternak` (
  `idPeternak` int(11) NOT NULL AUTO_INCREMENT,
  `namaPeternak` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `saldo_wallet` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPeternak`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `peternak` */

insert  into `peternak`(`idPeternak`,`namaPeternak`,`email`,`password`,`no_telp`,`no_rek`,`alamat`,`saldo_wallet`) values (1,'glory','glory@gmail.com','ee17e3f3d607b3e7cdb4cdcdfb6f899322dbd106646c429302fb32da2bc31407d06450001fb2b45b968c7cf46104f6c2b4e36cfe6dfe92ec2145170940141d25OGA99XTJZLBmoMr6y9TYKZJzgdCS0ougy9aFGCfEv28=','102102','98181','dimana aja',0),(2,'fikriii','fikrii@gmail.com','fd37f87359c6d4ca833f8dd3ea28aa59d81ce1e001438a6e2b5e13666f79a2432ac884d59f4b8c454a323a5457aab183567eb6888bb65b6e90bafc567badb00d6dGbRaWazhiE4pHV5mIffWshgEt+piGBNz0/DTCvWqA=','090909','989898','dimana ya?',0),(3,'obaaa','lomba@gmail.com','0444bc67674edfb04504aeaebd877cd0e71c6bb09ddc87d5cc0e7d4654b11bb34703be2d3e988ce2a385417279aa6b3994c1522de827d8a627318d3b612ee725/Fcbx5yTtHJPusLGcpBtvsENY7nuyDXKCL/9mI1HzqI=','091881','98383383','mana aja',NULL);

/*Table structure for table `proyek` */

DROP TABLE IF EXISTS `proyek`;

CREATE TABLE `proyek` (
  `id` int(11) NOT NULL,
  `namaProyek` varchar(100) DEFAULT NULL,
  `target_dana` int(11) DEFAULT NULL,
  `minimal_dana` int(11) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `batas_galang` date DEFAULT NULL,
  `mulai_proyek` date DEFAULT NULL,
  `akhir_proyek` date DEFAULT NULL,
  `kategori` smallint(6) DEFAULT NULL,
  `foto_siup` varchar(255) DEFAULT NULL,
  `foto_usaha` varchar(255) DEFAULT NULL,
  `saldo_proyek` int(11) DEFAULT NULL,
  `jml_investor` int(11) DEFAULT NULL,
  `idPeternak` int(11) DEFAULT NULL,
  `estimasi_profit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proyek` */

insert  into `proyek`(`id`,`namaProyek`,`target_dana`,`minimal_dana`,`lokasi`,`deskripsi`,`batas_galang`,`mulai_proyek`,`akhir_proyek`,`kategori`,`foto_siup`,`foto_usaha`,`saldo_proyek`,`jml_investor`,`idPeternak`,`estimasi_profit`) values (1,'TErnak sapi',24000000,2400000,'Lampung tengah','dummy','2018-03-16','2018-07-15','2019-03-15',0,'file_1521087955.jpg','file_15210879551.jpg',0,0,1,0),(2,'ternak sapi afrika',230000000,12000000,'jalan dimana','sapi gerot','2018-03-10','2018-03-17','2018-03-31',0,'file_1520684897.jpg','file_15206848971.jpg',0,0,1,300000000),(4,'ternak kambing gunung',28282828,292929,'salaempat','kabing gunung modern','2018-03-14','2018-06-14','2019-03-14',0,'file_1521030156.jpg','file_15210301561.jpg',0,0,1,0),(5,'ternak kambing gunung',25000000,2500000,'Wakanda','kambing gunung wakanda, tanduk vibranium','2018-04-14','2018-06-14','2018-08-14',0,'file_1521021164.jpg','file_15210211641.jpg',0,0,1,2000000000);

/*Table structure for table `temporary` */

DROP TABLE IF EXISTS `temporary`;

CREATE TABLE `temporary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaProyek` varchar(50) DEFAULT NULL,
  `target_dana` int(11) DEFAULT NULL,
  `minimal_dana` int(11) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `batas_galang` date DEFAULT NULL,
  `mulai_proyek` date DEFAULT NULL,
  `akhir_proyek` date DEFAULT NULL,
  `kategori` smallint(6) DEFAULT NULL,
  `foto_siup` varchar(255) DEFAULT NULL,
  `foto_usaha` varchar(255) DEFAULT NULL,
  `saldo_proyek` int(11) DEFAULT NULL,
  `jml_investor` int(11) DEFAULT NULL,
  `idPeternak` int(11) DEFAULT NULL,
  `estimasi_profit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temporary` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
