SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `lojavirtual` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `lojavirtual` ;

-- -----------------------------------------------------
-- Table `lojavirtual`.`uf`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`uf` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`uf` (
  `iduf` VARCHAR(2) NOT NULL,
  `nome` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`iduf`))
ENGINE = InnoDB
COMMENT = 'Tabela de UF (Estados)';


-- -----------------------------------------------------
-- Table `lojavirtual`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`pais` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`pais` (
  `idpais` VARCHAR(2) NOT NULL COMMENT 'Código do país de 2 caracteres, conforme norma ISO3166',
  `nome` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idpais`))
ENGINE = InnoDB
COMMENT = 'Tabela que Armazena a lista de países';


-- -----------------------------------------------------
-- Table `lojavirtual`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`usuario` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(128) NOT NULL,
  `endereco` VARCHAR(100) NOT NULL,
  `cidade` VARCHAR(30) NOT NULL,
  `iduf` VARCHAR(2) NOT NULL,
  `idpais` VARCHAR(2) NOT NULL,
  `cep` VARCHAR(8) NULL,
  `nascimento` DATE NULL,
  `cpf` VARCHAR(11) NULL,
  `admin` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`idusuario`),
  INDEX `fk_iduf_idx` (`iduf` ASC),
  INDEX `fk_idpais_idx` (`idpais` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_usuario_uf1`
    FOREIGN KEY (`iduf`)
    REFERENCES `lojavirtual`.`uf` (`iduf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_pais1`
    FOREIGN KEY (`idpais`)
    REFERENCES `lojavirtual`.`pais` (`idpais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lojavirtual`.`produto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`produto` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`produto` (
  `idproduto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `descricao` VARCHAR(1000) NULL,
  `quantidade` VARCHAR(45) NULL,
  `preco` FLOAT NULL,
  `linkfoto` VARCHAR(1000) NULL,
  `datainicio` DATE NULL,
  `datatermino` DATE NULL,
  `tamanholote` INT NULL,
  `precolote` DOUBLE NULL,
  `validadeaposcompra` INT NULL,
  `excluidovendedor` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`idproduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lojavirtual`.`produto_vendedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`produto_vendedor` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`produto_vendedor` (
  `idvendaproduto` INT NOT NULL AUTO_INCREMENT,
  `idvendedor` INT NOT NULL,
  `idproduto` INT NOT NULL,
  `datacadastro` DATETIME NULL,
  PRIMARY KEY (`idvendaproduto`, `idvendedor`, `idproduto`),
  INDEX `fk_idvendedor_idx` (`idvendedor` ASC),
  INDEX `fk_idproduto_idx` (`idproduto` ASC),
  CONSTRAINT `fk_produtovendedor_idvendedor`
    FOREIGN KEY (`idvendedor`)
    REFERENCES `lojavirtual`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtovendedor_idproduto`
    FOREIGN KEY (`idproduto`)
    REFERENCES `lojavirtual`.`produto` (`idproduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Tabela que relaciona o produto de um determinado vendedor. O /* comment truncated */ /*bs: a relacao eh de 1:n, afinal um vendedor pode ter
n produtos.
Aqui somenta estao presentes usuarios que tenham a coluna vendedor com o valor TRUE*/';


-- -----------------------------------------------------
-- Table `lojavirtual`.`compra_cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`compra_cliente` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`compra_cliente` (
  `idcompra` INT NOT NULL AUTO_INCREMENT,
  `idcliente` INT NOT NULL,
  `idproduto` INT NOT NULL,
  `quantidade` INT NULL,
  `datahoracompra` DATETIME NULL,
  PRIMARY KEY (`idcompra`, `idcliente`, `idproduto`),
  INDEX `fk_idproduto_idx` (`idproduto` ASC),
  INDEX `fk_idcliente_idx` (`idcliente` ASC),
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
COMMENT = 'Tabela que relaciona o produto de um determinado cliente, at /* comment truncated */ /*raves da relacao COMPRA. 
Obs: a relacao eh de 1:n, afinal um cliente pode ter n produtos. Aqui somente estao presentes os ids dos usuarios que 
possuam a coluna CLIENTE com o valor TRUE. Observacao: Cada compra possui um identificador unico, porem podemos 
ter o mesmo produto comprado diversas vezes pelo mesmo cliente, de modo que cada compra corresponderah a uma 
entrada diferente na tabela.*/';


-- -----------------------------------------------------
-- Table `lojavirtual`.`produto_cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`produto_cliente` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`produto_cliente` (
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


-- -----------------------------------------------------
-- Table `lojavirtual`.`loja`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lojavirtual`.`loja` ;

CREATE TABLE IF NOT EXISTS `lojavirtual`.`loja` (
  `idloja` INT NOT NULL,
  `razao_social` VARCHAR(100) NOT NULL,
  `nome_fantasia` VARCHAR(100) NOT NULL,
  `CNPJ` VARCHAR(14) NOT NULL,
  `endereco` VARCHAR(100) NOT NULL,
  `cidade` VARCHAR(30) NOT NULL,
  `iduf` VARCHAR(2) NOT NULL,
  `idpais` VARCHAR(2) NOT NULL,
  `CEP` VARCHAR(8) NULL,
  `titulo` VARCHAR(100) NULL COMMENT 'Nome alternativo para aparecer junto com a descrição da loja.',
  `descricao` VARCHAR(300) NULL COMMENT 'Descrição da loja.',
  `foto` VARCHAR(300) NULL COMMENT 'Link para foto da loja.',
  `idvendedor` INT NOT NULL,
  PRIMARY KEY (`idloja`, `idvendedor`),
  INDEX `fk_idvendedor_idx` (`idvendedor` ASC),
  INDEX `fk_idpais_idx` (`idpais` ASC),
  INDEX `fk_iduf_idx` (`iduf` ASC),
  CONSTRAINT `fk_loja_idusuario`
    FOREIGN KEY (`idvendedor`)
    REFERENCES `lojavirtual`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_loja_pais1`
    FOREIGN KEY (`idpais`)
    REFERENCES `lojavirtual`.`pais` (`idpais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_loja_uf1`
    FOREIGN KEY (`iduf`)
    REFERENCES `lojavirtual`.`uf` (`iduf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Tabela com as lojas do Vendedor';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `lojavirtual`.`uf`
-- -----------------------------------------------------
START TRANSACTION;
USE `lojavirtual`;
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('AC', 'Acre');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('AL', 'Alagoas');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('AP', 'Amapá');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('AM', 'Amazonas');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('BA', 'Bahia');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('CE', 'Ceará');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('DF', 'Distrito Federal');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('ES', 'Espírito Santo');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('GO', 'Goiás');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('MA', 'Maranhão');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('MT', 'Mato Grosso');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('MS', 'Mato Grosso do Sul');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('MG', 'Minas Gerais');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('PA', 'Pará');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('PB', 'Paraíba');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('PR', 'Paraná');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('PE', 'Pernambuco');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('PI', 'Piauí');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('RJ', 'Rio de Janeiro');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('RN', 'Rio Grande do Norte');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('RS', 'Rio Grande do Sul');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('RO', 'Rondônia');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('RR', 'Roraima');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('SC', 'Santa Catarina');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('SP', 'São Paulo');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('SE', 'Sergipe');
INSERT INTO `lojavirtual`.`uf` (`iduf`, `nome`) VALUES ('TO', 'Tocantins');

COMMIT;


-- -----------------------------------------------------
-- Data for table `lojavirtual`.`pais`
-- -----------------------------------------------------
START TRANSACTION;
USE `lojavirtual`;
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AF', 'Afeganistão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ZA', 'África do Sul');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AL', 'Albânia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('DE', 'Alemanha');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AD', 'Andorra');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AO', 'Angola');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AI', 'Anguilla');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AQ', 'Antártida');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AG', 'Antígua e Barbuda');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AN', 'Antilhas Holandesas');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SA', 'Arábia Saudita');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('DZ', 'Argélia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AR', 'Argentina');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AM', 'Armênia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AW', 'Aruba');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AU', 'Austrália');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AT', 'Áustria');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AZ', 'Azerbaijão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BS', 'Bahamas');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BH', 'Bahrein');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BD', 'Bangladesh');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BB', 'Barbados');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BY', 'Belarus');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BE', 'Bélgica');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BZ', 'Belize');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BJ', 'Benin');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BM', 'Bermudas');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BO', 'Bolívia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BA', 'Bósnia-Herzegóvina');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BW', 'Botsuana');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BR', 'Brasil');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BN', 'Brunei');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BG', 'Bulgária');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BF', 'Burkina Fasso');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BI', 'Burundi');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BT', 'Butão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CV', 'Cabo Verde');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CM', 'Camarões');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KH', 'Camboja');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CA', 'Canadá');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KZ', 'Cazaquistão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TD', 'Chade');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CL', 'Chile');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CN', 'China');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CY', 'Chipre');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SG', 'Cingapura');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CO', 'Colômbia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CG', 'Congo');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KP', 'Coréia do Norte');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KR', 'Coréia do Sul');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CI', 'Costa do Marfim');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CR', 'Costa Rica');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('HR', 'Croácia (Hrvatska)');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CU', 'Cuba');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('DK', 'Dinamarca');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('DJ', 'Djibuti');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('DM', 'Dominica');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('EG', 'Egito');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SV', 'El Salvador');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AE', 'Emirados Árabes Unidos');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('EC', 'Equador');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ER', 'Eritréia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SK', 'Eslováquia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SI', 'Eslovênia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ES', 'Espanha');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('US', 'Estados Unidos');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('EE', 'Estônia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ET', 'Etiópia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('FJ', 'Fiji');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PH', 'Filipinas');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('FI', 'Finlândia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('FR', 'França');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GA', 'Gabão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GM', 'Gâmbia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GH', 'Gana');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GE', 'Geórgia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GI', 'Gibraltar');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GB', 'Grã-Bretanha (Reino Unido, UK)');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GD', 'Granada');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GR', 'Grécia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GL', 'Groelândia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GP', 'Guadalupe');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GU', 'Guam (Território dos Estados Unidos)');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GT', 'Guatemala');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('G', 'Guernsey');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GY', 'Guiana');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GF', 'Guiana Francesa');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GN', 'Guiné');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GQ', 'Guiné Equatorial');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GW', 'Guiné-Bissau');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('HT', 'Haiti');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NL', 'Holanda');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('HN', 'Honduras');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('HK', 'Hong Kong');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('HU', 'Hungria');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('YE', 'Iêmen');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BV', 'Ilha Bouvet (Território da Noruega)');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('IM', 'Ilha do Homem');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CX', 'Ilha Natal');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PN', 'Ilha Pitcairn');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('RE', 'Ilha Reunião');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AX', 'Ilhas Aland');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KY', 'Ilhas Cayman');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CC', 'Ilhas Cocos');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KM', 'Ilhas Comores');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CK', 'Ilhas Cook');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('FO', 'Ilhas Faroes');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('FK', 'Ilhas Falkland (Malvinas)');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('GS', 'Ilhas Geórgia do Sul e Sandwich do Sul');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('HM', 'Ilhas Heard e McDonald (Território da Austrália)');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MP', 'Ilhas Marianas do Norte');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MH', 'Ilhas Marshall');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('UM', 'Ilhas Menores dos Estados Unidos');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NF', 'Ilhas Norfolk');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SC', 'Ilhas Seychelles');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SB', 'Ilhas Solomão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SJ', 'Ilhas Svalbard e Jan Mayen');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TK', 'Ilhas Tokelau');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TC', 'Ilhas Turks e Caicos');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('VI', 'Ilhas Virgens (Estados Unidos)');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('VG', 'Ilhas Virgens (Inglaterra)');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('WF', 'Ilhas Wallis e Futuna');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('IN', 'índia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ID', 'Indonésia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('IR', 'Irã');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('IQ', 'Iraque');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('IE', 'Irlanda');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('IS', 'Islândia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('IL', 'Israel');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('IT', 'Itália');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('JM', 'Jamaica');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('JP', 'Japão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('JE', 'Jersey');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('JO', 'Jordânia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KE', 'Kênia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KI', 'Kiribati');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KW', 'Kuait');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LA', 'Laos');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LV', 'Látvia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LS', 'Lesoto');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LB', 'Líbano');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LR', 'Libéria');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LY', 'Líbia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LI', 'Liechtenstein');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LT', 'Lituânia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LU', 'Luxemburgo');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MO', 'Macau');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MK', 'Macedônia (República Yugoslava)');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MG', 'Madagascar');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MY', 'Malásia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MW', 'Malaui');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MV', 'Maldivas');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ML', 'Mali');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MT', 'Malta');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MA', 'Marrocos');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MQ', 'Martinica');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MU', 'Maurício');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MR', 'Mauritânia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('YT', 'Mayotte');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MX', 'México');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('FM', 'Micronésia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MZ', 'Moçambique');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MD', 'Moldova');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MC', 'Mônaco');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MN', 'Mongólia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ME', 'Montenegro');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MS', 'Montserrat');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MM', 'Myanma');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NA', 'Namíbia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NR', 'Nauru');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NP', 'Nepal');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NI', 'Nicarágua');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NE', 'Níger');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NG', 'Nigéria');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NU', 'Niue');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NO', 'Noruega');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NC', 'Nova Caledônia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('NZ', 'Nova Zelândia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('OM', 'Omã');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PW', 'Palau');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PA', 'Panamá');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PG', 'Papua-Nova Guiné');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PK', 'Paquistão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PY', 'Paraguai');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PE', 'Peru');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PF', 'Polinésia Francesa');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PL', 'Polônia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PR', 'Porto Rico');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PT', 'Portugal');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('QA', 'Qatar');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KG', 'Quirguistão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CF', 'República Centro-Africana');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CD', 'República Democrática do Congo');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('DO', 'República Dominicana');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CZ', 'República Tcheca');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('RO', 'Romênia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('RW', 'Ruanda');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('RU', 'Rússia (antiga URSS) - Federação Russa');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('EH', 'Saara Ocidental');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('VC', 'Saint Vincente e Granadinas');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('AS', 'Samoa Ocidental');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('WS', 'Samoa Ocidental');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SM', 'San Marino');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SH', 'Santa Helena');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LC', 'Santa Lúcia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('BL', 'São Bartolomeu');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('KN', 'São Cristóvão e Névis');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('MF', 'São Martim');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ST', 'São Tomé e Príncipe');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SN', 'Senegal');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SL', 'Serra Leoa');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('RS', 'Sérvia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SY', 'Síria');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SO', 'Somália');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('LK', 'Sri Lanka');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PM', 'St. Pierre and Miquelon');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SZ', 'Suazilândia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SD', 'Sudão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SE', 'Suécia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('CH', 'Suíça');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('SR', 'Suriname');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TJ', 'Tadjiquistão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TH', 'Tailândia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TW', 'Taiwan');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TZ', 'Tanzânia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('IO', 'Território Britânico do Oceano índico');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TF', 'Territórios do Sul da França');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('PS', 'Territórios Palestinos Ocupados');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TP', 'Timor Leste');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TG', 'Togo');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TO', 'Tonga');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TT', 'Trinidad and Tobago');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TN', 'Tunísia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TM', 'Turcomenistão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TR', 'Turquia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('TV', 'Tuvalu');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('UA', 'Ucrânia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('UG', 'Uganda');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('UY', 'Uruguai');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('UZ', 'Uzbequistão');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('VU', 'Vanuatu');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('VA', 'Vaticano');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('VE', 'Venezuela');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('VN', 'Vietnã');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ZM', 'Zâmbia');
INSERT INTO `lojavirtual`.`pais` (`idpais`, `nome`) VALUES ('ZW', 'Zimbábue');

COMMIT;

