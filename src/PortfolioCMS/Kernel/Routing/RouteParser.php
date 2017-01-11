<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 15:25
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Routing;


use StendenINF1B\PortfolioCMS\Kernel\Exception\ConfigurationErrorException;
use StendenINF1B\PortfolioCMS\Kernel\Exception\FileNotFoundException;
use StendenINF1B\PortfolioCMS\Kernel\Exception\XMLParserException;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class RouteParser
{
    const REGEX_PLACEHOLDER = '([\w]+)';
    const REGEX_SLASH = '\/';

    protected $filename;
    protected $simpleXMLObject;
    protected $routesContainer;

    public function __construct( string $routeConfigFile = null )
    {
        $this->filename = $routeConfigFile ?? ROUTE_CONFIG_FILE;
        $this->routesContainer = new ParameterContainer();
    }

    public function loadXml()
    {
        if ( file_exists( $this->filename ) )
        {
            $this->simpleXMLObject = simplexml_load_file( $this->filename );
        }
        else
        {
            throw new FileNotFoundException( sprintf( 'The routing configuration file is not found at location: %s.', $this->filename ) );
        }

        if ( !is_a( $this->simpleXMLObject, '\\SimpleXMLElement' ) )
        {
            throw new XMLParserException( sprintf( 'Can\'t parse the routing configuration file.' ) );
        }
    }

    public function getSimpleXmlObject() : \SimpleXMLElement
    {
        if ( $this->simpleXMLObject == null )
        {
            $this->loadXml();
        }

        return $this->simpleXMLObject;
    }

    public function getRoutes() : ParameterContainer
    {
        if ( count( $this->routesContainer ) < 1 )
        {
            $this->parseXmlToRoutes();
        }

        return $this->routesContainer;
    }

    public function parseXmlToRoutes()
    {
        foreach ($this->getSimpleXmlObject() as $route)
        {
            if ( empty( $route[ 'id' ] ) )
            {
                throw new ConfigurationErrorException( 'All configured routes must have an id.' );
            }
            if ( empty( $route[ 'path' ] ) )
            {
                throw new ConfigurationErrorException( 'All configured routes must have an path to.' );
            }

            $id = (string)$route[ 'id' ];
            $path = (string)$route[ 'path' ];

            if ( !empty( $route[ 'methods' ] ) )
            {
                $httpMethods = explode( '|', (string)$route[ 'methods' ] );
                $httpMethods = count( $httpMethods ) ? $httpMethods : [ ConfiguredRoute::DEFAULT_METHOD ];
            }
            else
            {
                $httpMethods = [ ConfiguredRoute::DEFAULT_METHOD ];
            }

            $authorization = $route['authorization'] ?? 'ANONYMOUS_USER';

            if ( empty( $route->action ) )
            {
                throw new ConfigurationErrorException( sprintf( 'You must supply an controller and action in an route configuration in route: %s', $id ) );
            }

            $parts = explode( ':', (string)$route->action );
            if ( count( $parts ) < 1 )
            {
                throw new ConfigurationErrorException( sprintf( 'The action is not valid from route: %s', $id ) );
            }
            $controller = $parts[ 0 ];
            $method = isset( $parts[ 1 ] ) ? $parts[ 1 ] : ConfiguredRoute::DEFAULT_ACTION;

            $configuredRoute = new ConfiguredRoute( $id, $path, $httpMethods, $controller, $method, (string)$authorization );

            $configuredRoute->setRegularExpressionPattern( $this->compileRouteToRegex( $path ) );
            $this->routesContainer->set( $configuredRoute->getPath(), $configuredRoute );
        }
    }

    public function compileRouteToRegex( string $url )
    {
        $url = str_replace( '/', '\/', $url );
        $searchPlaceholder = "/\{([\w\]]+)\}/";
        return '/'. preg_replace( $searchPlaceholder, self::REGEX_PLACEHOLDER, $url) . '$/';
    }
}