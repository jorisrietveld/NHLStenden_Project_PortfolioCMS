<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 26-12-2016 15:54
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database\Driver;


use StendenINF1B\PortfolioCMS\Kernel\Database\Driver\MysqlDriver;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\DatabaseConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Exception\DatabaseDriverException;

class MysqlDriverTest extends \PHPUnit_Framework_TestCase
{
    protected $configParser;

    public function __construct()
    {
        $this->configParser = new DatabaseConfigLoader( __DIR__ . DIRECTORY_SEPARATOR . 'testMysqlDriver.xml');

        // Initiate the config containers.
        $this->configParser->getDatabaseConfigContainers( TRUE );

        parent::__construct();
    }

    /*public function setUp(  )
    {
        $configParser = new DatabaseConfigLoader();
        $configParser->getDatabaseConfigContainers( TRUE );
    }*/

    public function testConstructor()
    {
        $mysqlDriver = new MysqlDriver();

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Driver\\MysqlDriver',
            $mysqlDriver
        );
    }

    public function testCreateDsn()
    {
        $mysqlDriver = new MysqlDriver();

        // Test default config
        $this->assertEquals(
            'mysql:host=10.20.30.40;',
            $mysqlDriver->getDsn( $this->configParser->getDatabaseConfigContainer( 'defaultMysqlConfig' ) )
        );

        // Test config with port
        $this->assertEquals(
            'mysql:host=10.20.30.40;port=3306;',
            $mysqlDriver->getDsn( $this->configParser->getDatabaseConfigContainer( 'defaultMysqlConfigWithPort' ) )
        );

        // Test config with database name.
        $this->assertEquals(
            'mysql:host=10.20.30.40;dbname=Test;',
            $mysqlDriver->getDsn( $this->configParser->getDatabaseConfigContainer( 'defaultMysqlConfigWithDbname' ) )
        );

        // Test config with database name and port.
        $this->assertEquals(
            'mysql:host=10.20.30.40;port=3306;dbname=Test;',
            $mysqlDriver->getDsn( $this->configParser->getDatabaseConfigContainer( 'defaultMysqlConfigWithDbnamePort' ) )
        );

        // Test config with socket configuration.
        $this->assertEquals(
            'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=Test;',
            $mysqlDriver->getDsn( $this->configParser->getDatabaseConfigContainer( 'socketMysqlConfig' ) )
        );

        try{
            $exception = NULL;
            $mysqlDriver->getDsn( $this->configParser->getDatabaseConfigContainer( 'wrongSocketMysqlConfig' ) );
        }
        catch ( DatabaseDriverException $databaseDriverException )
        {
            $exception = $databaseDriverException;
        }

        // Test an wrong socket configuration.
        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Exception\\DatabaseDriverException',
            $exception
        );
    }

    /**
     * Test the actual opening of an connection to an database.
     * You will need to first setup your database before you can test this.
     */
    public function testOpenConnection(  )
    {
        $mysqlDriver = new MysqlDriver();
        $configFileName = __DIR__.DIRECTORY_SEPARATOR.'testConnectConfig.xml';
        $dbConfig = (new DatabaseConfigLoader( $configFileName ) )->getDatabaseConfigContainer( 'testConnectConfig', TRUE );

        $connection = $mysqlDriver->connect( $dbConfig );
    }
}