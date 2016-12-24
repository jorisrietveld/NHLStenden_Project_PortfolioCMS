#DROP DATABASE IF EXISTS `DigitalPortfolio`;

# Create the new database.
CREATE DATABASE IF NOT EXISTS `DigitalPortfolio`;

# Select the just created database.
USE `DigitalPortfolio`;

/**
 * This entity represent an user that can authenticate on the site.
 */
CREATE TABLE IF NOT EXISTS `User` (
  `id`             INT UNSIGNED UNIQUE AUTO_INCREMENT                             NOT NULL, # The unique identification code of the record.
  `password`       VARCHAR(255)                                                   NOT NULL, # An secret key for authenticating an user.
  `accountCreated` DATETIME DEFAULT CURRENT_TIMESTAMP                             NOT NULL, # An timestamp of when the account was created.
  `lastLogin`      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL, # An timestamp of the last time the user was online.
  `email`          VARBINARY(255) UNIQUE                                          NOT NULL, # The encrypted email address of the user, also used for the login.
  `lastIpAddress`  VARBINARY(50)                                                  NULL, # The encrypted last ip address the user used to login.
  `firstName`      VARBINARY(255)                                                 NOT NULL, # The encrypted first name of the user.
  `lastName`       VARBINARY(255)                                                 NOT NULL, # The encrypted last name of the user.
  `isAdmin`        BOOLEAN DEFAULT 0                                              NOT NULL, # Boolean for storing if this user is an administrator.
  `active` BOOLEAN DEFAULT 1 NOT NULL, # Field to mark the user as inactive.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_user PRIMARY KEY `User`(`id`)
);

/**
 * This entity is an type of user that can have an portfolio.
 */
CREATE TABLE IF NOT EXISTS `Student` (
  `userId`      INT UNSIGNED UNIQUE   NOT NULL, # Inherited key from the entity user and unique identifier for this record.
  `street`      VARBINARY(255)        NOT NULL, # The encrypted name the street where the student lives.
  `address`     VARBINARY(5)          NOT NULL, #The encrypted street number where the student lives.
  `zipCode`     VARBINARY(10)         NOT NULL, # The zip code of where student lives.
  `location`    VARBINARY(100)        NOT NULL, # The place the student lives.
  `dateOfBirth` VARBINARY(50)         NOT NULL, # The date of birth of an student.
  `studentCode` VARBINARY(50) UNIQUE  NOT NULL, # Unique identification given by school field for the student.
  `phoneNumber` VARBINARY(100) UNIQUE NOT NULL, # The encrypted phone number of the student.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_student PRIMARY KEY `Student`(`userId`),

  # Constrains that defines the foreign key to entity User( id )
  CONSTRAINT fk_student_user FOREIGN KEY `Student`(`userId`) REFERENCES `DigitalPortfolio`.`User` (`id`)
    ON UPDATE CASCADE # When the user is updated, update this record also.
    ON DELETE CASCADE # When the user is deleted, delete this record also.
);

/**
 * This entity is an type of user that depending on the isSLBer field can give grades on portfolios.
 */
CREATE TABLE IF NOT EXISTS `Teacher` (
  `userId`  INT UNSIGNED UNIQUE NOT NULL, # Inherited key from the entity user and unique identifier for this record.
  `isSLBer` BOOLEAN             NOT NULL, # Field TO differentiate between normal teachers AND SLB teachers.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_teacher PRIMARY KEY `Teacher`(`userId`),

  # Constrains that defines the foreign key to the entity User( id )
  CONSTRAINT fk_teacher_user FOREIGN KEY `Teacher`(`userId`) REFERENCES `DigitalPortfolio`.`User` (`id`)
    ON UPDATE CASCADE # When the user is updated, update this record also.
    ON DELETE CASCADE # When the user is deleted, delete this record also.
);

/**
 * This Entity represents an message posted on the guest book.
 */
