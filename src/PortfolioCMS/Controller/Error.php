<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 13:13
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;


use Prophecy\Exception\Exception;
use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class Error extends BaseController 
{
    public function index(  )
    {
        
    }

    public function error400(  )
    {
        return new Response('<h1>Error 400</h1> De webpagina is niet gevonden!', Response::HTTP_STATUS_NOT_FOUND );
    }

    public function error500( Request $request, $arguments = NULL )
    {
        if( DEBUG && !empty( $arguments['exception'] ) )
        {
            ob_start();
            dump( $arguments['exception'] );
            $exception = ob_get_clean();
            return new Response(' <h1>Error 500</h1> An exception was thrown:'.$exception, Response::HTTP_STATUS_INTERNAL_SERVER_ERROR );
        }
        return new Response('<h1>Error 500</h1>Oops er ging iets mis... probeer later opnieuw', Response::HTTP_STATUS_INTERNAL_SERVER_ERROR );

    }
}