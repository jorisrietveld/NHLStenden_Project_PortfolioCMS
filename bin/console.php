<?php
/**
 * This is an simple tool to generate SQL statement for the database.
 *
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 13:57
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

define( 'DIR_SEP', DIRECTORY_SEPARATOR );
define( 'DIR_UP', '..' . DIR_SEP );

define( 'BIN_DIR', __DIR__ . DIR_SEP );
define( 'INSTALL_DIR', rtrim( __DIR__, 'bin' ) . 'Install' );

define( 'PUBLIC_WEB_DIR', BIN_DIR . DIR_UP . 'web' . DIR_SEP );
define( 'SRC_DIR', BIN_DIR . DIR_UP . 'src' . DIR_SEP );
define( 'THEME_DIR', SRC_DIR . 'PortfolioCMS' . DIR_SEP . 'Themes' . DIR_SEP );

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$outputFile = 'sqlStatements.sql';

use Symfony\Component\Console\Application;

// Create an new command so it can be registered to the application.
$generateSqlCommand = new JorisRietveld\Commandline\GenerateSqlCommand();

// Bootstrap the application.
$application = new Application();

// Register the commands.
$application->add( $generateSqlCommand );

// Execute the command.
$application->run();