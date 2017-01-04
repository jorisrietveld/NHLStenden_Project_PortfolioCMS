<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 30-12-2016 16:00
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database;


use StendenINF1B\PortfolioCMS\Kernel\Database\ConnectionManager;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;

class ConnectionManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor(  )
    {
        $connectionManager = new ConnectionManager( true );
        $databaseConnection = $connectionManager->getConnection( (new ConfigLoader( CONFIG_FILE ) )->getConfigContainer( TRUE )->get('database','') );

        // Test constructor with auto loading connections.
        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\DatabaseConnection',
            $databaseConnection
        );

        $connectionManager = new ConnectionManager();
        // Test constructor without auto loading connections.
        $this->assertCount( 0, $connectionManager->getConnections() );
    }

    public function testAutoloadConnectionsWithRestriction(  )
    {
        $configFileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConnectionMananger.xml';
        $connectionManager = new ConnectionManager( FALSE, $configFileName );

        $connectionManager->loadConnectionsFromConfig( [ 'config1', 'config3' ] );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\DatabaseConnection',
            $connectionManager->getConnection( 'config1' )
        );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\DatabaseConnection',
            $connectionManager->getConnection( 'config3' )
        );

        $exception = NULL;
        try
        {
            $undefinedConnection = $connectionManager->getConnection( 'config2' );
        }
        catch ( \Exception $e)
        {
            $exception = $e;
        }

        $this->assertNotNull( $exception );
    }

    public function testAutoloadConnectionsWithoutRestrict(  )
    {
        $configFileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConnectionMananger.xml';
        $connectionManager = new ConnectionManager( FALSE, $configFileName );

        $connectionManager->loadConnectionsFromConfig( );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\DatabaseConnection',
            $connectionManager->getConnection( 'config1' )
        );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\DatabaseConnection',
            $connectionManager->getConnection( 'config2' )
        );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\DatabaseConnection',
            $connectionManager->getConnection( 'config3' )
        );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\DatabaseConnection',
            $connectionManager->getConnection( 'config4' )
        );
    }
}