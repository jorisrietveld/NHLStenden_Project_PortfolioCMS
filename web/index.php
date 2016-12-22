<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-12-2016 14:31
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

/**
 * This file defines some global constants and contains the code for autoloading classes.
 */
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// This file does nothing it is only for auto completion in PHPStorm for lib Sodium for secure encryption.
require __DIR__ . DIRECTORY_SEPARATOR . 'PHPStormAutoCompleteLibSodiumHack.php';

$application = new StendenINF1B\PortfolioCMS\Kernel\ApplicationKernel();
$request = \StendenINF1B\PortfolioCMS\Kernel\Http\Request::createFromGlobals();

var_dump([
    \Sodium\library_version_major(),
    \Sodium\library_version_minor(),
    \Sodium\version_string()
]);

dump($request);
//dump($request);
$routeParser = new \StendenINF1B\PortfolioCMS\Kernel\Routing\RouteParser();

//$routeParser->loadXml();
// dump( $routeParser->getSimpleXmlObject());
$routeParser->parseXmlToRoutes();
$routes = $routeParser->getRoutes();
dump( $routes );
//$response = $application->handle( $request );
//$response->send();

//$response = $application->handle( $request );

