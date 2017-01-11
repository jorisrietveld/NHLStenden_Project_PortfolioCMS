<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 16:05
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Routing;


use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

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
    protected $path;

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
     * @var string
     */
    protected $authorization;

    /**
     * Arguments that need to be passed to the controller.
     * @var array
     */
    protected $arguments;

    /**
     * The compiled regex for matching this route.
     * @var string
     */
    protected $regularExpressionPattern;

    public function __construct( string $id = '', string $fullPath = '', array $httpMethods = [ self::DEFAULT_METHOD ], string $controller = '', string $method = '', string $authorization = 'ANONYMOUS_USER' )
    {
        $this->setId( $id );
        $this->setPath( $fullPath );
        $this->setHttpMethods( $httpMethods );

        $this->setController( $controller );
        $this->setMethod( $method );
        $this->setArguments( [] );
        $this->setAuthorization( $authorization );
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

    public function setRegularExpressionPattern( string $regularExpressionPattern )
    {
        $this->regularExpressionPattern = $regularExpressionPattern;
    }

    public function getRegularExpressionPattern(  )
    {
        return $this->regularExpressionPattern;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $fullPath
     */
    public function setPath( string $fullPath )
    {
        $this->path = $fullPath;
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

    /**
     * @param array $arguments
     */
    public function setArguments( array $arguments )
    {
        $this->arguments = $arguments;
    }

    /**
     * @param string $key
     * @param        $argument
     */
    public function addArgument( string $key, $argument )
    {
        $this->arguments[ $key ] = $argument;
    }

    /**
     * @return array
     */
    public function getArguments(  )
    {
        return $this->arguments;
    }

    /**
     * @return string
     */
    public function getAuthorization(): string
    {
        return $this->authorization;
    }

    /**
     * @param string $authorization
     */
    public function setAuthorization( string $authorization )
    {
        $this->authorization = $authorization;
    }


}