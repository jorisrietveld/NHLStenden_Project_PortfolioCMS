<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 13:30
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\TemplateEngine\TemplateEngine;

class Portfolio extends BaseController 
{
    use SiteHelper;

    public function __construct( TemplateEngine $templateEngine = NULL, ConfigLoader $configLoader = NULL )
    {
        parent::__construct( $templateEngine, $configLoader );

    }

    public function index( Request $request = NULL, $studentName = NULL, $portfolioPageName = NULL )
    {
        if( $studentName !== NULL )
        {
            if( $this->getPortfolios()->getEntityWith( 'url', $studentName ) )
            {
                return new Response(
                    sprintf( '<h1>Portfolio from %s</h1>', $studentName),
                    200
                );
            }

        }
        else
        {
            // No name is set for the repository so redirect the user to home.
            $this->redirect( '/home' );
        }

        return new Response( '<h1>No Portfolio found!</h1>', 200 );
    }

}