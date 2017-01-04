<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 04-01-2017 14:20
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database\Helper;


use StendenINF1B\PortfolioCMS\Kernel\Helper\ConfigLoader;

class ConfigLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testController()
    {
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConfig.xml';
        $configLoader = new ConfigLoader( $fileName );

        $this->assertEquals( $fileName, $configLoader->getFilename() );

        $configLoader = new ConfigLoader();
        $this->assertEquals( CONFIG_FILE, $configLoader->getFilename() );
    }

    /**
     * Test the loading and parsing of an XML file to an SimpleXMLElement.
     */
    public function testLoadXMLFile()
    {
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConfig.xml';

        $configLoader = new ConfigLoader();
        $configLoader->loadXmlFile( $fileName );

        $simpleXMLFile = simplexml_load_file( $fileName );
        $this->assertEquals( $simpleXMLFile, $configLoader->getSimpleXmlObject() );
    }

    /**
     * Test the parsing of an XML string to an SimpleXMLElement.
     */
    public function testLoadXMLString()
    {
        $xmlData = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<configuration>

    <setting id="database">defaultConnection</setting>

</configuration>
XML;
        $configLoader = new ConfigLoader();

        $configLoader->loadXmlString( $xmlData );

        $simpleXMLFile = simplexml_load_string( $xmlData );
        $this->assertEquals( $simpleXMLFile, $configLoader->getSimpleXmlObject() );
    }

    /**
     * Test the converting of the SimpleXMLElement to an ParameterContainer.
     */
    public function testParseSimpleXMLToParameterContainer()
    {
        $configFileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConfig.xml';

        $configLoader = new ConfigLoader( $configFileName );

        // Test if it loaded the ParameterContainer.
        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Helper\\ParameterContainer',
            $configLoader->getConfigContainer( TRUE )
        );
    }
}