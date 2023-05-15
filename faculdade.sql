DROP SCHEMA IF EXISTS `faculdade` ;
CREATE SCHEMA IF NOT EXISTS `faculdade` DEFAULT CHARACTER SET utf8 ;
USE `faculdade` ;

DROP TABLE IF EXISTS `faculdade`.`turma` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`turma` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `periodo` INT(11) NOT NULL,
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

DROP TABLE IF EXISTS `faculdade`.`disciplina` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`disciplina` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `turma_codigo` INT(11) NOT NULL,
  PRIMARY KEY (`codigo`, `turma_codigo`),
  CONSTRAINT `fk_disciplina_turma1`
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
  `disciplina_codigo` INT(11) NOT NULL,
  PRIMARY KEY (`codigo`, `disciplina_codigo`),
  CONSTRAINT `fk_professor_disciplina1`
    FOREIGN KEY (`disciplina_codigo`)
    REFERENCES `faculdade`.`disciplina` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
