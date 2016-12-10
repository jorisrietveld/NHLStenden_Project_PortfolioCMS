<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 18-11-2016 19:43
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );
namespace StendenINF1B\PortefolioCMS\Kernel\Http\Header;


use StendenINF1B\PortefolioCMS\Kernel\Http\ParameterContainer;

/**
 * Class HeaderContainer
 *
 * @package StendenINF1B\PortefolioCMS\Kernel\Http\Header
 *          TODO replace this class.
 */

class HeaderContainer extends ParameterContainer
{
    protected $headers = [];
    protected $cacheControl = [];

    public function __construct( array $headers = [] )
    {
        parent::__construct();
        foreach ($headers as $headerKey => $headerValue)
        {
            $this->set( $headerKey, $headerValue );
        }

    }

    /**
     * Only get the first element from the header.
     *
     * @param string $headerKey
     * @param string $default
     * @return string
     */
    public function getFirst( string $headerKey, string $default = '' ) :string
    {
        $headerKey = str_replace( '_', '-', strtolower( $headerKey ) );

        // If there are no headers with the name of headerKey.
        if ( $this->has( $headerKey ) === false )
        {
            return (string)$default;
        }

        // TODO check if it will return an string.
        return count( $this->parameters[ $headerKey ] ) && !count( $this->parameters[ $headerKey ][ 0 ] ) ? (string)$this->parameters[ $headerKey ][ 0 ] : $default;
    }

    /**
     * Get all elements in an header.
     *
     * @param string $headerKey
     * @param string $default
     * @return array
     */
    public function get( string $headerKey, string $default = [] ) : array
    {
        $headerKey = str_replace( '_', '-', strtolower( $headerKey ) );

        if ( $this->has( $headerKey ) === false )
        {
            return is_array( $default ) ? $default : [ $default ];
        }

        $headerItems = $this->get( $headerKey );
        return is_array( $headerItems ) ? $headerItems : [ $headerItems ];
    }

    public function set( $key, $values, $replace = true )
    {
        $key = str_replace( '_', '-', strtolower( $key ) );

        $values = array_values( (array)$values );

        if ( true === $replace || !isset( $this->headers[ $key ] ) )
        {
            $this->headers[ $key ] = $values;
        }
        else
        {
            $this->headers[ $key ] = array_merge( $this->headers[ $key ], $values );
        }

        if ( 'cache-control' === $key )
        {
            $this->cacheControl = $this->parseCacheControl( $values[ 0 ] );
        }
    }

    /**
     * Returns true if the HTTP header is defined.
     *
     * @param string $key The HTTP header
     *
     * @return bool true if the parameter exists, false otherwise
     */
    public function has( $key ) : bool
    {
        return array_key_exists( str_replace( '_', '-', strtolower( $key ) ), $this->headers );
    }

    /**
     * Returns true if the given HTTP header contains the given value.
     *
     * @param string $key   The HTTP header name
     * @param string $value The HTTP value
     *
     * @return bool true if the value is contained in the header, false otherwise
     */
    public function contains( $key, $value )
    {
        return in_array( $value, $this->get( $key, '' ) );
    }

    /**
     * Removes a header.
     *
     * @param string $key The HTTP header name
     */
    public function remove( $key )
    {
        $key = str_replace( '_', '-', strtolower( $key ) );

        unset( $this->parameters[ $key ] );

        if ( 'cache-control' === $key )
        {
            $this->cacheControl = array();
        }
    }

    /**
     * Returns the HTTP header value converted to a date.
     *
     * @param string    $key     The parameter key
     * @param \DateTime $default The default value
     *
     * @return null|\DateTime The parsed DateTime or the default value if the header does not exist
     *
     * @throws \RuntimeException When the HTTP header is not parseable
     */
    public function getDate( $key, \DateTime $default = null )
    {
        if ( null === $value = $this->get( $key ) )
        {
            return $default;
        }

        if ( false === $date = \DateTime::createFromFormat( DATE_RFC2822, $value ) )
        {
            throw new \RuntimeException( sprintf( 'The %s HTTP header is not parseable (%s).', $key, $value ) );
        }

        return $date;
    }

    /**
     * Adds a custom Cache-Control directive.
     *
     * @param string $key   The Cache-Control directive name
     * @param mixed  $value The Cache-Control directive value
     */
    public function addCacheControlDirective( $key, $value = true )
    {
        $this->cacheControl[ $key ] = $value;

        $this->set( 'Cache-Control', $this->getCacheControlHeader() );
    }

    /**
     * Returns true if the Cache-Control directive is defined.
     *
     * @param string $key The Cache-Control directive
     *
     * @return bool true if the directive exists, false otherwise
     */
    public function hasCacheControlDirective( $key )
    {
        return array_key_exists( $key, $this->cacheControl );
    }

    /**
     * Returns a Cache-Control directive value by name.
     *
     * @param string $key The directive name
     *
     * @return mixed|null The directive value if defined, null otherwise
     */
    public function getCacheControlDirective( $key )
    {
        return array_key_exists( $key, $this->cacheControl ) ? $this->cacheControl[ $key ] : null;
    }

    /**
     * Removes a Cache-Control directive.
     *
     * @param string $key The Cache-Control directive
     */
    public function removeCacheControlDirective( $key )
    {
        unset( $this->cacheControl[ $key ] );

        $this->set( 'Cache-Control', $this->getCacheControlHeader() );
    }

    protected function getCacheControlHeader()
    {
        $parts = array();
        ksort( $this->cacheControl );
        foreach ($this->cacheControl as $key => $value)
        {
            if ( true === $value )
            {
                $parts[] = $key;
            }
            else
            {
                if ( preg_match( '#[^a-zA-Z0-9._-]#', $value ) )
                {
                    $value = '"' . $value . '"';
                }

                $parts[] = "$key=$value";
            }
        }

        return implode( ', ', $parts );
    }

    /**
     * Parses a Cache-Control HTTP header.
     *
     * @param string $header The value of the Cache-Control HTTP header
     *
     * @return array An array representing the attribute values
     */
    protected function parseCacheControl( $header )
    {
        $cacheControl = array();
        preg_match_all( '#([a-zA-Z][a-zA-Z_-]*)\s*(?:=(?:"([^"]*)"|([^ \t",;]*)))?#', $header, $matches, PREG_SET_ORDER );
        foreach ($matches as $match)
        {
            $cacheControl[ strtolower( $match[ 1 ] ) ] = isset( $match[ 3 ] ) ?
                $match[ 3 ] : ( isset( $match[ 2 ] ) ?
                    $match[ 2 ] : true );
        }

        return $cacheControl;
    }


}