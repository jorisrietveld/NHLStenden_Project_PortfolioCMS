<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-12-2016 14:29
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Routing;

use StendenINF1B\PortfolioCMS\Kernel\Http\Request;

class RouteMatcher
{
    protected $basePath;
    protected $url;
    protected $routeParser;
    protected $configuredRoutes;

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
        return $this->matchHttpMethod( $request, $route );

    }

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

    public function matchRouteUrl( Request $request ): ConfiguredRoute
    {
        $requestUri = str_replace( $request->getBasePath(), '/', $request->getRequestUri() );

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
                dump($route);
                return $route;
            }
        }
        return $this->configuredRoutes->get('/400');
    }

    public function getRouteForPath( string $path ) : ConfiguredRoute
    {
        if ( $this->configuredRoutes->has( $path ) )
        {
            return $this->configuredRoutes->get( $path );
        }
        else
        {
            return $this->configuredRoutes->get( '/400' );
        }
    }


}