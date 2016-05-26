CREATE TABLE IF NOT EXISTS `mydb`.`post` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `message` TEXT NOT NULL,
  `users_id` INT NOT NULL,
  `other_user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_post_users1_idx` (`users_id` ASC),
  INDEX `fk_post_users2_idx` (`other_user_id` ASC),
  CONSTRAINT `fk_post_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_users2`
    FOREIGN KEY (`other_user_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

alter table post add title varchar(255) , NOT NULL
alter table post add created datetime , NOT NULL 
