<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 11:34
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database\Repository;


use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;

class ImageRepositoryTest
{
    public function testGetById(  )
    {
        $entityManager = new EntityManager();

        $imageRepository = $entityManager->getRepository('Image');

        //$imageRepository->getById(1);


    }
}