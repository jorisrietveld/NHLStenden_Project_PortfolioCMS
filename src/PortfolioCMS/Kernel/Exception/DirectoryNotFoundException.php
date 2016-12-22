<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 01-10-2016 01:00
 */
declare(strict_types = 1);

namespace StendenINF1B\PortfolioCMS\Kernel\Exception;


class DirectoryNotFoundException extends \Exception
{
    public function __construct( $message = '', $code = 0, \Exception $previous = NULL )
    {
        parent::__construct( $message, $code, $previous );
    }
}