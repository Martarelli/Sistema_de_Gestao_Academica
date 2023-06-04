DROP SCHEMA IF EXISTS `faculdade` ;
CREATE SCHEMA IF NOT EXISTS `faculdade` DEFAULT CHARACTER SET utf8 ;
USE `faculdade` ;

DROP TABLE IF EXISTS `faculdade`.`usuario` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`usuario` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`codigo`));


DROP TABLE IF EXISTS `faculdade`.`turma` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`turma` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `curso` VARCHAR(45) NOT NULL,
  `semestre` INT(11) NOT NULL,
  `periodo` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`codigo`));

DROP TABLE IF EXISTS `faculdade`.`aluno` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`aluno` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` INT(11) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `turma_codigo` INT(11) NOT NULL,
  PRIMARY KEY (`codigo`, `turma_codigo`),
  CONSTRAINT `fk_aluno_turma`
    FOREIGN KEY (`turma_codigo`)
    REFERENCES `faculdade`.`turma` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

DROP TABLE IF EXISTS `faculdade`.`professor` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`professor` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `data_nasc` DATE NOT NULL,
  PRIMARY KEY (`codigo`));

DROP TABLE IF EXISTS `faculdade`.`disciplina` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`disciplina` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `professor_codigo` INT(11) NOT NULL,
  `turma_codigo` INT(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  CONSTRAINT `fk_disciplina_professor`
    FOREIGN KEY (`professor_codigo`)
    REFERENCES `faculdade`.`professor` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_disciplina_turma`
    FOREIGN KEY (`turma_codigo`)
    REFERENCES `faculdade`.`turma` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

INSERT INTO `faculdade`.`usuario`(login, senha) VALUES ("administrador", "123456");
