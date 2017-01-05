/**
 * An script to install all the default themes.
 */
/*
BEGIN;
INSERT INTO `DigitalPortfolio`.`Theme`(name, author, description, directoryName)
VALUES ( 'site', 'admin', 'the global site theme', 'site' );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'home', 'home.php', 'the home page of the website', '/home', LAST_INSERT_ID() );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'login', 'login.php', 'the login page of the website', '/login', LAST_INSERT_ID() );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'register', 'register.php', 'the register page of the website', '/register', LAST_INSERT_ID() );

COMMIT;
*/

/*




*/