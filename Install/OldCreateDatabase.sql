CREATE DATABASE IF NOT EXISTS `DigitaalPortfolio`;
USE `DigitaalPortfolio`;

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `username`       VARCHAR(100)          NOT NULL,
  `password`       VARCHAR(255)          NOT NULL, # Hashed data
  `accountCreated` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `lastOnline`     DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email`          VARBINARY(255) UNIQUE NOT NULL, # Encrypted data
  `lastIpAddress`  VARBINARY(50), # Encrypted data
  `address`        VARBINARY(255), # Encrypted data
  `birthday`       VARBINARY(50), # Encrypted data
  `displayName`    VARCHAR(255)          NOT NULL, # Encrypted data
  `firstName`      VARBINARY(255)        NOT NULL, # Encrypted data
  `lastName`       VARBINARY(255)        NOT NULL, # Encrypted data
  `studentCode`    VARCHAR(6), # todo So teachers and admins also have an student code? Set to not required.
  `phoneNumber`    VARBINARY(50), # Encrypted data

  CONSTRAINT pk_user PRIMARY KEY `User`(`username`)
);

DROP TABLE IF EXISTS `Guestbook`;
CREATE TABLE `Guestbook` (
  `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `senderName` VARCHAR(255) NOT NULL,
  `message`    TEXT         NOT NULL,
  `title`      VARCHAR(50),
  `receiverId` INT UNSIGNED NOT NULL, # todo is the receiver an user? The primary key of an user is an VARCHAR...

  CONSTRAINT pk_guestbook PRIMARY KEY `Guestbook`(`id`),
  CONSTRAINT fk_receiver FOREIGN KEY `Guestbook`(`receiverId`) REFERENCES #todo what references this?
);

