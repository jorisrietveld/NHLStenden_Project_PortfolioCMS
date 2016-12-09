<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 02-12-2016 20:44
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Http\Session;

use StendenINF1B\PortefolioCMS\Http\Session\Storage\SessionContainerInterface;

/**
 * Interface SessionInterface
 *
 * @package HTTP\Session
 */
interface SessionInterface
{
    public function start() : bool;

    /**
     * Clear all session attributes, remove the cookie and clear the server side data.
     * @return bool
     */
    public function destroy() : bool;

    /**
     * Regenerate the session id and keep the data.
     * @return bool
     */
    public function regenerate() : bool;

    /**
     * Clear all session attributes.
     * @return mixed
     */
    public function clear();

    /**
     * Get an registered session data container.
     * @return mixed
     */
    public function getContainer() : SessionContainerInterface;

    /**
     * Register an new session data container to the session.
     * @param SessionContainerInterface $sessionContainer
     */
    public function registerContainer( SessionContainerInterface $sessionContainer );

    /**
     * Set the sessions id.
     * @param int $sessionId
     */
    public function setId( int $sessionId );

    /**
     * Get the sessions id.
     * @return int
     */
    public function getId() : int;

    /**
     * Set the sessions name.
     * @param string $sessionName
     * @return mixed
     */
    public function setName( string $sessionName );

    /**
     * Get the sessions name.
     * @return string
     */
    public function getName() : string ;

    /**
     * Check if the session has an attribute in the attributes container.
     * @param string $attributeKey
     * @return bool
     */
    public function has( string $attributeKey ) : bool ;

    /**
     * Get all the stored attributes from the session.
     * @return array
     */
    public function all() : array ;

    /**
     * Get an stored attribute from the session or the default return type.
     * @param string $attributeName
     * @param null   $default
     * @return mixed
     */
    public function get( string $attributeName, $default = null ) ;

    /**
     * Replace the stored attributes.
     * @param array $attributesArray
     * @return mixed
     */
    public function replace( array $attributesArray );

    /**
     * Remove an attribute from the session.
     * @param string $attributeKey
     * @return mixed
     */
    public function remove( string $attributeKey );

    /**
     * Get the metadata container from the session that contains some basic information about the session.
     * @return SessionMetadataContainer
     */
    public function getMetadata() : SessionMetadataContainer;

}