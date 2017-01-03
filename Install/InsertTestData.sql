/**
 *  INSERT admin student
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('password', 'student.root@linux.com', '127.0.0.1', 'I\'am', 'Root', TRUE, TRUE);
INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), 'street 42', '1415PI', '127.0.0.1', '30-05-1984', '01234', '06431415762');
COMMIT;

/**
 *  INSERT normal student
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('password', 'student@linux.com', '127.0.0.1', 'user', 'normal', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), 'street 42', '1415PI', '127.0.0.1', '30-05-1984', '12345', '06774159262');
COMMIT;

/**
 *  INSERT normal SLB teacher
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('password', 'slber@linux.com', '127.0.0.1', 'slb', 'teacher', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Teacher (userId, isSLBer)
VALUES (LAST_INSERT_ID(), TRUE);
COMMIT;

/**
 *  INSERT normal teacher
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('password', 'teacher@linux.com', '127.0.0.1', 'normal', 'teacher', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Teacher (userId, isSLBer)
VALUES (LAST_INSERT_ID(), FALSE);
COMMIT;

/**
 *  INSERT admin SLB teacher
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('password', 'slber.root@linux.com', '127.0.0.1', 'slb', 'teacher', TRUE, TRUE);
INSERT INTO DigitalPortfolio.Teacher (userId, isSLBer)
VALUES (LAST_INSERT_ID(), TRUE);
COMMIT;

/**
 *  INSERT admin teacher
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('password', 'teacher.root@linux.com', '127.0.0.1', 'normal', 'teacher', TRUE, TRUE);
INSERT INTO DigitalPortfolio.Teacher (userId, isSLBer)
VALUES (LAST_INSERT_ID(), FALSE);
COMMIT;


/**
 * INSERT theme
 */
INSERT INTO DigitalPortfolio.Theme (author, description, directoryName)
VALUES ('/dev/null', 'An simple test theme', 'TestTheme');

/**
 * INSERT page
 */
INSERT INTO DigitalPortfolio.Page (name, fileName, description, url, themeId)
VALUES ('home', 'home.php', 'The homepage of the portfolio', '/', 1);

/**
 * INSERT student portfolio
 */
INSERT INTO DigitalPortfolio.Portfolio (themeId, title, url, grade, userId)
VALUES (1, 'root_portfolio', 'root', 9.8, 1);

/**
 * INSERT skill
 */
INSERT INTO DigitalPortfolio.Skill (name, levelOfExperience, portfolioId)
VALUES ('Programming', 2, 1);

/**
 * INSERT training
 */
INSERT INTO DigitalPortfolio.Training (title, institution, location, startedAt, finishedAt, description, obtainedCertificate, currentTraining, portfolioId)
VALUES  ('Professioneel Putjes schepper', 'Stenden', 'Emmen', NOW(), NOW(), 'Master degree: putjes schepper', TRUE, FALSE, 1);

/**
 * INSERT Hobby
 */
INSERT INTO DigitalPortfolio.Hobby(name, portfolioId)
VALUES ( 'Programming', 1 );

/**
 * INSERT Language
 */
INSERT INTO DigitalPortfolio.Language(language, level, isNative, portfolioId)
VALUES( 'Dutch', 6, TRUE, 1 );

/**
 * INSERT JobExperience
 */
INSERT INTO DigitalPortfolio.JobExperience(location, startedAt, endedAt, description, isInternship, portfolioId)
VALUES ( 'Wedde', NOW(), NOW(), 'Junior Programmer', FALSE, 1 );

/**
 * Insert an image
 */
BEGIN;
INSERT INTO `DigitalPortfolio`.`UploadedFile`(fileName, mimeType, filePath, portfolioId)
VALUES ( 'image.png', 'image/png', '/var/www', 1 );
INSERT INTO `DigitalPortfolio`.`Image`(uploadedFileId, name, description, type, `order`)
VALUES ( LAST_INSERT_ID(), 'test image', 'This is an test image', 'PROFILE_IMAGE', 0 );
COMMIT;

/**
 * Insert an SLBAssignment
 */
BEGIN;
INSERT INTO `DigitalPortfolio`.`UploadedFile`(fileName, mimeType, filePath, portfolioId)
VALUES ( 'image.png', 'image/png', '/var/www', 1 );
INSERT INTO DigitalPortfolio.SLBAssignment(uploadedFileId, name, feedback)
VALUES ( LAST_INSERT_ID(), 'Reflectie verslag', 'Mooi' );
COMMIT;

/**
 * INSERT an Project
 */
INSERT INTO DigitalPortfolio.Project(name, description, link, imageId, portfolioId, grade)
VALUES ( 'Professionele website', 'Some school project', 'http://146.185.141.142/project/', 1, 1, 6.8 );