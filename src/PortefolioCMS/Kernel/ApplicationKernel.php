<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-12-2016 14:37
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Kernel;

use StendenINF1B\PortefolioCMS\Kernel\Http\Request;
use StendenINF1B\PortefolioCMS\Kernel\Http\Response;
use StendenINF1B\PortefolioCMS\Kernel\Routing\Route;
use StendenINF1B\PortefolioCMS\Kernel\Routing\RouteResolver;

class ApplicationKernel
{
    protected $request;
    protected $response;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->response = new Response();
    }

    /**
     *  Handle an incoming http request and return an appropriate response.
     *
     * @param Request $request
     * @return Response
     */
    public function handle( Request $request ) : Response
    {
        $this->setRequest( $request );

        $route = $this->resolveRoute();

        try
        {
            $this->callController( $route );
        }
        catch ( \Exception $exception )
        {
            $route = $this->resolveRoute( 'error500' );
            $this->callController( $route );
        }
        return $this->response;
    }

    /**
     * This method will call the controller matched by the route.
     *
     * @param $controller
     * @param $method
     * @return Response
     */
    protected function callController( Route $route ) : Response
    {
        $controller = '\\StendenINF1B\\PortefolioCMS\\Controller\\' . $route->getController();
        $controller = new $controller();

        $response = $controller->{$route->getMethod()}( $this->request, $route->getArguments() );

        if( is_a($response, 'StendenINF1B\PortefolioCMS\Kernel\Http\Response'))
        {
            $this->response = $response;
            return $this->response;
        }
        throw new \LogicException('The controller must return an Response object!');
    }

    /**
     * This Method will resolve the route to an controller based on the request.
     *
     * @param string $path
     * @return Route
     */
    protected function resolveRoute( string $path = NULL ) : Route
    {
        //$routerResolver = new RouteResolver();
        $path = $path ?? $this->request->getRequestUri();
        return new Route('index', '/', 'index', 'Home' ,[] );
        //return $routerResolver->resolve( $path );
    }

    /**
     * @return Request
     */
    public function getRequest() : Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest( Request $request )
    {
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function getResponse() : Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse( Response $response )
    {
        $this->response = $response;
    }
}