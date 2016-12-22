<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 07-12-2016 10:08
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Http\Session\Storage;


use StendenINF1B\PortfolioCMS\Kernel\Http\ParameterContainer;

class SessionAttributesContainer extends ParameterContainer implements SessionContainerInterface
{
    protected $name;
    protected $key;

    public function setName( string $sessionName )
    {
        $this->name = $sessionName;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $storageKey
     */
    public function setKey( string $storageKey )
    {
        $this->key = $storageKey;
    }

    /**
     * @return string
     */
    public function getKey() : string
    {
        return $this->key;
    }

    /**
     * @param array $array
     */
    public function init( array $array )
    {
        $this->replace( $array );
    }
}