-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema basic_ecommerce
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `basic_ecommerce` ;

-- -----------------------------------------------------
-- Schema basic_ecommerce
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `basic_ecommerce` DEFAULT CHARACTER SET utf8 ;
USE `basic_ecommerce` ;

-- -----------------------------------------------------
-- Table `basic_ecommerce`.`bookinventory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `basic_ecommerce`.`bookinventory` ;

CREATE TABLE IF NOT EXISTS `basic_ecommerce`.`bookinventory` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `price` DECIMAL(10,0) NULL DEFAULT NULL,
  `author` VARCHAR(45) NULL DEFAULT NULL,
  `quantity` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `basic_ecommerce`.`customer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `basic_ecommerce`.`customer` ;

CREATE TABLE IF NOT EXISTS `basic_ecommerce`.`customer` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(12) NOT NULL,
  `address` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `basic_ecommerce`.`bookinventoryorder`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `basic_ecommerce`.`bookinventoryorder` ;

CREATE TABLE IF NOT EXISTS `basic_ecommerce`.`bookinventoryorder` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `product_id` INT(11) NULL DEFAULT NULL,
  `customer_id` INT(11) NULL DEFAULT NULL,
  `order_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`ID`),
  INDEX `fk_customer_order_idx` (`customer_id` ASC) ,
  INDEX `fk_product_order_idx` (`product_id` ASC) ,
  CONSTRAINT `fk_customer_order`
    FOREIGN KEY (`customer_id`)
    REFERENCES `basic_ecommerce`.`customer` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_order`
    FOREIGN KEY (`product_id`)
    REFERENCES `basic_ecommerce`.`bookinventory` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
