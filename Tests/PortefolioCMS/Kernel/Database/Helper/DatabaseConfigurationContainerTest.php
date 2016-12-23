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
    public function testController(  )
    {
        $dbConfigContainer = new DatabaseConfigurationContainer( [ 'foo' => 'bar' ] );
        $this->assertEquals( [ 'foo' => 'bar' ], $dbConfigContainer->all() );
    }
}