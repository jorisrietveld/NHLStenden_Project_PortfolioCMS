<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 07-12-2016 10:08
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Http\Session\Storage;


use StendenINF1B\PortefolioCMS\Http\ParameterContainer;

class SessionAttributesContainer extends ParameterContainer implements SessionContainerInterface
{
    
    public function setName( string $sessionName )
    {
        // TODO: Implement setName() method.
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        // TODO: Implement getName() method.
    }

    /**
     * @param string $storageKey
     */
    public function setKey( string $storageKey )
    {
        
    }

    /**
     * @return string
     */
    public function getKey() : string
    {
        // TODO: Implement getKey() method.
    }

    /**
     * @return mixed
     */
    public function clear()
    {
        // TODO: Implement clear() method.
    }

    /**
     * @param array $array
     * @return mixed
     */
    public function init( array $array )
    {
        // TODO: Implement init() method.
    }
}