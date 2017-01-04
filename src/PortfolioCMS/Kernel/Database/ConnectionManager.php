<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 03:32
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database;

use StendenINF1B\PortfolioCMS\Kernel\Database\Driver\DriverFactory;
use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\DatabaseConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;
use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class ConnectionManager
{
    /**
     * TODO remove hack and load the global config.
     */
    const defaultDatabase = 'jorisLocalhost';

    /**
     * @var ParameterContainer
     */
    protected  $openedConnections;

    /**
     * @var DriverFactory
     */
    protected $driverFactory;

    /**
     * @var DatabaseConfigLoader
     */
    protected $configLoader;

    /**
     * ConnectionManager constructor.
     *
     * @param bool $autoLoadConfig
     */
    public function __construct( bool $autoLoadConfig = FALSE, string $configFile = DATABASE_CONFIG_FILE )
    {
        $this->driverFactory = new DriverFactory();
        $this->configLoader = new DatabaseConfigLoader( $configFile );
        $this->openedConnections = new ParameterContainer();

        if( $autoLoadConfig )
        {
            $this->loadConnectionFromConfig();
        }
    }

    /**
     * Auto loads an connection from the configuration by name.
     *
     * @param string $connectionName
     */
    public function loadConnectionFromConfig( string $connectionName = '' )
    {
        if( $connectionName === '' )
        {
            $connectionName = (new ConfigLoader( CONFIG_FILE ) )->getConfigContainer( TRUE )->get('database','');
        }

        $databaseConfigContainer = $this->configLoader->getDatabaseConfigContainer( $connectionName, TRUE );
        $driver =  $this->driverFactory->createDriver( $databaseConfigContainer );

        $this->addConnection( $driver->connect( $databaseConfigContainer ));
    }

    /**
     * Auto loads all database connections from the configuration.
     *
     * @param $loadConnectionNames array Only load connections with the names or load everything if the array is empty.
     */
    public function loadConnectionsFromConfig( array $loadConnectionNames = [] )
    {
        $databaseConfigContainers = $this->configLoader->getDatabaseConfigContainers( TRUE );
        $restrictConnectionLoading = count( $loadConnectionNames ) > 0 ? TRUE : FALSE;

        foreach ( $databaseConfigContainers as $name => $container )
        {
            if( $restrictConnectionLoading )
            {
                if( in_array( $name, $loadConnectionNames, TRUE ) )
                {
                    $this->loadConnectionFromConfig( $name );
                }
            }
            else
            {
                $this->loadConnectionFromConfig( $name );
            }
        }
    }

    /**
     * Adds a new database connection to the connection manger, it will override connections with the same name.
     * 
     * @param DatabaseConnection $databaseConnection
     */
    public function addConnection( DatabaseConnection $databaseConnection )
    {
        $this->openedConnections->set( $databaseConnection->getName(), $databaseConnection );
    }

    /**
     * Get an single database connection.
     *
     * @param string $connectionName
     * @return DatabaseConnection
     */
    public function getConnection( string $connectionName = '' ): DatabaseConnection
    {
        if( $connectionName === '' )
        {
            $connectionName = (new ConfigLoader( CONFIG_FILE ) )->getConfigContainer( TRUE )->get('database','');
        }

        if( $this->openedConnections->has( $connectionName ) )
        {
            return $this->openedConnections->get( $connectionName );
        }
        else
        {
            throw new \LogicException( sprintf( 'There is no connection stored with the name: %s.', $connectionName ) );
        }
    }

    /**
     * Sets an new array of database connections.
     *
     * @param array $connections
     */
    public function setConnections( ParameterContainer $connections )
    {
        $this->openedConnections = $connections;
    }

    /**
     * Gets all the stored database connections.
     *
     * @return array
     */
    public function getConnections(  ): ParameterContainer
    {
        return $this->openedConnections;
    }
}