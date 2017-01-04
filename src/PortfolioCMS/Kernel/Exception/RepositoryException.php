<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 21:45
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Exception;


class RepositoryException extends \Exception
{
    public function __construct( string $message = '', int $code = 0, \Exception $exception = NULL )
    {
        parent::__construct( $message, $code, $exception );
    }
}