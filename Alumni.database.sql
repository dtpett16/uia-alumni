-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS mydb DEFAULT CHARACTER SET UTF8 ;

USE mydb ;

DROP TABLE IF EXISTS News;
DROP TABLE IF EXISTS Institute;
DROP TABLE IF EXISTS FieldOfStudy;
DROP TABLE IF EXISTS a_Event;
DROP TABLE IF EXISTS CourseMaterial;
DROP TABLE IF EXISTS AlumniList;
DROP TABLE IF EXISTS UiaStaff;
DROP TABLE IF EXISTS Alumni;

-- -----------------------------------------------------
-- Table a_Events
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS a_Events (
  eventsID INT NOT NULL,
  startDate DATETIME(6) NOT NULL,
  endDate DATETIME(6) NOT NULL,
  location VARCHAR(45) NOT NULL,
  info VARCHAR(200) NOT NULL,
  PRIMARY KEY (eventsID))
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table FieldOfStudy
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS FieldOfStudy (
  FoSID INT NOT NULL,
  FoSName VARCHAR(45) NULL,
  PRIMARY KEY (FoSID))
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table Institute
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Institute (
  InstituteID INT NOT NULL,
  InstituteName VARCHAR(45) NULL,
  FieldOfStudy_FoSID INT NOT NULL,
  PRIMARY KEY (InstituteID, FieldOfStudy_FoSID),
  INDEX fk_Institute_FieldOfStudy1_idx (FieldOfStudy_FoSID ASC),
  CONSTRAINT fk_Institute_FieldOfStudy1
    FOREIGN KEY (FieldOfStudy_FoSID)
    REFERENCES FieldOfStudy (FoSID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table Alumni
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Alumni (
  AlumniID INT NOT NULL AUTO_INCREMENT,
  AlumniName VARCHAR(45) NULL,
  AlumniDegree VARCHAR(45) NULL,
  AlumniInstitute VARCHAR(45) NULL,
  AlumniTlf INT NULL,
  AlumniEmail VARCHAR(45) NULL,
  AlumniMunicipality VARCHAR(45) NULL,
  PRIMARY KEY (AlumniID))
ENGINE = INNODB;




-- -----------------------------------------------------
-- Table UiaStaff
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS UiaStaff (
  US_ID INT NOT NULL,
  US_Name VARCHAR(45) NULL,
  US_Faculty VARCHAR(45) NULL,
  US_Tlf INT NULL,
  US_Epost VARCHAR(45) NULL,
  US_Role VARCHAR(45) NULL,
  PRIMARY KEY (US_ID))
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table News
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS News (
  NewsID INT NOT NULL,
  NewsTitle VARCHAR(50) NULL,
  NewsStory VARCHAR(500) NULL,
  NewsDate DATE NULL,
  Alumni_AlumniID INT NOT NULL,
  UiaStaff_US_ID INT NOT NULL,
  PRIMARY KEY (NewsID),
  INDEX fk_News_Alumni1_idx (Alumni_AlumniID ASC),
  INDEX fk_News_UiaStaff1_idx (UiaStaff_US_ID ASC),
  CONSTRAINT fk_News_Alumni1
    FOREIGN KEY (Alumni_AlumniID)
    REFERENCES Alumni (AlumniID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_News_UiaStaff1
    FOREIGN KEY (UiaStaff_US_ID)
    REFERENCES UiaStaff (US_ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table CourseMaterial
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS CourseMaterial (
  CM_ID INT NOT NULL,
  CM_Contents VARCHAR(45) NULL,
  Alumni_AlumniID INT NOT NULL,
  PRIMARY KEY (CM_ID, Alumni_AlumniID),
  CONSTRAINT fk_CourseMaterial_Alumni1
    FOREIGN KEY (Alumni_AlumniID)
    REFERENCES Alumni (AlumniID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table AlumniList
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS AlumniList (
  Alumni_AlumniID INT NOT NULL,
  AlumniOverview VARCHAR(45) NULL,
  UiaStaff_US_ID INT NOT NULL,
  PRIMARY KEY (Alumni_AlumniID, UiaStaff_US_ID),
  CONSTRAINT fk_AlumniList_Alumni1
    FOREIGN KEY (Alumni_AlumniID)
    REFERENCES Alumni (AlumniID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_AlumniList_UiaStaff1
    FOREIGN KEY (UiaStaff_US_ID)
    REFERENCES UiaStaff (US_ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table events_has_FieldOfStudy
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS events_has_FieldOfStudy (
  events_eventsID INT NOT NULL,
  FieldOfStudy_FoSID INT NOT NULL,
  PRIMARY KEY (events_eventsID, FieldOfStudy_FoSID),
  INDEX fk_events_has_FieldOfStudy_FieldOfStudy1_idx (FieldOfStudy_FoSID ASC),
  INDEX fk_events_has_FieldOfStudy_events1_idx (events_eventsID ASC),
  CONSTRAINT fk_events_has_FieldOfStudy_events1
    FOREIGN KEY (events_eventsID)
    REFERENCES a_Events (eventsID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_events_has_FieldOfStudy_FieldOfStudy1
    FOREIGN KEY (FieldOfStudy_FoSID)
    REFERENCES FieldOfStudy (FoSID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table UiaStaff_has_a_Events
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS UiaStaff_has_a_Events (
  UiaStaff_US_ID INT NOT NULL,
  a_Events_eventsID INT NOT NULL,
  PRIMARY KEY (UiaStaff_US_ID, a_Events_eventsID),
  INDEX fk_UiaStaff_has_a_Events_a_Events1_idx (a_Events_eventsID ASC),
  INDEX fk_UiaStaff_has_a_Events_UiaStaff1_idx (UiaStaff_US_ID ASC),
  CONSTRAINT fk_UiaStaff_has_a_Events_UiaStaff1
    FOREIGN KEY (UiaStaff_US_ID)
    REFERENCES UiaStaff (US_ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_UiaStaff_has_a_Events_a_Events1
    FOREIGN KEY (a_Events_eventsID)
    REFERENCES a_Events (eventsID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


SELECT * FROM Alumni;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
