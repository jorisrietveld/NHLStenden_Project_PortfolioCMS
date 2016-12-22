<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-12-2016 14:37
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel;

use StendenINF1B\PortfolioCMS\Kernel\Debug\Debug;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;
use StendenINF1B\PortfolioCMS\Kernel\Routing\ConfiguredRoute;
use StendenINF1B\PortfolioCMS\Kernel\Routing\RouteMatcher;

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
            Debug::warning( 'An exception was thrown' );
            Debug::addException( $exception );

            // An exception was thrown so set the route to 500.
            $route = $this->resolveRoute( '500' );
            $route->setArguments( [ 'exception' => $exception ] );
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
    protected function callController( ConfiguredRoute $route ) : Response
    {
        Debug::debug( 'Call to controller: ' . $route->getController() );

        // Construct the controller that handles the request.
        $controller = '\\StendenINF1B\\PortfolioCMS\\Controller\\' . $route->getController();
        $controller = new $controller();

        // Call the method on the controller and pass it the arguments so we get an response.
        $response = $controller->{$route->getMethod()}( $this->request, ...array_values( $route->getArguments() ) );

        // Check if the controller returned an appropriate response.
        if( is_a($response, 'StendenINF1B\PortfolioCMS\Kernel\Http\Response'))
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
     * @return ConfiguredRoute
     */
    protected function resolveRoute( string $path = NULL ) : ConfiguredRoute
    {
        $routeMatcher = new RouteMatcher();

        if( $path === NULL )
        {
            return $routeMatcher->match( $this->request );
        }
        else
        {
            return $routeMatcher->getRouteForPath( $path );
        }
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