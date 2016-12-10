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

    CONST VALID_HTTP_METHODS = [
        'GET',
        'POST',
        'PUT',
        'PATCH',
        'DELETE'
    ];

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
    protected $methods;

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

    public function __construct( string $id = '', string $fullPath = '', array $methods = [], string $controllerAction = '' )
    {
        $this->setId( $id );
        $this->setControllerAction( $controllerAction );
    }

    /**
     * This parses the configured controller:action
     *
     * @param string $controllerAction
     */
    public function setControllerAction( string $controllerAction )
    {
        if( !empty( $controllerAction ))
        {
            $parts = explode( ':', $controllerAction );

            if( count( $parts ) === 2 )
            {
                $this->setController( $parts[0] );
                $this->setMethod( $parts[1] );
            }
            elseif( count( $parts ) === 1 )
            {
                $this->setController( $parts[0] );
                $this->setMethod( self::DEFAULT_ACTION );
            }
            else
            {
                throw new ConfigurationErrorException( sprintf( 'The configuration of the route: %s is not correct. You must supply at least the name of the Controller', $this->id ) );
            }
        }
        else
        {
            Debug::notice( 'Empty controller and action configured in route with id %s', $this->getId() );
        }
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
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     */
    public function setMethods( array $methods )
    {
        $this->methods = $methods;
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
     * @return array
     */
    public function getPlaceHolders(): array
    {
        return $this->placeHolders;
    }

    /**
     * @param array $placeHolders
     */
    public function setPlaceHolders( array $placeHolders )
    {
        $this->placeHolders = $placeHolders;
    }




}