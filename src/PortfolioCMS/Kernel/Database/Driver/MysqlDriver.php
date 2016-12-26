<?php
/**
 * Author: Joris Rietveld <jorisrietveld@protonmail.com>
 * Date: 2-9-15 - 19:06
 */

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Driver;

use PDO;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\DatabaseConfigurationContainer;
use StendenINF1B\PortfolioCMS\Kernel\Debug\Debug;
use StendenINF1B\PortfolioCMS\Kernel\Exception\DatabaseDriverException;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;


class MysqlDriver extends Driver implements DriverInterface
{
    /**
     * @var PDO The PHP data object connected to the MySQL server.
     */
    private $mysqlConnection;

    /**
     * @var DatabaseConfigurationContainer An conteiner containing connection parameters and PDO options.
     */
    protected $databaseConfig;

    /**
     * This method will open an connection to the MySQL server and initiate the settings defined in the config container.
     *
     * @param DatabaseConfigurationContainer $config
     * @return PDO
     */
    public function connect( DatabaseConfigurationContainer $config ) : \PDO
    {
        $dsn = $this->getDsn( $config );

        $this->mysqlConnection = $this->openConnection( $dsn, $config );

        // If the connection conects through an unix socket select the default database to use.
        if ( $config->has( 'unix_socket' ) )
        {
            $this->mysqlConnection->exec( sprinf( 'use `%s`;', $config->get('dbname') ));
        }

        if( $config->has( 'charset') )
        {
            $this->setCharset();
        }

        if ( $config->has('charset') )
        {
            $this->setCharset( );
        }

        if ( $config->has( 'timezone' ) )
        {
            $this->setTimezone( );
        }

        if ( $this->configHasStrict( ) )
        {
            $this->setStrict();
        }

        return $this->mysqlConnection;
    }

    /**
     * Sets default the charset and collation to an the MySQL database connection.
     */
    protected function setCharset( )
    {
        $setCharsetQuery = sprintf(
            'set names %s %s',
            $this->databaseConfig->get('charset'),
            ( $this->databaseConfig->has('collation') ? 'collation '. $this->databaseConfig->get('collation') : '' )
        );

        $this->mysqlConnection->prepare( $setCharsetQuery )->execute();
    }

    /**
     * Sets default the timezone to an the MySQL database connection.
     */
    protected function setTimezone( )
    {
        $setTimeZoneQuery = sprintf(
            'SET time_zone=\'%s\'',
            $this->databaseConfig->get('timezone', '')
        );

        $this->mysqlConnection->prepare( $setTimeZoneQuery )->execute();
    }

    /**
     * Sets MySQL database connection to strict mode.
     */
    protected function setStrict()
    {
        $this->mysqlConnection->prepare( "SET session sql_mode='STRICT_ALL_TABLES'" )->execute();
    }

    /**
     * Get the domain name string that can be passed in an PDO object for connecting to an mysql database.
     *
     * @param DatabaseConfigurationContainer $config
     * @throws DatabaseDriverException
     */
    public function getDsn( DatabaseConfigurationContainer $config )
    {
        if ( $config->has( 'host' ) )
        {
            // Generate an domain name string for an mysql connection with host configuration.
            $this->getDsnWithHostConfiguration( $config );
        }
        elseif ( $config->has( 'unix_socket' ) )
        {
            // Generate an Domain name string for mysql with unix socket configuration.
            $this->getDsnWithSocketConfiguration( $config );
        }
        else
        {
            // Missing crusial database configuration.
            throw new DatabaseDriverException( sprintf( 'Invalid configuration for %s connection. You should at least configure an hostname or unix socket to connect to an MySQL database.', $config->getConnectionName() ) );
        }
    }

    /**
     * Generate an domain name string based on unix socket configuration that can be passed in an PDO object for connecting to an MySQL database.
     *
     * @param DatabaseConfigurationContainer $config
     * @return string
     */
    protected function getDsnWithSocketConfiguration( DatabaseConfigurationContainer $config )
    {
        if ( !$config->has( 'dbname' ) )
        {
            throw new DatabaseDriverException( 'It is required to set an database name when connecting to an database with unix socket.' );
        }

        return sprinf( 'mysql:unix_socket=%s;dbname=%s;', $config->get( 'unix_socket' ), $config->get( 'dbname' ) );
    }

    /**
     * Generate an domain name string based on host configuration that can be passed in an PDO object for connecting to an MySQL database.
     *
     * @param DatabaseConfigurationContainer $config
     * @return string
     */
    protected function getDsnWithHostConfiguration( DatabaseConfigurationContainer $config )
    {
        $port = $config->has( 'port' ) ? sprintf( 'port=%s;', $config->get( 'port' ) ) : '';
        $dbname = $config->has( 'dbname=' ) ? sprintf( 'dbname=%s;', $config->get( 'dbname' ) ) : '';

        return sprinf( 'mysql:host=%s%s%s', $config->get( 'host' ), $port, $dbname );
    }
}