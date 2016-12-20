<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-12-2016 14:29
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Kernel\Routing;

use StendenINF1B\PortefolioCMS\Kernel\Http\Request;

class RouteMatcher
{
    protected $basePath;
    protected $url;
    protected $routeParser;
    protected $configuredRoutes;

    public function __construct(  )
    {
        $this->routeParser = new RouteParser();
        $this->configuredRoutes = $this->routeParser->getRoutes();
    }

    public function match( Request $request )
    {
        
    }

    public function parseUrlParts( Request $request )
    {
        $requestUri = str_replace( $request->getBasePath(), '/', $request->getRequestUri();
        $requestParts = explode( '/', $requestUri );

        if( count( $requestParts ) > 1 )
        {
            return
        }
        elseif( count( $requestParts ) === 1 )
        {
            return $this->configuredRoutes->has( $requestParts[0] ) ? $this->configuredRoutes->get( $requestParts[0] ) : $this->configuredRoutes->get( 'error400');
        }
        else
        {
            // no url given so match go to home
            return $this->configuredRoutes->get('home');
        }
        throw new \Exception('No route found!');
    }

    



}