<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 13:13
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Debug\Debug;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class Error extends BaseController 
{
    use SiteHelper;

    public function index(  )
    {
        return new Response(
            '<h1>Er ging iets mis... probeer later opnieuw</h1>',
            Response::HTTP_STATUS_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * This route will be be called when an route is not authorized on the server.
     *
     * @return Response
     */
    public function error401(  )
    {
        return new Response(
            $this->renderWebPage( 'site:error', [
                'errorMessage' => '<h1>Error 401</h1>U heeft niet de juiste authorizatie om deze pagina te bekijken<a href="home">hier</a> om terug te gaan naar home.'
            ] ),
            Response::HTTP_STATUS_UNAUTHORIZED
        );
    }

    /**
     * This route will be called when an route is not found on the server.
     *
     * @return Response
     */
    public function error404(  )
    {
        return new Response(
            $this->renderWebPage( 'site:error', [
                'errorMessage' => '<h1>Error 404</h1>De door u opgevraagde web pagina bestaat niet Klik <a href="home">hier</a> om terug te gaan naar home.'
            ] ),
            Response::HTTP_STATUS_NOT_FOUND
        );
    }

    /**
     * This route will be called when an exception was thrown.
     *
     * @param Request|null $request
     * @param null         $exception
     * @return Response
     */
    public function error500( Request $request = NULL, $exception = NULL )
    {
        if( DEBUG )
        {
            Debug::error( 'Error 500: Internal server error.' );

            if( $exception )
            {
                Debug::addException( $exception );

                // Render some styled exception info..
                ob_start();
                dump( $exception );
                $exception = ob_get_clean();
            }

            $debugBarRender = Debug::getDebugBar()->getJavascriptRenderer();

            return new Response(
                $debugBarRender->renderHead() .
                '<h1>Error 500</h1> An exception was thrown:'.$exception .
                $debugBarRender->render(),
                Response::HTTP_STATUS_INTERNAL_SERVER_ERROR
            );
        }
        return new Response(
            '<h1>Error 500</h1>Oops er ging iets mis... probeer later opnieuw. Klik <a href="home">hier</a> om terug te gaan naar home. ',
            Response::HTTP_STATUS_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * This route will be called when an HTTP method is not allowed for an route.
     *
     * @param Request|null $request
     * @return Response
     */
    public function error405( Request $request = NULL )
    {
        $method = $request ? $request->getMethod() : '';
        Debug::error( 'Error 405: HTTP method not allowed.' );

        return new Response(
            $this->renderWebPage( 'site:error', [
                'errorMessage' => sprintf( '<h1>Error 405</h1>HTTP methode %s niet toegestaan.</h1>', $method ),
            ] ),
            Response::HTTP_STATUS_METHOD_NOT_ALLOWED
        );
    }
}