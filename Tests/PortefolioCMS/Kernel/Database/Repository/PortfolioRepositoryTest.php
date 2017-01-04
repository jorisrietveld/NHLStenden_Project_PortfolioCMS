<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 04-01-2017 23:16
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database\Repository;


use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;

class PortfolioRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $entityManager = new EntityManager();
        $portfolio = $entityManager->getRepository( 'Portfolio' );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Repository\\PortfolioRepository',
            $portfolio
        );
    }

    public function testGetPortfolio()
    {
        $entityManager = new EntityManager();
        $portfolioRepository = $entityManager->getRepository( 'Portfolio' );

        $portfolio = $portfolioRepository->getById( 1 );

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Entity\\Portfolio',
            $portfolio
        );
    }

    public function testGetAllPortfolios()
    {
        $entityManager = new EntityManager();
        $portfolioRepository = $entityManager->getRepository( 'Portfolio' );

        $portfolio = $portfolioRepository->getAll();

        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Helper\\EntityCollection',
            $portfolio
        );
        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Entity\\Portfolio',
            $portfolio->get( 1, null )
        );
    }
}