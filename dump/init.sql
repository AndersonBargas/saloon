-- --------------------------------------------------------
-- Servidor:                     us-cdbr-iron-east-04.cleardb.net
-- Versão do servidor:           5.5.56-log - MySQL Community Server (GPL)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para heroku_a85676cedbf0712
CREATE DATABASE IF NOT EXISTS `heroku_a85676cedbf0712` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `heroku_a85676cedbf0712`;

-- Copiando estrutura para tabela heroku_a85676cedbf0712.historico
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

-- Copiando dados para a tabela heroku_a85676cedbf0712.historico: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historico` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico` ENABLE KEYS */;

-- Copiando estrutura para tabela heroku_a85676cedbf0712.reservas
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` int(10) unsigned NOT NULL,
  `sala` int(10) unsigned NOT NULL,
  `observacao` tinytext NOT NULL,
  `data` date NOT NULL,
  `hora` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reserva_unica` (`data`,`hora`,`usuario`),
  KEY `reserva_usuario_fk` (`usuario`),
  KEY `reserva_sala_fk` (`sala`),
  CONSTRAINT `reserva_sala_fk` FOREIGN KEY (`sala`) REFERENCES `salas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reserva_usuario_fk` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela onde guardaremos todas as reservas de salas.';

-- Copiando dados para a tabela heroku_a85676cedbf0712.reservas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;

-- Copiando estrutura para tabela heroku_a85676cedbf0712.salas
CREATE TABLE IF NOT EXISTS `salas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `lotacao` smallint(5) unsigned NOT NULL,
  `projetor` bit(1) NOT NULL DEFAULT b'0',
  `som` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='Tabela onde salvamos as Salas.';

-- Copiando dados para a tabela heroku_a85676cedbf0712.salas: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `salas` DISABLE KEYS */;
INSERT INTO `salas` (`id`, `nome`, `lotacao`, `projetor`, `som`) VALUES
	(10, 'Stark', 300, b'0', b'0'),
	(11, 'Targaryen', 20000, b'1', b'1'),
	(22, 'Lannister', 200, b'1', b'1');
/*!40000 ALTER TABLE `salas` ENABLE KEYS */;

-- Copiando estrutura para tabela heroku_a85676cedbf0712.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(120) NOT NULL,
  `administrador` bit(1) NOT NULL DEFAULT b'0',
  `criacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8 COMMENT='Tabela com todos os usuários do sistema RoomTrax';

-- Copiando dados para a tabela heroku_a85676cedbf0712.usuarios: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `administrador`, `criacao`) VALUES
	(1, 'Anderson Bargas', 'admin@admin.com', '$2y$13$ToPRR/EFMeCs71g7CfHvaOVULFraO.i6XkWw7e0HYk9SY.w5vVmRS', b'1', '2017-06-13 20:25:58'),
	(72, 'Marty McFly', 'marty.mcfly@bttf.com', '$2y$13$IvuuttEgsxOyAko7QzPhWe5/kBCFiqNiHiQq0l8aUvULnL3tpk1ie', b'0', '2018-05-20 13:24:02'),
	(82, 'Emmett Brown', 'emmett.brown@bttf.com', '$2y$13$dUZX968njHLrRC.08rxdi.rETrV7GHRZI5qXT1wp5CIhsa2tM7pKq', b'0', '2018-05-20 13:24:43'),
	(92, 'Biff Tannen', 'biff.tannen@bttf.com', '$2y$13$gkhXkQmBcHqu9qwStsSRT.QVdp1AbIEiDWyCxK8SG/w1sbOAjerCi', b'0', '2018-05-20 13:25:09'),
	(102, 'Vincent Vega', 'vincent.vega@pulpfiction.com', '$2y$13$Y17iFdm5AimoUD9q89QEUuvWjhNh05r8RQI/TJsjHEeFwI0KYGNue', b'0', '2018-05-20 13:27:09'),
	(112, 'Marsellus Wallace', 'marsellus.wallace@pulpfiction.com', '$2y$13$ay6xzQ3V2.QoneieGSKYOOYjClOTpgHA9.ORlf4khW4adHgMT84IO', b'0', '2018-05-20 13:28:18'),
	(122, 'Mia Wallace', 'mia.wallace@pulpfiction.com', '$2y$13$baJdgn4MD0Xi.SgJHSNpKuQ2pcTWiFmobh3WhlFEiImqHZxm6A7le', b'0', '2018-05-20 13:28:48'),
	(132, 'Antoine Roccamora', 'antoine.roccamora@pulpfiction.com', '$2y$13$CLl1CQ9BPIxH4V/O2q32O.iJr5nlyhFFqqrNU9HqgSOwTr2iz2UR2', b'0', '2018-05-20 13:30:00'),
	(142, 'Butch Coolidge', 'butch.coolidge@pulpfiction.ccom', '$2y$13$qk9lZW5.VSTNXnfRaNV2T.XkT8xbb1Kk5V3ZQ/2axtJxBxTRK0FX6', b'0', '2018-05-20 13:30:32'),
	(152, 'Jules Winnfield', 'jules.winnfield@pulpfiction.com', '$2y$13$yj6r1HfenNgaoqrZ2K0EN.hGRYtX/8AtT4h5J6LQDUMiMvmBd6xvK', b'0', '2018-05-20 13:32:14');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
