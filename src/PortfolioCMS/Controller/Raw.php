<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-01-2017 16:57
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class Raw extends BaseController
{
    use SiteHelper;

    const DEFAULT_PORTFOLIO_PAGE = 'index';

    public function index( Request $request, $studentName = NULL, $portfolioPageName = NULL )
    {
        if ( DEBUG == FALSE )
        {
            return $this->redirect( '/401' );
        }

        if ( $studentName !== NULL )
        {
            $portfolioEntity = $this->getPortfolios()->getEntityWith( 'url', $studentName );
            if ( $portfolioEntity )
            {
                $portfolioPageName = $portfolioPageName ?? self::DEFAULT_PORTFOLIO_PAGE;

                ob_start();
                dump( $portfolioEntity );

                return new Response(
                    '<h1>Portfolio from:</h1>' . ob_get_clean(),
                    200
                );
            }
        }

    }
}