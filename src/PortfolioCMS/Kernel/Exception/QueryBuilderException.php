<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 02-01-2017 14:59
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Exception;


class QueryBuilderException extends \Exception
{
    public function __construct( string $message = 'Query builder error.', int $code = 0, \Exception $previous = NULL )
    {
        parent::__construct( $message, $code, $previous );
    }
}