<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 15:25
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Kernel\Routing;


use StendenINF1B\PortefolioCMS\Kernel\Exception\ConfigurationErrorException;
use StendenINF1B\PortefolioCMS\Kernel\Exception\FileNotFoundException;
use StendenINF1B\PortefolioCMS\Kernel\Exception\XMLParserException;
use StendenINF1B\PortefolioCMS\Kernel\Helper\ParameterContainer;

class RouteParser
{
    protected $filename;
    protected $simpleXMLObject;

    public function __construct( string $routeConfigFile = null )
    {
        $this->filename = $routeConfigFile ?? ROUTE_CONFIG_FILE;
    }

    public function loadXml(  )
    {
        if( file_exists( $this->filename ))
        {
            $this->simpleXMLObject = simplexml_load_file( $this->filename );
        }
        else
        {
            throw new FileNotFoundException( sprintf( 'The routing configuration file is not found at location: %s.', $this->filename ) );
        }

        if( !is_a(  $this->simpleXMLObject, '\\SimpleXMLElement' ))
        {
            throw new XMLParserException( sprintf( 'Can\'t parse the routing configuration file.' ) );
        }
    }

    public function getSimpleXmlObject(  ) : \SimpleXMLElement
    {
        return $this->simpleXMLObject;
    }

    public function createRoute(  )
    {
        
    }

    public function createRoutes(  )
    {
        
    }

    public function parseXmlToRoutes(  )
    {
        foreach ( $this->getSimpleXmlObject() as $route )
        {
            if( empty( $route['id'] ) )
            {
                throw new ConfigurationErrorException( 'All configured routes must have an id.' );
            }
            if( empty( $route['path'] ))
            {
                throw new ConfigurationErrorException( 'All configured routes must have an path to.' );
            }

            $id = (string)$route['id'];
            $path = (string)$route['path'];

            if( !empty( $route['methods'] ))
            {
                $methods = explode( '|', (string)$route['methods'] );
                $methods = count( $methods ) ? [ ConfiguredRoute::DEFAULT_METHOD ] : $methods;
            }
            else
            {
                $methods = [ ConfiguredRoute::DEFAULT_METHOD ];
            }

            if( empty( $route['']))


            $configuredRoute = new ConfiguredRoute( $id, $path, $methods,  );





        }
    }
}