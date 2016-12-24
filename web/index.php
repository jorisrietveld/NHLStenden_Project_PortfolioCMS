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

// Boot an new application.
$application = new StendenINF1B\PortfolioCMS\Kernel\ApplicationKernel();

// Create an new Request from PHP's gobals.
$request = \StendenINF1B\PortfolioCMS\Kernel\Http\Request::createFromGlobals();
//dump($request);
//dump($request->getBaseUrl());
// Handle the request.
$response = $application->handle( $request );

//$databaseConfigLoader = new \StendenINF1B\PortfolioCMS\Kernel\Database\Helper\DatabaseConfigLoader();
//$databaseConfigLoader->convertXMLToDatabaseContainer();
//dump( $databaseConfigLoader->getDatabaseConfigContainers() );

// Send the generated response.
$response->send();

