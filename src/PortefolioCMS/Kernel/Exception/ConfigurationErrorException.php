<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 10-12-2016 16:23
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Kernel\Exception;


use Exception;

class ConfigurationErrorException extends \Exception
{
    /**
     * Initiate an new ConfigurationErrorException. This exception is for errors made in any configuration files.
     *
     * @link  http://php.net/manual/en/exception.construct.php
     * @param string    $message  [optional] The Exception message to throw.
     * @param int       $code     [optional] The Exception code.
     * @param Exception $previous [optional] The previous exception used for the exception chaining. Since 5.3.0
     */
    public function __construct( string $message = '', int $code = 0, Exception $previous = NULL )
    {
        parent::__construct( $message, $code, $previous );
    }

}