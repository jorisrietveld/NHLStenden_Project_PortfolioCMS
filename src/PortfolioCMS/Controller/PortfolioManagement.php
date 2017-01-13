<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-01-2017 14:45
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Portfolio;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class PortfolioManagement extends BaseController 
{
    protected $requiredInsertFields = [
        'title',
        'url',
        'themeId',
        'userId',
    ];


    public function index( Request $request )
    {
        
    }

    public function remove( Request $request )
    {
        
    }

    public function insert( Request $request )
    {
        $postParams = $request->getPostParams();

        if( $this->checkPostParams( $postParams, $this->requiredInsertFields ))
        {
            $themeRepository = $this->getEntityManager()->getRepository( 'Theme' );
            $studentRepository = $this->getEntityManager()->getRepository( 'Student' );
            $portfolioRepository = $this->getEntityManager()->getRepository( 'Portfolio' );

            $newPortfolio = new Portfolio();
            $newPortfolio->setTitle( (string)$postParams->get( 'title') );
            $newPortfolio->setUrl( (string)$postParams->get( 'url' ) );
            $newPortfolio->setTheme( $themeRepository->getById( (int)$postParams->get( 'themeId' ) ) );
            $newPortfolio->setStudent( $studentRepository->getById( (int)$postParams->get( 'userId' ) ) );

            $portfolioRepository->insert( $newPortfolio );

            return new Response(
                $this->renderWebPage(
                    'admin:editPortfolio', [
                        'feedback' => 'Het porfolio is toegevoed.',
                    ]
                ),
                Response::HTTP_STATUS_OK
            );
        }
        else
        {

        }
    }

    public function edit( Request $request )
    {
        
    }
}