/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.28-MariaDB : Database - incidencias
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`incidencias` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `incidencias`;

/*Table structure for table `cat_adscripcion` */

DROP TABLE IF EXISTS `cat_adscripcion`;

CREATE TABLE `cat_adscripcion` (
  `id_ads` int(2) NOT NULL AUTO_INCREMENT,
  `cve_area` varchar(10) NOT NULL,
  `adscripcion` varchar(150) NOT NULL,
  KEY `id` (`id_ads`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cat_adscripcion` */

insert  into `cat_adscripcion`(`id_ads`,`cve_area`,`adscripcion`) values (1,'09NC014000','Direccion Juridica'),(2,'09NC014001','Coordinacion Administrativa'),(3,'09NC014010','Division de Seguimiento y Apoyo A Proyectos'),(4,'09NC014A00','Unidad de Investigaciones y Procesos Juridicos'),(5,'09NC014A10','Coordinacion de Asuntos Contenciosos'),(6,'09NC014AC0','Coordinacion Tecnica de Control Constitucional'),(7,'09NC014AC1','Division de Asuntos Fiscales y Administrativos'),(8,'09NC014AC2','Division de Amparos Fiscales y Administrativos'),(9,'09NC014A12','Division de Asuntos Civiles'),(10,'09NC014A20','Coordinacion de Investigacion y Asuntos de defraudacion'),(11,'09NC014AA0','Coordinacion Tecnica de Control, Investigaciones y Procesos Penales'),(12,'09NC014AA1','Division de Investigacion E Integracion Documental'),(13,'09NC014AA2','Division de Control de Procedimientos'),(14,'09NC014AA3','Division de Procesos, Recursos y Amparos'),(15,'09NC014AA4','Division de Analisis y Formulacion de denuncias'),(16,'09NC014A30','Coordinacion Laboral'),(17,'09NC014A31','Division \"A\" de Juicios Laborales'),(18,'09NC014A32','Division \"B\" de Juicios Laborales'),(19,'09NC014A33','Division de Investigaciones Laborales, Amparos y Juicios Foraneos'),(20,'09NC014AB0','Coordinacion de Evaluacion de Procesos Juridicos'),(21,'09NC014AB1','Division de Analisis y Control de Procesos Juridicos'),(22,'09NC014AB2','Division de Informacion Estadistica Juridica'),(23,'09NC014B00','Unidad de Asuntos Consultivos y de Atencion A Organos Fiscalizadores'),(24,'09NC014B10','Coordinacion de Legislacion y Consulta'),(25,'09NC014B11','Division de Notariado y Operaciones Inmobiliarias'),(26,'09NC014B12','Division de Dictamen Juridico de Contratos y Convenios'),(27,'09NC014B13','Division de Apoyo Tecnico Legal'),(28,'09NC014B14','Division de Asuntos Consultivos'),(29,'09NC014B15','Division de Legislacion y Estudios Juridicos'),(30,'09NC014B30','Coordinacion de Atencion A Organos Fiscalizadores'),(31,'09NC014B31','Division de Atencion A Organos Fiscalizadores'),(32,'09NC014B32','Division de Analisis Supervision y Evaluacion de Resultados de Auditorias'),(33,'09NC014C20','Coord Atn A Quejas E Informacion Publica'),(34,'09NC014D00','Unidad de derechos Humanos'),(35,'09NC014DA0','Coordinacion Tecnica de Politica Institucional En derechos Humanos'),(36,'09NC014DA1','Division de Implementacion y Seguimiento de La Politica Institucional En derechos Humanos'),(37,'09NC014DA2','Division de Formacion En derechos Humanos'),(38,'09NC014DA3','Division de Vinculación Institucional En Materia de derechos Humanos'),(39,'09NC014DA4','Division de Seguimiento Con La Sociedad Civil'),(40,'09NC014D10','Coordinacion de Atencion A Quejas y Casos Especiales'),(41,'09NC014D11','Division de Atencion y Seguimiento A Casos Especiales '),(42,'09NC014D15','Division de Atencion A Quejas En Materia de derechos Humanos'),(43,'09NC014D13','División Estadística y Evaluación En Materia de derechos Humanos'),(44,'09NC014D12','Div de Centro de Atn Inmed Casos Espec'),(45,'09NC014D14','Division de Atencion A Quejas Medicas'),(46,'09NC014D20','Coordinacion de Igualdad , Genero E Inclusión'),(47,'09NC014D21','Division de Transversalizacion de La  Igualdad'),(48,'09NC014D22','Division Para El Fortalecimiento de La Cultura Institucional de La Igualdad'),(49,'09NC014D23','Division de Atencion y Seguimiento A Grupos En Situación de Vulnerabilidad'),(50,'09NC014D24','Division Para El Fortalecimiento de La Cultura de Inclusión');

/*Table structure for table `cat_folios` */

DROP TABLE IF EXISTS `cat_folios`;

CREATE TABLE `cat_folios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(11) NOT NULL,
  `desc_area` varchar(255) NOT NULL,
  `clave_adsc` varchar(50) NOT NULL,
  `nombre_adscripcion` varchar(255) NOT NULL,
  `clave_ip` varchar(50) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `inicio` bigint(70) NOT NULL,
  `fin` bigint(70) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `cat_folios` */

insert  into `cat_folios`(`id`,`id_area`,`desc_area`,`clave_adsc`,`nombre_adscripcion`,`clave_ip`,`localidad`,`inicio`,`fin`) values (1,1,'CAMELOT','09NC014000','CAMELOT','12345678900','CONOCIDA',500000,500770),(2,3,'UTOPIA','09NC014010','UTOPIA','12345678900','CONOCIDA',500771,501541),(3,4,'ZENDA','09NC014A00','ZENDA','12345678900','CONOCIDA',501542,502312),(4,5,'TIERRA MEDIA','09NC014A10','TIERRA MEDIA','12345678900','CONOCIDA',570000,595000),(44,15,'EL CASTILLO DE IF','09NC014DA4','EL CASTILLO DE IF','12345678900','CONOCIDA',515885,516078);

/*Table structure for table `datos_incidencia` */

DROP TABLE IF EXISTS `datos_incidencia`;

CREATE TABLE `datos_incidencia` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(100) NOT NULL,
  `horario` varchar(75) NOT NULL,
  `desc_horario` varchar(20) DEFAULT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `folio` varchar(10) NOT NULL,
  `fecha_de_incidencia` date NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `matricula` int(10) NOT NULL,
  `cve_ads` varchar(70) NOT NULL,
  `adscripcion` varchar(150) NOT NULL,
  `micro` varchar(4) NOT NULL,
  `a_partir` varchar(150) DEFAULT NULL,
  `ocurrir` varchar(300) DEFAULT NULL,
  `motivo` varchar(600) DEFAULT NULL,
  `jefe_inmediato` varchar(200) NOT NULL,
  `responsable_personal` varchar(200) NOT NULL,
  `turno` varchar(30) NOT NULL,
  `fecha_de_alta` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `datos_incidencia` */

insert  into `datos_incidencia`(`id`,`tipo_documento`,`horario`,`desc_horario`,`asunto`,`folio`,`fecha_de_incidencia`,`nombre`,`categoria`,`matricula`,`cve_ads`,`adscripcion`,`micro`,`a_partir`,`ocurrir`,`motivo`,`jefe_inmediato`,`responsable_personal`,`turno`,`fecha_de_alta`) values (1,'JUSTIFICACION POR OMISION DE REGISTRO','Salida','9.00  A 17.00',NULL,'500000','2024-02-16','BENNET ELIZABETH','JEFE AREA NIVEL CENTRAL E0',987654321,'09NC014000','CAMELOT','M021',NULL,NULL,'JUNTA','Isaac Newton','JUANITO PEREZ','VESPERTINO','2024-04-05');

/*Table structure for table `personal_valida` */

DROP TABLE IF EXISTS `personal_valida`;

CREATE TABLE `personal_valida` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `id_ads` int(2) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `personal_valida` */

insert  into `personal_valida`(`id`,`id_ads`,`nombre_completo`) values (1,1,'Juan Perez Hernandez'),(2,2,'Jacinto Bolaños'),(3,2,'Susana Quintero'),(4,2,'Berenice Garcia'),(5,2,'Shakira Benitez'),(6,2,'Gerard Pique'),(7,2,'Albert Einstein'),(8,3,'Isaac Newton'),(9,4,'Marie Curie'),(11,5,'Galileo Gailei'),(12,5,'Gregor Mendel'),(13,5,'Charles Darwin'),(14,5,'Nikola Tesla'),(15,5,'Luis Pasteur'),(16,6,'Lise Meitner'),(17,7,'Stephen Hawking'),(18,8,'Ada Lovelace'),(19,9,'Benjamin Franklin'),(20,10,'Margarita Salas'),(21,11,'Arquimedes'),(22,12,'Nicolás Copernico'),(23,13,'Barbara McClintock'),(24,14,'Tomas Young'),(25,15,'Leornardo Da Vinci'),(26,16,'Thomas Alva Edison'),(27,16,'Aristoles Rene Descartes'),(29,16,'John Dalton ');

/*Table structure for table `principal` */

DROP TABLE IF EXISTS `principal`;

CREATE TABLE `principal` (
  `id_trabajador` int(2) NOT NULL AUTO_INCREMENT,
  `cve_ads` varchar(20) NOT NULL,
  `nom_ads` varchar(255) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `desc_contratacion` varchar(255) NOT NULL,
  `matricula` int(10) NOT NULL,
  `ocupante` varchar(255) NOT NULL,
  `cve_ctg` int(8) NOT NULL,
  `desc_categoria` varchar(255) NOT NULL,
  `plaza` int(5) NOT NULL,
  `desc_plaza` varchar(255) NOT NULL,
  `desc_marca_ocupacion` varchar(78) NOT NULL,
  `fecha_ocupacion` date NOT NULL,
  `desc_horario` varchar(20) NOT NULL,
  `turno` varchar(30) NOT NULL,
  `ant_anos` int(2) NOT NULL,
  `ant_qnas` int(11) NOT NULL,
  `salario_mens_int` decimal(10,0) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `curp` varchar(18) NOT NULL,
  `numafil` int(11) NOT NULL,
  `micro` varchar(4) NOT NULL,
  PRIMARY KEY (`id_trabajador`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `principal` */

insert  into `principal`(`id_trabajador`,`cve_ads`,`nom_ads`,`localidad`,`desc_contratacion`,`matricula`,`ocupante`,`cve_ctg`,`desc_categoria`,`plaza`,`desc_plaza`,`desc_marca_ocupacion`,`fecha_ocupacion`,`desc_horario`,`turno`,`ant_anos`,`ant_qnas`,`salario_mens_int`,`rfc`,`curp`,`numafil`,`micro`) values (1,'09NC014000','CAMELOT','CONOCIDA','ESTATUTO A',123456789,'SALANDER LISBETH ',36210680,'COORD PROYECTO E1',23212,'ESTATUTO','DEFINITIVA ESTAT.','0000-00-00','9.00  A 17.00','MATUTINO',0,0,1,'RFCKWE3456TG3','CURPGENERICORRLJ00',2147483647,'M021'),(2,'09NC014000','CAMELOT','CONOCIDA','ESTATUTO A',987654321,'BENNET ELIZABETH',37310980,'JEFE AREA NIVEL CENTRAL E0',6622,'ESTATUTO','DEFINITIVA ESTAT.','0000-00-00','9.00  A 17.00','VESPERTINO',0,0,1,'RFCKWE3456TG3','CURPGENERICORRLJ00',2147483647,'M021'),(6,'09NC014000','CAMELOT','CONOCIDA','CONFIANZA',112233445,'WHEELER FRANK',10001480,'N50 LIDER PROYECTO A 80',28669,'CONFIANZA','DEFINITIVA','0000-00-00','9.00  A 17.00','MATUTINO',0,0,1,'RFCKWE3456TG3','CURPGENERICORRLJ00',2147483647,'M021'),(21,'09NC014010','UTOPIA','CONOCIDA','ESTATUTO A',223344556,'OLAF CONDE',37310980,'JEFE AREA NIVEL CENTRAL E0',21079,'ESTATUTO','DEFINITIVA ESTAT.','0000-00-00','9.00  A 17.00','MATUTINO',0,0,1,'RFCKWE3456TG3','CURPGENERICORRLJ00',2147483647,'M021'),(37,'09NC014010','UTOPIA','CONOCIDA','CONFIANZA',445566778,'MALFOY DRACO',12010980,'N31 ANALISTA B 80',26774,'CONFIANZA','DEFINITIVA','0000-00-00','9.00  A 17.00','MATUTINO',0,0,1,'RFCKWE3456TG3','CURPGENERICORRLJ00',2147483647,'M021'),(46,'09NC014001','UTOPIA','CONOCIDA','BASE',667788991,'COIN ALMA',22760280,'OF DE SERVS ADMVOS 80',9635,'BASE','DEFINITIVA','0000-00-00','14.00 A 21.30 JORNAD','VESPERTINO',0,0,1,'RFCKWE3456TG3','CURPGENERICORRLJ00',2147483647,'M021'),(57,'09NC014A00','ZENDA','CONOCIDA','ESTATUTO A',778899112,'SCHMITZ HANNA',35210180,'ANALISTA SUPERVISOR E2',25607,'ESTATUTO','DEFINITIVA ESTAT.','0000-00-00','9.00  A 17.00','MATUTINO',0,0,1,'RFCKWE3456TG3','CURPGENERICORRLJ00',2147483647,'M003'),(73,'09NC014A10','TIERRA MEDIA','CONOCIDA','ESTATUTO A',889911223,'ALLAN POE EDGAR',33310380,'ASISTENTE INFORMACION E2',24075,'ESTATUTO','DEFINITIVA ESTAT.','0000-00-00','9.00  A 17.00','MATUTINO',0,0,1,'RFCKWE3456TG3','CURPGENERICORRLJ00',2147483647,'M003'),(165,'09NC014DA4','EL CASTILLO DE IF','CONOCIDA','BASE',991122334,'DICKENS CHARLES',24760280,'JEFE GPO SERVS ADMVOS 80',9708,'BASE','DEFINITIVA','0000-00-00','8.00  A 16.00','VESPERTINO',0,0,1,'RFCKWE3456TG3','CURPGENERICORRLJ00',2147483647,'M021');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
