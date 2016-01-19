-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sol_empleo
-- ------------------------------------------------------
-- Server version	5.5.44-0+deb8u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aspirantes`
--

DROP TABLE IF EXISTS `aspirantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aspirantes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de aspirante',
  `nombre` varchar(32) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `paterno` varchar(32) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `materno` varchar(32) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_nacimiento` bigint(20) unsigned NOT NULL,
  `nacionalidad` bigint(20) unsigned NOT NULL,
  `religion` bigint(20) unsigned NOT NULL,
  `sexo` bit(1) NOT NULL DEFAULT b'0',
  `estado_civil` bigint(20) unsigned NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_casa` bigint(20) unsigned NOT NULL,
  `vivienda_compartida_con` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `lugar_nacimiento` (`lugar_nacimiento`),
  KEY `nacionalidad` (`nacionalidad`),
  KEY `estado_civil` (`estado_civil`),
  KEY `tipo_casa` (`tipo_casa`),
  KEY `vivienda_compartida_con` (`vivienda_compartida_con`),
  KEY `religion` (`religion`),
  CONSTRAINT `aspirantes_ibfk_1` FOREIGN KEY (`lugar_nacimiento`) REFERENCES `paises` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `aspirantes_ibfk_2` FOREIGN KEY (`nacionalidad`) REFERENCES `paises` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `aspirantes_ibfk_3` FOREIGN KEY (`estado_civil`) REFERENCES `estados_civiles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `aspirantes_ibfk_4` FOREIGN KEY (`tipo_casa`) REFERENCES `tipos_casas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `aspirantes_ibfk_5` FOREIGN KEY (`vivienda_compartida_con`) REFERENCES `cat_vivienda_compartida` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `aspirantes_ibfk_6` FOREIGN KEY (`religion`) REFERENCES `religiones` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cat_vivienda_compartida`
--

DROP TABLE IF EXISTS `cat_vivienda_compartida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_vivienda_compartida` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vivienda_compartida` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dependientes_economicos`
--

DROP TABLE IF EXISTS `dependientes_economicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependientes_economicos` (
  `aspirante` bigint(20) unsigned NOT NULL,
  `tipo` bigint(20) unsigned NOT NULL,
  `cantidad` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estados_civiles`
--

DROP TABLE IF EXISTS `estados_civiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados_civiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `estado_civil` varchar(16) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `leyenda` varchar(16) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paises` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` char(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'MX',
  `pais` varchar(44) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `perfil_menu`
--

DROP TABLE IF EXISTS `perfil_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_menu` (
  `perfil` bigint(20) unsigned NOT NULL,
  `menu` bigint(20) unsigned NOT NULL,
  KEY `perfil` (`perfil`),
  KEY `menu` (`menu`),
  CONSTRAINT `perfil_menu_ibfk_1` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `perfil_menu_ibfk_2` FOREIGN KEY (`menu`) REFERENCES `menu` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `perfil` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `religiones`
--

DROP TABLE IF EXISTS `religiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `religiones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `religion` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telefonos`
--

DROP TABLE IF EXISTS `telefonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefonos` (
  `aspirante` bigint(20) unsigned NOT NULL,
  `tipo_telefono` bigint(20) unsigned NOT NULL,
  `telefono` int(10) unsigned NOT NULL,
  KEY `aspirante` (`aspirante`),
  CONSTRAINT `telefonos_ibfk_1` FOREIGN KEY (`aspirante`) REFERENCES `aspirantes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipo_telefono`
--

DROP TABLE IF EXISTS `tipo_telefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_telefono` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_telefono` varchar(16) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipos_casas`
--

DROP TABLE IF EXISTS `tipos_casas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_casas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_casa` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `password` char(41) COLLATE utf8_spanish_ci DEFAULT NULL,
  `perfil` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `perfil` (`perfil`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-19 15:15:49
