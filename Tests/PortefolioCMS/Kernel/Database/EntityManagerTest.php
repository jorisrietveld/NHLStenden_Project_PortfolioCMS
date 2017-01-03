<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 11:18
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database;


use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;

class EntityManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor(  )
    {
        $entityManager = new EntityManager();

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\ConnectionManager',
            $entityManager->getConnectionManager()
        );
        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Helper\\ParameterContainer',
            $entityManager->getRepositories()
        );
    }

    public function testGetRepository(  )
    {
        $entityManager = new EntityManager();

        $imageRepository = $entityManager->getRepository( 'Image' );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Repository\\ImageRepository',
            $imageRepository
        );

    }

}