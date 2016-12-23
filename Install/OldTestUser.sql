# test data for the user table
USE `DigitaalPortfolio`;

# key for aes encryption
SET @aes_key = 'password';

# Test insert.
INSERT INTO `DigitaalPortfolio`.`User` (
  username,
  password,
  email,
  lastIpAddress,
  address,
  birthday,
  displayName,
  firstName,
  lastName,
  studentCode,
  phoneNumber
)
VALUES (
  'Joris',
  SHA1('password'),
  AES_ENCRYPT('joris@joris.com', @aes_key),
  AES_ENCRYPT('192.168.1.254', @aes_key),
  AES_ENCRYPT('lageweg', @aes_key),
  AES_ENCRYPT('1995-06-30', @aes_key),
  'rekcahxunil',
  AES_ENCRYPT('joris', @aes_key),
  AES_ENCRYPT('rietveld', @aes_key),
  '304010',
  AES_ENCRYPT('0612345', @aes_key)
);

# Test select encrypted user
SELECT
  username,
  password,
  accountCreated,
  lastOnline,
  email,
  lastIpAddress,
  address,
  birthday,
  displayName,
  firstName,
  lastName,
  studentCode,
  phoneNumber
FROM DigitaalPortfolio.User;

# Test select decrypted user
SELECT
  username,
  password,
  accountCreated,
  lastOnline,
  AES_DECRYPT(email, @aes_key)         AS 'email',
  AES_DECRYPT(lastIpAddress, @aes_key) AS 'lastIpAddress',
  AES_DECRYPT(address, @aes_key)       AS 'address',
  AES_DECRYPT(birthday, @aes_key)      AS 'birthday',
  displayName,
  AES_DECRYPT(firstName, @aes_key)     AS 'firstName',
  AES_DECRYPT(lastName, @aes_key)      AS 'lastName',
  studentCode,
  AES_DECRYPT(phoneNumber, @aes_key)   AS 'phoneNumber'
FROM DigitaalPortfolio.User;
