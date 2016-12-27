<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 25-12-2016 17:37
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 *
 *  TODO create check for valid XML ROOT tags and DOCTYPE.
 */
declare( strict_types = 1 );

namespace Tests\PortefolioCMS\Kernel\Database\Helper;


use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\DatabaseConfigLoader;

class DatabaseConfigLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the controller works correct and sets the correct filename.
     */
    public function testController()
    {
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConfig.xml';
        $dbConfigLoader = new DatabaseConfigLoader( $fileName );

        $this->assertEquals( $fileName, $dbConfigLoader->getFilename() );

        $dbConfigLoader = new DatabaseConfigLoader();
        $this->assertEquals( DATABASE_CONFIG_FILE, $dbConfigLoader->getFilename() );
    }

    /**
     * Test the loading and parsing of an XML file to an SimpleXMLElement.
     */
    public function testLoadXMLFile()
    {
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConfig.xml';

        $configLoader = new DatabaseConfigLoader();
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
<databaseConnections>

    <databaseConnection name="testConnection">
        <option id="driver">mysql</option>
        <option id="host">10.20.30.40</option>
        <option id="port">3306</option>
        <option id="dbname">Test</option>
        <option id="user">root</option>
        <option id="password">toor</option>
        <option id="charset">UTF8</option>
        <option id="strict">1</option>
        <option id="pdo-options">
            <option id="\PDO::ATTR_EMULATE_PREPARES">FALSE</option>
            <option id="\PDO::ATTR_ERRMODE">\PDO::ERRMODE_EXCEPTION</option>
            <option id="\PDO::ATTR_CASE">\PDO::CASE_NATURAL</option>
            <option id="\PDO::ATTR_ORACLE_NULLS">\PDO::NULL_NATURAL</option>
            <option id="\PDO::ATTR_STRINGIFY_FETCHES">FALSE</option>
        </option>
    </databaseConnection>

    <databaseConnection name="secondTestConnection">
        <option id="driver">mssql</option>
        <option id="host">10.20.30.40</option>
        <option id="port">1800</option>
        <option id="dbname">Test</option>
        <option id="user">root</option>
        <option id="password">toor</option>
        <option id="charset">UTF8</option>
        <option id="strict">1</option>
        <option id="pdo-options">
            <option id="\PDO::ATTR_EMULATE_PREPARES">FALSE</option>
            <option id="\PDO::ATTR_ERRMODE">\PDO::ERRMODE_EXCEPTION</option>
            <option id="\PDO::ATTR_CASE">\PDO::CASE_NATURAL</option>
            <option id="\PDO::ATTR_ORACLE_NULLS">\PDO::NULL_NATURAL</option>
            <option id="\PDO::ATTR_STRINGIFY_FETCHES">FALSE</option>
        </option>
    </databaseConnection>

</databaseConnections>
XML;
        $configLoader = new DatabaseConfigLoader();

        $configLoader->loadXmlString( $xmlData );

        $simpleXMLFile = simplexml_load_string( $xmlData );
        $this->assertEquals( $simpleXMLFile, $configLoader->getSimpleXmlObject() );
    }

    /**
     * Test the converting of the SimpleXMLElement to an DatabaseConfig Object.
     */
    public function testParseSimpleXMLToDatabaseConfig()
    {
        $configFileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConfig.xml';

        $configLoader = new DatabaseConfigLoader( $configFileName );

        // Test if it loaded the 2 database containers.
        $this->assertCount( 2, $configLoader->getDatabaseConfigContainers( TRUE ) );

        // Test if it loaded the correct DatabaseConfigurationContainers.
        $this->assertInstanceOf(
            '\\StendenINF1B\\PortfolioCMS\\Kernel\\Database\\Helper\\DatabaseConfigurationContainer',
            $configLoader->getDatabaseConfigContainer( 'testConnection', TRUE )
        );
    }

    /**
     * Test the parsing php dataobject parameters.
     */
    public function testParsingPdoOptions()
    {
        $configFileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConfig.xml';
        $configLoader = new DatabaseConfigLoader( $configFileName );

        $dbConfigContainer = $configLoader->getDatabaseConfigContainer( 'testConnection', TRUE );

        $this->assertEquals( [
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
            \PDO::ATTR_ORACLE_NULLS => \PDO::NULL_NATURAL,
            \PDO::ATTR_STRINGIFY_FETCHES => false,
        ],
            $dbConfigContainer->pdoOptions->all()
        );
    }

    /**
     * Test the parsing of connection parameters.
     */
    public function testParsingConnectionParams(  )
    {
        $configFileName = __DIR__ . DIRECTORY_SEPARATOR . 'testConfig.xml';
        $configLoader = new DatabaseConfigLoader( $configFileName );

        $dbConfigContainer = $configLoader->getDatabaseConfigContainer( 'testConnection', TRUE );

        $this->assertEquals( 'mysql', $configLoader->getDatabaseConfigContainer( 'testConnection', TRUE )->get( 'driver', '' ) );
    }
}