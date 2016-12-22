<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-09-2016 14:16
 */
declare(strict_types = 1);

namespace StendenINF1B\PortfolioCMS\Kernel\Helper;


use StendenINF1B\PortfolioCMS\Kernel\Exception\FileNotFoundException;
use StendenINF1B\PortfolioCMS\Http\ParameterContainer;

class ConfigLoader
{
    private $configDirectory;
    private $configContainer;

    private static $instance;

    const CONFIG_NAME = 'config.xml';

    /**
     * ConfigLoader constructor.
     * @param $configDir
     */
    public function __construct( $configDir = CONFIG_DIR )
    {
        $this->configDirectory = $configDir;
        $this->parseConfig();
    }

    /**
     * Get an specific key from the config.
     *
     * @param $key
     * @return mixed
     */
    public function get( string $key = '' )
    {
        $segments = explode( '.', $key );
        
        
        // TODO: implement an way to load config by dot separated values.
        return $this->configContainer->get( $key );
    }

    /**
     * Get all the configuration.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->configContainer;
    }

    /**
     * Set new configuration.
     * 
     * @param $item
     */
    public function set( Array $items = [] )
    {
        $this->configContainer->set( $items );
    }

    /**
     * This method will parse the configuration file in an php array.
     *
     * @return array
     * @throws FileNotFoundException
     */
    protected function parseConfig()
    {
        $fileName = $this->configDirectory . self::CONFIG_NAME;
        if( file_exists( $fileName ) )
        {
            // Use an hack to parse the xml file in an array.
            $configArray = (array) simplexml_load_file( $fileName );
            $configArray = count($configArray) ? $configArray : [];

            $this->configContainer = new ParameterContainer(  $configArray );
            return;
        }
        throw new FileNotFoundException( 'The configuration file: ' . $this->configDirectory .  ' can\'t be found');
    }


    /**
     * Singleton for getting this object.
     *
     * @return ConfigLoader
     */
    public static function getLoader() : self
    {
        if( self::$instance === NULL )
        {
            self::$instance = new self;
        }
        return self::$instance;
    }
}