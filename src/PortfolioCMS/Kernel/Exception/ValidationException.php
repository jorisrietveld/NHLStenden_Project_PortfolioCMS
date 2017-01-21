<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 20-01-2017 19:25
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Exception;

use Exception;

class ValidationException extends \Exception
{
    /**
     * Construct the exception. Note: The message is NOT binary safe.
     *
     * @link  http://php.net/manual/en/exception.construct.php
     * @param string    $message  [optional] The Exception message to throw.
     * @param int       $code     [optional] The Exception code.
     * @param Exception $previous [optional] The previous exception used for the exception chaining. Since 5.3.0
     * @since 5.1.0
     */
    public function __construct( string $message = '', int $code = 0, Exception $previous = NULL )
    {
        parent::__construct( $message, $code, $previous );
    }

}