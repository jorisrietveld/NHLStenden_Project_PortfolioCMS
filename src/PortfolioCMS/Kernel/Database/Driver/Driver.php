<?php
/**
 * Author: Joris Rietveld <jorisrietveld@protonmail.com>
 * Date: 2-9-15 - 14:59
 */

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Driver;

use PDO;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\DatabaseConfigurationContainer;
use StendenINF1B\PortfolioCMS\Kernel\Exception\DatabaseDriverException;


class Driver
{
    /**
     * This are the default PHP Data Object options for opening an connection to the database.
     *
     * @var array
     */
    protected $pdoOptions = [
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
        \PDO::ATTR_ORACLE_NULLS => \PDO::NULL_NATURAL,
        \PDO::ATTR_STRINGIFY_FETCHES => false,
    ];

    /**
     * Add a new pdo option or set it to a new value.
     *
     * @param $option
     * @param $value
     */
    public function addPdoOption( $option, $value )
    {
        $this->pdoOptions[ $option ] = $value;
    }

    /**
     * Add the pdo options from an database configuration container.
     *
     * @param DatabaseConfigurationContainer $config
     * @throws DatabaseDriverException
     */
    public function addPdoOptionsFromConfig( DatabaseConfigurationContainer $config )
    {
        foreach ( $config->getPdoOptions() as $setting => $value )
        {
            if( defined( $setting ) )
            {
                $this->addPdoOption( constant( $setting ), constant( $value ));
            }
            else
            {
                throw new DatabaseDriverException( sprintf( 'Bad configured PDO option: %s with value: %s', $setting, $value ) );
            }
        }
    }

    /**
     * Sets new php data object options.
     *
     * @param array $pdoOptions
     */
    public function setPdoOptions( array $pdoOptions )
    {
        $this->pdoOptions = $pdoOptions;
    }

    /**
     * Gets an php data object option.
     *
     * @param $key
     * @return array|mixed|null
     */
    public function getPdoOption( $key )
    {
        return isset( $this->pdoOptions[ $key ] ) ? $this->pdoOptions[ $key ] : NULL;
    }

    /**
     * Gets the all php data object Options.
     *
     * @return array
     */
    public function getPdoOptions( ) : array
    {
        return $this->pdoOptions;
    }

    /**
     * Attempt to open an connection to a database using \PDO and return an PDO instance.
     *
     * @param       $dsn
     * @param array $config
     * @param array $options
     * @return PDO
     */
    public function openConnection( string $dsn, DatabaseConfigurationContainer $config )
    {
        $this->setPdoOptions( $config->pdoOptions->all() );

        return new \PDO(
            $dsn,
            $config->get( 'username' ),
            $config->get( 'password' ),
            $this->getPdoOptions()
        );
    }

    /**
     * Set the default options for an database connection.
     *
     * @param array $options
     */
    public function setDefaultPdoOptions( array $pdoOptions )
    {
        $this->pdoOptions = $pdoOptions;
    }

    /**
     * Get the default database connection options.
     *
     * @return array
     */
    public function getDefaultPdoOptions() : array
    {
        return $this->pdoOptions;
    }

    /**
     * Get all the installed PDO drivers.
     *
     * @return array
     */
    public function getAvailablePdoDrivers()
    {
        return PDO::getAvailableDrivers();
    }
}