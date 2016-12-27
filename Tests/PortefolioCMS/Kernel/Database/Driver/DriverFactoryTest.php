<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 26-12-2016 15:37
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database\Driver;


use StendenINF1B\PortfolioCMS\Kernel\Database\Driver\DriverFactory;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\DatabaseConfigLoader;

class DriverFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the driver factory can create an MySQL driver.
     */
    public function testGetMysqlDriver(  )
    {
        $driverFactory = new DriverFactory();
        $configFileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConfig.xml';
        $mysqlConfig = (new DatabaseConfigLoader( $configFileName ) )->getDatabaseConfigContainer( 'mysqlConfig', TRUE );

        // Test if the driver retunes an MySQL driven when given mysql driver configuration.
        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\Driver\\MysqlDriver',
            $driverFactory->createDriver( $mysqlConfig ));

    }

}