CREATE TABLE IF NOT EXISTS `GuestBookMessage` (
  `id`        INT UNSIGNED UNIQUE AUTO_INCREMENT NOT NULL, # The unique identification code of the record.
  `sender`    VARCHAR(255)                       NOT NULL, # The name of the author of the message in the posted in the guest book.
  `title`     VARCHAR(50) DEFAULT 'Reactie op portfolio', # The subject or title for the message.
  `message`   TEXT                               NOT NULL, # The actual message.
  `sendAt`    DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, # The time the message was posted.
  `studentId` INT UNSIGNED                       NOT NULL, # The unique identifier for the student witch receives the message.
  `accsepted` BOOLEAN DEFAULT 0                  NOT NULL, # If the post is accepted by the student.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_guestBook PRIMARY KEY `GuestBookMessage`(`id`),

  # Constraint that defines the foreign key to the entity Student( id )
  CONSTRAINT fk_guestBookMessage_student FOREIGN KEY `GuestBookMessage`(`studentId`) REFERENCES `DigitalPortfolio`.`Student` (`userId`)
    ON UPDATE CASCADE # When the student is updated, update this record.
    ON DELETE CASCADE # When the student is deleted set id to NULL
);

/**
 * This entity represents an installed theme that can be used FOR an portfolio.
 */
CREATE TABLE IF NOT EXISTS `Theme` (
  `id`            INT UNSIGNED UNIQUE AUTO_INCREMENT NOT NULL, # The unique identification code of the record.
  `author`        VARCHAR(50)                        NOT NULL, # The author that created the theme.
  `description`   VARCHAR(255)                       NOT NULL, # A short description of the theme.
  `directoryName` VARCHAR(100)                       NOT NULL, # the name of the actual theme folder.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_theme PRIMARY KEY `Theme`(`id`)
);

/**
 * This entity represents a web page in a theme
 */
CREATE TABLE IF NOT EXISTS `Page` (
  `id`          INT UNSIGNED UNIQUE AUTO_INCREMENT NOT NULL, # The unique identification code of the record.
  `name`        VARCHAR(100)                       NOT NULL, # The name of the page.
  `fileName`    VARCHAR(100)                       NOT NULL, # The actual filename of the web page.
  `description` VARCHAR(300)                       NULL, # An short description about what is displayed on the page.
  `url`         VARCHAR(100)                       NULL, #this is the url part after the url from portfolio.
  `themeId`     INT UNSIGNED                       NOT NULL, # The unique identification code to Theme( id ).

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_page PRIMARY KEY `Page`(`id`),

  # Constraint to define the foreign key to Theme( id )
  CONSTRAINT fk_page_theme FOREIGN KEY `Page`(`themeId`) REFERENCES `DigitalPortfolio`.`Theme` (`id`)
    ON UPDATE CASCADE # When an theme is updated, update this record.
    ON DELETE CASCADE # When an theme is deleted, delete this record.
);

/**
 * This entity represents an portfolio of an user.
*/
CREATE TABLE IF NOT EXISTS `Portfolio` (
  `id`      INT UNSIGNED UNIQUE AUTO_INCREMENT NOT NULL, # The unique identification code of the record.
  `themeId` INT UNSIGNED                       NOT NULL, # The unique identifier for the theme that will be used to render this portfolio.
  `title`   VARCHAR(50)                        NOT NULL, # The title that will be displayed IN the tab ON the browser.
  `url`     VARCHAR(50)                        NOT NULL, # The url used IN the address field IN the browser.
  `grade`   DECIMAL(2, 1)                      NULL, # The grade of the portfolio given BY the SBL teacher.
  `userId`  INT UNSIGNED                       NOT NULL, # The unique identification code to User( id )

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_portfolio PRIMARY KEY `Portfolio`(`id`),

  # Constraint to define the foreign key to User( id )
  CONSTRAINT fk_portfolio_user FOREIGN KEY `Portfolio`(`userId`) REFERENCES `DigitalPortfolio`.`User` (`id`)
    ON UPDATE CASCADE # When an user is updated, update this record.
    ON DELETE RESTRICT, # When an user is deleted, delete this record.

  # Constraint to define the foreign key to User( id )
  CONSTRAINT fk_portfolio_theme FOREIGN KEY `Portfolio`(`themeId`) REFERENCES `DigitalPortfolio`.`Theme` (`id`)
    ON UPDATE CASCADE # When an theme is updated, update this record.
    ON DELETE NO ACTION # When an theme is deleted, do not delete this record.
);

