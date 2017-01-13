<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 13-01-2017 20:17
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Helper;


class FeedbackProvider
{
    /**
     * @var string
     */
    protected $filename;

    /**
     * @var ParameterContainer
     */
    protected $configContainer;

    /**
     * @var \SimpleXMLElement
     */
    protected $simpleXMLObject;

    /**
     * ConfigLoader constructor for initiating the configuration loader.
     *
     * @param string|null $configFile
     */
    public function __construct( string $configFile = null )
    {
        $this->filename = $configFile ?? CONFIG_FILE;
        $this->configContainer = new ParameterContainer();
    }

    /**
     * Loads an xml configuration file to a SimpleXMLElement so it ca be used to create an ParameterContainer.
     *
     * @throws FileNotFoundException
     * @throws XMLParserException
     */
    public function loadXmlFile( string $fileName = null )
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
            throw new FileNotFoundException( sprintf( 'The configuration file is not found at location: %s.', $this->filename ) );
        }

        if ( !is_a( $this->simpleXMLObject, '\\SimpleXMLElement' ) )
        {
            throw new XMLParserException( sprintf( 'Can\'t parse the configuration file.' ) );
        }
    }

    /**
     * Loads xml configuration to an SimpleXMLElement so it can be used to create an ParameterContainer.
     *
     * @param string $xmlConfig
     * @throws XMLParserException
     */
    public function loadXmlString( string $xmlConfig )
    {
        $this->simpleXMLObject = simplexml_load_string( $xmlConfig );

        if ( !is_a( $this->simpleXMLObject, '\\SimpleXMLElement' ) )
        {
            throw new XMLParserException( sprintf( 'Can\'t parse the configuration file.' ) );
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
    public function convertSimpleXMLToParameterContainer( \SimpleXMLElement $simpleXMLElement = null )
    {
        if ( $simpleXMLElement !== null )
        {
            $this->simpleXMLObject = $simpleXMLElement;
        }

        // Iterate through the database connections.
        foreach ( $this->getSimpleXmlObject() as $configSetting )
        {
            if ( empty( $configSetting[ 'id' ] ) )
            {
                throw new ConfigurationErrorException( 'You must set an id in an configuration option.' );
            }

            $this->configContainer->set( (string)$configSetting[ 'id' ], (string)$configSetting );
        }
    }

    /**
     * Gets the file name of the  configuration file.
     *
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * Sets the file name of the configuration file.
     *
     * @param string $filename
     */
    public function setFilename( string $filename )
    {
        $this->filename = $filename;
    }

    /**
     * Gets the configuration container.
     *
     * @param $autoLoadXml bool Set this to to prevent the auto loading of the SimpleXMLFile.
     * @return array
     */
    public function getConfigContainer( $autoLoadXml = false ): ParameterContainer
    {
        if ( $autoLoadXml )
        {
            $this->convertSimpleXMLToParameterContainer();
        }

        return $this->configContainer;
    }


    /**
     *  Sets an configuration container.
     *
     * @param ParameterContainer $databaseConfigurationContainer
     */
    public function setConfigContainer( ParameterContainer $configContainer )
    {
        $this->configContainer = $configContainer;
    }
}