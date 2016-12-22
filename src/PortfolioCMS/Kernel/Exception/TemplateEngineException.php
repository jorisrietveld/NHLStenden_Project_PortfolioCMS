<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 17:08
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Exception;


class TemplateEngineException extends \Exception
{
    /**
     * TemplateEngineException constructor.
     *
     * @param string     $message
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct( string $message = '', int $code = 0, \Exception $previous = NULL )
    {
        parent::__construct( $message, $code, $previous );
    }
}