/**
 * This entity represent an job experience of an student that has an relation to the portfolio.
 */
CREATE TABLE IF NOT EXISTS `JobExperience` (
  `id`           INT UNSIGNED UNIQUE  AUTO_INCREMENT NOT NULL, # The unique identification code of the record.
  `location`     VARCHAR(100)                        NOT NULL, # The location of the job experience.
  `startedAt`    DATE                                NULL, #The START DATE of the job.
  `endedAt`      DATE                                NULL, # The END DATE of the job.
  `description`  VARCHAR(255)                        NOT NULL, #An description about the tasks performed AT the job.
  `isInternship` BOOL DEFAULT 0                      NOT NULL, # If the job experience IS an internship.
  `portfolioId`  INT UNSIGNED                        NOT NULL, # The unique identifier of the portfolio that the job experience belongs to.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_jobExperience PRIMARY KEY `JobExperience`(`id`),

  # Constraint to define the foreign key to the entity Portfolio( id )
  CONSTRAINT fk_jobExperience_portfolio FOREIGN KEY `JobExperience`(`portfolioId`) REFERENCES `DigitalPortfolio`.`Portfolio` (`id`)
    ON UPDATE CASCADE # When the portfolio is updated, update this record.
    ON DELETE CASCADE # When the portfolio is updated, delete this record.
);

/*
 * This entity represents the languages the student masters.
 */
CREATE TABLE IF NOT EXISTS `Language` (
  `id`          INT UNSIGNED UNIQUE AUTO_INCREMENT    NOT NULL, # The unique identification code of the record.
  `language`    VARCHAR(50)                           NOT NULL, # Thee name of the language.
  `level`       TINYINT(2) UNSIGNED DEFAULT 10        NOT NULL, # The level of mastery the student has of the language.
  `isNative`    BOOLEAN DEFAULT 0                     NOT NULL, # If it IS the native LANGUAGE of the user.
  `portfolioId` INT UNSIGNED                          NOT NULL, # The unique identifier of the portfolio that the language belongs to.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_language PRIMARY KEY `Language`(`id`),

  # Constraint to define the foreign key to the entity Portfolio( id )
  CONSTRAINT fk_language_portfolio FOREIGN KEY `Language`(`portfolioId`) REFERENCES `DigitalPortfolio`.`Portfolio` (`id`)
    ON UPDATE CASCADE # When the portfolio is updated, update this record.
    ON DELETE CASCADE # When the portfolio is updated, delete this record.
);

/**
 * This entity represents the trainings the student attended.
*/
CREATE TABLE IF NOT EXISTS `Training` (
  `id`                  INT UNSIGNED UNIQUE AUTO_INCREMENT NOT NULL, # The unique identification code of the record.
  `title`               VARCHAR(100)                       NOT NULL, # The title of the training.
  `institution`         VARCHAR(100)                       NOT NULL, # The institution where the student attended the training.
  `location`            VARCHAR(100)                       NOT NULL, # The location of the institution.
  `startedAt`           DATE                               NULL, # The start date of the training.
  `finishedAt`          DATE                               NULL, # The date the student earned an certificate of the training.
  `description`         VARCHAR(255)                       NOT NULL, # An description about the training the student attended.
  `obtainedCertificate` BOOLEAN DEFAULT 0                  NOT NULL, # An boolean representing IF the student obtained an certificate for the training.
  `currentTraining`     BOOLEAN DEFAULT 0                  NOT NULL, # An boolean representing if the this is the current training the student is attending.
  `portfolioId`         INT UNSIGNED                       NOT NULL, # The unique identifier of the portfolio that the training belongs to.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_training PRIMARY KEY `Training`(`id`),

  # Constraint to define the foreign key to the entity Portfolio( id )
  CONSTRAINT fk_training_portfolio FOREIGN KEY `Training`(`portfolioId`) REFERENCES `DigitalPortfolio`.`Portfolio` (`id`)
    ON UPDATE CASCADE # When the portfolio is updated, update this record.
    ON DELETE CASCADE # When the portfolio is updated, delete this record.
);

