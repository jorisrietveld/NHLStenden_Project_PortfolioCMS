<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 07-12-2016 09:28
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Http\Session\Handler;

/**
 * TODO finish the session classes they don't work At the moment so don't use them!
 */
/**
 * Class FileHandler
 *
 * @package HTTP\Session\Handler
 */
class FileHandler extends PHPDefaultSessionHandler
{
    /**
     * @return mixed
     */
    public function close()
    {
        // TODO: Implement close() method.
    }

    /**
     * @param string $session_id
     * @return mixed
     */
    public function destroy( $session_id )
    {
        // TODO: Implement destroy() method.
    }

    /**
     * @param int $maxlifetime
     * @return mixed
     */
    public function gc( $maxlifetime )
    {
        // TODO: Implement gc() method.
    }

    /**
     * @param string $save_path
     * @param string $name
     * @return mixed
     */
    public function open( $save_path, $name )
    {
        // TODO: Implement open() method.
    }

    /**
     * @param string $session_id
     * @return mixed
     */
    public function read( $session_id )
    {
        // TODO: Implement read() method.
    }

    /**
     * @param string $session_id
     * @param string $session_data
     * @return mixed
     */
    public function write( $session_id, $session_data )
    {
        // TODO: Implement write() method.
    }

}