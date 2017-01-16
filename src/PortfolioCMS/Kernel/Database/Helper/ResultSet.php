<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-01-2017 12:43
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Helper;

/**
 * Class ResultSet
 *
 * This is an helper class that will be used when fetching database results using PDOStatement::fetchObject( $thisClass ), or
 * PDOStatement->fetchAll( \PDO::FETCH_CLASS ) then this class will be returned containing some helper methods for
 * getting data in specific types.
 *
 * @package StendenINF1B\PortfolioCMS\Kernel\Database\Helper
 */
class ResultSet
{
    /**
     * Gets an column from an database ResultSet as an integer value.
     *
     * @param string $columnName
     * @return int
     * @throws \BadMethodCallException
     * @throws \InvalidArgumentException
     */
    public function getInt( string $columnName ) : int
    {
        if ( property_exists( $this, $columnName ) )
        {
            if ( ctype_digit( $this->$columnName ) || is_int( $this->$columnName ) )
            {
                return (int)$this->$columnName;
            }
            throw new \BadMethodCallException( 'Trying to get an database result as an integer from an column that does not contain an integer value.' );
        }
        throw new \InvalidArgumentException( sprintf( 'There is no column named %s in the database result set.', $columnName ) );
    }

    /**
     * Gets an column from an database ResultSet as an float value.
     *
     * @param string $columnName
     * @return int
     * @throws \BadMethodCallException
     * @throws \InvalidArgumentException
     */
    public function getFloat( string $columnName ) : float
    {
        if ( property_exists( $this, $columnName ) )
        {
            if ( (float)$this->$columnName == $this->$columnName )
            {
                return (float)$this->$columnName;
            }
            throw new \BadMethodCallException( 'Trying to get an database result as an float from an column that does not contain an float value.' );
        }
        throw new \InvalidArgumentException( sprintf( 'There is no column named %s in the database result set.', $columnName ) );
    }

    /**
     * Gets an column from an database ResultSet as an string value.
     *
     * @param string $columnName
     * @return int
     * @throws \BadMethodCallException
     * @throws \InvalidArgumentException
     */
    public function getString( string $columnName ) : string
    {
        if ( property_exists( $this, $columnName ) )
        {
            return (string)$this->$columnName;
        }
        throw new \InvalidArgumentException( sprintf( 'There is no column named %s in the database result set.', $columnName ) );
    }

    /**
     * Gets the ResultSet as an associate array.
     *
     * @return array
     */
    public function getAsArray() : array
    {
        return get_object_vars( $this );
    }

    /**
     * Gets an column from an database ResultSet as an DateTime object.
     *
     * @param string $columnName
     * @return \DateTime
     * @throws \BadMethodCallException
     * @throws \InvalidArgumentException
     */
    public function getDateTime( string $columnName ) : \DateTime
    {
        if ( property_exists( $this, $columnName ) )
        {
            try
            {
                return new \DateTime( $this->$columnName );
            }
            catch ( \Exception $e )
            {
                throw new \BadMethodCallException( 'Trying to get an database result as an \DateTime from an column that does not contain an valid date/time/datetime.' );
            }
        }
        throw new \InvalidArgumentException( sprintf( 'There is no column named %s in the database result set.', $columnName ) );
    }
}