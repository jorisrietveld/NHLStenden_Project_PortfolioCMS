<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 02-12-2016 20:47
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Http\Session\Storage;

/**
 * TODO finish the session classes they don't work At the moment so don't use them!
 */
interface SessionContainerInterface
{
    /**
     * Sets the name of the session container.
     *
     * @param string $sessionName
     * @return mixed
     */
    public function setName( string $sessionName );

    /**
     * Gets the name of the session container.
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Sets the storage key.
     *
     * @param string $storageKey
     * @return mixed
     */
    public function setKey( string $storageKey );

    /**
     * Gets the storage key from the session container.
     *
     * @return string
     */
    public function getKey() : string;

    /**
     * Clears all the session data stored in the container.
     *
     * @return mixed
     */
    public function clear();

    /**
     * Initiates the parameters stored in the container.
     *
     * @param array $array
     * @return mixed
     */
    public function init( array $array );
}