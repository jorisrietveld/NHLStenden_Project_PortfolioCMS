/**
 * Insert account Joris Rietveld
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('$2y$10$VpJl/sTxAUXbgWk50cqHuuUbgFY2osyVdDclQE9Z2xoao2VAZGo7G', 'jorisrietveld@gmail.com', '127.0.0.1', 'Joris', 'Rietveld', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), 'Lageweg 50', '9698BR', 'Wedde', '30-06-1995', '551473', '0629300582');
COMMIT;

/**
 * Insert account Aron Soppe
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('$2y$10$FGohL.QH3cfu4K8THi/JjeSOiWdZnyqEYZRt2JhonrM4rQWX0LHFK', 'aron.soppe@student.stenden.com', '127.0.0.1', 'Aron', 'Soppe', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), 'Modem 19', '7741MA', 'Coevorden', '01-10-1997', '498467', '0632141288');
COMMIT;

/**
 * Insert account Anouk van der Veen
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('$2y$10$Bf5zkOKBFXrBpBGBW8SHkeElNWy5Z.sT0cdLcgFTTLwQ7KyrhgK8i', 'anouk.van.der.veen@student.stenden.com', '127.0.0.1', 'Anouk', 'van der Veen', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), 'Munnekemoer oost 19', '9561NN', 'Ter Apel', '21-06-1999', '521795', '0629766229');
COMMIT;

/**
 * Insert account Kevin Veldman
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('$2y$10$e1i2mE43Fh/i5uwzicYiKefjikN2lOh1rMsj821cw24ZxRqaXtWsa', 'kevin.veldman@student.stenden.com', '127.0.0.1', 'Kevin', 'Veldman', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), 'Lottinglaan 3', '9451KL', 'Rolde', '29-07-1996', '555827', '0642448330');
COMMIT;

/**
 * Insert account Kevin Tabak
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES (' $2y$10$WR6xWodYkmsos9nYzhyJBuyfQsOmuY1H7aF1GKPh3Px5ePQlSFSTi', 'kevin.tabak@student.stenden.com', '127.0.0.1', 'Kevin', 'Tabak', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), 'street 42', '1415PI', '127.0.0.1', '30-07-1984', '533270', '0646723554');
COMMIT;

/**
 * Insert account Marco Brink
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('$2y$10$AcVISNdt9GcEbBfI8VYB6uwPdZwNZRdl3FeuPBSVB6b8TwEX65p4W', 'marco.brink@student.stenden.com', '127.0.0.1', 'Marco', 'Brink', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), 'Burgemeester Jollesstraat 7', '9401LD', 'Assen', '10-05-1996', '535672', '0646500174');
COMMIT;

/**
 * Insert account Esmee Lunenborg
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('$2y$10$AcVISNdt9GcEbBfI8VYB6uwPdZwNZRdl3FeuPBSVB6b8TwEX65p4W', 'esmee.lunenborg@student.stenden.com', '127.0.0.1', 'Esmée', 'Lunenborg', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), 'Langedijk 15', '7913VG', ' Hollandscheveld', '12-08-1995', '550035', '');
COMMIT;


/**
 * Insert account Albert de Jonge
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('$2y$10$D6f6h9SONNL8y9zqG0NMhODDV.O3lrD2H8jzklusX6NQPvWcW.4e.', 'albert.de.jonge@stenden.com', '127.0.0.1', 'Albert', 'de Jonge', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Teacher (userId, isSLBer)
VALUES (LAST_INSERT_ID(), TRUE);
COMMIT;

/**
 * Insert account Raymond Blankestijn
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('$2y$10$jl2.wwI6n1kqa3bfDjDZgOeIbejpl9xik6JlL3fH0xVqOGBSRHJVy', 'raymond.blankestijn@stenden.com', '127.0.0.1', 'Raymond', 'Blankenstijn', FALSE, TRUE);
INSERT INTO DigitalPortfolio.Teacher (userId, isSLBer)
VALUES (LAST_INSERT_ID(), FALSE);
COMMIT;

/**
 * Insert GOD mode account \m/ ( ^_^ ) \m/
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin, active)
VALUES ('$2y$10$c3MLH92bnrzQ0.m9xs1eGuQlCZIr6OgYT12cqWspHvBMor/8f8Hc.', 'admin@portfoliocms.com', '127.0.0.1', 'Root', '@146.185.141.142', TRUE, TRUE);
INSERT INTO DigitalPortfolio.Teacher (userId, isSLBer)
VALUES (LAST_INSERT_ID(), FALSE);
COMMIT;

