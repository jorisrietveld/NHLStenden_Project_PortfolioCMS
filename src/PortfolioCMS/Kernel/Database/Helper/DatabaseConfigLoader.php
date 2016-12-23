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
use StendenINF1B\PortfolioCMS\Kernel\Helper\ParameterContainer;

class DatabaseConfigLoader
{
    /**
     * @var string
     */
    protected $filename;

    /**
     * @var array
     */
    protected $databaseConfigurationContainers;

    /**
     * @var \SimpleXMLElement
     */
    protected $simpleXMLObject;

    /**
     * DatabaseConfigLoader constructor for initiating the database configuration loader.
     *
     * @param string|null $configFile
     */
    public function __construct( string $configFile = null )
    {
        $this->filename = $routeConfigFile ?? DATABASE_CONFIG_FILE;
        $this->databaseConfigContainers = [ ];
    }

    /**
     * Loads an xml database configuration file to a SimpleXMLElement so it ca be used to create an DatabaseConfigurationContainer.
     *
     * @throws FileNotFoundException
     * @throws XMLParserException
     */
    public function loadXmlFile( string $fileName = NULL )
    {
        if( $fileName !== NULL )
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
        if ( $this->simpleXMLObject == null )
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
    public function convertXMLTo( \SimpleXMLElement $databaseConfig = NULL )
    {
        if( $databaseConfig !== NULL )
        {
            $this->simpleXMLObject =  $databaseConfig;
        }

        // Iterate through the database connections.
        foreach ( $this->getSimpleXmlObject() as $databaseConnection )
        {
            $databaseConfigContainer = new DatabaseConfigurationContainer();

            if( empty( $databaseConnection[ 'name' ] ))
            {
                throw new ConfigurationErrorException( 'You must name the configured database connection' );
            }

            $databaseConfigContainer->setConnectionName( (string)$databaseConnection['name'] );

            // Iterate through database connection options.
            foreach ( $databaseConnection->option as $configOption )
            {
                if ( (string)$configOption[ 'id' ] !== 'pdo-options' )
                {
                    $databaseConfigContainer->set( (string)$configOption[ 'id' ], (string)$configOption );
                }
                else
                {
                    // Iterate through the pdo options
                    foreach ($configOption as $pdoOption)
                    {
                        $databaseConfigContainer->pdoOptions->set(
                            (string)$pdoOption['id'],
                            (string)$pdoOption
                        );
                    }
                }
            }
            // Add the new DatabaseConfigurationContainer to the
            $this->databaseConfigurationContainers[ $databaseConfigContainer->getConnectionName() ] = $databaseConfigContainer;
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
     * Gets the database configuration container that hol
     * @return DatabaseConfigurationContainer
     */
    public function getDatabaseConfigurationContainer(): DatabaseConfigurationContainer
    {
        return $this->databaseConfigurationContainer;
    }

    /**
     * @param DatabaseConfigurationContainer $databaseConfigurationContainer
     */
    public function setDatabaseConfigurationContainer( DatabaseConfigurationContainer $databaseConfigurationContainer )
    {
        $this->databaseConfigurationContainer = $databaseConfigurationContainer;
    }

}