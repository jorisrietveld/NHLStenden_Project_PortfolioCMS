<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 02-12-2016 21:12
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Http\Session\Storage;


use StendenINF1B\PortfolioCMS\Kernel\Http\ParameterContainer;

class SessionMetadataContainer extends ParameterContainer implements SessionContainerInterface
{
    protected $name = 'metadata';
    protected $storageKey;

    /**
     * SessionMetadataContainer constructor.
     *
     * @param string $storageKey
     */
    public function __construct( string $storageKey = 'metadata' )
    {
        $this->storageKey = $storageKey;

        // Initiate the parameter storage.
        parent::__construct([
            'created' => 0,
            'updated' => 0,
            'lifetime' => 0
        ]);
    }

    /**
     * Sets the name of the container.
     *
     * @param string $name
     */
    public function setName( string $name )
    {
        $this->name = $name;
    }

    /**
     * Get the name of the container.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Initialize the container.
     *
     * @param array $array
     */
    public function init( array $array )
    {
        $this->replace( $array );
    }

    /**
     * Sets the storage key.
     *
     * @param string $key
     */
    public function setKey( string $key )
    {
        $this->storageKey = $key;
    }

    /**
     * Gets the storage key.
     *
     * @return string
     */
    public function getKey() : string 
    {
        return $this->storageKey;
    }

}