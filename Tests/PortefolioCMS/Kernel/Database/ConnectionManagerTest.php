<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 30-12-2016 16:00
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database;


use StendenINF1B\PortfolioCMS\Kernel\Database\ConnectionManager;

class ConnectionManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor(  )
    {
        $connectionManager = new ConnectionManager( true );
        $databaseConnection = $connectionManager->getConnection( $connectionManager::defaultDatabase );

        // Test constructor with auto loading connections.
        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\DatabaseConnection',
            $databaseConnection
        );

        $connectionManager = new ConnectionManager();
        // Test constructor without auto loading connections.
        $this->assertCount( 0, $connectionManager->getConnections() );
    }
    
}