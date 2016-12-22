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
        $requestUri = str_replace( $request->getBasePath(), '/', $request->getRequestUri() );
        $requestParts = explode( '/', $requestUri );

        if( empty( $requestParts[0] ) )
        {
            unset( $requestParts[0] );
            $requestParts = array_values( $requestParts );
        }

        if ( count( $requestParts ) > 1 && !empty( $requestParts[ 0 ] ) )
        {
            if ( $this->configuredRoutes->has( $requestParts[ 0 ] ) )
            {
                $route = $this->configuredRoutes->get( $requestParts[ 0 ] );
                $route->setArguments( [ 'url' => $requestParts[ 1 ] ] );
                return $route;
            }
            else
            {
                return $this->configuredRoutes->get( '400' );
            }
        }
        elseif ( count( $requestParts ) === 1 && !empty( $requestParts[ 0 ] ) )
        {
            return $this->configuredRoutes->has( $requestParts[ 0 ] ) ? $this->configuredRoutes->get( $requestParts[ 0 ] ) : $this->configuredRoutes->get( '400' );
        }
        else
        {
            // no url given so match go to home
            return $this->configuredRoutes->get( 'home' );
        }
    }

    public function getRouteForPath( string $path ) : ConfiguredRoute
    {
        if ( $this->configuredRoutes->has( $path ) )
        {
            return $this->configuredRoutes->get( $path );
        }
        else
        {
            return $this->configuredRoutes->get( '400' );
        }
    }


}