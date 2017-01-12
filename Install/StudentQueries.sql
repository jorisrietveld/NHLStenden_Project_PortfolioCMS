/**
 * Insert student transaction.
 */
BEGIN;
INSERT INTO DigitalPortfolio.User (password, email, lastIpAddress, firstName, lastName, isAdmin)
VALUES ( :password, :email, :lastIpAddress, :firstName, :lastName, :isAdmin );

INSERT INTO DigitalPortfolio.Student (userId, address, zipCode, location, dateOfBirth, studentCode, phoneNumber)
VALUES (LAST_INSERT_ID(), :address, :zipCode, :location, :dateOfBirth, :studentCode, :phoneNumber );
COMMIT;

/**
 * Update an Student transaction.
 */
BEGIN;

UPDATE `DigitalPortfolio`.`User`
SET
  `password` = :password,
  `accountCreated` = :accountCreated,
  `email` = :email,
  `lastIpAddress` = :lastIpAddress,
  `firstName` = :firstName,
  `lastName` = :lastName,
  `isAdmin` = :isAdmin,
  `active` = :active
WHERE `id` = :id;

UPDATE `DigitalPortfolio`.`Student`
SET
  `address` = :address,
  `zipCode` = :zipCode,
  `location` = :location,
  `dateOfBirth` = :dateOfBirth,
  `studentCode` = :studentCode,
  `phoneNumber` = :phoneNumber;

COMMIT;

