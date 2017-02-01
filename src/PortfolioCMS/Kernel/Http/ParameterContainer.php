<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 18-11-2016 12:21
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );
namespace StendenINF1B\PortfolioCMS\Kernel\Http;

/**
 * Class ParameterContainer
 *
 * This class is for storing key/value parameters container.
 * It implements the \IteratorAggregate so you can use the parameter container in foreach loops and the \Countable so
 * you van use the count( ) function to count the amount of parameters stored in this container.
 *
 * @package HTTP
 */
class ParameterContainer implements \IteratorAggregate, \Countable, \ArrayAccess
{
    /**
     * Storage of the parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Initiates the parameter container with arguments passed in the constructor or an empty array.
     *
     * @param array $parameters
     */
    public function __construct( array $parameters = [] )
    {
        $this->parameters = $parameters;
    }

    /**
     * Get all the parameters stored in the container.
     *
     * @return array
     */
    public function all() : array
    {
        return $this->parameters;
    }

    /**
     * Adds parameters the the container and overwrites parameters if they already exist in the container.
     *
     * @param array $parameters
     */
    public function add( array $parameters = [] )
    {
        $this->parameters = array_replace( $this->parameters, $parameters );
    }

    /**
     * Set an new parameter to the container, override the parameter if it already exists.
     *
     * @param $key
     * @param $value
     */
    public function set( $key, $value )
    {
        $this->parameters[ $key ] = $value;
    }

    /**
     * Check if key exists in the container.
     *
     * @param $key
     * @return bool
     */
    public function has( $key ) : bool
    {
        return (bool)array_key_exists( $key, $this->parameters );
    }

    /**
     * Get an parameter from the parameter container or get the default if it does not exist.
     *
     * @param      $key
     * @param null $default
     * @return mixed|null
     */
    public function get( $key, $default = null )
    {
        return array_key_exists( $key, $this->parameters ) ? $this->parameters[ $key ] : $default;
    }

    /**
     * Remove an parameter from the container.
     *
     * @param $key
     */
    public function remove( $key )
    {
        unset( $this->parameters[ $key ] );
    }

    /**
     * Clears all parameters.
     */
    public function clear(  )
    {
        $this->parameters = [];
    }

    /**
     * Get all parameter keys from the container.
     *
     * @param null $searchValues
     * @return array
     */
    public function keys() : array
    {
        return array_keys( $this->parameters );
    }

    /**
     * Replace the current parameters stored in the container with an new set of parameters.
     *
     * @param array $parameters
     */
    public function replace( array $parameters = [] )
    {
        $this->parameters = $parameters;
    }

    /**
     * Filter an parameter from the container.
     *
     * @see filters <http://php.net/manual/en/filter.filters.php>
     * @see filter flags <http://php.net/manual/en/filter.filters.flags.php>
     *
     * @param       $key
     * @param null  $default the default return type if an key is not found.
     * @param int   $filter  The filter like: FILTER_VALIDATE_IP or FILTER_VALIDATE_EMAIL
     * @param array $options The filter flags like: FILTER_FLAG_IPV4 or FILTER_FLAG_IPV6
     * @return mixed
     */
    public function filter( $key, $default = null, $filter = FILTER_DEFAULT, $options = [] )
    {
        $value = $this->get( $key, $default );

        if ( !is_array( $options ) && $options )
        {
            $options = [
                'flags' => $options
            ];
        }

        if ( is_array( $value ) && !isset( $options[ 'flags' ] ) )
        {
            $options[ 'flags' ] = FILTER_REQUIRE_ARRAY;
        }

        return filter_var( $value, $filter, $options );
    }

    /**
     * Get an parameter value as an integer.
     *
     * @param     $key
     * @param int $default
     * @return int
     */
    public function getInt( $key, $default = 0 ) : int
    {
        return (int)$this->get( $key, $default );
    }

    /**
     * Get an parameter value as an boolean.
     *
     * @param      $key
     * @param bool $default
     * @return bool
     */
    public function getBoolean( $key, $default = false ) : bool
    {
        return $this->filter( $key, $default, FILTER_VALIDATE_BOOLEAN );
    }

    /**
     * Get an paramether value as an float
     * @param      $key
     * @param bool $default
     * @return bool
     */
    public function getFloat( $key, $default = 0.0 ) : float
    {
        return (float)$this->filter( $key, $default, FILTER_VALIDATE_FLOAT );
    }

    /**
     * Gets an parameter value as an string.
     *
     * @param        $key
     * @param string $default
     * @return string
     */
    public function getString( $key, $default = '' ) : string
    {
        return (string)$this->get( $key, $default );
    }

    /**
     * Gets an parameter value as an datetime.
     *
     * @param      $key
     * @param null $default
     * @return \DateTime
     */
    public function getDateTime( $key, $default = NULL ) : \DateTime
    {
        return new \DateTime( $this->get( $key, 'NOW' ));
    }

    /**
     * Add an element to the parameter container using array access.
     * Like $parameterContainer[] = value or $parameterContainer[ 'key' ] = value
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet( $key, $value )
    {
        $this->set( ( $key ?? 0 ), $value );
    }

    /**
     * Checks if an element exists in the parameter container when using array access.
     * like isset( $parameterContainer[ 'key' ] )
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists( $key )
    {
        return $this->has( $key );
    }

    /**
     * Unset an element from the parameter container when using array access.
     * Like unset( $parameterContainer[ 'key' ] )
     *
     * @param mixed $offset
     */
    public function offsetUnset( $key )
    {
        $this->remove( $key );
    }

    /**
     * Get an parameter from the container when using array access.
     * like echo $parameterContainer[ 'key' ]
     *
     * @param mixed $key
     * @return mixed|null
     */
    public function offsetGet( $key )
    {
        return $this->get( $key );
    }

    /**
     * Get an array iterator so you can iterate through the parameters stored in the parameter property.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator( $this->parameters );
    }

    /**
     * Count the amount of parameters stored in the container.
     * Implemented from the \Countable interface.
     *
     * @return int
     */
    public function count() : int
    {
        return count( $this->parameters );
    }
}