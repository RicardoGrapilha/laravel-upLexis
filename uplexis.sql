/*
Source Server         : Mysql
Source Host           : localhost:8889
Source Database       : laravel_teste

Autor                 : João Ricardo Grapilha Lopes

Date: 2016-06-17 00:10:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sintegra
-- ----------------------------
DROP TABLE IF EXISTS `sintegra`;
CREATE TABLE `sintegra` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idusuario` int(10) unsigned NOT NULL,
  `cnpj` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `resultado_json` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sintegra_idusuario_foreign` (`idusuario`),
  CONSTRAINT `sintegra_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_usuario_unique` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;