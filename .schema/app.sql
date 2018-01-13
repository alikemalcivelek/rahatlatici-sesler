-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema app
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema app
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ;
SHOW WARNINGS;
USE `app` ;

-- -----------------------------------------------------
-- Table `app`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullName` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(191) NOT NULL,
  `password` CHAR(60) NOT NULL,
  `rememberToken` CHAR(60) NULL DEFAULT NULL,
  `apiToken` CHAR(60) NULL DEFAULT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC),
  UNIQUE INDEX `apiToken` (`apiToken` ASC),
  INDEX `fullName` (`fullName` ASC),
  INDEX `password` (`password` ASC),
  INDEX `created` (`created` ASC),
  UNIQUE INDEX `rememberToken` (`rememberToken` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `app`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`categories` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoryName` VARCHAR(45) NOT NULL,
  `backgroundImage` VARCHAR(191) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `categoryName` (`categoryName` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `app`.`sounds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`sounds` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoryId` MEDIUMINT(8) UNSIGNED NOT NULL,
  `soundName` VARCHAR(45) NOT NULL,
  `soundFile` VARCHAR(191) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fkx-sounds-categoryId` (`categoryId` ASC),
  INDEX `soundName` (`soundName` ASC),
  CONSTRAINT `fk-sounds-categoryId`
    FOREIGN KEY (`categoryId`)
    REFERENCES `app`.`categories` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `app`.`favorites`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`favorites` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` INT(11) UNSIGNED NOT NULL,
  `soundId` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fkx-favorites-userId` (`userId` ASC),
  INDEX `fkx-favorites-soundId` (`soundId` ASC),
  CONSTRAINT `fk-favorites-userId`
    FOREIGN KEY (`userId`)
    REFERENCES `app`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk-favorites-soundId`
    FOREIGN KEY (`soundId`)
    REFERENCES `app`.`sounds` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `app`.`categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `app`;
INSERT INTO `app`.`categories` (`id`, `categoryName`, `backgroundImage`) VALUES (1, 'Kuş Sesleri', '/storage/images/category-backgrounds/1.jpg');
INSERT INTO `app`.`categories` (`id`, `categoryName`, `backgroundImage`) VALUES (2, 'Piyano Sesleri', '/storage/images/category-backgrounds/2.jpg');
INSERT INTO `app`.`categories` (`id`, `categoryName`, `backgroundImage`) VALUES (3, 'Doğa Sesleri', '/storage/images/category-backgrounds/3.jpg');

COMMIT;


-- -----------------------------------------------------
-- Data for table `app`.`sounds`
-- -----------------------------------------------------
START TRANSACTION;
USE `app`;
INSERT INTO `app`.`sounds` (`id`, `categoryId`, `soundName`, `soundFile`) VALUES (1, 1, 'Kuş Sesi 1', '/storage/sounds/1.mp3');
INSERT INTO `app`.`sounds` (`id`, `categoryId`, `soundName`, `soundFile`) VALUES (2, 2, 'Piyano Sesi 1', '/storage/sounds/2.mp3');
INSERT INTO `app`.`sounds` (`id`, `categoryId`, `soundName`, `soundFile`) VALUES (3, 3, 'Doğa Sesi 1', '/storage/sounds/3.mp3');

COMMIT;