DROP TABLE IF EXISTS `Content`; # todo is this an portfolio? if so why not name it that to be more descriptive?
CREATE TABLE `Content` (
  `id`                  INT UNSIGNED     NOT NULL AUTO_INCREMENT, # todo added auto increment on primary key.
  `contentPosition`     TINYINT UNSIGNED NOT NULL,
  `text`                TEXT             NOT NULL,
  `heading`             VARCHAR(100)     NOT NULL,
  `username`            VARCHAR(100)     NOT NULL, # todo auto increment on a varchar?
  `contentType`         VARCHAR(100)     NOT NULL,
  `authorizationToView` INT UNSIGNED     NOT NULL, # todo shouldn't this be an authorization id or enum( GUEST, TEACHER, ... )

  CONSTRAINT pk_content PRIMARY KEY `Content`(`id`),
  CONSTRAINT fk_authorization FOREIGN KEY `Content`(`authorizationToView`) REFERENCES `User` (`username`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Grade`;
CREATE TABLE `Grade` (
  `id`          INT UNSIGNED                       NOT NULL AUTO_INCREMENT,
  `course`      VARCHAR(50)                        NOT NULL,
  `teacher`     INT UNSIGNED                       NOT NULL, # todo shouldn't this be required?
  `dateAdded`   DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, # todo I chanced the name to something more appropriate.
  `grade`       TINYINT UNSIGNED                   NOT NULL,
  `studentCode` VARCHAR(6)                         NOT NULL, # todo shouldn't the forgein key be required? and why don't we use the user id this is safer than an unrequired attribute.
  `description` VARCHAR(50)                        NOT NULL,

  CONSTRAINT pk_grade PRIMARY KEY `Grade`(`id`),
  CONSTRAINT fk_studentCode FOREIGN KEY `Grade`(`studentCode`) REFERENCES `User` (`studentCode`) # todo this forgein key is not save
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Certificate`;
CREATE TABLE `Certificate` (
  `id`                     INT UNSIGNED NOT NULL,
  `certificateTitle`       VARCHAR(50)  NOT NULL,
  `startDate`              DATE, # todo renamed to be more consistent with the other tables.
  `earnedOnDate`           DATE, # todo renamed to be more consistent with the other tables.
  `certificateDescription` VARCHAR(100) NOT NULL, # todo TEXT(50) doesn't take an size converted to VARCHAR(100).
  `contentId`              INT UNSIGNED NOT NULL,

  CONSTRAINT pk_certificate PRIMARY KEY `Certificate`(`id`),
  CONSTRAINT fk_content FOREIGN KEY `Certificate`(`contentId`) REFERENCES `Content` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

DROP TABLE IF EXISTS `PageSettings`;
CREATE TABLE `PageSettings` (
  `username`    VARCHAR(100) NOT NULL,
  `theme`       VARCHAR(100) NOT NULL,
  `headerImage` VARCHAR(100) NOT NULL, # todo Why this field? you can use multiple images in an theme.
  `pageTitle`   VARCHAR(100) NOT NULL,
  `pageLink`    VARCHAR(100) NOT NULL,

  CONSTRAINT pk_pageSettings PRIMARY KEY `PageSettings`(`username`),
  CONSTRAINT fk_user FOREIGN KEY `PageSettings`(`username`) REFERENCES `User` (`username`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

DROP TABLE IF EXISTS `JobExperience`;
CREATE TABLE `JobExperience` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT, # todo varchar as id and no auto increment? converted to INT AUTO_INCREMENT
  `jobLocation`   VARCHAR(100) NOT NULL,
  `startDate`     DATE,
  `endDate`       DATE,
  `jobDescripton` VARCHAR(255), # todo TEXT(150) Doesn't exist converted to VARCHAR(255) shouldn't this be required?
  `contentId`     INT UNSIGNED NOT NULL,

  CONSTRAINT pk_jobExperience PRIMARY KEY `JobExperience`(`id`),
  CONSTRAINT fk_content FOREIGN KEY `JobExperience`(`contentId`) REFERENCES `Content` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

# todo: shouldn't language have an relation with an user instead to content?
DROP TABLE IF EXISTS `Language`;
CREATE TABLE `Language` (
  `id`               INT UNSIGNED NOT NULL AUTO_INCREMENT, # todo shouldn't this be auto increment? converted to AUTO_INCREMENT.
  `nativeLanguage`   VARCHAR(50)  NOT NULL, # todo I renamed it to be more appropriate. Its an convention for is{Someting} fields to be booleans.
  # todo why save an native language? you when you can define languageControl as native?
  `languageControll` VARCHAR(50)  NOT NULL,
  `contentId`        INT UNSIGNED NOT NULL,

  CONSTRAINT pk_language PRIMARY KEY `Language`(`id`),
  CONSTRAINT fk_content FOREIGN KEY `Language`(`contentId`) REFERENCES `Content` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

DROP TABLE IF EXISTS `UploadedFile`;
CREATE TABLE `UploadedFile` (# todo renamed the entity to be more convenient.
  `id`        INT UNSIGNED AUTO_INCREMENT, # todo shouldn't this be auto increment? converted to AUTO_INCREMENT.
  `filePath`  VARCHAR(255) NOT NULL, # todo renamed attribute to be more convenient.
  `mimeType`  VARCHAR(20)  NOT NULL, # todo renamed attribute to be more descriptive.
  `fileName`  VARCHAR(50)  NOT NULL, # todo added this attribute because it was missing.
  `contentId` INT UNSIGNED NOT NULL,

  CONSTRAINT pk_uploadedFile PRIMARY KEY `UploadedFile`(`id`),
  CONSTRAINT fk_content FOREIGN KEY `UploadedFile`(`contentId`) REFERENCES `Content` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Catagory`;
CREATE TABLE `Category` (# todo are this the authorization groups? if so why not call it that?
  `id`                  INT UNSIGNED AUTO_INCREMENT NOT NULL, # todo shouldn't this be auto increment? converted to AUTO_INCREMENT,
  `catecoryName`        VARCHAR(50)                 NOT NULL,
  `categoryDescription` VARCHAR(300)                NOT NULL, # todo there is no TEXT(300) datatype converted to VARCHAR(300)

  CONSTRAINT pk_catagory PRIMARY KEY `Category`(`id`)
);

DROP TABLE IF EXISTS `UserCategory`; #todo if the above is an authorization id why does it have an N:M relation to user instead of an 1:N?
CREATE TABLE `UserCategory` (
  `username`   VARCHAR(100) NOT NULL,
  `categoryId` INT UNSIGNED NOT NULL,

  CONSTRAINT pk_userCacegory PRIMARY KEY `UserCategory`(`username`, `categoryId`),
  CONSTRAINT fk_user FOREIGN KEY `UserCategory`(`username`) REFERENCES `User` (`username`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT fk_category FOREIGN KEY `UserCategory`(`categoryId`) REFERENCES `Category` (`categoryId`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);