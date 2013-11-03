SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `lojavirtual` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `lojavirtual` ;

-- -----------------------------------------------------
-- Table `lojavirtual`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`usuario` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `sobrenome` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `senha` VARCHAR(128) NULL,
  `rua` VARCHAR(45) NULL,
  `numero` VARCHAR(8) NULL,
  `cidade` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  `pais` VARCHAR(45) NULL,
  `cep` VARCHAR(45) NULL,
  `nascimento` DATE NULL,
  `cpf` VARCHAR(45) NULL,
  `cliente` TINYINT(1) NULL,
  `vendedor` TINYINT(1) NULL,
  `admin` TINYINT(1) NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lojavirtual`.`produto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`produto` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`produto` (
  `idproduto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `descricao` VARCHAR(200) NULL,
  `quantidade` VARCHAR(45) NULL,
  `preco` FLOAT NULL,
  `foto` VARCHAR(100) NULL,
  `datainicio` DATE NULL,
  `datatermino` DATE NULL,
  `tamanholote` INT NULL,
  `precolote` DOUBLE NULL,
  `validadeaposcompra` INT NULL,
  PRIMARY KEY (`idproduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lojavirtual`.`produtodovendedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`produtodovendedor` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`produtodovendedor` (
  `idvendaproduto` INT NOT NULL,
  `idvendedor` INT NOT NULL,
  `idproduto` INT NOT NULL,
  `datacadastro` DATETIME NULL,
  PRIMARY KEY (`idvendaproduto`, `idvendedor`, `idproduto`),
  INDEX `fk_idvendedor_idx` (`idvendedor` ASC),
  INDEX `fk_idproduto_idx` (`idproduto` ASC),
  CONSTRAINT `fk_idvendedor`
    FOREIGN KEY (`idvendedor`)
    REFERENCES `lojavirtual`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_idproduto`
    FOREIGN KEY (`idproduto`)
    REFERENCES `lojavirtual`.`produto` (`idproduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Tabela que relaciona o produto de um determinado vendedor. O /* comment truncated */ /*bs: a relacao eh de 1:n, afinal um vendedor pode ter
n produtos.
Aqui somenta estao presentes usuarios que tenham a coluna vendedor com o valor TRUE*/';


-- -----------------------------------------------------
-- Table `lojavirtual`.`compradocliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`compradocliente` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`compradocliente` (
  `idcompra` INT NOT NULL AUTO_INCREMENT,
  `idcliente` INT NOT NULL,
  `idproduto` INT NOT NULL,
  `quantidade` INT NULL,
  `datahoracompra` DATETIME NULL,
  PRIMARY KEY (`idcompra`, `idcliente`, `idproduto`),
  INDEX `fk_idproduto_idx` (`idproduto` ASC),
  CONSTRAINT `fk_compradocliente_idproduto`
    FOREIGN KEY (`idproduto`)
    REFERENCES `lojavirtual`.`produto` (`idproduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compradocliente_idcliente`
    FOREIGN KEY (`idcliente`)
    REFERENCES `lojavirtual`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Tabela que relaciona o produto de um determinado cliente, at /* comment truncated */ /*raves da relacao 'Compra'. Obs: a relacao eh de 1:n, afinal um cliente pode ter
n produtos.
Aqui somente estao presentes os ids dos usuarios que possuam a coluna 'cliente' com o valor TRUE.
Observacao: Cada compra possui um identificador unico, porem podemos ter o mesmo produto comprado diversas vezes pelo mesmo cliente, 
de modo que cada compra corresponderah a uma entrada diferente na tabela.*/';


-- -----------------------------------------------------
-- Table `lojavirtual`.`produtocliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`produtocliente` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`produtocliente` (
  `idcliente` INT NOT NULL,
  `idproduto` INT NOT NULL,
  `quantidade` INT NULL,
  PRIMARY KEY (`idproduto`, `idcliente`),
  INDEX `fk_idcliente_idx` (`idcliente` ASC),
  INDEX `fk_idproduto_idx` (`idproduto` ASC),
  CONSTRAINT `fk_produtocliente_idcliente`
    FOREIGN KEY (`idcliente`)
    REFERENCES `lojavirtual`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtocliente_idproduto`
    FOREIGN KEY (`idproduto`)
    REFERENCES `lojavirtual`.`produto` (`idproduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Armazena as informacoes dos produtos que cada cliente possui /* comment truncated */ /*.*/';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
