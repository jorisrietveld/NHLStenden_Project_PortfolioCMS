<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 23-12-2016 15:03
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database\Helper;


use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\DatabaseConfigurationContainer;

class DatabaseConfigurationContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testController()
    {
        $dbConfigContainer = new DatabaseConfigurationContainer( 'dbConn', [ 'foo' => 'bar' ] );

        $this->assertEquals( [ 'foo' => 'bar' ], $dbConfigContainer->all() );
        $this->assertEquals( 'dbConn', $dbConfigContainer->getConnectionName() );
    }

    public function testSetPdoOptions()
    {
        $dbConfigContainer = new DatabaseConfigurationContainer('dbConn');

        $pdoOptions = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $dbConfigContainer->setPdoOptions( $pdoOptions );

        $this->assertEquals( $pdoOptions, $dbConfigContainer->getPdoOptions()->all() );
    }
}