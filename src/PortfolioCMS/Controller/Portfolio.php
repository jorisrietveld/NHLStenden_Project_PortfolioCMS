<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 13:30
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class Portfolio extends BaseController 
{
    public function index( Request $request = NULL, $arguments = NULL )
    {
        if( !empty( $arguments['url'] ) )
        {
            ob_start();
            dump($request);
            return new Response( '<h1>Portfolio van: ' . $arguments['url']. '</h1>'.ob_get_clean(), 200 );
        }
        return new Response( '<h1>Portfolio controller</h1>', 200 );
    }
}