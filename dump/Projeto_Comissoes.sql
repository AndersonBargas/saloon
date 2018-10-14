-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema comissao
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema comissao
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `comissao` DEFAULT CHARACTER SET utf8 ;
USE `comissao` ;

-- -----------------------------------------------------
-- Table `comissao`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comissao`.`cliente` (
  `idCliente` INT NOT NULL COMMENT 'Chave primaria da tabela',
  `nomeCliente` VARCHAR(45) NOT NULL COMMENT 'Nome do cliente',
  `cpfCliente` INT NOT NULL COMMENT 'CPF do cliente',
  `rgCliente` INT NOT NULL COMMENT 'RG do cliente',
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comissao`.`tabelaComissao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comissao`.`tabelaComissao` (
  `idTabelaComissao` INT NOT NULL COMMENT 'Chave primaria da tabela',
  `descricaoTabelaComissao` VARCHAR(45) NOT NULL COMMENT 'Descricao da Tabela de Comissao',
  PRIMARY KEY (`idTabelaComissao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comissao`.`consorcioCliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comissao`.`consorcioCliente` (
  `idConsorcioCliente` INT NOT NULL COMMENT 'Chave primaria da tabela',
  `codigoGrupoConsorcio` VARCHAR(10) NOT NULL COMMENT 'Grupo do Consorcio',
  `codigoCotaConsorcio` VARCHAR(10) NOT NULL COMMENT 'Cota do Consorcio',
  `valorConsorcio` DOUBLE NOT NULL COMMENT 'Valor do Consorcio',
  `tabelaComissao_idTabelaComissao` INT NOT NULL,
  `cliente_idCliente` INT NOT NULL,
  PRIMARY KEY (`idConsorcioCliente`, `tabelaComissao_idTabelaComissao`, `cliente_idCliente`),
  INDEX `fk_consorcioCliente_tabelaComissao_idx` (`tabelaComissao_idTabelaComissao` ASC),
  INDEX `fk_consorcioCliente_cliente_idx` (`cliente_idCliente` ASC),
  CONSTRAINT `fk_consorcioCliente_tabelaComissao`
    FOREIGN KEY (`tabelaComissao_idTabelaComissao`)
    REFERENCES `comissao`.`tabelaComissao` (`idTabelaComissao`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_consorcioCliente_cliente`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `comissao`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comissao`.`funcao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comissao`.`funcao` (
  `idFuncao` INT NOT NULL COMMENT 'Chave primaria',
  `descricaoFuncao` VARCHAR(45) NOT NULL COMMENT 'Descricao da funcao',
  `ativoFuncao` CHAR(1) NOT NULL DEFAULT 'S' COMMENT 'Ativo/Inativo',
  PRIMARY KEY (`idFuncao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comissao`.`tabelaComissaoFuncao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comissao`.`tabelaComissaoFuncao` (
  `tabelaComissao_idTabelaComissao` INT NOT NULL,
  `funcao_idFuncao` INT NOT NULL,
  `ordemComissao` INT NOT NULL DEFAULT 1 COMMENT 'Ordem de prioridade',
  `percentualComissao` FLOAT NOT NULL COMMENT 'Percentual de comissão',
  PRIMARY KEY (`tabelaComissao_idTabelaComissao`, `funcao_idFuncao`),
  INDEX `fk_tabelaComissaoFuncao_tabelaComissao1_idx` (`tabelaComissao_idTabelaComissao` ASC),
  INDEX `fk_tabelaComissaoFuncao_funcao1_idx` (`funcao_idFuncao` ASC),
  CONSTRAINT `fk_tabelaComissaoFuncao_tabelaComissao1`
    FOREIGN KEY (`tabelaComissao_idTabelaComissao`)
    REFERENCES `comissao`.`tabelaComissao` (`idTabelaComissao`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tabelaComissaoFuncao_funcao1`
    FOREIGN KEY (`funcao_idFuncao`)
    REFERENCES `comissao`.`funcao` (`idFuncao`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;