/**
 * An script to install all the default themes.
 */

BEGIN;
INSERT INTO `DigitalPortfolio`.`Theme`(name, author, description, directoryName)
VALUES ( 'Anouk\'s thema', 'Anouk van der Veen', 'Het thema gemaakt door Anouk van der Veen', 'Theme_anouk' );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'index', 'index.php', 'De portefolio pagina', '/index', LAST_INSERT_ID() );
COMMIT;

BEGIN;
INSERT INTO `DigitalPortfolio`.`Theme`(name, author, description, directoryName)
VALUES ( 'Aron\'s thema', 'Aron Soppe', 'Het thema gemaakt door Aron Soppe', 'Theme_aron' );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'index', 'index.php', 'De portefolio pagina', '/index', LAST_INSERT_ID() );
COMMIT;

BEGIN;
INSERT INTO `DigitalPortfolio`.`Theme`(name, author, description, directoryName)
VALUES ( 'joris\'s thema', 'Joris Rietveld', 'Het thema gemaakt door Joris Rietveld', 'Theme_joris' );
SET @portfolioId = LAST_INSERT_ID();

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'index', 'index.php', 'De portefolio pagina', '/index', @portfolioId );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'projecten', 'projecten.php', 'De projecten pagina', '/projects', @portfolioId );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'guestbook', 'guestbook.php', 'De gastenboek pagina', '/guestbook', @portfolioId );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'slbAssignments', 'slbOpdrachten.php', 'De slbOpdrachten pagina', '/slb_assignments', @portfolioId );
COMMIT;

BEGIN;
INSERT INTO `DigitalPortfolio`.`Theme`(name, author, description, directoryName)
VALUES ( 'Kevin Tabak\'s thema', 'Kevin Tabak', 'Het thema gemaakt door Kevin Tabak', 'Theme_kevinTabak' );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'index', 'index.php', 'De portefolio pagina', '/index', LAST_INSERT_ID() );
COMMIT;

BEGIN;
INSERT INTO `DigitalPortfolio`.`Theme`(name, author, description, directoryName)
VALUES ( 'Marco\'s thema', 'Marco Brink', 'Het thema gemaakt door Marco Brink', 'Theme_marco' );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'index', 'index.php', 'De portefolio pagina', '/index', LAST_INSERT_ID() );
COMMIT;

BEGIN;
INSERT INTO `DigitalPortfolio`.`Theme`(name, author, description, directoryName)
VALUES ( 'generics', 'Kevin Veldman', 'Het thema gemaakt door Kevin Veldman', 'kevin_theme' );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'index', 'index.php', 'De portefolio pagina', '/index', LAST_INSERT_ID() );
COMMIT;

BEGIN;
INSERT INTO `DigitalPortfolio`.`Theme`(name, author, description, directoryName)
VALUES ( 'Esmee\'s thema', 'Esmee Lunenborg', 'Het thema gemaakt door Esmee Lunenborg', 'Theme_Esmee' );

INSERT INTO `DigitalPortfolio`.`Page`(name, fileName, description, url, themeId)
VALUES ( 'index', 'index.php', 'De portefolio pagina', '/index', LAST_INSERT_ID() );
COMMIT;
