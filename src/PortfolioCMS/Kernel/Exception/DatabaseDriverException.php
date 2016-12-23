<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 23-12-2016 13:32
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Exception;


class DatabaseDriverException extends \Exception
{
    public function __construct( string $message = '', int $code = 0, \Exception $previous = NULL )
    {
        parent::__construct( $message, $code, $previous );
    }
}