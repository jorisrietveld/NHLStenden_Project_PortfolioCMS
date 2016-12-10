<?php
/**
 * Author: Joris Rietveld <jorisrietveld@protonmail.com>
 * Date: 2-9-15 - 14:59
 */

namespace StendenINF1B\PortefolioCMS\Kernel\Database\Driver;

use DebugBar\StandardDebugBar;
use PDO;
use StendenINF1B\PortefolioCMS\Kernel\Helper\ParameterContainer;


/**
 * Class Driver
 *
 * @package CWDatabase\Drivers
 */
class Driver
{
    /**
     * This are the default \PDO connection options for opening an connection to the database.
     *
     * @var array
     */
    protected $options = [
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
        \PDO::ATTR_ORACLE_NULLS => \PDO::NULL_NATURAL,
        \PDO::ATTR_STRINGIFY_FETCHES => false,
    ];

    /**
     * Get all options configured to open an connection to the database And optionally add/chance other options with
     * the $config argument.
     *
     * @param array $config
     * @return array
     */
    public function getOptions( ParameterContainer $config )
    {
        $options = !empty( $config[ "options" ] ) ? $config[ "options" ] : [];

        return array_diff_key( $this->options, $options ) + $options;
    }

    /**
     * Attempt to open an connection to a database using \PDO and return an PDO instance.
     *
     * @param       $dsn
     * @param array $config
     * @param array $options
     * @return PDO
     */
    public function openConnection( $dsn, array $config, array $options )
    {
        $username = !empty( $config[ "username" ] ) ? $config[ "username" ] : "";
        $password = !empty( $config[ "password" ] ) ? $config[ "password" ] : "";

        return new \PDO( $dsn, $username, $password, $options );
    }

    /**
     * Set the default options for an database connection.
     *
     * @param array $options
     */
    public function setDefaultOptions( ParameterContainer $options )
    {
        $this->options = $options;
    }

    /**
     * Get the default database connection options.
     *
     * @return array
     */
    public function getDefaultOptions()
    {
        return $this->options;
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