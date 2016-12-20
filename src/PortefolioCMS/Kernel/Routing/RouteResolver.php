<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 17-09-2016 19:10
 */
declare(strict_types = 1);

namespace StendenINF1B\PortefolioCMS\Kernel\Routing;

use StendenINF1B\PortefolioCMS\Kernel\Helper\ConfigLoader;

class RouteResolver
{
    private $routerConfiguration;
    private $hostConfiguration;

    public function __construct()
    {
        $this->routerConfiguration = ConfigLoader::getLoader()->get('route');
        $this->hostConfiguration = ConfigLoader::getLoader()->get('host');
    }

    /**
     * This method will return all the routes configuration.
     *
     * @return mixed
     */
    public function getRouterConfig()
    {
        return $this->routerConfiguration;
    }

    /**
     * This method will parse the config and look if the url matches an path in the config. Other wise it
     * wil match to the 404
     *
     * @param string $url
     * @return Route
     */
    public function resolve( string $url ) : Route
    {
        foreach ($this->routerConfiguration as $route )
        {
            if( $url == $this->selectHostConfiguration().(string)$route->path )
            {
                return new Route(
                    (string)$route->name,
                    (string)$route->path,
                    (string)$route->method,
                    (string)$route->controller,
                    (isset($route->httpMethod)? $route->httpMethod : 'GET')
                );
            }
        }

        return new Route(
            (string)$this->routerConfiguration[0]->name,
            (string)$this->routerConfiguration[0]->path,
            (string)$this->routerConfiguration[0]->method,
            (string)$this->routerConfiguration[0]->controller,
            (isset( $this->routerConfiguration[0]->httpMethod)? (string)$this->routerConfiguration[0]->httpMethod : 'GET')
            );
    }

    protected function selectHostConfiguration()
    {
        foreach ( $this->hostConfiguration as $host)
        {
            if( $host->hostname == $_SERVER['HTTP_HOST'] )
            {
                return $host->prefix;
            }
        }
    }
}