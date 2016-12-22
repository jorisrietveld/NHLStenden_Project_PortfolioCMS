<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 28-09-2016 13:09
 */
declare(strict_types = 1);

namespace StendenINF1B\PortfolioCMS\Kernel\Routing;


class Route
{
    private $name;
    private $path;
    private $method;
    private $controller;
    private $arguments;

    public function __construct( $name = 'index', $path = '/home', $method = 'index', $controller = 'Home', $arguments = [] )
    {
        $this->setName( $name );
        $this->setPath( $path );
        $this->setMethod( $method );
        $this->setController( $controller );
        $this->setArguments( $arguments );
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName( string $name )
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath( string $path )
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Route
     */
    public function setMethod( string $method ): Route
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return array
     */
    public function getArguments() : array
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     */
    public function setArguments( array $arguments )
    {
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getController() : string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController( string $controller )
    {
        $this->controller = $controller;
    }
}