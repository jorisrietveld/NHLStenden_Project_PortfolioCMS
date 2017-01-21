<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 13-01-2017 20:17
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Helper;

use StendenINF1B\PortfolioCMS\Kernel\Exception\ConfigurationErrorException;
use StendenINF1B\PortfolioCMS\Kernel\Exception\FileNotFoundException;
use StendenINF1B\PortfolioCMS\Kernel\Exception\XMLParserException;

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
     * @var FeedbackProvider
     */
    protected static $instance;

    /**
     * ConfigLoader constructor for initiating the feedback loader.
     *
     * @param string|null $configFile
     */
    public function __construct( string $feedbackFile = NULL )
    {
        $this->filename = $feedbackFile ?? FEEDBACK_CONFIG_FILE;
        $this->configContainer = new ParameterContainer();
    }

    /**
     * Loads an xml configuration file to a SimpleXMLElement so it ca be used to create an ParameterContainer.
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
            throw new FileNotFoundException( sprintf( 'The feedback file is not found at location: %s.', $this->filename ) );
        }

        if ( !is_a( $this->simpleXMLObject, '\\SimpleXMLElement' ) )
        {
            throw new XMLParserException( sprintf( 'Can\'t parse the feedback file.' ) );
        }
    }

    /**
     * Loads xml feedback to an SimpleXMLElement so it can be used to create an ParameterContainer.
     *
     * @param string $xmlConfig
     * @throws XMLParserException
     */
    public function loadXmlString( string $xmlConfig )
    {
        $this->simpleXMLObject = simplexml_load_string( $xmlConfig );

        if ( !is_a( $this->simpleXMLObject, '\\SimpleXMLElement' ) )
        {
            throw new XMLParserException( sprintf( 'Can\'t parse the feedback file.' ) );
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
    public function convertSimpleXMLToParameterContainer( \SimpleXMLElement $simpleXMLElement = NULL )
    {
        if ( $simpleXMLElement !== NULL )
        {
            $this->simpleXMLObject = $simpleXMLElement;
        }

        // Iterate through the database connections.
        foreach ($this->getSimpleXmlObject() as $configSetting)
        {
            if ( empty( $configSetting[ 'id' ] ) )
            {
                throw new ConfigurationErrorException( 'You must set an id in an feedback option.' );
            }

            $this->configContainer->set( (string)$configSetting[ 'id' ], (string)$configSetting );
        }
    }

    /**
     * Gets the file name of the  feedback file.
     *
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * Sets the file name of the feedback file.
     *
     * @param string $filename
     */
    public function setFilename( string $filename )
    {
        $this->filename = $filename;
    }

    /**
     * Gets the feedback container.
     *
     * @param $autoLoadXml bool Set this to to prevent the auto loading of the SimpleXMLFile.
     * @return array
     */
    public function getFeedbackContainer( $autoLoadXml = FALSE ): ParameterContainer
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
     * @param ParameterContainer $configContainer
     */
    public function setConfigContainer( ParameterContainer $configContainer )
    {
        $this->configContainer = $configContainer;
    }

    /**
     * Singleton access the feedback instance.
     */
    public static function getFeedbackInstance() : FeedbackProvider
    {
        if ( NULL == self::$instance )
        {
            self::$instance = new FeedbackProvider();
        }
        return self::$instance;
    }

    /**
     * Gets the feedback container.
     *
     * @param bool $autoloadXML
     * @return array|ParameterContainer
     */
    public static function getStaticFeedbackContainer( bool $autoloadXML = FALSE )
    {
        $feedbackProvider = self::getFeedbackInstance();

        if ( count( $feedbackProvider->getFeedbackContainer() ) < 1 || $autoloadXML === TRUE )
        {
            return $feedbackProvider->getFeedbackContainer( TRUE );
        }
        return $feedbackProvider->getFeedbackContainer();

    }

    public static function hasFeedback( $id ) : bool
    {
        return self::getStaticFeedbackContainer()->has( $id );
    }

    /**
     * @param string $id
     * @param array  $insertData
     */
    public static function getFeedback( string $id, array $insertData = [] )
    {
        extract( $insertData, EXTR_PREFIX_ALL, 'var' );

        if( self::hasFeedback( $id ) )
        {
            self::getStaticFeedbackContainer()->getString( $id );
        }
    }
}