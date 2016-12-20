<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 16:05
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Kernel\Routing;


use StendenINF1B\PortefolioCMS\Kernel\Debug\Debug;
use StendenINF1B\PortefolioCMS\Kernel\Exception\ConfigurationErrorException;

class ConfiguredRoute
{
    const DEFAULT_ACTION = 'index';
    const DEFAULT_METHOD = 'GET';

    /**
     * The id of the route.
     * @var string
     */
    protected $id;

    /**
     * The full path with placeholders.
     * @var string
     */
    protected $fullPath;

    /**
     * The base path without the placeholders.
     * @var string
     */
    protected $basePath;

    /**
     * The allowed http methods.
     * @var array
     */
    protected $httpMethods;

    /**
     * The controller.
     * @var string
     */
    protected $controller;

    /**
     * The method.
     * @var string
     */
    protected $method;

    /**
     * The placeholders.
     * @var array
     */
    protected $placeHolders;

    public function __construct( string $id = '', string $fullPath = '', array $httpMethods = [ self::DEFAULT_METHOD ], string $controller = '', string $method = '')
    {
        $this->setId( $id );
        $this->setFullPath( $fullPath );
        $this->basePath = explode( '/', $fullPath )[1];
        $this->setHttpMethods( $httpMethods );

        $this->setController( $controller );
        $this->setMethod( $method );
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId( string $id  )
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->fullPath;
    }

    /**
     * @param string $fullPath
     */
    public function setFullPath( string $fullPath )
    {
        $this->fullPath = $fullPath;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath( string $basePath )
    {
        $this->basePath = $basePath;
    }

    /**
     * @return array
     */
    public function getHttpMethods(): array
    {
        return $this->httpMethods;
    }

    /**
     * @param array $methods
     */
    public function setHttpMethods( array $httpMethods )
    {
        $this->httpMethods = $httpMethods;
    }

    /**
     * @return string
     */
    public function getController(): string
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

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod( string $method )
    {
        $this->method = $method;
    }

    public function setPlaceholders(  )
    {
        
    }
}