/*
 * This entity represents an uploaded file like an slb assignment or an picture.
 */
CREATE TABLE IF NOT EXISTS `UploadedFile` (
  `id`          INT UNSIGNED UNIQUE NOT NULL AUTO_INCREMENT, # The unique identification code of the record.
  `fileName`    VARCHAR(100)        NOT NULL, # The file name of the uploaded file.
  `mimeType`    VARCHAR(20)         NOT NULL, # The mime type the uploaded file.
  `filePath`    VARCHAR(255)        NOT NULL, # The path to the location of the file.
  `portfolioId` INT UNSIGNED        NOT NULL, # The unique identifier of the portfolio that the uploaded file belongs to.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_uploadedFile PRIMARY KEY `UploadedFile.`(`id`),

  # Constraint to define the foreign key to the entity Portfolio( id )
  CONSTRAINT fk_uploadedFile_portfolio FOREIGN KEY `UploadedFile`(`portfolioId`) REFERENCES `DigitalPortfolio`.`Portfolio` (`id`)
    ON UPDATE CASCADE # When the portfolio is updated, update this record.
    ON DELETE CASCADE # When the portfolio is updated, delete this record.
);

/**
 * This entity IS an type of UploadedFile that represents an slb assignment.
 */
CREATE TABLE IF NOT EXISTS `SLBAssignment` (
  `uploadedFileId` INT UNSIGNED UNIQUE, # Inherited key from the entity UploadedFile and unique identifier for this record
  `name`           VARCHAR(100) NOT NULL, # The name of the assignment.
  `feedback`       VARCHAR(500) NULL, # The Feedback by the SLB teacher on the assignment.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_slbAssignment PRIMARY KEY `SLBAssignment`(`uploadedFileId`),

  # Constraint to define the foreign key to the entity UploadedFile( id )
  CONSTRAINT fk_slbAssignment_uploadedFile FOREIGN KEY `SLBAssignment`(`uploadedFileId`) REFERENCES `DigitalPortfolio`.`UploadedFile` (`id`)
    ON UPDATE CASCADE # When the uploaded file is updated, update this record.
    ON DELETE CASCADE # When the uploaded file is updated, delete this record.
);

/**
 * This entity is an type of UploadedFile that represents an image that can be used in as profile or gallery image.
 */
CREATE TABLE IF NOT EXISTS `Image` (
  `uploadedFileId` INT UNSIGNED UNIQUE                                             NOT NULL, # Inherited key from the entity UploadedFile and unique identifier for this record.
  `name`           VARCHAR(50)                                                     NOT NULL, # An friendly name for the image.
  `description`    VARCHAR(255)                                                    NULL, # The description of the image that can be used IN the alt tag IN html_
  `type`           ENUM ('GALLERY_IMAGE', 'PROFILE_IMAGE') DEFAULT 'GALLERY_IMAGE' NOT NULL, # This defines where the image will be used as PROFILE_IMAGE OR GALLERY_IMAGE.
  `order`          TINYINT(2) UNSIGNED DEFAULT 0                                   NULL, # This can be used when an image is an gallery picture to set the order of display.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_slbAssignment PRIMARY KEY `Image`(`uploadedFileId`),

  # Constraint to define the foreign key to the entity UploadedFile( id )
  CONSTRAINT fk_image_uploadedFile FOREIGN KEY `Image`(`uploadedFileId`) REFERENCES `DigitalPortfolio`.`UploadedFile` (`id`)
    ON UPDATE CASCADE # When the uploaded file is updated, update this record.
    ON DELETE CASCADE # When the uploaded file is updated, delete this record.
);

