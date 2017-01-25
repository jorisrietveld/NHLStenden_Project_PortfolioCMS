<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 18:46
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Helper;

use StendenINF1B\PortfolioCMS\Kernel\Exception\ConfigurationErrorException;
use StendenINF1B\PortfolioCMS\Kernel\Exception\FileNotFoundException;
use StendenINF1B\PortfolioCMS\Kernel\Exception\XMLParserException;

class DatabaseConfigLoader
{
    /**
     * This holds the file name of the configuration file.
     *
     * @var string
     */
    protected $filename;

    /**
     * This holds an array with database connection containers.
     *
     * @var array
     */
    protected $databaseConfigContainers;

    /**
     * This holds an SimpleXMLElement parsed from the XML database configuration file.
     *
     * @var \SimpleXMLElement
     */
    protected $simpleXMLObject;

    /**
     * DatabaseConfigLoader constructor for initiating the database configuration loader.
     *
     * @param string|null $configFile
     */
    public function __construct( string $configFile = NULL )
    {
        $this->filename = $configFile ?? DATABASE_CONFIG_FILE;
        $this->databaseConfigContainers = [];
    }

    /**
     * Loads an xml database configuration file to a SimpleXMLElement so it ca be used to create an DatabaseConfigurationContainer.
     *
     * @throws FileNotFoundException
     * @throws XMLParserException
     */
    public function loadXmlFile( string $fileName = NULL )
    {
        if ( $fileName )
        {
            $this->setFilename( $fileName );
        }

        if ( file_exists( $this->filename ) )
        {
            $this->simpleXMLObject = simplexml_load_file( $this->filename );
        }
        else
        {
            throw new FileNotFoundException( sprintf( 'The database configuration file is not found at location: %s.', $this->filename ) );
        }

        if ( !is_a( $this->simpleXMLObject, '\\SimpleXMLElement' ) )
        {
            throw new XMLParserException( sprintf( 'Can\'t parse the database configuration file.' ) );
        }
    }

    /**
     * Loads xml database configuration to an SimpleXMLElement so it can be used to create an DatabaseConfigurationContainer.
     *
     * @param string $databaseConfiguration
     * @throws XMLParserException
     */
    public function loadXmlString( string $databaseConfiguration )
    {
        $this->simpleXMLObject = simplexml_load_string( $databaseConfiguration );

        if ( !is_a( $this->simpleXMLObject, '\\SimpleXMLElement' ) )
        {
            throw new XMLParserException( sprintf( 'Can\'t parse the database configuration file.' ) );
        }
    }

    /**
     * Gets the SimpleXMLElement.
     *
     * @return \SimpleXMLElement
     */
    public function getSimpleXmlObject() : \SimpleXMLElement
    {
        if ( $this->simpleXMLObject == NULL )
        {
            $this->loadXmlFile();
        }

        return $this->simpleXMLObject;
    }

    /**
     *
     * @param \SimpleXMLElement|null $databaseConfig
     * @throws ConfigurationErrorException
     */
    public function convertSimpleXMLToDatabaseContainer( \SimpleXMLElement $databaseConfig = NULL )
    {
        if ( $databaseConfig !== NULL )
        {
            $this->simpleXMLObject = $databaseConfig;
        }

        // Iterate through the database connections.
        foreach ($this->getSimpleXmlObject() as $databaseConnection)
        {
            if ( empty( $databaseConnection[ 'name' ] ) )
            {
                throw new ConfigurationErrorException( 'You must name the configured database connection' );
            }

            $databaseConfigContainer = new DatabaseConfigurationContainer( (string)$databaseConnection[ 'name' ] );

            // Iterate through database connection options.
            foreach ($databaseConnection->option as $configOption)
            {
                $count = 0;
                if ( (string)$configOption[ 'id' ] !== 'pdo-options' )
                {
                    $databaseConfigContainer->set( (string)$configOption[ 'id' ], (string)$configOption );
                }
                else
                {
                    // Iterate through the pdo options
                    foreach ($configOption as $pdoOption)
                    {
                        $count++;
                        $pdoOptionKey = (string)$pdoOption[ 'id' ];
                        $pdoOptionValue = (string)$pdoOption;

                        if ( defined( $pdoOptionKey ) && defined( $pdoOptionValue ) )
                        {
                            $databaseConfigContainer->pdoOptions->set(
                                constant( $pdoOptionKey ),
                                constant( $pdoOptionValue )
                            );
                        }
                        else
                        {
                            throw new ConfigurationErrorException( 'Invalid PDO configuration in database configuration file. Check the %s configured parameter.', $count );
                        }
                    }
                }
            }
            // Add the new DatabaseConfigurationContainer to the
            $this->setDatabaseConfigContainer( $databaseConfigContainer );
        }
    }

    /**
     * Gets the file name of the database configuration file.
     *
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * Sets the file name of the database configuration file.
     *
     * @param string $filename
     */
    public function setFilename( string $filename )
    {
        $this->filename = $filename;
    }

    /**
     * Gets the database configuration containers that hold connection information.
     *
     * @param $autoLoadXml bool Set this to to prevent the auto loading of the SimpleXMLFile.
     * @return array
     */
    public function getDatabaseConfigContainers( $autoLoadXml = FALSE ): array
    {
        if ( $autoLoadXml )
        {
            $this->convertSimpleXMLToDatabaseContainer();
        }

        return $this->databaseConfigContainers;
    }

    /**
     * Gets an single database configuration container.
     *
     * @param string $connectionName
     * @param        $autoLoadXml bool Set this to to prevent the auto loading of the SimpleXMLFile.
     * @return array|null
     */
    public function getDatabaseConfigContainer( string $connectionName, $autoLoadXml = FALSE ) : DatabaseConfigurationContainer
    {
        if ( $autoLoadXml )
        {
            $this->convertSimpleXMLToDatabaseContainer();
        }

        if ( !isset( $this->databaseConfigContainers[ $connectionName ] ) )
        {
            throw  new ConfigurationErrorException( sprintf( 'No database configuration found with connection name: %s', $connectionName ) );
        }

        return $this->databaseConfigContainers[ $connectionName ];
    }

    /**
     * Sets an array of database configuration containers, overwrites the current one if it exists.
     *
     * @param array $databaseConfigContainers
     */
    public function setDatabaseConfigContainers( array $databaseConfigContainers )
    {
        $this->databaseConfigContainers = $databaseConfigContainers;
    }

    /**
     *  Sets an single database configuration container.
     *
     * @param DatabaseConfigurationContainer $databaseConfigurationContainer
     */
    public function setDatabaseConfigContainer( DatabaseConfigurationContainer $databaseConfigContainer )
    {
        $this->databaseConfigContainers[ $databaseConfigContainer->getConnectionName() ] = $databaseConfigContainer;
    }

}