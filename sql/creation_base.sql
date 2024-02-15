
DROP TABLE IF EXISTS `eleve`;
CREATE TABLE `my_school`.`eleve` ( 
`eleve_id` INT NOT NULL AUTO_INCREMENT ,
`prenom` VARCHAR(64) NOT NULL , 
 `nom` VARCHAR(64) NOT NULL ,
  
  `dat_naiss` DATE NOT NULL ,
   `lieu_naiss` VARCHAR(64) NOT NULL ,
  `sexe` VARCHAR(20) NOT NULL ,
  `classe_id` INT NOT NULL ,
  `numero` VARCHAR(64) NOT NULL ,
  `nomP` VARCHAR(64) NOT NULL,
  `prenomP` VARCHAR(64) NOT NULL,
  `numeroP` VARCHAR(64) NOT NULL,
  `photo` BLOB ,
   PRIMARY KEY (`eleve_id`)
  ) ENGINE = MyISAM;

DROP TABLE IF EXISTS `classe`;
CREATE TABLE `my_school`.`classe` ( 
    `classe_id` INT NOT NULL AUTO_INCREMENT ,
     `classe` VARCHAR(28) NOT NULL , PRIMARY KEY (`classe_id`),
     `nombreEleve` INT NOT NULL
     ) ENGINE = MyISAM;


insert into `classe` (`classe`) values 
('1ère Année'),
('2ème Année'),
('3ème Année'),
('4ème Année');
ALTER TABLE `my_school`.`eleve` ADD FOREIGN KEY (classe_id) REFERENCES classe(classe_id) ON DELETE CASCADE;