/**
 * This entity represents an skill that the student masters.
 */
CREATE TABLE IF NOT EXISTS `Skill` (
  `id`                INT UNSIGNED UNIQUE AUTO_INCREMENT, # The unique identification code of the record.
  `name`              VARCHAR(100)                NOT NULL, # The name of the skill like MS Office OR PHP.
  `levelOfExperience` TINYINT(2) UNIQUE DEFAULT 0 NOT NULL, # The level experience the student has on this skill.
  `portfolioId`       INT UNSIGNED                NOT NULL, # The unique identifier of the portfolio that the skill belongs to.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_uploadedFile PRIMARY KEY `Skill`(`id`),

  # Constraint to define the foreign key to the entity Portfolio( id )
  CONSTRAINT fk_skill_portfolio FOREIGN KEY `Skill`(`portfolioId`) REFERENCES `DigitalPortfolio`.`Portfolio` (`id`)
    ON UPDATE CASCADE # When the portfolio is updated, update this record.
    ON DELETE CASCADE # When the portfolio is updated, delete this record.
);

/**
 * This entity represents an hobby the student has_
 */
CREATE TABLE IF NOT EXISTS `Hobby` (
  `id`          INT UNSIGNED UNIQUE AUTO_INCREMENT NOT NULL, # The unique identification code of the record.
  `name`        VARCHAR(255)                       NOT NULL, # The name of the hobby and optional an short description about the hobby.
  `portfolioId` INT UNSIGNED                       NOT NULL, # The unique identifier of the portfolio that the hobby belongs to.

  # Constraint to define the primary key of this table.
  CONSTRAINT pk_uploadedFile PRIMARY KEY `Hobby`(`id`),

  # Constraint to define the foreign key to the entity Portfolio( id )
  CONSTRAINT fk_hobby_portfolio FOREIGN KEY `Hobby`(`portfolioId`) REFERENCES `DigitalPortfolio`.`Portfolio` (`id`)
    ON UPDATE CASCADE # When the portfolio is updated, update this record.
    ON DELETE CASCADE # When the portfolio is updated, delete this record.
);

/**
  * This entity represent an project the student wants to show.
 */
CREATE TABLE IF NOT EXISTS `Project` (
  `id`               INT UNSIGNED UNIQUE AUTO_INCREMENT NOT NULL, # The unique identification code of the record.
  `name`             VARCHAR(100)                       NOT NULL, # The name of the project.
  `description`      VARCHAR(255)                       NOT NULL, # An short description about the project.
  `link`             VARCHAR(255)                       NOT NULL, # An link to the project.
  `thumbnailImageId` INT UNSIGNED                       NOT NULL, # The unique identifier of the uploaded image thumbnail that belongs to the project.
  `portfolioId`      INT UNSIGNED                       NOT NULL, # The unique identifier of the portfolio that the project belongs to.
  `grade`            DECIMAL(2, 1)                      NULL, # The grade the teacher has given for the project.
  # Constraint to define the primary key of this table.
  CONSTRAINT pk_project PRIMARY KEY `Project`(`id`),

  # Constraint to define the foreign key to the entity Image( id )
  CONSTRAINT fk_project_image FOREIGN KEY `Project`(`portfolioId`) REFERENCES `DigitalPortfolio`.`Image` (`uploadedFileId`)
    ON UPDATE CASCADE # When the portfolio is updated, update this record.
    ON DELETE CASCADE, # When the portfolio is updated, delete this record.

  # Constraint to define the foreign key to the entity Portfolio( id )
  CONSTRAINT fk_project_portfolio FOREIGN KEY `Project`(`portfolioId`) REFERENCES `DigitalPortfolio`.`Portfolio` (`id`)
    ON UPDATE CASCADE # When the portfolio is updated, update this record.
    ON DELETE CASCADE # When the portfolio is updated, delete this record.
);
