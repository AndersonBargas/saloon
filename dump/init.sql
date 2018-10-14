-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.5.56-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para saloon
DROP DATABASE IF EXISTS `saloon`;
CREATE DATABASE IF NOT EXISTS `saloon` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `saloon`;

-- Copiando estrutura para tabela saloon.historico
DROP TABLE IF EXISTS `historico`;
CREATE TABLE IF NOT EXISTS `historico` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsuario` int(10) unsigned NOT NULL,
  `dataHistorico` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `host` varchar(90) NOT NULL,
  `navegador` varchar(130) NOT NULL,
  `comentario` varchar(80) NOT NULL,
  `url` varchar(220) NOT NULL,
  `detalhes` mediumtext,
  PRIMARY KEY (`id`),
  KEY `historico_usuario_fk` (`idUsuario`),
  CONSTRAINT `historico_usuario_fk` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela onde para guardarmos todas as ações geradas dentro do sistema.';

-- Copiando dados para a tabela saloon.historico: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historico` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico` ENABLE KEYS */;

-- Copiando estrutura para tabela saloon.perfis
DROP TABLE IF EXISTS `perfis`;
CREATE TABLE IF NOT EXISTS `perfis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `criacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela saloon.perfis: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `perfis` DISABLE KEYS */;
INSERT INTO `perfis` (`id`, `nome`, `criacao`) VALUES
	(1, 'Administrador', '2018-10-13 17:12:16'),
	(2, 'Vendedor', '2018-10-13 18:09:42');
/*!40000 ALTER TABLE `perfis` ENABLE KEYS */;

-- Copiando estrutura para tabela saloon.permissoes
DROP TABLE IF EXISTS `permissoes`;
CREATE TABLE IF NOT EXISTS `permissoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPerfil` int(10) unsigned NOT NULL,
  `controlador` varchar(150) NOT NULL,
  `acao` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permissoes_perfis_fk` (`idPerfil`),
  CONSTRAINT `permissoes_perfis_fk` FOREIGN KEY (`idPerfil`) REFERENCES `perfis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela saloon.permissoes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;

-- Copiando estrutura para tabela saloon.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(120) NOT NULL,
  `idPerfil` int(10) unsigned NOT NULL,
  `criacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `usuarios_perfis_fk` (`idPerfil`),
  CONSTRAINT `usuarios_perfis_fk` FOREIGN KEY (`idPerfil`) REFERENCES `perfis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COMMENT='Tabela com todos os usuários do sistema RoomTrax';

-- Copiando dados para a tabela saloon.usuarios: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `idPerfil`, `criacao`) VALUES
	(194, 'Anderson', 'admin@admin.com', '$2y$13$ToPRR/EFMeCs71g7CfHvaOVULFraO.i6XkWw7e0HYk9SY.w5vVmRS', 1, '2018-10-13 17:13:01');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
