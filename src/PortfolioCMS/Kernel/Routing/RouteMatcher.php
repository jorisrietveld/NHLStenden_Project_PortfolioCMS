<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-12-2016 14:29
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Routing;

use StendenINF1B\PortfolioCMS\Kernel\Authorization\User as AuthorizedUser;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;

class RouteMatcher
{
    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var RouteParser
     */
    protected $routeParser;

    /**
     * @var \StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer
     */
    protected $configuredRoutes;

    /**
     * RouteMatcher constructor for initiating this object.
     */
    public function __construct()
    {
        $this->routeParser = new RouteParser();
        $this->configuredRoutes = $this->routeParser->getRoutes();
    }

    /**
     * Matches an request to an configured route.
     *
     * @param Request $request
     * @return ConfiguredRoute
     */
    public function match( Request $request ) : ConfiguredRoute
    {
        $route = $this->matchRouteUrl( $request );
        $route = $this->matchHttpMethod( $request, $route );
        return $this->matchAuthorization( $route );

    }

    /**
     * This method checks if the HTTP method from the request matches the Configured route.
     *
     * @param Request         $request
     * @param ConfiguredRoute $configuredRoute
     * @return ConfiguredRoute
     */
    public function matchHttpMethod( Request $request, ConfiguredRoute $configuredRoute ) : ConfiguredRoute
    {
        if( in_array( $request->getMethod(), $configuredRoute->getHttpMethods(), FALSE ) )
        {
            return $configuredRoute;
        }
        else
        {
            return $this->getRouteForPath( '/405' );
        }
    }

    public function matchAuthorization( ConfiguredRoute $configuredRoute ) : ConfiguredRoute
    {
        $authConsName = 'StendenINF1B\PortfolioCMS\Kernel\Authorization\User::'.$configuredRoute->getAuthorization();
        $authorizationValue = constant( $authConsName );
        if( isset( $_SESSION['authorizationLevel']) )
        {
            if( $authorizationValue <= $_SESSION['authorizationLevel'] )
            {
                return $configuredRoute;
            }
        }
        elseif( $authorizationValue == 0 )
        {
            return $configuredRoute;
        }
        return $this->getRouteForPath( '/login' );


    }

    /**
     * This method matches the Request to an ConfiguredRoute and returns the configured route.
     *
     * @param Request $request
     * @return ConfiguredRoute
     */
    public function matchRouteUrl( Request $request ): ConfiguredRoute
    {
        // Todo replace this line with the one commented out.
        $requestUri = str_replace( $request->getBasePath(), '/', $request->getRequestUri() );
        // $requestUri = $request->getBaseUrl();
        if( $requestUri === '/' )
        {
            return $this->configuredRoutes->get('/home');
        }

        foreach ( $this->configuredRoutes as $path => $configuredRoute )
        {
            $regex = $configuredRoute->getRegularExpressionPattern();

            if( preg_match( $regex, $requestUri, $matches ))
            {
                $route = $this->configuredRoutes->get( $path );
                unset( $matches[0] );
                $matches = array_values( $matches );
                $route->setArguments( $matches );
                return $route;
            }
        }
        return $this->configuredRoutes->get('/404');
    }

    /**
     * Gets an ConfiguredRoute that matches the path given as argument.
     *
     * @param string $path
     * @return ConfiguredRoute
     */
    public function getRouteForPath( string $path ) : ConfiguredRoute
    {
        if ( $this->configuredRoutes->has( $path ) )
        {
            return $this->configuredRoutes->get( $path );
        }
        else
        {
            return $this->configuredRoutes->get( '/404' );
        }
    }


}